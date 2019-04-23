<?php
declare(strict_types=1);

namespace Sokil\IsoCodes;

/**
 * Abstract collection of ISO entries loaded from single file
 */
abstract class AbstractNotPartitionedDatabase extends AbstractDatabase
{
    public function __construct(?string $baseDirectory = null)
    {
        parent::__construct($baseDirectory);

        // initialise cluster index
        $databaseFilePath = $this->baseDirectory . self::DATABASE_PATH . '/iso_' . $this->getISONumber() . '.json';
        $this->loadClusterIndex($databaseFilePath);
    }

    /**
     * Build cluster index for iteration
     *
     * @throws \Exception
     */
    private function loadClusterIndex(string $databaseFile): void
    {
        $isoNumber = $this->getISONumber();

        // load database from json file
        $json = \json_decode(
            file_get_contents($databaseFile),
            true
        );

        // build cluster index from database
        $this->clusterIndex = $json[$isoNumber];
    }
}