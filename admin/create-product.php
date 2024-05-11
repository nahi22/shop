<?php
require '../config.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['fileToUpload'];

    $target_dir = "../images/products/";
    $uploadOk = 1;
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
      if (isset($_FILES["fileToUpload"])) {
        $file_name = "../images/products/". $_FILES["fileToUpload"]["name"];
        $target_file = $target_dir . basename($file_name);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size (you can adjust this limit as needed)
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowed_formats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowed_formats)) {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is okay, try to upload the file
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                // INSERT
                 $sql = "INSERT INTO products (name, price, img) VALUES ('$name', '$price','$file_name')";
                 $conn->exec($sql);
                 header('location:products.php');
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}catch (\Exception $e) {
  echo $e->getMessage();
}

//       }
//     }
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//   $check = getimagesize($_FILES["image"]["tmp_name"]);
//   if($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }
//
// // Check if file already exists
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// }
//
// // Check file size
// if ($_FILES["image"]["size"] > 500000) {
//   echo "Sorry, your file is too large.";
//   $uploadOk = 0;
// }
//
// // Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }
//
// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//   echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//   if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
//     echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
//   } else {
//     echo "Sorry, there was an error uploading your file.";
//   }
// }
//     $sql = "INSERT INTO products (name, price, img) VALUES ($name, $price,$target_file)";
//
//


 ?>
