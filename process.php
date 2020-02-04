<?php

  //session_start();


  $update = false;
  $userid =0;
  $fist_name = "";
  $last_name = "";
  $email = "";
  $passed ="";

  $mysqli = new mysqli('db', 'root', 'test', 'sampledb') or die(mysqli_error($mysqli));

  if (isset($_POST['save'])){
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $passwd = trim($_POST['passwd']);

    $hashed_passcode = password_hash($passwd, PASSWORD_DEFAULT); // retornar password encriptado
    $mysqli->query("INSERT INTO users (first_name,last_name, email, password, registration_date)
              VALUES('$name', '$last_name','$email','$hashed_passcode', (SELECT NOW()))")
              or die ($mysqli->error);

    $_SESSION['message'] = "Record has Been Saved!";
    $_SESSION['msg_type'] = "SUCCESS";

    header("location: php_crud.php");

  }
  if (isset($_GET['edit'])){
     $id = $_GET['edit'];
     $update = true;
      $result = $mysqli->query("SELECT * FROM users WHERE userid=$id") or die($mysqli->error());

      $len_array = count($result);

      if ( $len_array == 1){
          $row = $result->fetch_array();
          $userid = $row['userid'];
          $first_name = $row['first_name'];
          $last_name = $row['last_name'];
          $email = $row['email'];
          $passwd = $row['passwd'];
      }


  }

  if (isset($_POST['update'])){
    $userid = $_POST['userid'];
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $passwd = trim($_POST['passwd']);

    $mysqli->query("UPDATE users SET first_name='$first_name',last_name='$last_name',
      email='$email', password='$passwd' WHERE userid=$userid") or die($mysqli->error);

    $_SESSION['message'] = "Record has Been Updated!";
    $_SESSION['msg_type'] = "SUCCESS";


    header("location: php_crud.php");
}


  if(isset($_GET['delete'])){
    $id =$_GET['delete'];
    $mysqli->query("DELETE FROM users WHERE userid=$id") or die ($mysqli->error);
    $_SESSION['message'] = "Record has Been Deleted!";
    $_SESSION['msg_type'] = "DANGER";

    header("location: php_crud.php");
  }
















?>
