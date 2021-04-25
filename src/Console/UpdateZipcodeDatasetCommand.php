<?php declare(strict_types=1);

namespace Wnx\SwissCantons\Console;

use League\Csv\Exception;
use League\Csv\InvalidArgument;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\TabularDataReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateZipcodeDatasetCommand extends Command
{
    public const PATH_TO_CSV = __DIR__ . '/../data/zipcodes.csv';
    public const PATH_TO_JSON = __DIR__ . '/../data/zipcodes.json';

    protected function configure(): void
    {
        $this
            ->setName('update-zipcode-dataset')
            ->setDescription('Fetch dataset from Swiss Post and create zipcodes.json file');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     * @throws InvalidArgument
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('🚧  Fetch dataset');
        $this->fetchDataset();

        $output->writeln('🔮  Create zipcodes.json');
        $records = $this->parseCsvDataset();
        $this->generateZipcodesFiles($records);

        $output->writeln('🧹  Cleanup');
        $this->cleanup();

        $output->writeln('🏁  Finished');

        return 0;
    }

    protected function fetchDataset(): void
    {
        $urlToDataset = "https://swisspost.opendatasoft.com/explore/dataset/plz_verzeichnis_v2/download/?format=csv&timezone=Europe/Berlin&lang=de&use_labels_for_header=true&csv_separator=%3B";

        $response = file_get_contents($urlToDataset);

        file_put_contents(self::PATH_TO_CSV, $response);
    }

    /**
     * @return TabularDataReader
     * @throws Exception
     * @throws InvalidArgument
     */
    protected function parseCsvDataset(): TabularDataReader
    {
        $csv = Reader::createFromPath(self::PATH_TO_CSV);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        return Statement::create()
            ->where(fn ($record) => $record['KANTON'] !== 'FL')
            ->process($csv);
    }

    /**
     * @param TabularDataReader $records
     */
    protected function generateZipcodesFiles(TabularDataReader $records): void
    {
        $data = [];

        foreach ($records as $zipcodeRecord) {
            $data[] = [
                'city' => $zipcodeRecord['ORTBEZ27'],
                'zipcode' => (int) $zipcodeRecord['POSTLEITZAHL'],
                'canton' => $zipcodeRecord['KANTON'],
            ];
        }

        file_put_contents(self::PATH_TO_JSON, json_encode($data, JSON_PRETTY_PRINT));
    }

    protected function cleanup(): void
    {
        unlink(self::PATH_TO_CSV);
    }
}
