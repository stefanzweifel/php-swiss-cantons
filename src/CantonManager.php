<?php

namespace Wnx\SwissCantons;

use Illuminate\Support\Collection;
use Exception;

class CantonManager
{
    /**
     * CantonSearch Instance
     * @var Wnx\SwissCantons\CantonSerach
     */
    protected $search;

    public function __construct()
    {
        $this->search = new CantonSearch;
    }

    public function getByAppreviation($abbreviation)
    {
        $result = $this->search->findByAppreviation($abbreviation);

        if (is_null($result)) {
            throw new Exception("Couldn't find Canton for appreviation");
        }

        return new Canton($result);
    }

    public function getByName($name)
    {
        $result = $this->search->findByName($name);

        if (is_null($result)) {
            throw new Exception("Couldn't find Canton for given Name {$name}");
        }

        return new Canton($result);
    }

}
