<?php
require "config/header.php";
include 'database.php';
include 'config/dbconnect.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true ||  $_SESSION['role'] != 1) {

    header("location:login.php");
    exit;
}
?>

<body>
    <?php require "config/nav.php" ?>


    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Registration Data</h2>
                        <p class="mb-md-0">All users data Submitted will appear here</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <button id="displaydata" class="btn btn-danger">Display</button>
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <p class="card-title">Registration List</p>
                    <div class="table-responsive">

                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">##</th>
                                </tr>
                            </thead>
                            <tbody id="response">
                                <?php
                                $query = new Database();
                                $result = $query->fetchDetails("registration");
                                $id = 1;

                                if (mysqli_num_rows($result) > 0) {
                                    while ($data = mysqli_fetch_array($result)) {
                                ?>

                                        <tr id="<?php echo $data['id'] ?>">
                                            <td><?php echo $id ?></td>
                                            <td data-target="name"><?php echo $data['name'] ?></td>
                                            <td data-target="email"><?php echo $data['email'] ?></td>
                                            <td data-target="description"><?php echo $data['description'] ?></td>
                                            <td>
                                                <a class="btn btn-danger" data-role="update" data-id="<?php echo $data['id'] ?>">Update</a>
                                            </td>
                                        </tr>
                                <?php
                                        $id++;
                                    }
                                }
                                ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modes -->
    <div class="modal fade" role="dialog" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" id="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label> Description</label>
                        <textarea name="update_desc" id="description" cols="30" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="userID" value="" id="userID ">
                    </div>
                    

                </div>
                <div class="modal-footer">
                    <a href="#" id="save" class="btn btn-primary pull-right">Update</a>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <?php require "config/footer.php" ?>