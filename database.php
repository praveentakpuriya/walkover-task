<?php

class Database
{
    public $showAlert;

    function insert($table, $array,$con)
    {
       
        array_walk($array, function (&$string) use ($con) {
            $string = mysqli_real_escape_string($con, $string);
        });

        $columns = implode(", ", array_keys($array));
        $values = implode("', '", $array);
        
        $sql = sprintf(
            "insert into %s (%s) values ('%s')",
            $table,
            $columns,
            $values
        );

        $result = mysqli_query($con, $sql) or die("Query unsuccessful : " . mysqli_error($con));
        return $result;
    }


    public function authUser($table, $array,$con)
    {
        
        array_walk($array, function (&$string) use ($con) {
            $string = mysqli_real_escape_string($con, $string);
        });

        $columns = implode(", ", array_keys($array));
        $values = implode("', '", $array);

        $sql = sprintf(
            "select * from %s where %s='%s'",
            $table,
            $columns,
            $values
        );

        $result = mysqli_query($con, $sql) or die("Query unsuccessful : " . mysqli_error($con));
        return $result;
    }


    public function fetchDetails($tableNam,$con)
    {
        
        $sql = "select * from $tableNam";
        $result = mysqli_query($con, $sql);

        return $result;
    }
    public function update($table, $array, $id,$con)
    {
      

        $query = "UPDATE `$table` SET ";
        $sep = '';
        foreach ($array as $key => $value) {
            $query .= $sep . $key . ' = "' . $value . '"';
            $sep = ',';
        }
        $query .= " WHERE `id` = ' $id  '";
        echo $query;

        $result = mysqli_query($con, $query) or die("Query unsuccessful : " . mysqli_error($con));
        return $result;

    }
    public function delete()
    {
    }
}
