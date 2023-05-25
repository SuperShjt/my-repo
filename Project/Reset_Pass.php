<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
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
      <p class="info-p">Please fill in your credentials to reset password.</p>
      <form class="login-form" action="Backend/SentEmail.php" method="post">
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
        <br><br>
        <div class="form-group">
          <input type="submit" class="btns-login btn" value="Submit" />
        </div>
      </form>
    </div>
  </body>
</html>