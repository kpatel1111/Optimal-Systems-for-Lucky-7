<?php
 session_start();
 $conn = mysqli_connect("localhost", "root", "", "cosc412");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky 7 - Delivery Records</title>
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
  <!-- Display the content header.-->
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
<!-- The below class with get delivery list of the driver from the database and show it in a table format. In addition, update status button can be used to change the delivery status of an existing order.-->
<div class="full-page" id="full-page">
<h2 style="text-align:center; color: red; margin-top:100px;">Your Delivery Schedule</h2>
<?php
$sql="SELECT * from driverdata WHERE email='$_SESSION[email]'";
$result=mysqli_query($conn, $sql);
?>
<table>
  <tr>
  <th>Order ID</th>
   <th>Customer Name</th>
   <th>Customer Address</th>
   <th>Customer Phone</th>
    <th>Delivery Status</th>
    <th>Update Delivery</th>
  </tr>
  <?php
while($rows=mysqli_fetch_array($result)){
    $sql1="SELECT DISTINCT orderid, email from userorderhistory WHERE orderid='$rows[orderid]'";
    $result1=mysqli_query($conn,$sql1);
while($rows1=mysqli_fetch_array($result1)){
        $sql2="SELECT * from userdata WHERE email='$rows1[email]'";
        $result2=mysqli_query($conn,$sql2);
while($rows2=mysqli_fetch_array($result2)){
?>
  <tr <?php if($rows['status']==='delivered' || $rows['status']==='Delivered') {?> style="background-color:lightgreen;"<?php }?>> 
  <td><?php echo $rows['orderid']?></td>
    <td><?php echo $rows2['firstName']?> <?php echo $rows2['lastName']?></td>
    <td><?php echo $rows2['address']?></td>
    <td><?php echo $rows2['phoneNumber']?></td>
    <td><?php echo $rows['status']?></td>
    <td><button><a href="updatedeliverystatusform.php?orderid=<?php echo $rows['orderid']; ?>">Update Delivery</a></button></td>
  </tr>
  <?php } } }?>
</table>
</div>
</body>
</html>

