<?php

/**
 * Class Queue.
 */
class Queue {

    public $id;
    public $name;
    public $created_at;
    public $updated_at;
    public $completed_at;
    public $duration;
    public $errors = [];

    /**
     * Show the user's queue
     *
     * @param $conn
     *
     * @return mixed
     */
    public static function getAll($conn){

        $sql = "SELECT *
        FROM queue  WHERE  updated_at IS NULL LIMIT 5 ";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Shows all completed users
     * @param $conn
     *
     * @return mixed
     */
    public static function getUpdatedUsers($conn){

        $sql = "SELECT *
        FROM queue WHERE NOT updated_at IS NULL ";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get user by his ID
     *
     * @param        $conn
     * @param        $id
     * @param string $columns
     *
     * @return mixed
     */
    public static function getById($conn, $id, $columns = '*'){

        $sql = "SELECT $columns
        FROM queue
        WHERE id = :id";

        $stmt = $conn->prepare($sql);



        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Queue');

        if ($stmt->execute()) {

            return $stmt->fetch();
        }
    }

    /**
     * Insert new name into the queue
     *
     * @param object $conn Connection to the database
     *
     * @return true if name was inserted into the queue, false otherwise.
     */
    public function create($conn){

        if($this->validate()) {
            $sql = "INSERT INTO queue (name)
                    VALUES (:name)";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);


            if($stmt->execute()){
                $this->id = $conn->lastInsertId();
                return true;
            }
        }else{

            return false;
        }

    }

    /**
     * Validate the properties, any error message puts to $errors property
     *
     * @return bool
     */
    protected function validate(){


        if ($this->name == '') {
            $this->errors[] = 'Įveskite vardą.';
        }

        return empty($this->errors);
    }

    /**
     * Shows total users in the queue
     * @param $conn
     *
     * @return mixed
     */
    public static function getTotal($conn){

        return $conn->query('SELECT COUNT(*) FROM queue WHERE  completed_at IS NULL')->fetchColumn();
    }

    /**
     * Sets updated_at column to current time
     * @param $conn
     *
     * @return mixed
     */
    public function update($conn){

            $sql = "UPDATE queue
                    SET updated_at = NOW()                
                    WHERE id = :id ";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Sets completed_at to current time
     *
     * @param $conn
     *
     * @return mixed
     */
    public function complete($conn){

        $sql = "UPDATE queue
                    SET completed_at = NOW()                
                    WHERE id = :id ";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Adds one visit's duration to the database
     * @param $conn
     *
     * @return mixed
     *
     */
    public function count($conn){

        $sql = "UPDATE queue
                SET duration = :duration                  
                WHERE id = :id ";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':duration', $this->duration, PDO::PARAM_STR);
        return $stmt->execute();

    }

    /**
     * Calculates average visit time
     *
     * @param $conn
     *
     * @return mixed
     */
    public function averageWaitingTime($conn){

        return $conn->query('SELECT AVG(duration)
                            FROM queue
                            WHERE NOT  updated_at IS NULL')->fetchColumn();

    }

    /**
     *
     * Method for recommended visit time
     *
     * @param $conn
     *
     * @return false|string
     */
    public function visitTime($conn){

        return date('H:i:s',strtotime($this->created_at) + self::averageWaitingTime($conn));
    }
}
