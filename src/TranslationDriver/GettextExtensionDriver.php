<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\TranslationDriver;

class GettextExtensionDriver implements TranslationDriverInterface
{
    public function configureDirectory(string $isoNumber, string $directory): void
    {
        // add gettext domain
        \bindtextdomain(
            $isoNumber,
            $directory
        );

        \bind_textdomain_codeset(
            $isoNumber,
            'UTF-8'
        );
    }

    /**
     * If defined, will configure system locale
     *
     * @param string $locale
     */
    public function setLocale(string $locale)
    {
        putenv(sprintf('LANGUAGE=%s.UTF-8', $locale));
        setlocale(LC_MESSAGES, sprintf('%s.UTF-8', $locale));
    }

    public function translate(string $isoNumber, string $message): string
    {
        return dgettext($isoNumber, $message);
    }
}