<?php
class Database
{

    /**
     * database connection object
     * @var \PDO
     */
    protected $pdo;

    /**
     * Connect to the database
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Return the pdo connection
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * Changes a camelCase table or field name to lowercase,
     * underscore spaced name
     *
     * @param  string $string camelCase string
     * @return string underscore_space string
     */
    protected function camelCaseToUnderscore($string)
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $string));
    }

    /**
     * Returns the ID of the last inserted row or sequence value
     *
     * @param  string $param Name of the sequence object from which the ID should be returned.
     * @return string representing the row ID of the last row that was inserted into the database.
     */
    public function lastInsertId($param = null)
    {
        return $this->pdo->lastInsertId($param);
    }

    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function commit()
    {
        $this->pdo->commit();
    }

    public function rollBack()
    {
        $this->pdo->rollBack();
    }
    /**
     * handler for dynamic CRUD methods
     *
     * Format for dynamic methods names -
     * Create:  insertTableName($arrData)
     * Retrieve: getTableNameByFieldName($value)
     * Update: updateTableNameByFieldName($value, $arrUpdate)
     * Delete: deleteTableNameByFieldName($value)
     *
     * @param  string     $function
     * @param  array      $arrParams
     * @return array|bool
     */
    public function __call($function, array $params = array())
    {
        if (!preg_match('/^(get|update|insert|delete)(.*)$/', $function, $matches)) {
            throw new \BadMethodCallException($function . ' is an invalid method Call');
        }

        if ('insert' == $matches[1]) {
            if (!is_array($params[0]) || count($params[0]) < 1) {
                throw new \InvalidArgumentException('insert values must be an array');
            }

            return $this->insert($this->camelCaseToUnderscore($matches[2]), $params[0]);
        }

        list($tableName, $fieldName) = explode('By', $matches[2], 2);
        if (!isset($tableName, $fieldName)) {
            throw new \BadMethodCallException($function . ' is an invalid method Call');
        }

        if ('update' == $matches[1]) {
            if (!is_array($params[1]) || count($params[1]) < 1) {
                throw new \InvalidArgumentException('update fields must be an array');
            }

            return $this->update(
                $this->camelCaseToUnderscore($tableName),
                $params[1],
                array($this->camelCaseToUnderscore($fieldName) => $params[0])
            );
        }

        //select and delete method
        return $this->{$matches[1]}(
            $this->camelCaseToUnderscore($tableName),
            array($this->camelCaseToUnderscore($fieldName) => $params[0])
        );
    }

    /**
     * Record retrieval method
     *
     * @param  string     $tableName name of the table
     * @param  array      $where     (key is field name)
     * @return array|bool (associative array for single records, multidim array for multiple records)
     */
    public function get($tableName,  $whereAnd    =    array(), $whereOr    =    array(), $whereLike    =     array())
    {
        $cond    =    '';
        $s = 1;
        $params =    array();
        foreach ($whereAnd as $key => $val) {
            $cond    .=     " And " . $key . " = :a" . $s;
            $params['a' . $s] = $val;
            $s++;
        }
        foreach ($whereOr as $key => $val) {
            $cond    .=     " OR " . $key . " = :a" . $s;
            $params['a' . $s] = $val;
            $s++;
        }
        foreach ($whereLike as $key => $val) {
            $cond    .=     " OR " . $key . " like '% :a" . $s . "%'";
            $params['a' . $s] = $val;
            $s++;
        }
        // echo "SELECT  count(*)	as count ,$tableName.* FROM $tableName WHERE 1 ".$cond;	
        $stmt = $this->pdo->prepare("SELECT  $tableName.* FROM $tableName WHERE 1 " . $cond);
        try {

            $stmt->execute($params);
            $res = $stmt->fetchAll();

            if (!$res || count($res) != 1) {
                return $res;
            }
            return $res;
        } catch (\PDOException $e) {
            throw new \RuntimeException("[" . $e->getCode() . "] : " . $e->getMessage());
        }
    }

    public function getAllRecords($tableName, $fields = '*', $cond = '', $orderBy = '', $limit = '')
    {
        // echo "SELECT  $tableName.$fields FROM $tableName WHERE 1 " . $cond . " " . $orderBy . " " . $limit . "<br>";
        $stmt = $this->pdo->prepare("SELECT $fields FROM $tableName WHERE 1 " . $cond . " " . $orderBy . " " . $limit);
        //print "SELECT $fields FROM $tableName WHERE 1 ".$cond." ".$orderBy." " ;
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getSingleRecord($tableName, $fields = '*', $cond = '', $orderBy = '', $limit = '')
    {
        // echo "SELECT $fields FROM $tableName WHERE 1 " . $cond . " " . $orderBy . " " . $limit;
        $stmt = $this->pdo->prepare("SELECT $fields FROM $tableName WHERE 1 " . $cond . " " . $orderBy . " " . $limit);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getLogin($tableName, $fields = '*', $cond = '', $orderBy = '', $limit = '')
    {
        // echo "SELECT  $tableName.$fields FROM $tableName WHERE 1 ".$cond." ".$orderBy." ".$limit;
        $stmt = $this->pdo->prepare("SELECT $fields FROM $tableName WHERE 1 " . $cond . " " . $orderBy . " " . $limit);
        //print "SELECT $fields FROM $tableName WHERE 1 ".$cond." ".$orderBy." " ;
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }


    public function getRecFrmQry($query)
    {
        // echo $query;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getRecFrmQry2($query)
    {
        //echo $query;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        return array();
    }
    public function getQueryCount($tableName, $field, $cond = '')
    {
        $stmt = $this->pdo->prepare("SELECT count($field) as total FROM $tableName WHERE 1 " . $cond);

        try {
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$res || count($res) != 1) {
                return $res;
            }
            return $res;
        } catch (\PDOException $e) {
            throw new \RuntimeException("[" . $e->getCode() . "] : " . $e->getMessage());
        }
    }

    /**
     * Update Method
     *
     * @param  string $tableName
     * @param  array  $set       (associative where key is field name)
     * @param  array  $where     (associative where key is field name)
     * @return int    number of affected rows
     */
    public function update($tableName, array $set, array $where)
    {
        $arrSet = array_map(
            function ($value) {
                return $value . '=:' . $value;
            },
            array_keys($set)
        );

        // echo "UPDATE $tableName SET ". implode(',', $arrSet).' WHERE '. key($where). '=:'. key($where) . 'Field';
        $stmt = $this->pdo->prepare(
            "UPDATE $tableName SET " . implode(',', $arrSet) . ' WHERE ' . key($where) . '=:' . key($where) . 'Field'
        );

        foreach ($set as $field => $value) {
            $stmt->bindValue(':' . $field, $value);
        }
        $stmt->bindValue(':' . key($where) . 'Field', current($where));
        try {
            $stmt->execute();

            return $stmt->rowCount();
        } catch (\PDOException $e) {
            throw new \RuntimeException("[" . $e->getCode() . "] : " . $e->getMessage());
        }
    }

    public function update_new($tableName, array $set, $cond = '')
    {
        $arrSet = array_map(
            function ($value) {
                return $value . '=:' . $value;
            },
            array_keys($set)
        );

        // echo "UPDATE $tableName SET ". implode(',', $arrSet).' WHERE 1 '.$cond;
        $stmt = $this->pdo->prepare(
            "UPDATE $tableName SET " . implode(',', $arrSet) . ' WHERE 1 ' . $cond
        );

        foreach ($set as $field => $value) {
            $stmt->bindValue(':' . $field, $value);
        }
        // $stmt->bindValue(':'.key($where) . 'Field', current($where));
        try {
            $stmt->execute();

            return $stmt->rowCount();
        } catch (\PDOException $e) {
            throw new \RuntimeException("[" . $e->getCode() . "] : " . $e->getMessage());
        }
    }

    public function multiUpdate($tableName, array $sets, array $where)
    {
        $i = 0;
        foreach ($sets as $set) {
            $arrSet = array_map(
                function ($value) {
                    return $value . '=:' . $value;
                },
                array_keys($set)
            );
            $stmt = $this->pdo->prepare(
                "UPDATE $tableName SET " . implode(',', $arrSet) . ' WHERE ' . key($where) . '=:' . key($where) . 'Field'
            );

            foreach ($set as $field => $value) {
                $stmt->bindValue(':' . $field, $value);
            }
            $stmt->bindValue(':' . key($where[$i]) . 'Field', current($where[$i]));

            $i++;

            try {
                $stmt->execute();

                return $stmt->rowCount();
            } catch (\PDOException $e) {
                throw new \RuntimeException("[" . $e->getCode() . "] : " . $e->getMessage());
            }
        }
    }

    /**
     * Delete Method
     *
     * @param  string $tableName
     * @param  array  $where     (associative where key is field name)
     * @return int    number of affected rows
     */
    public function delete($tableName, array $where)
    {
        // echo "DELETE FROM $tableName WHERE ".key($where) . ' = ?';
        $stmt = $this->pdo->prepare("DELETE FROM $tableName WHERE " . key($where) . ' = ?');
        try {
            $stmt->execute(array(current($where)));

            return $stmt->rowCount();
        } catch (\PDOException $e) {
            throw new \RuntimeException("[" . $e->getCode() . "] : " . $e->getMessage());
        }
    }


    public function delete2($query)
    {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();

            return $stmt->rowCount();
        } catch (\PDOException $e) {
            throw new \RuntimeException("[" . $e->getCode() . "] : " . $e->getMessage());
        }
    }


    /**
     * Insert Method
     *
     * @param  string $tableName
     * @param  array  $arrData   (data to insert, associative where key is field name)
     * @return int    number of affected rows
     */
    public function insert($tableName, array $data)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO $tableName (" . implode(',', array_keys($data)) . ")
            VALUES (" . implode(',', array_fill(0, count($data), '?')) . ")"
        );
        try {
            $stmt->execute(array_values($data));

            return $stmt->rowCount();
        } catch (\PDOException $e) {
            throw new \RuntimeException("[" . $e->getCode() . "] : " . $e->getMessage());
        }
    }

    /**
     * A custom function that automatically constructs a multi insert statement.
     * 
     * @param string $tableName Name of the table we are inserting into.
     * @param array $data An "array of arrays" containing our row data.
     * @param PDO $pdoObject Our PDO object.
     * @return boolean TRUE on success. FALSE on failure.
     */
    function multiInsert($tableName, array $data)
    {

        //Will contain SQL snippets.
        $rowsSQL = array();

        //Will contain the values that we need to bind.
        $toBind = array();

        //Get a list of column names to use in the SQL statement.
        $columnNames = array_keys($data[0]);

        //Loop through our $data array.
        foreach ($data as $arrayIndex => $row) {
            $params = array();
            foreach ($row as $columnName => $columnValue) {
                $param = ":" . $columnName . $arrayIndex;
                $params[] = $param;
                $toBind[$param] = $columnValue;
            }
            $rowsSQL[] = "(" . implode(", ", $params) . ")";
        }

        //Construct our SQL statement
        $sql = 'INSERT INTO ' . $tableName . ' (`' . implode('`, `', $columnNames) . '`) VALUES ' . implode(', ', $rowsSQL);

        //Prepare our PDO statement.
        $stmt = $this->pdo->prepare($sql);

        //Bind our values.
        foreach ($toBind as $param => $val) {
            $stmt->bindValue($param, $val);
        }
        //Execute our statement (i.e. insert the data).
        try {
            $stmt->execute();

            return $stmt->rowCount();
        } catch (\PDOException $e) {
            throw new \RuntimeException("[" . $e->getCode() . "] : " . $e->getMessage());
        }
    }

    public function close()
    {
        $this->pdo = null;
    }
}
