<?php

namespace Chat\Database;

use Chat\Injector;

class Utils
{
    private ?\PDO $dbConnection = null;
    private ?\Delight\Auth\Auth $authenticator = null;

    public function __construct() {
        if (!isset($this->dbConnection)) {
            $this->dbConnection = Injector::make('DatabaseConnection');
        }
        if (!isset($this->authenticator)) {
            $this->authenticator = Injector::make('Authenticator');
        }
    }
    public function initDatabase(bool $force = false): bool {
        if ($force === true) {
            $deleteTablesSql = "drop table users;
                drop table users_confirmations;
                drop table users_remembered;
                drop table users_resets;
                drop table users_throttling;";
            $this->dbConnection->exec($deleteTablesSql);
        }
        $batchSql = file_get_contents(__DIR__.'/../../vendor/delight-im/auth/Database/SQLite.sql');
        $result = $this->dbConnection->exec($batchSql);
        if ($result === false) { return $result; }
        try {
            $this->authenticator->admin()->createUser("john@domain.com","secretword");
            $this->authenticator->admin()->createUser("eugene@domain.com","secretword");
            $this->authenticator->admin()->createUser("jill@domain.com","secretword");
            $result = true;
        } catch (\Exception $e) {
            $result = false;
        }
        return $result;
    }
}
