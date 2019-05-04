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
    private $clusterIndex = [];

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
     * Get path to directory with database files
     *
     * @return string
     */
    protected function getDatabasesPath(): string
    {
        return $this->baseDirectory . self::DATABASE_PATH;
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
     * Get list of all database rows.
     * For large databases like ISO-3166-2 this may require a lot of memory.
     *
     * @return array
     */
    protected function getClusterIndex(): array
    {
        // initialise cluster index
        $this->loadClusterIndex();

        return $this->clusterIndex;
    }

    /**
     * Build cluster index for iteration
     */
    private function loadClusterIndex(): void
    {
        // check if cluster index already loaded
        if (!empty($this->clusterIndex)) {
            return;
        }

        $isoNumber = $this->getISONumber();

        // load database from json file
        $databaseFilePath = $this->getDatabasesPath() . '/iso_' . $isoNumber . '.json';

        $json = \json_decode(
            file_get_contents($databaseFilePath),
            true
        );

        // build cluster index from database
        $this->clusterIndex = $json[$isoNumber];
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
        // initialise cluster index
        $this->loadClusterIndex();

        reset($this->clusterIndex);
    }

    public function valid(): bool
    {
        return $this->key() !== null;
    }

    public function count(): int
    {
        return count($this->getClusterIndex());
    }
}
