<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>update</title>
    <link rel="stylesheet" href="../styles/updeat.css">
  </head>
  <body>
    <div class="value" style="margin-top:20px;">
      <?php
      require '../config.php';

      $res_sql = "";

      $conn = new mysqli($servername,$username,$password,$dbname);

        $id = $_GET['id'];

        $sql = "SELECT * FROM products WHERE id = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if there are any results
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
              if (isset($_POST['name'])) {
                $new_name = $_POST['name'];
                $new_price = $_POST['price'];
                $imgUrl = $row['img'];
                if (isset($_FILES["fileToUpload"]) && isset($_FILES["fileToUpload"]["tmp_name"])) {
                  $target_dir = "../images/products/";
                  $uploadOk = 1;

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
                          $imgUrl = $file_name;
                      }
                  }
                }

                $sql1 = "UPDATE products SET name = '$new_name', price = '$new_price', img = '$imgUrl' WHERE id = '$id'";
                $stmt = $conn->prepare($sql1);
                $stmt->execute();
                header('location:products.php');
              } ?>

              <h1>Խմբագրել ապրանք</h1>
              <form class="all" method="post" action="" enctype="multipart/form-data">
                <div class="name">
                  <label for="">Անվանում</label>
                  <input class="inp <?php echo isset($_SESSION['invalid']) ? "text-red" : ""; ?>" type="text" name="name" value="<?php echo $row["name"]?>" placeholder=" Անվանում">
                </div>
              <div class="price">
                <label for="">Գին</label>
                <input class="inp <?php echo isset($_SESSION['invalid']) ? "text-red" : ""; ?>" type="number" name="price" value="<?php echo $row["price"]?>" placeholder="Գին">
              </div>
                <div class="image">
                  <label for="fileToUpload">Նկար</label>
                  <?php
                  if ($row["img"]){
                    echo'<img src="'.$row["img"].'" alt="Image" style="max-width:200px;">';
                  }
                  ?>

                <input class="inp" type="file" name="fileToUpload" id="fileToUpload" >
                </div>
                <button type="submit" name="submit" value="Upload File" class="but">Պահպանել</button>
                  <a href="products.php" class="but1">Հետ վերադարձ</a>
              </form>


      <?php  }
        } else {
            echo "0 results";
        }

        //
        // $res_sql = $conn -> query("SELECT * FROM products");
        //
        // if($res_sql->num_rows>0){
        //   while($row = $res_sql->fetch_assoc()){
        //     $file_name = "..//images/products/". $row['img'];
        //
        //     echo '<tr>';
        //     echo '<td class="styled-td">'.$row['id'].'</td>';
        //     echo '<td class="styled-td">'.$row['name'].'</td>';
        //     echo '<td class="styled-td"><img src="'. $row['img'] .'"; style="width:60px; height:60px;"></td>';
        //     echo '<td class="styled-td">'.$row['price'].'</td>';
        //     echo '<td class="styled-td">'.$row['created_at'].'</td>';
        //     echo '<td class="styled-td">'.$row['updated_at'].'</td>';
        //     echo '<td class="styled-td"><a class="upd" href="updeat.php?id='.$row['id'].'">updeat</a><a class="delete" href="delete.php">delete</a></td>';
        //     echo '</tr>';
        //   }
        // }
    ?>
    </div>
  </body>
</html>
