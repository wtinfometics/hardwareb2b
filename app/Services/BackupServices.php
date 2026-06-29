<?php

namespace App\Services;

use App\Models\backup;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use ZipStream\ZipStream;
use ZipStream\CompressionMethod;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Exception;

class BackupServices {

  private string $backupPath;

    public function __construct()
    {
        $this->backupPath = storage_path('app/backups');

        if (!File::exists($this->backupPath)) {
            File::makeDirectory(
                $this->backupPath,
                0755,
                true
            );
        }
    }

    // Create Backup
public function createBackup(){
    try {

        $date = now()->format('Y-m-d');

        $backupName = "Backup_{$date}.zip";

        $zipPath = $this->backupPath .
            DIRECTORY_SEPARATOR .
            $backupName;

        $db = config('database.connections.mysql');

        $sqlFile = $this->backupPath .
            DIRECTORY_SEPARATOR .
            $db['database'] .
            '.sql';

        /*
        |--------------------------------------------------------------------------
        | Create Database Dump
        |--------------------------------------------------------------------------
        */
        $mysqldump = '"C:\\xampp\\mysql\\bin\\mysqldump.exe"';

        $command = sprintf(
            '%s -h%s -P%s -u%s -p%s %s > "%s"',
            $mysqldump,
            $db['host'],
            $db['port'],
            $db['username'],
            $db['password'],
            $db['database'],
            $sqlFile
        );

        exec($command . ' 2>&1', $output, $result);

dd([
    'command' => $command,
    'result' => $result,
    'output' => $output
]);

        if ($result !== 0) {
            return [
                'success' => false,
                'message' => implode("\n", $output),
                'status' => 500
            ];
        }

        if (!File::exists($sqlFile)) {
            return [
                'success' => false,
                'message' => 'SQL dump file was not generated.',
                'status' => 500
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Create ZIP
        |--------------------------------------------------------------------------
        */
        $stream = fopen($zipPath, 'wb');

        if (!$stream) {
            return [
                'success' => false,
                'message' => 'Unable to create zip file.',
                'status' => 500
            ];
        }

        $zip = new ZipStream(
            outputStream: $stream,
            sendHttpHeaders: false
        );

        /*
        |--------------------------------------------------------------------------
        | Add Database File
        |--------------------------------------------------------------------------
        */
        $zip->addFileFromStream(
            basename($sqlFile),
            fopen($sqlFile, 'rb')
        );

        /*
        |--------------------------------------------------------------------------
        | Add Products Folder
        |--------------------------------------------------------------------------
        */
        $uploadPath = public_path('Products');

        if (File::exists($uploadPath)) {

            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator(
                    $uploadPath,
                    RecursiveDirectoryIterator::SKIP_DOTS
                )
            );

            foreach ($files as $file) {

                if ($file->isDir()) {
                    continue;
                }

                $filePath = $file->getRealPath();

                $relativePath =
                    'Products/' .
                    substr(
                        $filePath,
                        strlen($uploadPath) + 1
                    );

                $zip->addFileFromStream(
                    $relativePath,
                    fopen($filePath, 'rb')
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Finalize ZIP
        |--------------------------------------------------------------------------
        */
        $zip->finish();

        fclose($stream);

        /*
        |--------------------------------------------------------------------------
        | Delete Temporary SQL File
        |--------------------------------------------------------------------------
        */
        File::delete($sqlFile);

        if (!File::exists($zipPath)) {
            return [
                'success' => false,
                'message' => 'Zip file was not created.',
                'status' => 500
            ];
        }

        $fileSize = filesize($zipPath);

        $backup = backup::create([
            'backup_name' => $backupName,
            'backup_file' => $zipPath,
            'file_size' => $fileSize,
            'backup_date' => now(),
        ]);

        if (!$backup) {
            return [
                'success' => false,
                'message' => 'Backup record not created.',
                'status' => 400
            ];
        }

        return [
            'success' => true,
            'message' => 'Backup created successfully.',
            'status' => 200,
            'data' => $backup
        ];

    } catch (\Throwable $th) {

        return [
            'success' => false,
            'message' => $th->getMessage(),
            'status' => 500
        ];
    }
}

    // View Backup
    public function viewBackup(){
          $backups = backup::orderBy(
            'backup_date',
            'desc'
        )->get();
        if (!$backups->count()>0) {
            # If backup Not Exists
            return [
                'success'=>false,
                'message'=>'Backup Not Exists',
                'status'=>400
            ];
        } else {
            # If backup is Exists
            return [
                'success'=>true,
                'data'=>$backups,
                'status'=>200
            ];
        }
    }

    // Download Back Up
    public function downloadBackup($id){
        $backup = backup::findOrFail($id);

        return response()->download(
            $backup->backup_file,
            $backup->backup_name
        );
    }

    // Restore Backup
    public function restore($uploadedFile){
         $restorePath =
            storage_path('app/restore');

        if (File::exists($restorePath)) {
            File::deleteDirectory(
                $restorePath
            );
        }

        File::makeDirectory(
            $restorePath,
            0755,
            true
        );

        $zip = new ZipArchive();

        if (
            $zip->open(
                $uploadedFile->getRealPath()
            ) !== true
        ) {
            throw new Exception(
                'Invalid zip file.'
            );
        }

        $zip->extractTo($restorePath);

        $zip->close();

        $db = config('database.connections.mysql');

        $sqlFile =
            $restorePath .
            DIRECTORY_SEPARATOR .
            $db['database'] .
            '.sql';

        if (!File::exists($sqlFile)) {
            throw new Exception(
                'SQL file not found.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Restore Database
        |--------------------------------------------------------------------------
        */
        $command = sprintf(
            'mysql -h%s -P%s -u%s -p%s %s < "%s"',
            $db['host'],
            $db['port'],
            $db['username'],
            $db['password'],
            $db['database'],
            $sqlFile
        );

        exec($command, $output, $result);

        if ($result !== 0) {
            throw new Exception(
                'Database restore failed.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Restore Uploads
        |--------------------------------------------------------------------------
        */
        $uploadBackup =
            $restorePath .
            DIRECTORY_SEPARATOR .
            'uploads';

        if (File::exists($uploadBackup)) {

            File::copyDirectory(
                $uploadBackup,
                public_path('uploads')
            );
        }

        File::deleteDirectory(
            $restorePath
        );

        return true;
    }

    //  Restore Backup
    public function deleteBackup(){
          $backup = Backup::findOrFail($id);

        if (
            File::exists(
                $backup->backup_file
            )
        ) {
            File::delete(
                $backup->backup_file
            );
        }

        return $backup->delete();
    }

}