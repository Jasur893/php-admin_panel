<?php
include('authentication.php');
include('config/dbcon.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit - Registered User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit - Registered User</h3>
                            <a href="registered.php" class="btn btn-danger btn-sm float-right">Back</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="code.php" method="POST">
                                        <div class="modal-body">
                                            <?php
                                            if ($_GET['user_id']) {
                                            $user_id = $_GET['user_id'];
                                            $query = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
                                            $query_run = mysqli_query($mysqli, $query);

                                            if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run

                                            as $row) {
                                            ?>
                                            <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="Name"
                                                       value="<?= $row['name'] ?>"
                                                       id="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control" value="<?= $row['email'] ?>"
                                                       placeholder="Email" id="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone_number">Phone Number</label>
                                                <input type="text" name="phone" class="form-control" value="<?= $row['phone'] ?>"
                                                       placeholder="Phone Number" id="phone_number">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" class="form-control" value="<?= $row['password'] ?>"
                                                       placeholder="Password" id="password">
                                            </div>
                                            <div class="form-group">
                                                <label Give Role</label>
                                                <select name="role_as" class="form-control" required>
                                                    <option value="">Select</option>
                                                    <option value="0">User</option>
                                                    <option value="1">Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="updateUser" class="btn btn-info">Update</button>
                                        </div>
                                        <?php
                                        }
                                        } else {
                                            echo "<h4>No Record Found!</h4>";
                                        }
                                        }

                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>

