<?php
//This class provides the search interface to the users.
$conn = mysqli_connect("localhost", "root", "", "cosc412");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="style18.css">
     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lucky 7 - Search</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
          href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>
<header>
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
<h1 style="margin-top:80px;text-align:center;color:red;">Search Inventory</h1>
     <!--Make sure the form has the autocomplete function switched off:-->
     <form autocomplete="off" action="action_page.php">
          <div class="autocomplete" style="width:300px;">
               <input class="input-field" id="myInput" type="text" name="myCountry" placeholder="Search Inventory">
          </div>
          <input type="submit">
     </form>

     <script>
          function autocomplete(inp, arr) {
               /*the autocomplete function takes two arguments,
               the text field element and an array of possible autocompleted values:*/
               var currentFocus;
               /*execute a function when someone writes in the text field:*/
               inp.addEventListener("input", function (e) {
                    var a, b, i, val = this.value;
                    /*close any already open lists of autocompleted values*/
                    closeAllLists();
                    if (!val) { return false; }
                    currentFocus = -1;
                    /*create a DIV element that will contain the items (values):*/
                    a = document.createElement("DIV");
                    a.setAttribute("id", this.id + "autocomplete-list");
                    a.setAttribute("class", "autocomplete-items");
                    /*append the DIV element as a child of the autocomplete container:*/
                    this.parentNode.appendChild(a);
                    /*for each item in the array...*/
                    for (i = 0; i < arr.length; i++) {
                         /*check if the item starts with the same letters as the text field value:*/
                         if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                              /*create a DIV element for each matching element:*/
                              b = document.createElement("DIV");
                              /*make the matching letters bold:*/
                              b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                              b.innerHTML += arr[i].substr(val.length);
                              /*insert a input field that will hold the current array item's value:*/
                              b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                              /*execute a function when someone clicks on the item value (DIV element):*/
                              b.addEventListener("click", function (e) {
                                   /*insert the value for the autocomplete text field:*/
                                   inp.value = this.getElementsByTagName("input")[0].value;
                                   /*close the list of autocompleted values,
                                   (or any other open lists of autocompleted values:*/
                                   closeAllLists();
                              });
                              a.appendChild(b);
                         }
                    }
               });
               /*execute a function presses a key on the keyboard:*/
               inp.addEventListener("keydown", function (e) {
                    var x = document.getElementById(this.id + "autocomplete-list");
                    if (x) x = x.getElementsByTagName("div");
                    if (e.keyCode == 40) {
                         /*If the arrow DOWN key is pressed,
                         increase the currentFocus variable:*/
                         currentFocus++;
                         /*and and make the current item more visible:*/
                         addActive(x);
                    } else if (e.keyCode == 38) { //up
                         /*If the arrow UP key is pressed,
                         decrease the currentFocus variable:*/
                         currentFocus--;
                         /*and and make the current item more visible:*/
                         addActive(x);
                    } else if (e.keyCode == 13) {
                         /*If the ENTER key is pressed, prevent the form from being submitted,*/
                         e.preventDefault();
                         if (currentFocus > -1) {
                              /*and simulate a click on the "active" item:*/
                              if (x) x[currentFocus].click();
                         }
                    }
               });
               function addActive(x) {
                    /*a function to classify an item as "active":*/
                    if (!x) return false;
                    /*start by removing the "active" class on all items:*/
                    removeActive(x);
                    if (currentFocus >= x.length) currentFocus = 0;
                    if (currentFocus < 0) currentFocus = (x.length - 1);
                    /*add class "autocomplete-active":*/
                    x[currentFocus].classList.add("autocomplete-active");
               }
               function removeActive(x) {
                    /*a function to remove the "active" class from all autocomplete items:*/
                    for (var i = 0; i < x.length; i++) {
                         x[i].classList.remove("autocomplete-active");
                    }
               }
               function closeAllLists(elmnt) {
                    /*close all autocomplete lists in the document,
                    except the one passed as an argument:*/
                    var x = document.getElementsByClassName("autocomplete-items");
                    for (var i = 0; i < x.length; i++) {
                         if (elmnt != x[i] && elmnt != inp) {
                              x[i].parentNode.removeChild(x[i]);
                         }
                    }
               }
               /*execute a function when someone clicks in the document:*/
               document.addEventListener("click", function (e) {
                    closeAllLists(e.target);
               });
          }
          var countries = ["User Profile","About Us","Privacy Notice","Shopping Cart","Order History","Track Order","Lays Classic Flavored Small Pack","Lays Limon Small Pack","Lays Chile Limon Small Pack","Lays Sour Cream and Onion Small Pack","Lays Salt and Vinegar","Doritos Nacho Cheese","Doritos Cool Ranch","Doritos Spicy Sweet Chili","Doritos Flaming Hot","Doritos Flaming Hot Limon","Ruffles Cheddar and Sour Cream","Ruffles Original","Ruffles Chili Cheese","Ruffles Lime and Jalapeno","Ruffles Flaming Hot","Ruffles Salt and Vinegar","Sour Patch Kids","Sour Patch Kids Extreme","Sour Patch Kids Strawberry","Sour Patch Kids Watermelon","Sour Patch Kids Blue Raspberry","Twix Minis","Twix Ice Cream","Snickers Ice Cream","Snickers Minis","Swedish Fish Original","CocaCola","CocaCola Diet","Mountain Dew","Mountain Dew Diet","Fanta","Fanta Grape","Fanta Green Apple","Fanta Berry","Gatorade Cool Blue","Gatorade Lemon Lime","Gatorade Fruit Punch","Gatorade Summer Fruits","Gatorade Orange","Red Baron Pepperoni Pizza","Red Baron Cheese Pizza","Vegetable Sandwich","Southwest Ham and Cheese Sandwich","Haagen Dazs Chocolate Ice Cream","Whole Almonds","Roasted Almonds","Honey Roasted Almond Pack","Whole Cashew Roasted and Salted","Sun Maid Raisins","Blue Ink Pens","Red Ink Pens","Galaxy Wireless Ear Phone","Galaxy Wired Ear Phone","Android Charging Cable","10 ft Lightning USB Cable","Charging Block Type USB","Dual USB Type Charging Block","Multi Pin USB and Type C Charging Block","Mix Chocolate Bag","Great Value Mixed Vegetables","Universal Power Adapter","Granulated Sugar","All Purpose Flour","Country Crock Butter","Folgers Classic Roast Coffee","Apple","Orange","Pineapple","Green Apple","Salad Bowl","Lipton Black Tea","Lipton Green Tea","AA4 Energizer 4 Pack Battery","Duct Tape Silver","Swingline Stapler","Swingline Stapler Pin","OZERO Knit Beanie Winter Hat","Purell Advanced Hand Sanitizer Gel","Supplyaid KN95 Protective Face Mask","Swingline Paper Clips 200 Pack","Amazon Gift Card $25.00","Apple App Store Gift Card $50.00","Google Play Store Gift Card $50.00","Playstation Gift Card $25.00","ANC Bluetooth 5.0 Headphone Wireless","Lightning to 3.5mm Headphone Jack Adapter","Enjoy Life Double Chocolate Brownie","Banana 4 Piece","Mini Sandwich Cookies Vanilla","Oreo Chocolate Sandwich Cookie","Cheez-It Original","Great Value White Hamburger Buns","Great Value White Hot Dog Buns","Great Value White Bread","Great Value Sourdough Bread","Great Value Bread Mix Italian","Great Value Honey Wheat Bread","Great Value Multi Grain Bread","Progresso Bread Crumbs","HERSHEYs Chocolate Syrup"];
        
          /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
          autocomplete(document.getElementById("myInput"), countries);
     </script>

</body>

</html>