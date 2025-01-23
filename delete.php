<?php
include 'database.php';
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];
    $sql = "DELETE FROM `uploads` WHERE id=$id";
    $result = mysqli_query($pdo);
    if($result){
        header('location:admin.php');
    }else{
        die(mysqli_error($pdo));
    }
}