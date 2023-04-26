
<?php
    $page = basename($_SERVER['PHP_SELF']);
?>

<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
            <span>
              HandTime
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">

              <li <?php echo $page === 'home' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li> 
              <li <?php echo $page === 'about' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
                <a class="nav-link" href="about.php">About</a>
              </li>
              <li <?php echo $page === 'products' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
                <a class="nav-link" href="products.php">Products</a>
              </li>
              <li <?php echo $page === 'contact' ? 'class="nav-item active"' : 'class="nav-item"' ?>>
                <a class="nav-link" href="contact.php">Contact Us</a>
              </li>

            </ul>
            <div class="user_optio_box">
              <a href="login.php">
              <?php 
                session_start();
                echo isset($_SESSION['login']) && $_SESSION['login'] == true ? $_SESSION['name'] : "prihláste sa"
              ?>

                <i class="fa fa-user" aria-hidden="true"></i>
              </a>
              <a href="php/card.php">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->

