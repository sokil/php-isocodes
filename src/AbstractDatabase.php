<?php

declare(strict_types=1);

namespace Sokil\IsoCodes;

use Sokil\IsoCodes\TranslationDriver\GettextExtensionDriver;
use Sokil\IsoCodes\TranslationDriver\TranslationDriverInterface;

/**
 * Abstract collection of ISO entries
 */
abstract class AbstractDatabase implements \Iterator, \Countable
{
    /**
     * Default ath ISO databases
     */
    public const DATABASE_PATH = 'databases';

    /**
     * Default path to gettext localised messages
     */
    public const MESSAGES_PATH = 'messages';

    /**
     * Path to directory with databases
     *
     * @var string
     */
    protected $baseDirectory;

    /**
     * @var string[][]
     * @psalm-var Array<int, Array<string, string>>
     *
     * Cluster index used for iteration by entries
     *
     */
    private $clusterIndex = [];

    /**
     * @var TranslationDriverInterface
     */
    protected $translationDriver;

    /**
     * @param string|null $baseDirectory
     * @param TranslationDriverInterface|null $translationDriver
     *
     * @throws \RuntimeException when base directory not specified and directory can not be located automatically
     */
    public function __construct(
        string $baseDirectory = null,
        TranslationDriverInterface $translationDriver = null
    ) {
        if (empty($baseDirectory)) {
            // Require external database in "sokil/php-isocodes-db-*" packages
            $suggestedBaseDirectories = [
                // production mode, find in sibling directory "php-isocodes-db-i18n" or "php-isocodes-db-only"
                __DIR__ . '/../../php-isocodes-db-i18n/',
                __DIR__ . '/../../php-isocodes-db-only/',
                // development mode, find in current vendor packages
                __DIR__ . '/../vendor/sokil/php-isocodes-db-i18n/',
                __DIR__ . '/../vendor/sokil/php-isocodes-db-only/',
            ];

            foreach ($suggestedBaseDirectories as $suggestedBaseDirectory) {
                if (is_dir($suggestedBaseDirectory)) {
                    $this->baseDirectory = $suggestedBaseDirectory;
                    break;
                }
            }

            if (empty($this->baseDirectory)) {
                throw new \RuntimeException(
                    sprintf(
                        'Base directory not specified and directory can not be located automatically. Finding at %s',
                        implode(', ', $suggestedBaseDirectories)
                    )
                );
            }
        } else {
            $this->baseDirectory = rtrim($baseDirectory, '/') . '/';
        }

        $this->translationDriver = $translationDriver ?? new GettextExtensionDriver();

        $this->translationDriver->configureDirectory(
            $this->getISONumber(),
            $this->getLocalMessagesDirPath()
        );
    }

    /**
     * ISO Standard Number
     *
     * @psalm-pure
     */
    abstract public static function getISONumber(): string;

    /**
     * @psalm-param Array<string, string> $entry
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
     * @psalm-return Array<string, object>
     * @return object[]
     */
    public function toArray(): array
    {
        /** @psalm-var Array<string, object> $array */
        $array = iterator_to_array($this);

        return $array;
    }

    /**
     * @return object
     */
    #[\ReturnTypeWillChange]
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
