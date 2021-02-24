<?php

namespace dwp\core;

abstract class Model
{
    // useful types for schema
    const TYPE_STRING   = 'string';
    const TYPE_INTEGER  = 'int';
    const TYPE_UINTEGER = 'uint';
    const TYPE_DECIMAL  = 'dec';
    const TYPE_DATE     = 'date';
    const TYPE_JSON     = 'json';

    protected $schema = [
    ];

    private $values = [
    ];

    // gets name of the current table
    public static function tablename()
    {
        $class = get_called_class();
        if(defined($class.'::TABLENAME'))
        {
            return $class::TABLENAME;
        }
        return null;
    }

    // gets data matching the parameters
    public static function find($whereStr = '1')
    {
        $db = $GLOBALS['db'];
        $sqlStr = 'SELECT * FROM `'.self::tablename().'` WHERE '.$whereStr.';';
        $results = [];
        try
        {
            $results = $db->query($sqlStr)->fetchAll();
            $count = count($results);
            for ($i=0; $i < $count; ++$i)
            { 
                $class = get_called_class();
                $results[$i] = new $class($results[$i]);
            }
        }
        catch(\PDOException $error)
        {
            print_r($error);
        }

        return $results;
    }

    // gets first data matching the parameters
    public static function findOne($whereStr = '1')
    {
        $results = self::find($whereStr);

        if(count($results) > 0)
        {
            return $results[0];
        }

        return null;
    }

    public function __construct($values)
    {
        try
        {
            foreach($this->schema as $key => $value)
            {
                if(isset($values[$key]))
                {
                    $this->$key = $values[$key];
                }
                else
                {
                    $this->$key = null;
                }
            }
            
        }
        catch(\Exception $error)
        {
            print_r($error);
            exit(1);
        }

    }

    public function __set($key, $value)
    {
        // key available?
        if(isset($this->schema[$key]))
        {
            $this->values[$key] = $value;
        }
        else
        {
            $className = get_called_class();
            throw new \Exception(`${key} does not exists in this class ${className}`);
        }
    }

     public function __get($key)
    {
        if(isset($this->schema[$key]))
        {
            return $this->values[$key];
        }
        else
        {
            $className = get_called_class();
            throw new \Exception(`${key} does not exists in this class ${className}`);
        }
    } 

    // inserts data into the database
    public function insert($values)
    {
        $db = $GLOBALS['db'];
        $tableName = self::tablename();
        $sqlStr = "INSERT INTO `${tableName}` (";
        $valuesStr = "(";
        foreach($values as $key => $value)
        {
            $sqlStr.=$key.',';
            $valuesStr.=$db->quote($value).',';
        }

        $sqlStr = rtrim($sqlStr, ',');
        $valuesStr = rtrim($valuesStr, ',');

        $sqlStr = $sqlStr.') VALUES '.$valuesStr.');';
        
        try
        {
            $stmt=$db->prepare($sqlStr);
            $stmt->execute();
            $return= $db->lastInsertId();
        }
        catch(\PDOException $e)
        {
            print_r($e);
        }
        return $return;
    }

    // updates data in the database
    public function update($id,$keys,$values)
    {
        $db = $GLOBALS['db'];
        $tableName = self::tablename();
        $sqlStr = "UPDATE `${tableName}` SET ";
        for($i=0; $i<count($keys); $i++)
        {
            $sqlStr.=$keys[$i].' = '.$db->quote($values[$i]).' ';
        }
        $sqlStr.="WHERE id = ".$id;

        try
        {
            $stmt=$db->prepare($sqlStr);
            $stmt->execute();
        }
        catch(\PDOException $e)
        {
            print_r($e);
        }
    }

    // deletes data in the database
    public function destroy($key,$value)
    {
        $db = $GLOBALS['db'];
        $tableName = self::tablename();
        $sqlStr = "DELETE FROM `${tableName}` WHERE `$key`=";
        $sqlStr.=$db->quote($value).';';

        try
        {
            $stmt=$db->prepare($sqlStr);
            $stmt->execute();
        }
        catch(\PDOException $e)
        {
            print_r($e);
        }
    }
}