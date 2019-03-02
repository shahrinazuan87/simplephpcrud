<?php

session_start();

//Connection syntax to database
$mysqli =  new mysqli('localhost', 'root', '', 'php_crud') or die(mysqli_error($mysqli)); 

//initialize variable default 
$id = 0;
$update = false;
$name = '';
$location = '';

//Function Save Data to database
if (isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("INSERT INTO data (name, location) VALUES('$name', '$location')") or die($mysqli->error);
    
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
    exit();
}

//Function Delete Data to database
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
    exit();
}

//Function Edit(get data from database) & place them to input box
if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    //cannot use count because its only for object or array that countable
    //so use mysqli_num_rows instead
    //@ function to hide warning
    if (mysqli_num_rows($result)==1){ 
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}

////Function Update Data to database
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id ") or  die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
    exit();
}