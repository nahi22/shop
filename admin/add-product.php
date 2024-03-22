<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>add-product</title>
    <link rel="stylesheet" href="../styles/add-product.css">
  </head>
  <body>
    <h1>Ավելացնել ապրանք</h1>
    <form class="all" method="post" action="create-product.php" enctype="multipart/form-data">
      <div class="name">
        <label for="">Անվանում</label>
        <input class="inp <?php echo isset($_SESSION['invalid']) ? "text-red" : ""; ?>" type="text" name="name" value="" placeholder=" Անվանում">
      </div>
    <div class="price">
      <label for="">Գին</label>
      <input class="inp <?php echo isset($_SESSION['invalid']) ? "text-red" : ""; ?>" type="number" name="price" value="" placeholder="Գին">
    </div>
      <div class="image">
        <label for="fileToUpload">Նկար</label>
        <input class="inp" type="file" name="fileToUpload" id="fileToUpload">
      </div>
      <button type="submit" name="submit" value="Upload File" class="but">Պահպանել</button>
        <a href="products.php" class="but1">Հետ վերադարձ</a>
    </form>
  </body>
</html>
