<?php
 $conn = mysqli_connect("localhost", "root", "", "cosc412");
 session_start();
 $_SESSION['itemstotal']=0;
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky 7 - Shopping Cart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style6.css">
    <link rel="stylesheet"
          href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
  <body>
  <header>
    <!--Display the header content-->
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

<form action="placeorder.php" method="post">
  <h2 style="text-align:center; color: red; margin-top: 100px;">Your Shopping Cart</h2>
  <button style="display: inline-block; padding: 16px 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px; background-color:blue;margin-left:695px;margin-top:20px;"> CheckOut </button>
<?php
$sql="SELECT * FROM usercart where email='$_SESSION[email]'";
$result=mysqli_query($conn,$sql);
?>

    <!--Shopping cart section-->
    <div class="small-container cart-page">
        <table id="myTable">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
<?php
while($rows=mysqli_fetch_array($result)){
?>
            <tr>
                <td>
                    <div class="cart-info">
                        <img src="<?php echo $rows['picture']?>">
                        <div>
                            <p>Name: <?php echo $rows['productName']?></p>
                            <small>Serial Number: <?php echo $rows['serialNumber']?></small>
                            <br>
                            <small>Price: <?php
                            $s="SELECT price FROM products WHERE serialNumber=$rows[serialNumber]";
                            $r=mysqli_query($conn,$s);
                            if($r=mysqli_fetch_assoc($r)){
                                echo $r['price'];
                            }
                            ?></small>
                            <br>
                            <a href="shoppingcartremoveitem.php?productName=<?php echo $rows['productName']; ?>">Remove</a>
                        </div>
                        </div>
                </td>
                <td>
                    
            <p>
            <?php echo $rows['quantity'];?>
			</p>

                </td>

                <td><?php
                $x=$rows['price'];
                $_SESSION['itemstotal']+=$x;
                echo $rows['price']; 
                ?>
                </td>
            </tr>
<?php } ?>
        </table>
</form>
<?php $result = mysqli_query($conn,$sql);

if($rows=mysqli_fetch_array($result)>0) { ?>
<!-- The below class is used to calculate and display costs like items-total, taxes, and sub-total.-->
        <div class="total-price">
            <table>
                <tr>
                    <td>Items Total</td>
                    <td><?php echo $_SESSION['itemstotal']?></td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td><?php $MD_TAX=0.06; 
                    $priceaftertax=$MD_TAX*$_SESSION['itemstotal'];
                    $_SESSION['priceaftertax']=$priceaftertax;
                    echo $priceaftertax;?></td>
                </tr>
                <tr>
                    <td>SubTotal</td>
                    <td><?php $subtotal=$_SESSION['itemstotal']+$_SESSION['priceaftertax'];
                    $_SESSION['subtotal']=$subtotal;
                    echo $subtotal;?></td>
                </tr>
            </table>
        </div>
        <?php } ?>
    </div>
  </body>
  </html>