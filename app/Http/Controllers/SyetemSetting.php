<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
class SyetemSetting extends Controller
{
    //

    public function index()
    {

       return view('dashbord.setting');
    }

    public function export()
    {
        $filename = "database_backup.sql";
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

        // Create a streamed response
        $response = new StreamedResponse(function() use ($sql) {
            echo $sql;
        });

        $response->headers->set('Content-Type', 'text/sql');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');

        return $response;
    }
}
