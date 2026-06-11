<?php

// Test database and run migrations
$_SERVER['SCRIPT_NAME'] = basename(__FILE__);
$_SERVER['SCRIPT_FILENAME'] = __FILE__;

chdir(__DIR__);

// Check if Laravel is installed
if (!file_exists('artisan')) {
    die("Laravel artisan not found in " . getcwd());
}

// Run migrations
echo "Running migrations...\n";
system('php artisan migrate 2>&1');

echo "\nMigration check complete!\n";
