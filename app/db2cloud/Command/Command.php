<?php
namespace db2cloud\Command;

use DateTime;
use db2cloud\Archive\Zip;
use db2cloud\Cloud\GoogleCloudStorage;
use db2cloud\Db\DbInterface;
use Symfony\Component\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface as In;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface as Out;

abstract class Command extends Console\Command\Command
{
    /**
     * @var In
     */
    protected $in;

    /**
     * @var Out
     */
    protected $out;

    /**
     * @return DbInterface
     */
    abstract protected function getDb();

    protected function configure()
    {
        $this->addArgument(
            'format',
            InputArgument::REQUIRED,
            'Backup location format based on current date'
        );

        $this->addOption('gsutil', null, InputOption::VALUE_OPTIONAL, 'gsutil path', 'gsutil');
        $this->addOption('db', null, InputOption::VALUE_REQUIRED, 'DataBase name');
    }

    public function execute(In $in, Out $out)
    {
        $this->in = $in;
        $this->out = $out;

        $backup = $this->getDb()->backup($in->getOption('db'));

        $cloud = new GoogleCloudStorage($in->getOption('gsutil'));
        $cloud->move($backup, $this->format($in->getArgument('format')));
    }

    private function format($format)
    {
        $replace = [
            '%host' => gethostname(),
            '%rand' => mt_rand(),
        ];

        $timePlaceholders = ['d', 'D', 'm', 'M', 'y', 'Y', 'h', 'H', 'i', 's'];

        $date = new DateTime('now', new \DateTimeZone('UTC'));
        foreach ($timePlaceholders as $placeholder) {
            $replace['%' . $placeholder] = $date->format($placeholder);
        }

        return str_replace(array_keys($replace), array_values($replace), $format);
    }
}
