<?php
declare(strict_types=1);

namespace Sokil\IsoCodes;

/**
 * Abstract collection of ISO entries loaded from single file
 */
abstract class AbstractNotPartitionedDatabase extends AbstractDatabase
{
    /**
     * Index to search by entry field's values
     *
     * @var object[][]
     */
    private $index;

    /**
     * List of entry fields to be indexed and searched.
     * May be override in child classes to search by indexed fields.
     *
     * @return mixed[]
     */
    protected function getIndexDefinition(): array
    {
        return [];
    }

    /**
     * @return mixed[]
     *
     * @throws \InvalidArgumentException If no index found in database
     */
    private function getIndex(string $indexedFieldName): array
    {
        // build index
        if ($this->index === null) {
            // init empty index
            $this->index = [];

            // get index definition
            $indexedFields = $this->getIndexDefinition();

            // build index for database
            if (!empty($indexedFields)) {
                // init all defined indexes
                foreach ($this->getClusterIndex() as $entryArray) {
                    $entry = $this->arrayToEntry($entryArray);
                    foreach ($indexedFields as $indexName => $indexDefinition) {
                        if (is_array($indexDefinition)) {
                            // compound index

                            // iteratively create hierarchy of array indexes
                            $reference = &$this->index[$indexName];
                            foreach ($indexDefinition as $indexDefinitionPart) {
                                if (is_array($indexDefinitionPart)) {
                                    // limited length of field
                                    $indexDefinitionPartValue = substr(
                                        $entryArray[$indexDefinitionPart[0]],
                                        0,
                                        $indexDefinitionPart[1]
                                    );
                                } else {
                                    $indexDefinitionPartValue = $entryArray[$indexDefinitionPart];
                                }
                                if (!isset($reference[$indexDefinitionPartValue])) {
                                    $reference[$indexDefinitionPartValue] = [];
                                }
                                $reference = &$reference[$indexDefinitionPartValue];
                            }

                            // add value
                            $reference = $entry;
                        } else {
                            // single index
                            $indexName = $indexDefinition;
                            // skip empty field
                            if (empty($entryArray[$indexDefinition])) {
                                continue;
                            }
                            // add to indexUA
                            $this->index[$indexName][$entryArray[$indexDefinition]] = $entry;
                        }
                    }
                }
            }
        }

        // get index
        if (!isset($this->index[$indexedFieldName])) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Unknown index "%s" in database "%s"',
                    $indexedFieldName,
                    get_class()
                )
            );
        }

        return $this->index[$indexedFieldName];
    }

    /**
     * @param string|int $fieldValue
     *
     * @return object|mixed[]|null
     */
    protected function find(string $indexedFieldName, $fieldValue)
    {
        $fieldIndex = $this->getIndex($indexedFieldName);

        return $fieldIndex[$fieldValue] ?? null;
    }
}