<?php
namespace db2cloud;

use db2cloud\Command\Mongodb;
use db2cloud\Command\Mysql;
use Symfony\Component\Console;

class Application
{
    public function run()
    {
        $app = new Console\Application('db2cloud', '0.1');
        $app->addCommands([
            new Mongodb(),
            new Mysql(),
        ]);
        $app->run();
    }
}