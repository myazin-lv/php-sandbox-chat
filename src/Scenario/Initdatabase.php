<?php

namespace Chat\Scenario;

use Chat\Http\Request;
use \Chat\Inject;
use Chat\Injector;
use Chat\Scenario;

/**
 *
 */
class Initdatabase implements Scenario
{
    use Inject\HtmlRenderer;

    private ?\Chat\Database\Utils $dbUtils = null;

    public function __construct()
    {
        if (!isset($this->dbUtils)) {
            $this->dbUtils = Injector::make('DatabaseUtils');
        }
    }

    /**
     * Runs scenario of init database page.
     *
     * @param Request $req      HTTP request to init database page.
     *
     * @return array    Result of init database page scenario.
     */
    public function run(Request $req): array
    {
        $force = false || ($req->GET->exists("force")) && ($req->GET->Bool("force")===true);
        $dbInitiationResult = 'Database is successfully initiated!';
        if (!$this->dbUtils->initDatabase($force)) {
            $dbInitiationResult = 'Error while database initiation!';
        }
        return ['toRender' => [
            'data' => $dbInitiationResult,
        ]];
    }

}
