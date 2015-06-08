<?php
namespace db2cloud\Command;

use db2cloud\Db\DbInterface;
use Symfony\Component\Console\Input\InputOption;

class Mysql extends Command
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('mysql')
            ->setDescription('Backup MySQL');

        $this->addOption(
            'user',
            'u',
            InputOption::VALUE_REQUIRED,
            'MySQL user'
        );

        $this->addOption(
            'pass',
            'p',
            InputOption::VALUE_OPTIONAL,
            'Password to MySQL',
            ''
        );

        $this->addOption(
            'mysqldump',
            null,
            InputOption::VALUE_OPTIONAL,
            'Path to mysqldump util',
            'mysqldump'
        );
    }

    /**
     * @return DbInterface
     */
    protected function getDb()
    {
        return new \db2cloud\Db\Mysql(
            $this->in->getOption('mysqldump'),
            $this->in->getOption('user'),
            $this->in->getOption('pass')
        );
    }
}