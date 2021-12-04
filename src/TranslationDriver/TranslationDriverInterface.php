<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\TranslationDriver;

interface TranslationDriverInterface extends TranslatorInterface
{
    public function configureDirectory(string $isoNumber, string $directory): void;

    /**
     * @param string $locale
     */
    public function setLocale(string $locale): void;
}
