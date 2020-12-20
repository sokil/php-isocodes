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
     * Warning: If defined, will configure system locale.
     *
     * @param string $locale
     */
    public function setLocale(string $locale): void
    {
        $fullLocaleName = sprintf('%s.UTF-8', $locale);

        if (\getenv('LANGUAGE') !== $fullLocaleName) {
            \putenv(sprintf('LANGUAGE=%s', $fullLocaleName));
        }


        if (\setlocale(LC_MESSAGES, '0') !== $fullLocaleName) {
            \setlocale(LC_MESSAGES, sprintf('%s.UTF-8', $locale));
        }
    }

    /**
     * @param string $isoNumber
     * @param string $message
     *
     * @return string
     */
    public function translate(string $isoNumber, string $message): string
    {
        return \dgettext($isoNumber, $message);
    }
}