<?php declare(strict_types=1);

namespace Wnx\SwissCantons\Console;

use League\Csv\Exception;
use League\Csv\InvalidArgument;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\TabularDataReader;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use ZipArchive;

class UpdateZipcodeDatasetCommand extends Command
{
    final public const PATH_TO_CSV = __DIR__ . '/../data/cities.csv';
    final public const PATH_TO_JSON = __DIR__ . '/../data/cities.json';

    private HttpClientInterface $httpClient;

    public function __construct(?HttpClientInterface $httpClient = null)
    {
        parent::__construct();
        $this->httpClient = $httpClient ?? HttpClient::create();
    }

    protected function configure(): void
    {
        $this
            ->setName('update-cities-dataset')
            ->setDescription('Fetch dataset from Swiss Post and create cities.json file');
    }

    /**
     * @throws Exception
     * @throws InvalidArgument
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('🚧  Fetch dataset');
        $this->fetchDataset();

        $output->writeln('🔮  Create cities.json');
        $records = $this->parseCsvDataset();
        $this->generateZipcodesFiles($records);

        $output->writeln('🧹  Cleanup');
        $this->cleanup();

        $output->writeln('🏁  Finished');

        return 0;
    }

    /**
     * @return void
     * @throws \Throwable
     */
    protected function fetchDataset(): void
    {
        $urlToDataset = "https://data.geo.admin.ch/ch.swisstopo-vd.ortschaftenverzeichnis_plz/ortschaftenverzeichnis_plz/ortschaftenverzeichnis_plz_2056.csv.zip";

        $response = $this->httpClient->request('GET', $urlToDataset);

        // Check for successful response (200 OK)
        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException("Failed to download file. Status code: " . $response->getStatusCode());
        }

        // Open the destination file for writing in binary mode
        $fileHandler = fopen('/tmp/dataset.zip', 'wb');
        if (!$fileHandler) {
            throw new RuntimeException("Failed to open file for writing: '/tmp/dataset.zip'");
        }

        foreach ($this->httpClient->stream($response) as $chunk) {
            fwrite($fileHandler, $chunk->getContent());
        }

        fclose($fileHandler);

        $zip = new ZipArchive();
        $res = $zip->open('/tmp/dataset.zip');
        if ($res) {
            $zip->extractTo('/tmp/extracted_dataset');
            $zip->close();
        }

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator('/tmp/extracted_dataset'),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && pathinfo($file->getPathname(), PATHINFO_EXTENSION) === 'csv') {
                $destinationFile = self::PATH_TO_CSV;
                if (!rename($file->getPathname(), $destinationFile)) {
                    // Handle potential errors during move operation
                    throw new \Exception("Error moving file: " . $file->getPathname());
                }
            }
        }
    }

    /**
     * @throws Exception
     * @throws InvalidArgument
     */
    protected function parseCsvDataset(): TabularDataReader
    {
        $csv = Reader::createFromPath(self::PATH_TO_CSV);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        return Statement::create()
            ->where(fn ($record) => $record['Kantonskürzel'] !== '')
            ->process($csv);
    }

    protected function generateZipcodesFiles(TabularDataReader $records): void
    {
        $data = [];

        foreach ($records as $zipcodeRecord) {
            $data[] = [
                'city' => $zipcodeRecord['Gemeindename'],
                'zipcode' => (int) $zipcodeRecord['PLZ'],
                'canton' => $zipcodeRecord['Kantonskürzel'],
            ];
        }

        file_put_contents(self::PATH_TO_JSON, json_encode($data, JSON_PRETTY_PRINT));
    }

    protected function cleanup(): void
    {
        unlink('/tmp/dataset.zip');
        unlink(self::PATH_TO_CSV);
    }
}
