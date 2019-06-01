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
    // alpha3
    $partitionFileName = substr($language['alpha_3'], 0, 2);
    $languages['alpha3/' . $partitionFileName][] = [
        'name' => $language['name'],
        'alpha_3' => $language['alpha_3'],
        'scope' => $language['scope'],
        'type' => $language['type'],
        'inverted_name' => $language['inverted_name'] ?? null,
        'alpha_2' => $language['alpha_2'] ?? null,
    ];

    // alpha2
    if (!empty($language['alpha_2'])) {
        $partitionFileName = substr($language['alpha_2'], 0, 1);
        $languages['alpha2/' . $partitionFileName][] = [
            'name' => $language['name'],
            'alpha_3' => $language['alpha_3'],
            'scope' => $language['scope'],
            'type' => $language['type'],
            'inverted_name' => $language['inverted_name'] ?? null,
            'alpha_2' => $language['alpha_2'] ?? null,
        ];
    }
}

// store partitioned database
if (!file_exists(TARGET_DATABASE_DIR . '/alpha2')) {
    mkdir(TARGET_DATABASE_DIR . '/alpha2', 0775, true);
}

if (!file_exists(TARGET_DATABASE_DIR . '/alpha3')) {
    mkdir(TARGET_DATABASE_DIR . '/alpha3', 0775, true);
}

foreach ($languages as $partitionFileName => $countrySubdivisions) {
    // save JSON file
    file_put_contents(
        sprintf('%s/%s.json', TARGET_DATABASE_DIR, $partitionFileName),
        json_encode($countrySubdivisions)
    );
}
