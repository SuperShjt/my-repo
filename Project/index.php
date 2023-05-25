<!-- Start Landing Page -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MyRepo</title>
    <link rel="stylesheet" href="style/Landstyle.css" />
    <link rel="stylesheet" href="style/footer.css"/>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="landing-page">
      <div class="container">
        <!-- Navbar -->
        <nav
          class="flex navbar navbar-expand-lg navbar-light"
          style="height: 90px"
        >
          <span class="logo mr-5">MyRepo</span>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div
            class="collapse navbar-collapse nav-med"
            style="background: #fff; padding-left: 15px; z-index: 5"
            id="navbarSupportedContent"
          >
            <ul class="navbar-nav float-right pl-5">
              <li class="nav-item">
                <a class="nav-link" href="Terms.php"> Terms & Condition</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Plans.php"> Plans</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="AboutUs.html"> About us</a>
              </li>
              <li onclick="location.href='Home.php'">
                <a class="nav-link btn-sm btn-success pl-2 text-white"
                  >Login / Register</a>
              </li>
            </ul>
          </div>
        </nav>
        <!-- <div class="header-area">
          <div class="logo">MyRepo</div>
          <ul class="links">
            <li>Terms & Condition</li>
            <li>Plans</li>
            <li onclick="location.href='Home.php'">Login / Register</li>
          </ul>
        </div> -->
        <div class="land-home">
          <div class="info">
            <h1>Looking For More Privacy..?</h1>
            <p>
              MyRepo is What you looking for with our highly secure system where
              you can save all your files safely.
            </p>
          </div>
          <div class="image">
            <img src="https://i.postimg.cc/65QxYYzh/001234.png" />
          </div>
        </div>
        <div class="land-home">
          <div class="image">
            <img id="security-img" src="https://www.vmware.com/content/dam/digitalmarketing/vmware/en/images/gallery/illustrations/illu-vmw-security-overview.jpg" />
          </div>
          <div class="info">
            <h1>Our Servers Know Nothing, Literally.</h1>
            <p>
              MyRepo encrpypts your uploaded files within your browser before pushing it to our servers.
              This means the server does not know what it is receiving.
            </p>
          </div>
        </div>
      </div>
    </div>


    <footer>
        <div class="footer-content">
            <h3>MyRepo</h3>
            <p class="footer-p">MyRepo, Storage As A Service Website. MyRepo is What you looking for with our highly secure system where you can save all your files safely.</p>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy; <a href="#">MyRepo</a>  </p>
                    <div class="footer-menu">
                      <ul class="f-menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="Plans.php">Plans</a></li>
                        <li><a href="AboutUs.html">About Us</a></li>
                        <li><a href="Home.php">Login/Register</a></li>
                      </ul>
                    </div>
        </div>

    </footer>


    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
  </body>
  <!-- End Landing Page -->
</html>
