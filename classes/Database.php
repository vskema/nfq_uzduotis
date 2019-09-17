<?php

/**
 * Class Database.
 *
 * Connection to the database
 */
class Database {
    /**
     * Get database connection
     *
     * @return PDO
     */
    public function getConn()
    {

        $db_host = "localhost";
        $db_name = "nfq_uzduotis";
        $db_user = "nfq_www";
        $db_pass = "8AsK3jgzNpZLjetM";

        $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';

        return new PDO($dsn, $db_user, $db_pass);
    }
}
