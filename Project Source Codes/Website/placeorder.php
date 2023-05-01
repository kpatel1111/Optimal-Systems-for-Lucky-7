<?php
 $conn = mysqli_connect("localhost", "root", "", "cosc412");
 session_start();
 $sql="SELECT * from userdata where email='$_SESSION[email]'";
 $result=mysqli_query($conn, $sql);
 $rows=mysqli_fetch_assoc($result);
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Lucky 7 - Review Order</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
          href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

          <link rel="stylesheet" href="style16.css">
</head>
<body>
<header>
<!--Displays the header information to the user.-->
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
<!--The below class shows both the cost and order summary to the user before placing the final order.-->
<form action="finalcheckout.php" method="post">
<div class="full-page" id="full-page">
<h2 style="text-align:center; margin-bottom: 20px;">Hi <?php echo $_SESSION['firstName']?> <?php echo $_SESSION['lastName']?>, Please Review Your Order Details</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="/action_page.php">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i><b> Full Name</b></label>
            <p><?Php echo $rows['firstName'];?> <?php echo $rows['lastName'];?></p>
            <label for="email"><i class="fa fa-envelope"></i><b> Email</b></label>
            <p><?Php echo $rows['email']?></p>
            <label for="adr"><i class="fa fa-address-card-o"></i><b> Address</b></label>
            <p><?Php echo $rows['address']?></p>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname"><b>Accepted Cards</b></label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname"><b>Name on Card</b></label>
            <p><?Php echo $rows['firstName'];?> <?php echo $rows['lastName'];?></p>
            <label for="ccnum"><b>Credit Card Number</b></label>
            <p><?Php echo $rows['cardNumber']?></p>
            <div class="row">
              <div class="col-50">
                <label for="cvv"><b>CVV</b></label>
                <p><?Php echo $rows['cardCvv']?></p>
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" value="Place Order" class="btn">
      </form>
    </div>
  </div>
  <div class="col-25">

  
  <div class="container1">
  <h4>Shipping Estimation and Cost<span class="price" style="color:black"><i class='bx bx-package'></i></span></h4>
      <p>Delivery Type: Same Day</p>
      <p>Estimated Delivery Day: <?php echo date("l (m/d/Y)")?></p>
      <p>Shipping Cost: $ <?php echo $_SESSION['shippingcost']=rand(4,12);?>.00</p>
    </div>


    <div class="container">
      <h4>Cart Summary <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i></span></h4>
      <?php $sql="SELECT * from usercart WHERE email='$_SESSION[email]'";
      $result=mysqli_query($conn, $sql);

      while($rows=mysqli_fetch_assoc($result)) { ?>
      <p><?php echo $rows['productName']?> <span class="price">$ <?php echo $rows['price']?></span></p>
      <?php } ?>
      <hr>
      <p style="margin-top: 20px;">Items Total <span class="price" style="color:black"><b>$ <?php echo $_SESSION['itemstotal']?></b></span></p>
      <p>Estimated Tax <span class="price" style="color:black"><b>$ <?php echo $_SESSION['priceaftertax']?></b></span></p>
      <p>Shipping Cost <span class="price" style="color:black"><b>$ <?php echo  $_SESSION['shippingcost']?>.00</b></span></p>
      <hr>
     <p style="margin-top:20px;">Sub Total <span class="price" style="color:black"><b>$ <?php echo $_SESSION['subtotal']=$_SESSION['itemstotal']+$_SESSION['priceaftertax']+$_SESSION['shippingcost']?></b></span></p>
    </div>


    
  </div>

  
</div>
</div>
</form>
</body>
</html>
