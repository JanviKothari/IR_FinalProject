<?php
$con = mysqli_connect("mysql13.000webhost.com","a6961521_stp","HH53YNXGCn4GMAz2","a6961521_stpinv");
//$con = mysqli_connect("localhost","public_access","9V2UfrJVJp867csh","inventory");
if (!$con)
  {
  die('Could not connect: ' . mysqli_connect_error());
  }
$tablename="stockyards_inventory";
//mysqli_query($con,"TRUNCATE $tablename;");
if(isset($_POST['category']))
{
	error_reporting(0);
	if($_POST['mode']=="bulk")
	{
	if($_POST['category']=="all")
	{
		if($_POST['sorting_order']=="price_high")
		{
			$inv_qry=mysqli_query($con,"SELECT * from $tablename ORDER BY price DESC;");
		}
		else if($_POST['sorting_order']=="price_low")
		{
			$inv_qry=mysqli_query($con,"SELECT * from $tablename ORDER BY price ASC;");
		}
		else if($_POST['sorting_order']=="date_old")
		{
			$inv_qry=mysqli_query($con,"SELECT * from $tablename ORDER BY time ASC;");
		}
		else if($_POST['sorting_order']=="date_new")
		{
			$inv_qry=mysqli_query($con,"SELECT * from $tablename ORDER BY time DESC;");
		}
		else
		{
			$inv_qry=mysqli_query($con,"SELECT * from $tablename ORDER BY name ASC;");
		}
	}
	else
	{
		$category=$_POST['category'];
		if($_POST['sorting_order']=="price_high")
		{
			$inv_qry=mysqli_query($con,"SELECT * from $tablename WHERE category=$category ORDER BY price DESC;");
		}
		else if($_POST['sorting_order']=="price_low")
		{
			$inv_qry=mysqli_query($con,"SELECT * from $tablename WHERE category=$category ORDER BY price ASC;");
		}
		else if($_POST['sorting_order']=="date_old")
		{
			$inv_qry=mysqli_query($con,"SELECT * from $tablename WHERE category=$category ORDER BY time ASC;");
		}
		else if($_POST['sorting_order']=="date_new")
		{
			$inv_qry=mysqli_query($con,"SELECT * from $tablename WHERE category=$category ORDER BY time DESC;");
		}
		else
		{
			$inv_qry=mysqli_query($con,"SELECT * from $tablename WHERE category=$category ORDER BY name ASC;");
		}
	}
	$i=1;
//printf("Errormessage: %s\n", mysqli_error($con));
	while($invrow = mysqli_fetch_array($inv_qry))
	{
		if($i==4)
		{
			$columnwidth="five";
			$i=1;}
		else
		{
			$columnwidth="four";
			$i++;}
		if(isset($invrow))
		{
		echo '<div id="item'.$invrow['inv_no'].'" class="catalog_items '.$columnwidth.' columns">
 		 <div class="img-wrap">
			<img class="item_image" alt=="'.$invrow['name'].'" src="'.$invrow['image_location'].'"/>
			<div class="img-info">
            <h5>$'.$invrow['price'].'</h5>
            <p>'.$invrow['description'].'</p>
            <button>Add to Cart</button>
     	  	 </div>
  		  </div>
   		 <h5>'.$invrow['name'].'</h5>
		</div>';
		}
		else
		{
			echo '<h4>No items found in this category</h4>';
		}
	}
	}
	else if($_POST['mode']=="single")
	{
		$inv_id=$_POST['id'];
		$inv_qry=mysqli_query($con,"SELECT * from $tablename WHERE inv_no=$inv_no;");
		$invrow = mysqli_fetch_row($inv_qry);
		
	}
}

?>