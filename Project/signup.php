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
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon"/>
  </head>
  <body>
    <div class="wrapper wrapper-signup">
      <div class="login-title-box">
        <h2>Sign Up</h2>
      </div>

      <p class="info-p">Please fill in your credentials to login.</p>
      <form class="login-form"action="Backend/register.php" method="post">
        <div class="form-group">
          <label>Username</label>
          <input
            type="text"
            name="username"
            class="form-control"
            placeholder="Username ..."
            autofocus
          />
          <span class="invalid-feedback"></span>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input
            type="text"
            name="email"
            class="form-control"
            placeholder="email ..."
            autofocus
          />
          <span class="invalid-feedback"></span>
        </div>
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
          <input type="submit" class="btns-login btn" value="Submit" />
        </div>
        <p>Already have an account? <a href="loginpage.php">Login now</a>.</p>
      </form>
    </div>
  </body>
</html>
