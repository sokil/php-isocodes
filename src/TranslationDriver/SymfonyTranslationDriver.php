<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\TranslationDriver;

use Symfony\Component\Translation\Loader\MoFileLoader;
use Symfony\Component\Translation\Translator;

class SymfonyTranslationDriver implements TranslationDriverInterface
{
    /**
     * @var Translator
     */
    private $translator;

    /**
     * @var string
     */
    private $locale = 'en';

    public function __construct()
    {
        $this->translator = new Translator($this->locale);
        $this->translator->addLoader('mo', new MoFileLoader());
    }

    public function configureDirectory(string $isoNumber, string $directory): void
    {
        $locales = [$this->locale];
        if (strpos($this->locale, '_') === 2) {
            $locales[] = substr($this->locale, 0, 2);
        }

        $validPathToMoFile = null;
        foreach ($locales as $locale) {
            $pathToMoFile = $this->getPathToMoFile($directory, $locale, $isoNumber);

            if (file_exists($pathToMoFile)) {
                $validPathToMoFile = $pathToMoFile;
                break;
            }
        }

        if ($validPathToMoFile !== null) {
            $this->translator->addResource(
                'mo',
                $validPathToMoFile,
                $locale,
                $isoNumber
            );
        }

    }

    private function getPathToMoFile(string $directory, string $locale, string $isoNumber): string
    {
        $pathToMoFile = sprintf(
            '%s/%s/LC_MESSAGES/%s.mo',
            $directory,
            $locale,
            $isoNumber
        );

        return $pathToMoFile;
    }

    /**
     * Warning: If defined, will configure system locale.
     *
     * @param string $locale
     */
    public function setLocale(string $locale): void
    {
        $this->locale = $locale;

        $this->translator->setLocale($locale);
    }

    /**
     * @param string $isoNumber
     * @param string $message
     *
     * @return string
     */
    public function translate(string $isoNumber, string $message): string
    {
        return $this->translator->trans($message, [], $isoNumber);
    }
}
