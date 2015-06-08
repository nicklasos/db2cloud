<?php
namespace db2cloud\Db;

final class Mongodb implements DbInterface
{
    public function backup($db)
    {
        $out = sys_get_temp_dir() . '/' . 'mongo_backup_' . mt_rand();

        $command = 'mongodump' .
            ' --db ' . $db.
            ' --out ' . $out;

        shell_exec($command);

        return $out . '/' . $db;
    }
}
