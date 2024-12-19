<?php

namespace Chat\Database;

use Chat\Inject\Authenticator;
use Chat\Inject\DatabaseConnection;

class Utils
{
    use DatabaseConnection;
    use Authenticator;

    public function initDatabase(bool $force = false): bool {
        if ($force === true) {
            $deleteTablesSql = "drop table users;
                drop table users_confirmations;
                drop table users_remembered;
                drop table users_resets;
                drop table users_throttling;";
            $this->databaseConnection()->exec($deleteTablesSql);
        }
        $batchSql = file_get_contents(__DIR__.'/../../vendor/delight-im/auth/Database/SQLite.sql');
        $result = $this->databaseConnection()->exec($batchSql);
        if ($result === false) { return $result; }
        try {
            $this->authenticator()->admin()->createUser("john@domain.com","secretword");
            $this->authenticator()->admin()->createUser("eugene@domain.com","secretword");
            $this->authenticator()->admin()->createUser("jill@domain.com","secretword");
            $result = true;
        } catch (\Exception $e) {
            $result = false;
        }
        return $result;
    }
}
