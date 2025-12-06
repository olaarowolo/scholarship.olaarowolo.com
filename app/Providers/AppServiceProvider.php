<?php

namespace App\Providers;

use App\Database\SQLiteConnection;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register custom SQLite connection resolver for compatibility with older SQLite versions
        Connection::resolverFor('sqlite', function ($connection, $database, $prefix, $config) {
            return new SQLiteConnection($connection, $database, $prefix, $config);
        });

        // Fix for SQLite pragma_table_xinfo compatibility issues with older SQLite versions
        if (config('database.default') === 'sqlite') {
            try {
                $pdo = DB::connection()->getPdo();
                $pdo->exec('PRAGMA legacy_alter_table = ON');

                // Check SQLite version and disable problematic features if needed
                $version = $pdo->query('SELECT sqlite_version()')->fetchColumn();
                if (version_compare($version, '3.26.0', '<')) {
                    // For older SQLite versions, use pragma_table_info instead of pragma_table_xinfo
                    config(['database.connections.sqlite.use_legacy_schema' => true]);
                }
            } catch (\Exception $e) {
                // Silently fail if database connection isn't ready yet
            }
        }
    }
}
