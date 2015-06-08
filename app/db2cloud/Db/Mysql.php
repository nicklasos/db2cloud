<?php
namespace db2cloud\Db;

/**
 * mysqldump -u [uname] -p[pass] [dbname] | gzip -9 > [backupfile.sql.gz]
 * gunzip < [backupfile.sql.gz] | mysql -u [uname] -p[pass] [dbname]
 * mysqlimport -u [uname] -p[pass] [dbname] [backupfile.sql]
 */
final class Mysql implements DbInterface
{
    private $mysqldump;
    private $user;
    private $pass;

    public function __construct($mysqldump, $user, $pass)
    {
        $this->mysqldump = $mysqldump;
        $this->user = $user;
        $this->pass = $pass;
    }

    public function backup($db)
    {
        $out = sys_get_temp_dir() . '/' . 'mysql_backup_' . mt_rand() . '.sql.gz';
        shell_exec("$this->mysqldump -u $this->user -p$this->pass $db | gzip -9 > $out");

        return $out;
    }
}
