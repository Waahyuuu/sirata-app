<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use ZipArchive;

class BackupController extends Controller
{
    public function backup()
    {
        try {

            $databaseName = env('DB_DATABASE');
            $tableKey = 'Tables_in_' . $databaseName;

            // ==========================
            // AMBIL SEMUA TABEL
            // ==========================
            $tables = DB::select('SHOW TABLES');

            // ==========================
            // GENERATE SQL
            // ==========================
            $sql = '';
            $sql .= "-- SIRATA Backup\n";
            $sql .= "-- Generated at: " . now() . "\n\n";
            $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            foreach ($tables as $table) {

                $tableName = $table->$tableKey;

                // STRUCTURE TABLE
                $createTable = DB::select(
                    "SHOW CREATE TABLE `$tableName`"
                )[0];

                $sql .=
                    "DROP TABLE IF EXISTS `$tableName`;\n";

                $sql .=
                    $createTable->{'Create Table'}
                    . ";\n\n";

                // DATA TABLE
                $rows =
                    DB::table($tableName)->get();

                foreach ($rows as $row) {

                    $values = [];

                    foreach ((array) $row as $value) {

                        if (is_null($value)) {
                            $values[] = 'NULL';
                        } else {
                            $values[] =
                                "'" .
                                addslashes($value)
                                . "'";
                        }
                    }

                    $sql .=
                        "INSERT INTO `$tableName`
                        VALUES (" .
                        implode(',', $values)
                        . ");\n";
                }

                $sql .= "\n\n";
            }

            $sql .=
                "SET FOREIGN_KEY_CHECKS=1;\n";

            // ==========================
            // FILE ZIP NAME
            // ==========================
            $fileName =
                'sirata-backup-' .
                now()->format('Y-m-d_H-i-s')
                . '.zip';

            $zipPath =
                storage_path(
                    'app/' . $fileName
                );

            // ==========================
            // CREATE ZIP
            // ==========================
            $zip = new ZipArchive();

            if (
                $zip->open(
                    $zipPath,
                    ZipArchive::CREATE |
                        ZipArchive::OVERWRITE
                ) === TRUE
            ) {

                // DATABASE SQL
                $zip->addFromString(
                    'database.sql',
                    $sql
                );

                // ==========================
                // BACKUP STORAGE/APP/PUBLIC
                // ==========================
                $storageFolder =
                    storage_path(
                        'app/public'
                    );

                if (
                    File::exists(
                        $storageFolder
                    )
                ) {

                    $files =
                        File::allFiles(
                            $storageFolder
                        );

                    foreach ($files as $file) {

                        $relativePath =
                            'storage/' .
                            $file->getRelativePathname();

                        $zip->addFile(
                            $file->getRealPath(),
                            $relativePath
                        );
                    }
                }

                // ==========================
                // OPTIONAL:
                // BACKUP PUBLIC/UPLOADS
                // ==========================
                $publicUploads =
                    public_path('uploads');

                if (
                    File::exists(
                        $publicUploads
                    )
                ) {

                    $files =
                        File::allFiles(
                            $publicUploads
                        );

                    foreach ($files as $file) {

                        $relativePath =
                            'public/uploads/' .
                            $file->getRelativePathname();

                        $zip->addFile(
                            $file->getRealPath(),
                            $relativePath
                        );
                    }
                }

                $zip->close();
            }

            return response()
                ->download($zipPath)
                ->deleteFileAfterSend(true);
        } catch (\Exception $e) {

            return back()->with(
                'error',
                'Backup gagal: ' .
                    $e->getMessage()
            );
        }
    }
}
