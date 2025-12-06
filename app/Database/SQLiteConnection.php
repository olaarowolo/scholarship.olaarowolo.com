<?php

namespace App\Database;

use Illuminate\Database\SQLiteConnection as BaseSQLiteConnection;

class SQLiteConnection extends BaseSQLiteConnection
{
    /**
     * Get the column listing for a given table.
     *
     * @param  string  $table
     * @return array
     */
    public function getColumnListing($table)
    {
        $table = $this->getTablePrefix().$table;

        $results = $this->select(
            $this->getConfig('use_legacy_schema')
                ? "pragma table_info({$this->getPdo()->quote($table)})"
                : "select name from pragma_table_info({$this->getPdo()->quote($table)})"
        );

        return $this->getPostProcessor()->processColumnListing($results);
    }

    /**
     * Get the column type listing for a given table.
     *
     * @param  string  $table
     * @return array
     */
    public function getColumnTypeListing($table)
    {
        $table = $this->getTablePrefix().$table;

        try {
            // Try modern syntax first
            return $this->select(
                "select name, type, not notnull as \"nullable\", dflt_value as \"default\", pk as \"primary\", hidden as \"extra\" from pragma_table_xinfo({$this->getPdo()->quote($table)}, 'main') order by cid asc"
            );
        } catch (\PDOException $e) {
            // Fall back to legacy syntax for older SQLite versions
            return $this->select(
                "select name, type, not notnull as \"nullable\", dflt_value as \"default\", pk as \"primary\", '' as \"extra\" from pragma_table_info({$this->getPdo()->quote($table)}) order by cid asc"
            );
        }
    }
}
