<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $login = $_POST['username'];
      $pass = $_POST['password'];
      $stmt = $conn->prepare("SELECT * FROM user WHERE email='$login' AND password='$pass'");
      $stmt->execute();

      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

      if (count($stmt->fetchAll()) > 0) {
         header('location:admin/products.php');
      }else {
        session_start();
        $_SESSION['invalid'] = 'Wrong username or password';
        header('location:admin.php');
      }
       }
        catch (\Exception $e) {
         echo $e->getMessage();
    }






?>
