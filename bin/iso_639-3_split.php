<?php

define('DATABASES_DIR', rtrim($argv[1], '/'));
define('SOURCE_DATABASE_PATH', DATABASES_DIR . '/iso_639-3.json');
define('TARGET_DATABASE_DIR', DATABASES_DIR . '/iso_639-3');

if (!is_dir(DATABASES_DIR)) {
    throw new \InvalidArgumentException('Invalid databases dir specified');
}

if (!is_writable(DATABASES_DIR)) {
    throw new \InvalidArgumentException('Databases dir is not writable');
}

// parse database
if (!file_exists(SOURCE_DATABASE_PATH)) {
    throw new \InvalidArgumentException(sprintf(
        'Database file %s not found. Please, update database',
        SOURCE_DATABASE_PATH
    ));
}

$database = json_decode(file_get_contents(SOURCE_DATABASE_PATH), true);

$languages = [];

foreach ($database['639-3'] as $language) {
    $partitionFileName = $language['alpha_3'][0];

    $languages[$partitionFileName][] = [
        'name' => $language['name'],
        'alpha_3' => $language['alpha_3'],
        'scope' => $language['scope'],
        'type' => $language['type'],
        'inverted_name' => $language['inverted_name'] ?? null,
        'alpha_2' => $language['alpha_2'] ?? null,
    ];
}

// store splitted database
if (!file_exists(TARGET_DATABASE_DIR)) {
    mkdir(TARGET_DATABASE_DIR, 0775);
}

foreach ($languages as $partitionFileName => $countrySubdivisions) {
    // save JSON file
    file_put_contents(
        sprintf('%s/%s.json', TARGET_DATABASE_DIR, $partitionFileName),
        json_encode($countrySubdivisions)
    );
}
