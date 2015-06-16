<?php
namespace db2cloud\Db;

use db2cloud\Archive\Zip;

final class Mongodb implements DbInterface
{
    public function backup($db)
    {
        $out = sys_get_temp_dir() . '/' . 'mongo_backup_' . mt_rand();

        $command = 'mongodump' .
            ' --db="' . $db . '"' .
            ' --out="' . $out . '"';

        shell_exec($command);

        $backup = $out . '/' . $db;

        $archive = (new Zip())->archive($backup);

        return $archive;
    }
}
