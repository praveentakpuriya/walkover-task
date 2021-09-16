<?php
include 'database.php';
session_start();


class Action
{

    public function actionCall($action, $request)
    {
        switch ($action) {
            case 1:
                if (isset($request['name']) && isset($request['email']) && isset($request['password'])) {

                    $name = trim($request['name']);
                    $email = trim($request['email']);
                    $description = $request['description'];

                    $password = password_hash(trim($request['password']), PASSWORD_DEFAULT);
                    // $cpassword = password_hash(trim($_POST['cpassword']), PASSWORD_DEFAULT);

                    // check if email is already exists in database
                    $querySql = new Database();
                    $result = $querySql->authUser($email);
                    $num=mysqli_num_rows($result);

                    //  echo "your form is submitted";

                    if ($request['password'] == $request['cpassword']) {
                        if ($num == 0) {
                            
                            $querySql->insert("$name", "$email", "$password", "$description");
                            $_SESSION['created'] = "Your account has been created successfully";

                            echo json_encode(['status' => 'success']);
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'Sorry this email is already taken']);
                        }
                    } else {
                        echo json_encode(['status' => 'passerror', 'message' => 'Password does not match']);
                    }
                    //
                }
                break;

            case 2:
                if (isset($request['email']) && isset($request['password'])) {
                    include 'config/dbconnect.php';
                    $email = trim($request['email']);
                    $password = trim($request['password']);

                    $Query = new Database();

                    $result = $Query->authUser($email);

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_array($result)) {
                            if (password_verify($password, $row['password'])) {
                                //return true;  
                                
                                $_SESSION["username"] = $row['name'];
                                $_SESSION["loggedin"]=true;
                                $_SESSION["role"]=$row['role'];
                                echo json_encode(['status' => 'success']);
                            } else {
                                //return false;  
                                echo json_encode(['status' => 'passwordError', 'message' => 'Your email or password dimatch']);
                            }
                        }
                    } else {
                        echo json_encode(['status' => 'emailError', 'message' => 'Your email or password is dismatch']);
                    }
                }
                break;
            case 3:
                $query = new Database();
                $result = $query->fetchDetails();
                $id = 1;

                if (mysqli_num_rows($result) > 0) {
                    while ($data = mysqli_fetch_array($result)) {

                        echo '<tr id="'.$data['id'].'">
                <td>' . $id . '</td>
                <td data-target="name">' . $data['name'] . '</td>
                <td data-target="email">' . $data['email'] . '</td>
                <td data-target="description">' . $data['description'] . '</td>
                <td>
                <a class="btn btn-danger" data-role="update" data-id="' . $data['id'] . '">Update</a>
                </td>
            </tr>';
                        $id++;
                    }
                }
                break;


            case 4:
                $name = $request['name'];
                $email = $request['email'];
                $description = $request['description'];
                $id = $request['id'];
                // include 'config/dbconnect.php';
                // mysqli_query($con,"UPDATE registration SET name='$name' , email='$email' , description='$description' where id='$id'");


                $updateQuery = new Database();
                $result = $updateQuery->update($id, $name, $email, $description);
                if ($result) {
                    echo json_encode(['status' => 'success']);
                }
                break;
        }
    }
}


$action = $_GET['action'];
$request;

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        $request = $_POST;
        break;

    case "GET":
        $request = $_GET;
}
$obj = new Action();
$obj->actionCall($action, $request);