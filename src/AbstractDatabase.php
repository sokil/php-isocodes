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
     * @var array[]
     */
    private $clusterIndex = [];

    /**
     * Index to search by entry field's values
     *
     * @var array
     */
    private $index = [];

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
        throw new \Exception(
            sprintf(
                'Method "%s" must be inmpemented in class %s',
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
     * @param string $databaseFile
     */
    private function loadDatabase($databaseFile)
    {
        // add gettext domain
        bindtextdomain(
            $this->getISONumber(),
            $this->getLocalMessagesPath()
        );

        bind_textdomain_codeset(
            $this->getISONumber(),
            'UTF-8'
        );

        // load database from json file
        $json = json_decode(
            file_get_contents($databaseFile),
            true
        );

        // build index from database
        $entryList = $json[$this->getISONumber()];

        // index database
        $indexedFields = $this->getIndexDefinition();

        if (empty($indexedFields)) {
            $this->clusterIndex = $entryList;
        } else {
            // init all defined indexes
            foreach ($entryList as &$entry) {
                foreach ($indexedFields as $indexName => $indexDefinition) {
                    if (is_array($indexDefinition)) {
                        $reference = &$this->index[$indexName];
                        // compound index
                        foreach ($indexDefinition as $indexDefinitionPart) {
                            // limited length of field
                            if (is_array($indexDefinitionPart)) {
                                $indexDefinitionPartValue = substr(
                                    $entry[$indexDefinitionPart[0]],
                                    0,
                                    $indexDefinitionPart[1]
                                );
                            } else {
                                $indexDefinitionPartValue = $entry[$indexDefinitionPart];
                            }
                            if (!isset($reference[$indexDefinitionPartValue])) {
                                $reference[$indexDefinitionPartValue] = [];
                            }
                            $reference = &$reference[$indexDefinitionPartValue];
                        }

                        $reference = $this->arrayToEntry($entry);
                    } else {
                        // single index
                        $indexName = $indexDefinition;
                        // skip empty field
                        if (empty($entry[$indexDefinition])) {
                            continue;
                        }
                        // add to index
                        $this->index[$indexName][$entry[$indexDefinition]] = $this->arrayToEntry($entry);
                    }
                }
            }

            // set cluster index as first index
            $clusterIndexName = key($this->index);
            $this->clusterIndex = &$this->index[$clusterIndexName];
        }
    }

    /**
     * @param string $indexedFieldName
     * @param string|int $fieldValue
     *
     * @return object|null
     */
    protected function find($indexedFieldName, $fieldValue)
    {
        if (!isset($this->index[$indexedFieldName][$fieldValue])) {
            throw new \InvalidArgumentException(sprintf('Unknown field %s', $indexedFieldName));
        }

        $result = $this->index[$indexedFieldName][$fieldValue];

        return $result;
    }

    /**
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
        return current($this->clusterIndex);
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
