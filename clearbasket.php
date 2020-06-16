<?php
session_start();
include("db.php");
$pagename="Clear Basket";       //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";//Call in stylesheet
echo "<link rel=stylesheet type=text/css href=mystylesheet2.css>";//Call in stylesheet
echo "<title>".$pagename."</title>";//display name of the page as window title
echo "<body>";
include ("headfile.html");//include headerlayoutfile
echo "<h4>".$pagename."</h4>";//display name of thepageon the web page
unset($_SESSION['basket']);
echo "<p>Your Basket has been cleared.</p>";
echo "<table>";
	echo "<tr>";
		echo "<th>Product Name</th>";
		echo "<th>Price</th>";
		echo "<th>Quantity</th>";
		echo "<th>Subtotal</th>";
		echo "<th></th>";
	echo"</tr>";
	echo "<tr>";
		echo "<th colspan='3'>Total</th>";
		echo "<th>$</th>";
		echo "<th></th>";
	echo"</tr>";
echo"</table>";
include("footfile.html");//include head layout
echo "</body>";
?>