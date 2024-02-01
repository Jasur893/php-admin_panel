<?php
session_start();
include("authentication.php");
include("config/dbcon.php");

if(isset($_POST['product_delete_btn'])){
    $product_id = $_POST['product_delete_id'];
    $product_img = $_POST['product_img'];

    $query = "DELETE FROM products WHERE id='$product_id'";
    $query_run = mysqli_query($mysqli, $query);

    if($query_run){
        $path = "uploads/product/$product_img";

        if(file_exists($path)){
            unlink($path);
        }
        $_SESSION['status'] = "Product Deleted Successfuly!";
        header("Location: product.php");
    } else{
        $_SESSION['status'] = "Product Deleting  Failed!";
        header("Location: product.php");
    }
}

if(isset($_POST['product_update'])){
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $small_description = $_POST['small_description'];
    $long_description = $_POST['long_description'];
    $price = $_POST['price'];
    $offerprice = $_POST['offerprice'];
    $tax = $_POST['tax'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'] == true ? '1' : '0';

    $image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($image != ''){
        $update_filename = $_FILES['image']['name'];

        $allowed_extension = array('png', 'jpg', 'jpeg');
        $file_extension = pathinfo($update_filename, PATHINFO_EXTENSION);
        $filename = time() . '.' .$file_extension;

        if(!in_array($file_extension, $allowed_extension, true)){
            $_SESSION['status'] = "You are allowed width only jpg, png, jpeg Images";
            header("Location: product-add.php");
            exit(0);
        }

        $update_filename = $filename;

    } else{
        $update_filename = $old_image;
    }

    $query = "UPDATE products SET category_id='$category_id',name='$name',small_description='$small_description',long_description='$long_description',price='$price',offerprice='$offerprice',tax='$tax',quantity='$quantity',image='$update_filename',status='$status' WHERE id='$product_id'";

    $query_run = mysqli_query($mysqli, $query);

    if($query_run){
        if($image != ''){
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/product/'.$filename);
            if(file_exists('uploads/product/'.$old_image)){
                unlink("uploads/product/".$old_image);
            }
        }
        $_SESSION['status'] = "Product Updated Successfully";
        header('Location: product-edit.php?prod_id='.$product_id);
        exit(0);
    } else{
        $_SESSION['status'] = "Product not Updated";
        header('Location: product-edit.php?prod_id='.$product_id);
        exit(0);
    }

}

if(isset($_POST['product_save'])){
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $small_description = $_POST['small_description'];
    $long_description = $_POST['long_description'];
    $price = $_POST['price'];
    $offerprice = $_POST['offerprice'];
    $tax = $_POST['tax'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'] == true ? '1' : '0';
    $image = $_FILES['image']['name'];

    $allowed_extension = array('png', 'jpg', 'jpeg');
    $file_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' .$file_extension;

    if(!in_array($file_extension, $allowed_extension, true)){
        $_SESSION['status'] = "You are allowed width only jpg, png, jpeg Images";
        header("Location: product-add.php");
        exit(0);
    }
    else {
        $query = "INSERT INTO products (category_id,name,small_description,long_description,price,offerprice,tax,quantity,status,image) VALUES ('$category_id','$name','$small_description','$long_description','$price','$offerprice','$tax','$quantity','$status','$filename')";

        $query_run = mysqli_query($mysqli, $query);
        if($query_run){
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/product/'.$filename);
            $_SESSION['status'] = "Product Added Successfully";
            header("Location: product-add.php");
            exit(0);
        } else{
            $_SESSION['status'] = "Something went wrong";
            header("Location: product-add.php");
            exit(0);
        }
    }
}



if(isset($_POST['category_save'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $trending = $_POST['trending'] === true ? "1" : "0";
    $status = $_POST['status'] === true ? "1" : "0";

    $category_query = "INSERT INTO categories (name,description,trending,status) VALUES ('$name','$description','$trending','$status')";
    $cate_query_run = mysqli_query($mysqli, $category_query);
    if($cate_query_run){
        $_SESSION['status'] = "Category inserted Successfuly!";
        header("Location: category.php");
    } else{
        $_SESSION['status'] = "Category insertion  Failed!";
        header("Location: category.php");
    }
}

if(isset($_POST['category_update'])){
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $trending = $_POST['trending'] == true ? '1' : '0';
    $status = $_POST['status'] == true ? '1' : '0';

    $query = "UPDATE categories SET name='$name', description='$description', trending='$trending', status='$status' WHERE id='$category_id'";
    $query_run = mysqli_query($mysqli, $query);

    if($query_run){
        $_SESSION['status'] = "Category Updated Successfuly!";
        header("Location: category.php");
    } else{
        $_SESSION['status'] = "Category Updating  Failed!";
        header("Location: category.php");
    }
}

if(isset($_POST['category_delete_btn'])){
    $category_id = $_POST['category_delete_id'];

    $query = "DELETE FROM categories WHERE id='$category_id'";
    $query_run = mysqli_query($mysqli, $query);

    if($query_run){
        $_SESSION['status'] = "Category Deleted Successfuly!";
        header("Location: category.php");
    } else{
        $_SESSION['status'] = "Category Deleting  Failed!";
        header("Location: category.php");
    }
}

if(isset($_POST['logout_btn'])){
    unset($_SESSION['auth'], $_SESSION['auth_user']);

    $_SESSION['status'] = "logged out Successfuly";
    header('Location: login.php');
    exit(0);
}

if (isset($_POST['check_Emailbtn'])) {
    $email = $_POST['email'];

    $checkemail = "SELECT email FROM users WHERE email='$email'";
    $checkemail_run = mysqli_query($mysqli, $checkemail);

    if (mysqli_num_rows($checkemail_run) > 0) {
        echo "Email id already taken!";
    } else {
        echo "It's Available";
    }
}

if (isset($_POST['addUser'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $checkemail = "SELECT email FROM users WHERE email='$email'";
        $checkemail_run = mysqli_query($mysqli, $checkemail);

        if (mysqli_num_rows($checkemail_run) > 0) {
            // Taken -Already exist
            $_SESSION['status'] = "Email id is already taken!";
            header("Location: registered.php");
            exit;
        } else {
            // Available - record not found
            $user_query = "INSERT INTO users (name,phone,email,password) VALUES ('$name','$phone','$email','$password')";
            $user_query_run = mysqli_query($mysqli, $user_query);
            if ($user_query_run) {
                $_SESSION['status'] = "User added Successfully";
                header("Location: registered.php");
            } else {
                $_SESSION['status'] = "User Registration Failed";
                header("Location: registered.php");
            }
        }
    } else {
        $_SESSION['status'] = "Password and Confirm Password does not match";
        header("Location: registered.php");
    }

}

if (isset($_POST['updateUser'])) {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];

    $query = "UPDATE users SET name='$name', phone='$phone', email='$email', password='$password', role_as='$role_as' WHERE id='$user_id'";
    $query_run = mysqli_query($mysqli, $query);

    if ($query_run) {
        $_SESSION['status'] = "User Updated Successfully";
        header("Location: registered.php");
    } else {
        $_SESSION['status'] = "User Updating  Failed";
        header("Location: registered.php");
    }
}

if (isset($_POST['DeleteUserbtn'])) {
    $userid = $_POST['delete_id'];

    $query = "DELETE FROM users WHERE id='$userid'";
    $query_run = mysqli_query($mysqli, $query);

    if ($query_run) {
        $_SESSION['status'] = "User Deleted Successfully";
        header("Location: registered.php");
    } else {
        $_SESSION['status'] = "User Deleting  Failed";
        header("Location: registered.php");
    }
}
