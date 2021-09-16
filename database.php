<?php
 
class Database
{
    public $showAlert;
    public function insert($name, $email, $pass , $description)
    {include 'config/dbconnect.php';
       

        $sql = "INSERT INTO `registration` ( `name`, `email`, `password`, `description`) VALUES ('$name', '$email', '$pass','$description')";
        $result = mysqli_query($con, $sql);
        return $result;
    }

    public function authUser($usermail){
        include 'config/dbconnect.php';
        $sql = "select * from registration where email='$usermail'";
        $result = mysqli_query($con, $sql);
        return $result;

    }



    public function fetchDetails(){
        include 'config/dbconnect.php';
        $sql="select * from registration";
        $result=mysqli_query($con,$sql);
       
        return $result;
    }
    public function update($id,$name,$email,$details){
        include 'config/dbconnect.php';
        $sql="UPDATE registration SET name='$name',email='$email',description='$details' WHERE id=$id";
        $result=mysqli_query($con,$sql);
        return $result;

    }
    public function delete(){
        
    }
}


