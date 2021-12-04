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
     * {indexedFieldName => {indexedFieldValue => entryObject}}
     *
     * @psalm-var Array<string, Array<string, object>>
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

    private function buildIndex(): void
    {
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

    /**
     * @return mixed[]
     *
     * @throws \InvalidArgumentException If no index found in database
     */
    private function getIndex(string $indexedFieldName): array
    {
        // build index
        if ($this->index === null) {
            $this->buildIndex();
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
     * @param string $indexedFieldName
     * @param string $fieldValue
     *
     * @return null|object|object[] null when not found, object when found by single-field index,
     *         object[] when found by compound index
     */
    protected function find(string $indexedFieldName, string $fieldValue)
    {
        $fieldIndex = $this->getIndex($indexedFieldName);

        return $fieldIndex[$fieldValue] ?? null;
    }
}
