<?php
namespace db2cloud\Cloud;

use Exception;

class GoogleCloudStorage implements CloudInterface
{
    private $gsUtil;

    public function __construct($utilPath)
    {
        $output = shell_exec('which ' . $utilPath);
        if ($output === null) {
            throw new Exception('Gsutil error: gsutil is not installed: (' . $utilPath . ')');
        }

        $this->gsUtil = $utilPath;
    }

    public function move($from, $to)
    {
        exec("{$this->gsUtil} mv {$from} gs://{$to}");
    }
}
