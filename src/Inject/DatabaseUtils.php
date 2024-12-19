<?php

namespace Chat\Inject;

use Chat\Injector;

trait DatabaseUtils
{
    protected ?\Chat\Database\Utils $databaseUtils = null;

    protected function databaseUtils(): \Chat\Database\Utils
    {
        if (!isset($this->databaseUtils)) {
            $this->databaseUtils = Injector::make('DatabaseUtils');
        }
        return $this->databaseUtils;
    }

}
