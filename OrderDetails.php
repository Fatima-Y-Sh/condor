<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Boutique | Ecommerce bootstrap template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/front/bootstrap/css/bootstrap.min.css">
    <!-- Lightbox-->
    <link rel="stylesheet" href="vendor/front/lightbox2/css/lightbox.min.css">
    <!-- Range slider-->
    <link rel="stylesheet" href="vendor/front/nouislider/nouislider.min.css">
    <!-- Bootstrap select-->
    <link rel="stylesheet" href="vendor/front/bootstrap-select/css/bootstrap-select.min.css">
    <!-- Owl Carousel-->
    <link rel="stylesheet" href="vendor/front/owl.carousel2/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/front/owl.carousel2/assets/owl.theme.default.css">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/front/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/front/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/front/favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
  <?php
      include("controllers/database/connection.php");
      $con=openCon();
      //$usersid=1;
      session_start();
    if (!isset($_SESSION['id'])){
    $users_id=-1;
    header('Location:user/login.php');
    }
    else $users_id=$_SESSION['id'];
      //$ordersid=1;
      $ordersid = $_GET["id"];
      $orders = mysqli_query($con, "select * from orders where users_id=$users_id and ordersid=$ordersid");
      if (mysqli_num_rows($orders)==false)
        header('Location:index.php');
    ?>
    <div class="page-holder">
      <!-- navbar-->
      <header class="header bg-white">
      <div class="container px-0 px-lg-3">
        <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="index.php"><span class="font-weight-bold text-uppercase text-dark">Boutique</span></a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <!-- Link--><a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <!-- Link--><a class="nav-link" href="shop.php">Shop</a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto">

              <?php
                if($users_id == -1) {
              ?>
              <li class="nav-item"><a class="nav-link" href="user/login.php"> <i class="fas fa-user-alt mr-1 text-gray"></i>Login</a></li>
              <?php }
              else {
                echo "<li class='nav-item'><a class='nav-link' href='cart.php'> <i class='fas fa-dolly-flatbed mr-1 text-gray'></i>Cart<small class='text-gray'></small></a></li>
                <li class='nav-item'><a class='nav-link' href='wishlist1.php'> <i class='far fa-heart mr-1'></i><small class='text-gray'></small></a></li>";
                echo "

                <li class='nav-item dropdown'><a class='nav-link dropdown-toggle' id='pagesDropdown' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-user-alt mr-1 text-gray'></i></a>
                  <div class='dropdown-menu mt-3' aria-labelledby='pagesDropdown'><a class='dropdown-item border-0 transition-link' href='user/profile.php?id=".base64_encode($users_id)."'>User Profile</a>
                  ";
                  echo "
                  <a class='dropdown-item border-0 transition-link' href='myorders.php'>My Orders</a>";
                  if (isset($_SESSION['admin'])&& $_SESSION['admin']==true)
                  echo "
                  <a class='dropdown-item border-0 transition-link' href='admin/index.php'>Admin Panel</a>";
                  echo "
                  <a class='dropdown-item border-0 transition-link' href='user/logout.php'>Logout</a></div>
                </li>";
              }
              ?>
            </ul>
          </div>
        </nav>
      </div>
    </header>
      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Order <?php echo $ordersid?></h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="myorders.php">My Orders</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order <?php echo $ordersid?></li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <h2 class="h5 text-uppercase mb-4">Items</h2>
          <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
              <!-- CART TABLE-->
              <div class="table-responsive mb-4">
                <table class="table">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Product</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Price</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Quantity</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Total</strong></th>
                      <th class="border-0" scope="col"> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $total = 0;
                      while ($rorders=mysqli_fetch_array($orders)){
                        $billing_id = $rorders["billing_information_id"];
                        $coupon = $rorders["coupons_coupon"];
                        $totalitem = 0;
                        $price = $rorders["unitPrice"]*(1-($rorders["discountPerc"]/100));
                        $totalperproduct = $price * $rorders["quantity"];
                        $total = $total + $totalperproduct;
                        $products = mysqli_query($con, "select products.name, products_media.media_path from products, products_media where products_media.products_id=$rorders[products_id] and products.id=$rorders[products_id]");
                        $rproducts = mysqli_fetch_array($products);
                        echo
                        "<tr>
                        <th class='pl-0 border-light' scope='row'>
                          <div class='media align-items-center'><a class='reset-anchor d-block animsition-link' href='detail.php?productid=".base64_encode($rorders["products_id"])."'><img src='".$rproducts["media_path"]."' alt='...' width='70'/></a>
                            <div class='media-body ml-3'><strong class='h6'><a class='reset-anchor animsition-link' href='detail.php?productid=".base64_encode($rorders["products_id"])."'>".$rproducts["name"]."</a></strong></div>
                          </div>
                        </th>";
                        if ($rorders["discountPerc"]==0){
                          echo "
                          <td class='align-middle border-light'>
                            <p class='mb-0 small'>$".$price."</p>
                          </td>";
                        }
                        else {
                          echo "
                          <td class='align-middle border-light'>
                            <p class='mb-0 small'><s>$".$rorders["unitPrice"]."</s>&nbsp&nbsp$".($price)."</p>
                          </td>";
                        }
                        echo "
                        <td class='align-middle border-light'>
                          <p class='mb-0 small'>".$rorders["quantity"]."</p>
                        </td>
                        <td class='align-middle border-light'>
                          <p class='mb-0 small'>$".$totalperproduct."</p>
                        </td>
                      </tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>

              <section class="py-12">
                <?php
                  $users = mysqli_query($con, "select * from billing_information where id = $billing_id");
                  $rusers = mysqli_fetch_array($users);
                ?>
          <!-- BILLING ADDRESS-->
          <h2 class="h5 text-uppercase mb-4">Billing details</h2>
          <div id="toappend"></div>
          <div class="row">
            <div class="col-lg-12">
              <!-- <form action="#" id='main'> -->
                <div class="row">
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="firstName">First name</label>
                    <input class="form-control form-control-lg" id="firstName" name="firstName" type="text" value='<?php
                        echo $rusers["first_name"];
                        ?>' disabled>
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="lastName">Last name</label>
                    <input class="form-control form-control-lg form-control" id="lastName" name="lastName" type="text" value='<?php
                        echo $rusers["last_name"];
                        ?>' disabled>
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="email">Email address</label>
                    <input class="form-control form-control-lg" name = "email "id="email" type="email" value='<?php
                        echo $rusers["email"];
                        ?>' disabled>
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="phone">Phone number</label>
                    <input class="form-control form-control-lg" id="phone" name = "phone" type="tel" placeholder="e.g. +02 245354745" value='<?php
                        echo $rusers["phone_number"];
                        ?>' disabled>
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="company">Company name (optional)</label>
                    <input class="form-control form-control-lg" id="company" name = "company" type="text" placeholder="Your company name" value='<?php
                        echo $rusers["company_name"];
                        ?>' disabled>
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="country">Country</label>
                    <select class="selectpicker country" id="country" name = "country" data-width="fit" data-style="form-control form-control-lg" data-title='<?php
                        echo $rusers["country"];
                        ?>' disabled></select>
                  </div>
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="address">Address line 1</label>
                    <input class="form-control form-control-lg" id="address" name = "address" type="text" placeholder="House number and street name" disabled value ='<?php
                        echo $rusers["address"];
                        ?>'>
                  </div>
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="address">Address line 2</label>
                    <input class="form-control form-control-lg" id="addressalt" type="text" name = "addressalt"  placeholder="Apartment, Suite, Unit, etc (optional)" disabled value='<?php
                        echo $rusers["address2"];
                        ?>'>
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="city">Town/City</label>
                    <input class="form-control form-control-lg" name="city" id="city" type="text" value='<?php
                        echo $rusers["city"];
                        ?>' disabled>
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="zip">Zip</label>
                    <input class="form-control form-control-lg" name="zip" id="zip" type="text" value='<?php
                        echo $rusers["zip"];
                        ?>' disabled>
                  </div>
                    </section>

              <!-- CART NAV-->
              <div class="bg-light px-4 py-3">
                <div class="row align-items-center text-center">
                  <div class="col-md-6 mb-3 mb-md-0 text-md-left"><a class="btn btn-link p-0 text-dark btn-sm" href="MyOrders.php"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Order History</a></div>
                </div>
              </div>
            </div>
            <!-- ORDER TOTAL-->
            <div class="col-lg-4">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Order Total</h5>
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Subtotal</strong><span class="text-muted small">$<?php echo $total ?></span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between mb-4"><strong class="text-uppercase small font-weight-bold">Total</strong><span>$
                      <?php
                      //echo $coupon;
                        if ($coupon!=null){
                          $cpn = mysqli_query($con, "select * from coupons where coupon = $coupon");
                          $rcpn = mysqli_fetch_array($cpn);
                          echo $total*(1-($rcpn['percentage']/100));
                          echo "<li class='text-muted small'>Coupon ".$coupon." used for".$rcpn['percentage']." % off</li>";
                        }
                        else {
                          echo $total;
                        }
                      ?>
                    </span></li>
                    <li>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <footer class="bg-dark text-white">
        <div class="container py-4">
          <div class="row py-5">
            <div class="col-md-4 mb-3 mb-md-0">
              <h6 class="text-uppercase mb-3">Customer services</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="#">Help &amp; Contact Us</a></li>
                <li><a class="footer-link" href="#">Returns &amp; Refunds</a></li>
                <li><a class="footer-link" href="#">Online Stores</a></li>
                <li><a class="footer-link" href="#">Terms &amp; Conditions</a></li>
              </ul>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
              <h6 class="text-uppercase mb-3">Company</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="#">What We Do</a></li>
                <li><a class="footer-link" href="#">Available Services</a></li>
                <li><a class="footer-link" href="#">Latest Posts</a></li>
                <li><a class="footer-link" href="#">FAQs</a></li>
              </ul>
            </div>
            <div class="col-md-4">
              <h6 class="text-uppercase mb-3">Social media</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="#">Twitter</a></li>
                <li><a class="footer-link" href="#">Instagram</a></li>
                <li><a class="footer-link" href="#">Tumblr</a></li>
                <li><a class="footer-link" href="#">Pinterest</a></li>
              </ul>
            </div>
          </div>
          <div class="border-top pt-4" style="border-color: #1d1d1d !important">
            <div class="row">
              <div class="col-lg-6">
                <p class="small text-muted mb-0">&copy; 2020 All rights reserved.</p>
              </div>
              <div class="col-lg-6 text-lg-right">
                <p class="small text-muted mb-0">Template designed by <a class="text-white reset-anchor" href="https://bootstraptemple.com/p/bootstrap-ecommerce">Bootstrap Temple</a></p>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <!-- JavaScript files-->
      <script src="vendor/front/jquery/jquery.min.js"></script>
      <script src="vendor/front/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="vendor/front/lightbox2/js/lightbox.min.js"></script>
      <script src="vendor/front/nouislider/nouislider.min.js"></script>
      <script src="vendor/front/bootstrap-select/js/bootstrap-select.min.js"></script>
      <script src="vendor/front/owl.carousel2/owl.carousel.min.js"></script>
      <script src="vendor/front/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
      <script src="js/front/front.js"></script>
      <script>
        // ------------------------------------------------------- //
        //   Inject SVG Sprite -
        //   see more here
        //   https://css-tricks.com/ajaxing-svg-sprite/
        // ------------------------------------------------------ //
        function injectSvgSprite(path) {

            var ajax = new XMLHttpRequest();
            ajax.open("GET", path, true);
            ajax.send();
            ajax.onload = function(e) {
            var div = document.createElement("div");
            div.className = 'd-none';
            div.innerHTML = ajax.responseText;
            document.body.insertBefore(div, document.body.childNodes[0]);
            }
        }
        // this is set to BootstrapTemple website as you cannot
        // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
        // while using file:// protocol
        // pls don't forget to change to your domain :)
        injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');

      </script>
      <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </div>
  </body>
</html>
