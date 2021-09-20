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
                   
                   $request=array_map('trim',$request);
                   $password=$request['password'];
                   $request['password'] = password_hash($request['password'], PASSWORD_DEFAULT);

                    $querySql = new Database();
                    $result = $querySql->authUser("registration", $request);
                    $num = mysqli_num_rows($result);

                    if ($password == $request['cpassword']) {
                        if ($num == 0) {
                            unset($request["cpassword"]);
                            $querySql->insert("registration", $request);
                        
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
                    $request=array_map('trim',$request);
                    $password=$request['password'];
                    $Query = new Database();
                    unset($request["password"]);

                    $result = $Query->authUser("registration", $request);

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_array($result)) {
                            if (password_verify($password, $row['password'])) {
                                //return true;  

                                $_SESSION["username"] = $row['name'];
                                $_SESSION["loggedin"] = true;
                                $_SESSION["role"] = $row['role'];
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
                $result = $query->fetchDetails("registration");
                $id = 1;

                if (mysqli_num_rows($result) > 0) {
                    while ($data = mysqli_fetch_array($result)) {

                        echo '<tr id="' . $data['id'] . '">
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
                $key = $request['id'];
                unset($request["id"]);

                $updateQuery = new Database();
                $result = $updateQuery->update("registration", $request,$key);
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
