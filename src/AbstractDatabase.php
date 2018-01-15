<?php

namespace Sokil\IsoCodes;

/**
 * Abstract collection of ISO entries
 */
abstract class AbstractDatabase implements \Iterator, \Countable
{
    /**
     * Path to ISO databases
     */
    const DATABASE_PATH = '/../databases';

    /**
     * Path to gettext localised messages
     */
    const MESSAGES_PATH = '/../messages';

    /**
     * Cluster index used for iteration by entries
     *
     * @var array[]
     */
    private $clusterIndex;

    /**
     * Index to search by entry field's values
     *
     * @var array
     */
    private $index;

    public function __construct()
    {
        $this->loadDatabase($this->getDatabaseFilePath());
    }

    /**
     * ISO Standard Number
     *
     * @return string
     *
     * @throws \Exception
     */
    public static function getISONumber()
    {
        // abstract static methods not allowed on PHP < 7.0
        throw new \Exception(
            sprintf(
                'Method "%s" must be implemented in class %s',
                __METHOD__,
                get_class()
            )
        );
    }

    /**
     * @param array $entry
     *
     * @return object
     */
    abstract protected function arrayToEntry(array $entry);

    /**
     * List of entry fields to be indexed and searched.
     * May be override in child classes to search by indexed fields.
     *
     * First index in array used as cluster index.
     *
     * @return array
     */
    protected function getIndexDefinition()
    {
        return [];
    }

    /**
     * @return string
     */
    private function getDatabaseFilePath()
    {
        return __DIR__ . self::DATABASE_PATH . '/iso_' . $this->getISONumber() . '.json';
    }

    /**
     * @return string
     */
    private function getLocalMessagesPath()
    {
        return __DIR__ . self::MESSAGES_PATH;
    }

    /**
     * Build cluster index for iteration
     *
     * @param string $databaseFile
     */
    private function loadDatabase($databaseFile)
    {
        $isoNumber = $this->getISONumber();

        // add gettext domain
        bindtextdomain(
            $isoNumber,
            $this->getLocalMessagesPath()
        );

        bind_textdomain_codeset(
            $isoNumber,
            'UTF-8'
        );

        // load database from json file
        $json = json_decode(
            file_get_contents($databaseFile),
            true
        );

        // build cluster index from database
        $this->clusterIndex = $json[$isoNumber];
    }

    /**
     * @param string $indexedFieldName
     *
     * @return array
     */
    private function getIndex($indexedFieldName)
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
                foreach ($this->clusterIndex as $entryArray) {
                    $entry = $this->arrayToEntry($entryArray);
                    foreach ($indexedFields as $indexName => $indexDefinition) {
                        if (is_array($indexDefinition)) {
                            // compound index
                            $reference = &$this->index[$indexName];
                            foreach ($indexDefinition as $indexDefinitionPart) {
                                // limited length of field
                                if (is_array($indexDefinitionPart)) {
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

                            $reference = $entry;
                        } else {
                            // single index
                            $indexName = $indexDefinition;
                            // skip empty field
                            if (empty($entryArray[$indexDefinition])) {
                                continue;
                            }
                            // add to index
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
     * @param string $indexedFieldName
     * @param string|int $fieldValue
     *
     * @return object|null
     */
    protected function find($indexedFieldName, $fieldValue)
    {
        $fieldIndex = $this->getIndex($indexedFieldName);
        if (!isset($fieldIndex[$fieldValue])) {
            throw new \InvalidArgumentException(sprintf('Unknown field %s', $indexedFieldName));
        }

        return $fieldIndex[$fieldValue];
    }

    /**
     * Builds array of entries.
     * Creates many entry objects in loop, use iterator instead.
     *
     * @return object[]
     */
    public function toArray()
    {
        return iterator_to_array($this);
    }

    /**
     * @return object
     */
    public function current()
    {
        return $this->arrayToEntry(current($this->clusterIndex));
    }

    /**
     * @return int|null
     */
    public function key()
    {
        return key($this->clusterIndex);
    }

    public function next()
    {
        next($this->clusterIndex);
    }
    
    public function rewind()
    {
        reset($this->clusterIndex);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->key() !== null;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->clusterIndex);
    }
}
