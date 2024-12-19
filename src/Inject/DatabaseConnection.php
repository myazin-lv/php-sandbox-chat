<?php

namespace Chat\Inject;

use Chat\Injector;

trait DatabaseConnection
{
    protected ?\PDO $databaseConnection = null;

    protected function databaseConnection(): \PDO
    {
        if (!isset($this->databaseConnection)) {
            $this->databaseConnection = Injector::make('DatabaseConnection');
        }
        return $this->databaseConnection;
    }

}
