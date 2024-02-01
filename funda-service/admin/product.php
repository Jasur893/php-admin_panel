<?php
include('authentication.php');
include('config/dbcon.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php include('message.php'); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Gift Products
                                <a href="product-add.php" class="btn btn-primary float-right">Add</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = "SELECT * FROM products";
                                $query_run = mysqli_query($mysqli, $query);

                                if(mysqli_num_rows($query_run) > 0){
                                    foreach($query_run as $product_item){

                                        ?>
                                        <tr>
                                            <td><?= $product_item['id'] ?></td>
                                            <td>
                                                <img width="50px" height="50px" src="./uploads/product/<?= $product_item['image'] ?>" alt="">
                                            </td>
                                            <td><?= $product_item['name'] ?></td>
                                            <td><?= $product_item['price'] ?></td>

                                            <td>
                                                <input type="checkbox" <?= $product_item['status'] == '1' ? 'checked' : '' ?> readonly/>
                                            </td>
                                            <td><?= $product_item['created_at'] ?></td>
                                            <td>
                                                <a href="product-edit.php?prod_id=<?=$product_item['id']?>" class="btn btn-success">Edit</a>
                                            </td>
                                            <td>
                                                <form action="code.php" method="POST">
                                                    <input type="hidden" name=" product_delete_id" value="<?= $product_item['id']?>">
                                                    <input type="hidden" name="product_img" value="<?= $product_item['image']?>">
                                                    <button type="submit" name="product_delete_btn" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="7">No Record Found</td>
                                    </tr>
                                    <?php
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>


