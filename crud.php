<?php
session_start();

// Check if the user is already logged in, if not then redirect him to register page
if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)) {
    header("location: register.php");
    exit;
}
//list of allowed roles for just viewering the users
$roles_viewer_user = array(1);
$roles_add_viewer_user = array(2);
$roles_update_add_viewer_user = array(3);

//list of allowed roles for creating new users
$roles_delete_update_add_viewer_user = array(4);

$user_role = $_SESSION['role_id'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
    .wrapper {
        width: 600px;
        margin: 0 auto;
    }

    table tr td:last-child {
        width: 120px;
    }
    </style>
    <script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">User Details</h2>
                        <?php if (in_array($user_role, $roles_add_viewer_user)): ?>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New
                            Users</a>
                        <?php endif;?>
                        <?php if (in_array($user_role, $roles_update_add_viewer_user)): ?>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New
                            Users</a>
                        <?php endif;?>
                        <?php if (in_array($user_role, $roles_delete_update_add_viewer_user)): ?>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New
                            Users</a>
                        <?php endif;?>
                    </div>
                    <?php
// Include config file
require_once "config.php";

// Attempt select query execution
$sql = "SELECT * FROM users";
if ($result = $mysqli->query($sql)) {
    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered table-striped">';
        echo "<thead>";
        echo "<tr>";
        echo "<th>#</th>";
        echo "<th>Name</th>";
        echo "<th>Created At</th>";
        // echo "<th>Lasst Update</th>";
        // echo "<th>Last Login</th>";
        echo "<th>Actions</th>";
        echo "<th>Type</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_array()) {

            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>";

            if (in_array($user_role, $roles_viewer_user)):

                echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record"
																																									                                                    data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
            endif;

            if (in_array($user_role, $roles_add_viewer_user)):

                echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record"
																																									                                                    data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
            endif;

            if (in_array($user_role, $roles_update_add_viewer_user)):

                echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record"
																												                                                                data-toggle="tooltip"><span class="fa fa-eye"></span></a>';

                echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record"
																																									                                                data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
            endif;

            // if (in_array($user_role, $roles_create_user)):

            //     echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record"
            //                                                                                                                                                         data-toggle="tooltip"><span class="fa fa-eye"></span></a>';

            //     echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record"
            //                                                                                                                                                                                             data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
            // endif;

            if (in_array($user_role, $roles_delete_update_add_viewer_user)):

                echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record"
	                                                                            data-toggle="tooltip"><span class="fa fa-eye"></span></a>';

                echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record"
	                                                                                    data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';

                echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span
	                                                                                                                                                        class="fa fa-trash"></span></a>';
            endif;
            // echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record"
            //             data-toggle="tooltip"><span class="fa fa-eye"></span></a>';

            // echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record"
            //                     data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';

            // echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span
            //                                     class="fa fa-trash"></span></a>';
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        // Free result set
        $result->free();
    } else {
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
    }
} else {
    echo "Oops! Something went wrong. Please try again later.";
}

// Close connection
$mysqli->close();
?>

                </div>
            </div>
        </div>
    </div>
</body>

</html>