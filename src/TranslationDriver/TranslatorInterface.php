<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\TranslationDriver;

interface TranslatorInterface
{
    public function translate(string $isoNumber, string $message): string;
}