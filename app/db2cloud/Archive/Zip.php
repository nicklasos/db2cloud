<?php
namespace db2cloud\Archive;

use RecursiveDirectoryIterator as DirIterator;
use RecursiveDirectoryIterator as FSIterator;
use RecursiveIteratorIterator as Iterator;
use ZipArchive;

class Zip
{
    public function archive($folder)
    {
        $zip = new ZipArchive();
        $archive = $folder . '.zip';
        $zip->open($archive, ZipArchive::CREATE);

        $files = new Iterator(
            new DirIterator($folder, FSIterator::SKIP_DOTS),
            Iterator::LEAVES_ONLY
        );

        foreach ($files as $file) {
            $zip->addFile(
                $file->getRealPath(),
                $file->getFilename()
            );
        }

        $zip->close();

        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }

        rmdir($folder);

        return $archive;
    }
}
