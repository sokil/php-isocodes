<?php
declare(strict_types=1);

namespace Sokil\IsoCodes;

/**
 * Abstract collection of ISO entries
 */
abstract class AbstractDatabase implements \Iterator, \Countable
{
    /**
     * Default ath ISO databases
     */
    const DATABASE_PATH = 'databases';

    /**
     * Default path to gettext localised messages
     */
    const MESSAGES_PATH = 'messages';

    /**
     * Path to directory with databases
     *
     * @var string
     */
    protected $baseDirectory;

    /**
     * Cluster index used for iteration by entries
     *
     * @var string[][]
     */
    protected $clusterIndex;

    /**
     * Index to search by entry field's values
     *
     * @var object[][]
     */
    private $index;

    /**
     * @throws \Exception
     */
    public function __construct(?string $baseDirectory = null)
    {
        if (empty($this->baseDirectory)) {
            $this->baseDirectory = __DIR__ . '/../';
        } else {
            $this->baseDirectory = rtrim($baseDirectory, '/') . '/';
        }


        $this->bindGettextDomain();
    }

    /**
     * ISO Standard Number
     */
    abstract public static function getISONumber(): string;

    /**
     * @param mixed[] $entry
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
     * @return mixed[]
     */
    protected function getIndexDefinition(): array
    {
        return [];
    }

    /**
     * Get path to directory with gettext messages
     */
    private function getLocalMessagesDirPath(): string
    {
        return $this->baseDirectory . self::MESSAGES_PATH;
    }

    /**
     * Initialise domain of gettext translations
     */
    private function bindGettextDomain(): void
    {
        $isoNumber = $this->getISONumber();

        // add gettext domain
        \bindtextdomain(
            $isoNumber,
            $this->getLocalMessagesDirPath()
        );

        \bind_textdomain_codeset(
            $isoNumber,
            'UTF-8'
        );
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
     * @param string|int $fieldValue
     *
     * @return object|mixed[]|null
     */
    protected function find(string $indexedFieldName, $fieldValue)
    {
        $fieldIndex = $this->getIndex($indexedFieldName);

        return isset($fieldIndex[$fieldValue]) ? $fieldIndex[$fieldValue] : null;
    }

    /**
     * Builds array of entries.
     * Creates many entry objects in loop, use iterator instead.
     *
     * @return object[]
     */
    public function toArray(): array
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

    public function key(): ?int
    {
        return key($this->clusterIndex);
    }

    public function next(): void
    {
        next($this->clusterIndex);
    }

    public function rewind(): void
    {
        reset($this->clusterIndex);
    }

    public function valid(): bool
    {
        return $this->key() !== null;
    }

    public function count(): int
    {
        return count($this->clusterIndex);
    }
}
