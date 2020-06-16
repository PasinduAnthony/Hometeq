<?php
include("db.php");
$pagename="A smart buy for a smart home";       //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";//Call in stylesheet
echo "<link rel=stylesheet type=text/css href=mystylesheet2.css>";//Call in stylesheet
echo "<title>".$pagename."</title>";//display name of the page as window title
echo "<body>";
include ("headfile.html");//include headerlayoutfile
include ("detectlogin.php");
echo "<h4>".$pagename."</h4>";//display name of thepageon the web page

//include ("search.php");
function search($pname){
	echo "<form action=index.php method=POST>";
		if($pname==""){
			echo "<input type='text' name='search' placeholder=Search>";
		}else{
			echo "<input type='text' name='search' placeholder=$pname>";
		}		
		echo "<button type='submit' name='submit' value='Search'>Search</button>";
	echo "</form>";
}
function searchProcess($pname){
	$search = $pname;
	$search2 = preg_replace("#[^0-9a-z]#i","",$search);
			
	$SQL="SELECT * FROM product WHERE prodName LIKE '%$search2%'";
	$exeSQL=mysqli_query($GLOBALS['conn'], $SQL) or die (mysqli_error());				
	
	return $SQL;
}

if(isset($_POST['search'])){
	$pname=$_POST['search'];
	search($pname);
	$SQL=searchProcess($pname);	
}else{
	$pname="";
	search($pname);
	$SQL="select prodId, prodName, prodPicNameSmall,prodDescripShort,prodPrice from Product";
}

//run SQL query for connected DB or exit and display error message
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
if(mysqli_num_rows($exeSQL)==0){
	echo "Item not found";
}
echo "<table style='border: 0px'>";//create an array of records (2 dimensional variable) called $arrayp.
//populate it with the records retrieved by the SQL query previously executed. 
//Iterate through the array i.e while the end of the array has not been reached, run through it
while ($arrayp=mysqli_fetch_array($exeSQL))
{
	echo "<tr>";
	echo "<td style='border: 0px'>";
	//make the image into an anchor to prodbuy.phpand pass the product id by URL (the id from the array)
	echo "<a href=view.php?u_prod_id=".$arrayp['prodId'].">";	
	//display the small image whose name is contained in the array
	echo "<img src=images/".$arrayp['prodPicNameSmall']." height=200 width=200>";
	echo "</a>";
	echo "</td>";echo "<td style='border: 0px'>";
	echo "<p><h5>".$arrayp['prodName']."</h5>";		
	echo "<p><h5>".$arrayp['prodDescripShort']."</h5>";
	echo "<p><h3><b>$</b>".$arrayp['prodPrice']."</h3>";
	//display product name as contained in the array
	echo "</td>";
	echo "</tr>";
}
echo "</table>";


include("footfile.html");//include head layout
echo "</body>";
?>