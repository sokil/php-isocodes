<?php

define('DATABASES_DIR', rtrim($argv[1], '/'));
define('SOURCE_DATABASE_PATH', DATABASES_DIR . '/iso_3166-2.json');
define('TARGET_DATABASE_DIR', DATABASES_DIR . '/iso_3166-2');

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

$countryAlpha2ToSubdivisionsMap = [];

foreach ($database['3166-2'] as $countrySubdivision) {
    [$countryAlpha2, $countrySubdivisionCode] = explode('-', $countrySubdivision['code']);
    $countryAlpha2ToSubdivisionsMap[$countryAlpha2][] = [
        'code' => $countrySubdivision['code'],
        'name' => $countrySubdivision['name'],
        'type' => $countrySubdivision['type'],
    ];
}

// store splitted database
if (!file_exists(TARGET_DATABASE_DIR)) {
    mkdir(TARGET_DATABASE_DIR, 0775);
}

foreach ($countryAlpha2ToSubdivisionsMap as $countryAlpha2 => $countrySubdivisions) {
    // save JSON file
    file_put_contents(
        sprintf('%s/%s.json', TARGET_DATABASE_DIR, $countryAlpha2),
        json_encode($countrySubdivisions)
    );
}
