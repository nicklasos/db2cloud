<?php
namespace db2cloud\Command;

final class Mongodb extends Command
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('mongodb')
            ->setDescription('Backup MongoDB');
    }

    protected function getDb()
    {
        return new \db2cloud\Db\Mongodb();
    }
}
