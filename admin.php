<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin panel</title>
    <link rel="stylesheet" href="styles/php.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
    <form action="login.php" method="post">
      <h3>Log In</h3>
      <?php
      session_start();
      if( isset($_SESSION['invalid']) ) {
        // echo "<p style='color:red;'>" . $_SESSION['invalid'] . "</p>";
      }
       ?>
      <label class="top" for="">Email</label>
      <div class="email">
        <i class="fa-solid fa-envelope"></i>
        <input class="inp <?php echo isset($_SESSION['invalid']) ? "text-red" : ""; ?>" type="email" name="username" id="subj" value=""  placeholder="  E-mail">
      </div>
      <label class="top" for="">Password</label>
      <div class="pass">
        <i class="fa-solid fa-lock"></i>
        <input class="inp <?php echo isset($_SESSION['invalid']) ? "text-red" : ""; ?>" type="password" name="password" value="" placeholder="  password">
        <?php
        if( isset($_SESSION['invalid']) ) {
          $_SESSION['invalid']=null;
        }
         ?>
      </div>
      <section>
        <input class="fon"type="checkbox" name="" value="">
        <label class="fon"for="">Remember me</label>
        <a href="forgot your password">Forgot your password?</a>
      </section>
      <button class="but" type="submit">Login</button>
    </form>

  </body>
</html>
