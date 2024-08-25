<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BackupDatabase extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'Backup the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $timestamp = now()->format('Y_m_d_His');
        $filename = "database_backup_$timestamp.sql";
        $sql = $this->generateSql();

        // Store the SQL content into a file in storage
        Storage::put("backups/$filename", $sql);

        $this->info('Database backup successfully stored as ' . $filename);
    }

    private function generateSql()
    {
        $tables = DB::select('SHOW TABLES');
        $database = env('DB_DATABASE');

        $sql = "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            $tableName = $table->{"Tables_in_$database"};

            // Get table structure
            $createTable = DB::select("SHOW CREATE TABLE `$tableName`")[0]->{'Create Table'} . ";\n\n";

            // Get table data
            $tableData = DB::table($tableName)->get();
            $insertStatements = "";

            foreach ($tableData as $row) {
                $values = array_map(function ($value) {
                    return is_null($value) ? 'NULL' : "'" . addslashes($value) . "'";
                }, (array) $row);

                $insertStatements .= "INSERT INTO `$tableName` VALUES (" . implode(',', $values) . ");\n";
            }

            $sql .= $createTable . $insertStatements . "\n\n";
        }

        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

        return $sql;
    }
}

