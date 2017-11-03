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
    private $entryList;

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
     */
    abstract public function getISONumber();

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
    public function getLocalMessagesPath()
    {
        return __DIR__ . self::MESSAGES_PATH;
    }

    /**
     * @param string $entryFieldValue
     *
     * @return string
     */
    protected function getLocal($entryFieldValue)
    {
        return dgettext(
            $this->getISONumber(),
            $entryFieldValue
        );
    }

    /**
     * @param string $databaseFile
     */
    private function loadDatabase($databaseFile)
    {
        $json = json_decode(
            file_get_contents($databaseFile),
            true
        );

        // read database
        $this->entryList = $json[$this->getISONumber()];

        // index database
        $indexedFields = $this->getIndexDefinition();
        if (!empty($indexedFields)) {
            foreach ($this->entryList as &$entry) {
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

                        $reference = $entry;
                    } else {
                        // single index
                        $indexName = $indexDefinition;
                        // skip empty field
                        if (empty($entry[$indexDefinition])) {
                            continue;
                        }
                        // add to index
                        $this->index[$indexName][$entry[$indexDefinition]] = $entry;
                    }
                }
            }
        }

        // add gettext domain
        bindtextdomain(
            $this->getISONumber(),
            $this->getLocalMessagesPath()
        );

        bind_textdomain_codeset(
            $this->getISONumber(),
            'UTF-8'
        );
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
            return null;
        }

        $result = $this->arrayToEntry($this->index[$indexedFieldName][$fieldValue]);



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
        return $this->arrayToEntry(current($this->entryList));
    }

    /**
     * @return int|null
     */
    public function key()
    {
        return key($this->entryList);
    }

    public function next()
    {
        next($this->entryList);
    }
    
    public function rewind()
    {
        reset($this->entryList);
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
        return count($this->entryList);
    }
}

