<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\TranslationDriver;

interface TranslatorInterface
{
    /**
     * @param string $isoNumber
     * @param string $message
     *
     * @return string
     */
    public function translate(string $isoNumber, string $message): string;
}
