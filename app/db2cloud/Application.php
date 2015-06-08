<?php
namespace db2cloud;

use db2cloud\Command\Mongodb;
use Symfony\Component\Console;

class Application
{
    public function run()
    {
        $app = new Console\Application('db2cloud', '0.1');
        $app->addCommands([
            new Mongodb(),
        ]);
        $app->run();
    }
}