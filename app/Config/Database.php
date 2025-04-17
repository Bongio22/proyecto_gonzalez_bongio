<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection.
     *
     * @var array<string, mixed>
     */
    public $default = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'root',            // Cambiar según tu usuario
        'password' => '',               // Cambiar según tu contraseña
        'database' => 'frikiverse',     // Cambiar según tu base de datos
        'DBDriver' => 'MySQLi',
        'charset'  => 'utf8',           // Asegúrate de que este sea válido
        'DBCollat' => 'utf8_general_ci', // Asegúrate de que sea compatible
        'DBDebug'  => (ENVIRONMENT !== 'production'),
    ];
    public function __construct()
    {
        parent::__construct();

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
