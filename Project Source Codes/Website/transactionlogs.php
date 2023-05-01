<?php
//This class displays the transaction logs of the owner in a table format.
 session_start();
 $conn = mysqli_connect("localhost", "root", "", "cosc412");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky 7 - Order History</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style12.css">
    <link rel="stylesheet"
          href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
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
<div class="full-page" id="full-page">
<h2 style="text-align:center; color: red; margin-top:100px;">Transaction History</h2>
<?php
$sql="SELECT * FROM transactionlog";
$result=mysqli_query($conn,$sql);
?>
<table>
  <tr>
    <th>Transaction ID</th>
    <th>Product</th>
    <th>Price</th>
    <th>Purchase Date</th>
    <th>Customer Email</th>
  </tr>
  <?php
while($rows=mysqli_fetch_array($result)){
?>
  <tr>
    <td><?php echo $rows['id']?></td>
    <td><?php echo $rows['product']?></td>
    <td><?php echo $rows['price']?></td>
    <td><?php echo $rows['purchaseDate']?></td>
    <td><?php echo $rows['customerEmail']?></td>
  </tr>
  <?php } ?>
</table>
</div>
</body>
</html>

