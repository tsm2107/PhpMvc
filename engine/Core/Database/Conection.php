<?php

namespace Engine\Core\Database;
use \PDO;
class Conection extends PDO
{
    public $link;
    public $conect;

    /**
     * Conection constructor.
     */
    public function __construct()
    {
        $this->conect = require __DIR__ . '/../../../config/config.php';
        $this->link = new PDO("{$this->conect['type']}:host={$this->conect['host']};port={$this->conect['port']};dbname={$this->conect['db']}",
            $this->conect['user'], $this->conect['pass']);

    }
    /**
     * @param $sql
     * @return mixed
     */
    public function sql_exec($bindings, $sql = null)
    {
        // Argument shifting
        if ($sql === null) {
            $sql = $bindings;
        }

        $stmt = $this->link->prepare($sql);;
        // Bind parameters
        if (is_array($bindings)) {
            for ($i = 0, $ien = count($bindings); $i < $ien; $i++) {
                $binding = $bindings[$i];
                $stmt->bindValue($binding['key'], $binding['val'], PDO::PARAM_STR);
            }
        }
        // Execute
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            $this->fatal("An SQL error occurred: " . $e->getMessage());
        }

        // Return all
        return $stmt->fetchAll(PDO::FETCH_NUM);
    }

    public function executes($sql, $user_data = [])
    {
        $sth = $this->link->prepare($sql);
        $sth->execute($user_data);
        return $sth;
    }

    /**
     * @param $sql
     * @return array
     */
    public function query($sql, $user_data = [])
    {
        $sth = $this->link->prepare($sql);
        $sth->execute($user_data);
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if (!$result) {
            return [];
        }
        return $result;
    }


}