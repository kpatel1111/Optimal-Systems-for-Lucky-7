<?php
//This class displays the order tracking details in terms of a progress bar representation, and also includes the name and phone number of the driver assigned to that unique orderid.
 $conn = mysqli_connect("localhost", "root", "", "cosc412");
 session_start();
 $orderid =$_REQUEST['orderid'];
 $sql="SELECT * from driverdata WHERE orderid='$orderid'";
 $result=mysqli_query($conn,$sql);
 $rows=mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap 4.3.1 CDN -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <!-- FontAwesome 4.7.0 CDN -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
      integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <?php if($rows['status']==='Delivered'){ ?>
    <link rel="stylesheet" href="style8.css" />
    <?php } ?>

    <?php if($rows['status']==='order placed'){ ?>
    <link rel="stylesheet" href="style10.css" />
    <?php } ?>

   
    <?php if($rows['status']==='In Transit'){ ?>
    <link rel="stylesheet" href="style9.css" />
    <?php } ?>

    <?php if($rows['status']==='picked up'){ ?>
    <link rel="stylesheet" href="style11.css" />
    <?php } ?>
    <title>Document</title>
  </head>
  <body>
    <div class="container px-1 px-md-4 py-5 mx-auto">
      <div class="card">
        <div class="row d-flex justify-content-between px-3 top">
          <div class="d-flex">
            <h5>
              ORDER ID: 
              <span class="text-primary font-weight-bold"><?php echo $rows['orderid'];?></span>
            </h5>
          </div>
          <div class="d-flex flex-column text-sm-right">
            <?php
            $sql="SELECT * FROM userdata WHERE email='$rows[email]'";
            $result=mysqli_query($conn,$sql);
            $rows=mysqli_fetch_assoc($result);
            ?>
            <p class="mb-0">
              Driver Name: <span class="font-weight-bold"><?php echo $rows['firstName'];?> <?php echo $rows['lastName'];?></span>
            </p>
            <p>
              Driver Phone Number: <span class="font-weight-bold"><?php echo $rows['phoneNumber'];?></span>
            </p>
          </div>
        </div>
        <!-- Add class "active" to progress -->
        <div class="row d-flex justify-content-center">
          <div class="col-12">
            <ul id="progressbar" class="text-center">
              <li class="active step0"></li>
              <li class="active step0"></li>
              <li class="active step0"></li>
              <li class="step0"></li>
            </ul>
          </div>
        </div>
        <div class="row justify-content-between top">
          <div class="row d-flex icon-content">
            <img src="./images/CheckList.png" alt="" class="icon" />
            <div class="d-flex flex-column">
              <p class="font-weight-bold">Order <br />Placed</p>
            </div>
          </div>
          <div class="row d-flex icon-content">
            <img src="./images/Delivery.png" alt="" class="icon" />
            <div class="d-flex flex-column">
              <p class="font-weight-bold">Order <br />Pickedup</p>
            </div>
          </div>
          <div class="row d-flex icon-content">
            <img src="./images/Shipping.png" alt="" class="icon" />
            <div class="d-flex flex-column">
              <p class="font-weight-bold">Order <br />Enroute</p>
            </div>
          </div>
          <div class="row d-flex icon-content">
            <img src="./images/Home.png" alt="" class="icon" />
            <div class="d-flex flex-column">
              <p class="font-weight-bold">Order <br />Delivered</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>