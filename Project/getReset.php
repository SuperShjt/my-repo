<?php 
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="style/signin.css" />
    <link rel="stylesheet" href="style/common.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="wrapper wrapper-signup">
      <div class="login-title-box">
        <h2>Reset Password</h2>
      </div>
      <p class="info-p">Please fill in your new Password.</p>
      <form class="login-form"action="Backend/PassReset.php" method="post">
        <div class="form-group">
          <label>Password</label>
          <input
            type="password"
            name="password"
            class="form-control"
            placeholder="Password ..."
          />
          <span class="invalid-feedback"></span>
        </div>
        <div class="form-group">
          <label>Confirm Password</label>
          <input
            type="password"
            name="confirm_password"
            class="form-control"
            placeholder="Confirm Password ..."
          />
          <span class="invalid-feedback"></span>
        </div>
        <div class="form-group">
            <?php 
                include 'Backend/domain-name.php';
                $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $link = (explode("$DOMAIN_NAME/getReset.php?",$link));
                $u_email = $link[1];
                $_SESSION['u_email'] = $u_email;
            ?>
          <input type="submit" class="btns-login btn" value="Submit" />
        </div>
      </form>
    </div>
  </body>
</html>
