<?php
// session_start();


class Dbconnect
{
    public function connect()
    {
        $server = "localhost";
        $username = "root";
        $password = "";
        $databse = "walkover";

        $con = mysqli_connect($server, $username, $password, $databse);

        if (!$con) {

            die(mysqli_connect_error());
        }

        return $con;
    }
}
?>