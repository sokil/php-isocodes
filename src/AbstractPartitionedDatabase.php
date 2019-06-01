<?php
declare(strict_types=1);

namespace Sokil\IsoCodes;

/**
 * Abstract collection of ISO entries loaded from separate files
 */
abstract class AbstractPartitionedDatabase extends AbstractDatabase
{
    /**
     * @param string $fileName File name of partition without extension
     *
     * @return array
     */
    protected function loadFromJSONFile(string $fileName) : array
    {
        $pathToPartitionFile = sprintf(
            '%s/iso_%s/%s.json',
            $this->getDatabasesPath(),
            $this->getISONumber(),
            $fileName
        );

        if (!file_exists($pathToPartitionFile)) {
            return [];
        }

        return \json_decode(
            \file_get_contents($pathToPartitionFile),
            true
        );
    }
}