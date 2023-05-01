<?php
 $conn = mysqli_connect("localhost", "root", "", "cosc412");
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky 7 - Home</title>
    <!-- CSS-link -->
    <link rel="stylesheet" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"
          href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

</head>
<body>
<header>
      <!--Display the content header menus to the user.-->
    <ul class="navmenu">
    <?php if($_SESSION['type']==="customer") { ?>
        <li><a href="index.php">Home</a></li>
        <li><a href="promotionaldeals.php">Promotional Deals</a></li>
        <li><a href="foodanddrinks.php">Food and Soft Drinks</a></li>
        <li><a href="accessories.php">Accessories</a></li>
        <li><a href="ordertracking.php">Track Order</a></li>
        <li><a href="customerreview.html">Customer Reviews</a></li>
        <?php } ?>

        <?php if($_SESSION['type']==="owner") { ?>
        <li><a href="index.php">Home</a></li>
        <li><a href="foodanddrinks.php">Food and Soft Drinks</a></li>
        <li><a href="accessories.php">Accessories</a></li>
            <li><a href="addinventoryproduct.php">Add Inventory</a></li>
            <li><a href="updateinventoryproduct.php">Update Inventory</a></li>
            <li><a href="deleteinventoryproduct.php">Delete Inventory</a></li>
            <?php } ?>

            <?php if($_SESSION['type']==="driver") { ?>
        <li><a href="index.php">Home</a></li>
        <li><a href="promotionaldeals.php">Promotional Deals</a></li>
        <li><a href="foodanddrinks.php">Food and Soft Drinks</a></li>
        <li><a href="accessories.php">Accessories</a></li>
            <li><a href="driverdeliverydata.php">Delivery Schedule</a></li>
            <?php } ?>
    </ul>
    <div class="nav-icon">
        <a href="search.php"><i class='bx bx-search'></i></a>
        <div class="dropdown">
            <a href="#"><i class='bx bxs-user' ></i></a>
            <div class="dropdown-content">
              <a href="useraccountpage.php">Profile Card</a>
              <a href="orderhistory.php">Order History</a>
               <?php if($_SESSION['type']==="owner") { ?>
              <a href="transactionlogs.php">Transaction Logs</a>
              <?php } ?>
            </div>
          </div>
        <a href="cartform.php"><i class='bx bx-cart' ></i></a>

        <div class="bx bx-menu" id="menu-icon"></div>
    </div>
</header>
<!--This class displays the home-page of the whole website.-->
<section class="main-home" id="main-home">
    <div class="main-text">
        <h1>Lucky 7<br>Convenience Store</h1>

        <a href="#trending" class="main-btn">Shop Now <i class='bx bx-right-arrow-alt' ></i></a>
    </div>

    <div class="down-arrow">
        <a href="#trending" class="down"><i class='bx bx-down-arrow-alt'></i></a>
    </div>
</section>

<?php 
$serials = array();
$count=0;
$sql="SELECT * FROM products";
$result=mysqli_query($conn,$sql);
while($rows=mysqli_fetch_assoc($result)){
    array_push($serials, $rows['serialNumber']);
    $count+=1;

} ?>
<!--trending-products-section-->
<section class="trending-product" id="trending">
    <div class="center-text">
        <h2>Our Trending <span>products</span></h2>
    </div>
    <div class="products">
    <?php for($i=0;$i<8;$i++){ 
        $random_keys=rand(0,($count-1));
        $sql = "SELECT * from products WHERE serialNumber='$serials[$random_keys]'";
        $result=mysqli_query($conn,$sql);
        $rows=mysqli_fetch_array($result); ?>
        <div class="row1">
            <img src="<?php echo $rows['picture'];?>" alt="">
            <div class="product-text">
                <h5>Trending</h5>
            </div>
            <div class="price">
                <h4><b>Name: </b><?php echo $rows['productName'];?></h4>
            </div>
        </div>
<?php } ?>

    </div>
</section>

<!--contact footer section-->
<section class="contact" id="contact">
    <div class="contact-info">
        <div class="first-info">
            <h1>Lucky 7</h1>

            <p>4568 York Road,<br>Towson, MD, 21334</p>
            <p>(410)-123-6789</p>
            <p>lucky7@yahoo.com</p>

            <div class="social-icon">
                <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                <a href="#"><i class='bx bxl-twitter' ></i></a>
                <a href="#"><i class='bx bxl-instagram-alt' ></i></a>
                <a href="#"><i class='bx bxl-youtube' ></i></a>
                <a href="#"><i class='bx bxl-linkedin-square' ></i></a>

            </div>
        </div>

        <div class="second-info">
            <h4>Support</h4>
            <p><a href="logout.php">Logout</a></p>
            <p>Live Chat Support</p>
            <p><a href="lucky7aboutus.html">About Us</a></p>
            <p><a href="privacypage.html">Privacy</a></p>
            <p><a href="useraccountpage.php">User Page</a></p>

        </div>

        <div class="third-info">
            <h4>Shop</h4>
            <p><a href="foodanddrinks.php">Shop Food</a></p>
            <p><a href="foodanddrinks.php">Shop Soft Drinks</a></p>
            <p><a href="accessories.php">Shop Accessories</a></p>
            <p><a href="promotionaldeals.php">Shop Promotional Deals</a></p>
        </div>

        <div class="five">
            <h4>Subscribe</h4>
            <p>Receive Updates, Hot Deals, Discounts Sent Straight In Your Inbox Daily</p>

        </div>

    </div>
</section>

<div class="end-text">
    <p>Copyright @2023. All Rights Reserved. Designed by Lucky 7 Convenience Store.</p>
</div>


<script src="java.js"></script>


</body>
</html>
