<?php
//This class is used to checkout each order, and accordingly store order data into user order history, transaction log chart, and also generate a unique order id and send it to the driver.
		$conn = mysqli_connect("localhost", "root", "", "cosc412");
		session_start();
        //Generate an random orderid.
        $_SESSION['orderid']=rand(1000,100000);

		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
        //Get today's date and time.
        $id=rand();
        date_default_timezone_set("America/New_York");
        $date=date('m-d-y h:i:sa');

$sql = "SELECT *  FROM usercart WHERE email = '$_SESSION[email]'";
if(mysqli_query($conn, $sql)){
    $result=mysqli_query($conn, $sql);
    while($rows=mysqli_fetch_assoc($result)){
    $sql1="INSERT INTO userorderhistory VALUES ('$_SESSION[orderid]','$rows[email]','$rows[picture]','$rows[productName]','$rows[serialNumber]','$rows[quantity]','$rows[price]','$date')";
    $result1=mysqli_query($conn, $sql1);
    }
    } else echo "Cart is Empty.";

    $sql = "SELECT email FROM userdata WHERE type = 'driver'";
    $result=mysqli_query($conn, $sql);
    $drivers=array();
    $count=0;
    while($rows=mysqli_fetch_assoc($result)){
        array_push($drivers,"$rows[email]");
        $count+=1;
    }
    $random_keys=rand(0,($count-1));
    $driver=$drivers[$random_keys];
    $sql="INSERT INTO driverdata VALUES ('$driver','$_SESSION[orderid]','order placed')";
    $result=mysqli_query($conn, $sql);

$sql = "SELECT *  FROM usercart WHERE email = '$_SESSION[email]'";
if(mysqli_query($conn, $sql)){
    $result=mysqli_query($conn, $sql);
    while($rows=mysqli_fetch_assoc($result)){
    $sql1="INSERT INTO transactionlog VALUES ('$id','$rows[productName]','$rows[price]','$date','$rows[email]')";
    $result1=mysqli_query($conn, $sql1);
    header('location: ordercompleted.php');
    }
    } else echo "Cart is Empty.";
		
		// Close connection
		mysqli_close($conn);
?>
