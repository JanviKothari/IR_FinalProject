<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>STP Shop</title>

<style>
html
{
	background-image:url(images/background.jpg);
	}
body
{
	margin:0px;}
header
{
	margin:0px;
	padding:15px;
	border-bottom:10px #630;
	background-image:url(images/background.jpg);
	}
#contents
{	
	margin-left:auto;
	margin-right:auto;
	}
h2
{
	color:#2B190F;
	font-size:3rem;
	}
#logo
{
	float:left;
	}

#bullhead
{
	display:block;
	margin-left:auto;
	margin-right:auto;
	visibility:visible;
}
nav ul
{
	list-style-type:none;
	margin:0px;
	padding:0px;
	}
nav ul li
{
	display:inline-block;}


nav ul li img:hover
	{
	-moz-box-shadow: 3px 3px 3px #2B190F;
  -moz-border-radius: 11px 11px 13px 11px;
  -webkit-box-shadow: 3px 3px 3px #2B190F;
  -webkit-border-radius: 11px 11px 13px 11px;
	}

#image_container
{
	border-width:49px;
	border-image:url(images/photoborder.png)47 47 47 47 round;
	width:800px;
	margin:auto;
	}

footer ul
{
	text-align:center;	}
footer li
{
	margin:10px;
	display:inline-block;	}
a
{
	text-decoration:none;
	color:#2B190F;
}

#navigationbar
{
width:900px;
position:relative;
padding-left:5px;
margin-top:10px;
}

.content_box
{
	background-color:rgba(250,250,235,0.8);
	color:#2B190F;
	padding:10px;
	-webkit-border-radius: 11px 11px 13px 11px;
 	-moz-border-radius: 11px 11px 13px 11px;
	 border-radius: 11px 11px 13px 11px;

	}

#side_panel
{
	width:15%;
	display:block;
	float:left;
	margin:10px 10px 0px 10px;
	}
#side_panel:after
{
	clear:both;}

#catalog
{
	width:70%;
	margin-top:10px;
	min-width:220px;
	display:inline-block;
	padding:7.5px;
	margin-left:auto;
	margin-right:auto;
	overflow-x:auto;
	}

.catalog_items
{
position:relative;
height:250px;
display:inline-block;
padding:7.5px;
	}
.item_image
{
	position:relative;
	width:100%;
	height:90%;
	max-height:212px;
	height:212px;}
	
.img-wrap{
overflow:hidden;
position:relative;
}
.img-info{
background-color:#000;
bottom:0;
opacity:0;
filter: alpha(opacity = 0);
position:absolute;
width:100%;
z-index:1000;
}
.img-info h5, .img-info p{
padding:0 10px;
color:#fff;
}
.img-wrap:hover .img-info{
opacity:0.75;
filter: alpha(opacity = 75);
transition:opacity 0.25s;
-moz-transition:opacity 0.25s;
-webkit-transition:opacity 0.25s;
}​
#cart
{
margin-left:251px;	}
</style>
<!-- CSS -->
<link type="text/css" href="css/skitter.styles.css" media="all" rel="stylesheet" />

<!-- JS -->
<script type="text/javascript" src="js/jquery-1.6.3.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.animate-colors-min.js"></script>
<script type="text/javascript" src="js/jquery.skitter.min.js"></script>

<!-- Init Plugin -->
<script>
var category_select="all",sort_order="ascending";
		
	function windowcompsize()
	{
		if($(window).width()<480)	
		{
			$('#navbarimage').css("display","none");
			$('#navbarselect').css("display","block");
			$('#side_panel').css("display","none");
			$('#side_select').css("display","block");
			$('#navigationbar').css('left','0px');
			$('#navigationbar').css('padding-left','20px');
			$('#side_select').css('padding-left','20px');
			$('#navigationbar').css('width','60px');
			$('#side_select').css('width','60px');
			$('#catalog').css('margin-left','20px');
			$('footer li').css('margin','5px');
			}
		else
		{
			
			$('#navbarimage').css("display","block");
			$('#side_panel').css("display","block");
			$('#navbarselect').css("display","none");
			$('#catalog').css('margin-left','auto');
			$('#side_select').css("display","none");
			$('#navigationbar').css('padding-left','20px');
			$('#navigationbar').css('width','900px');
			$('footer li').css('margin','10px');
			navmargin();
			}
		if($(window).width()<850)
		{
			$('#cart').css('margin-left','0px');
			}
		else
		{
			$('#cart').css('margin-left','351px');
			navmargin();
			}
	}
	
	$(document).ready(function(e) {
       	//navmargin();
	    windowcompsize();
		read_items("all","ascending");
   });
	$(window).resize(function(e) {
        windowcompsize();
    });
	
	function navmargin()
	{
		var leftmarg=$('#contents').offset().left;
		$('#navigationbar').css('left',leftmarg);
		}
		
	function navselect(uri)
	{
		window.location=uri;
		}
		
	
	function read_items(cat,order)
	{
		
		$.post("read.php",
    {
      category:category_select,
      sorting_order:order,
	  mode:"bulk",
    },
    function(data,status){
      $("#catalog").html(data);
    });
	
	}
	
	function category_chooser(category_param)
	{
		category_select=category_param;
		read_items(category_select,sort_order);
		}
	function sorting_chooser(sort_param)
	{
		sort_order=sort_param;
		read_items(category_select,sort_order);
		}
</script>

	  <link type="text/css" rel="stylesheet" href="css/imports.css">
  <!-- end CSS-->
 

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

  <!-- All JavaScript at the bottom, except for Modernizr / Respond.
       Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
       For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
  <script type="text/javascript" src="js/libs/modernizr-2.0.6.min.js"></script>

</head>
<body>
<header>
<!--<img alt="Trading Post" id="logo" src="./images/TPwoodleather.png">-->
<img alt="Bull logo" id="bullhead" src="./images/textwbull.png" />
</header>


<nav id="navigationbar">
	<ul id="navbarimage">
		<li><a href="index.html"><img class="navbutton" alt="Home" src="./images/nav/home.png" /></a></li>
		<li><a href="shop.php"><img class="navbutton" alt="Shop" src="./images/nav/shop.png" /></a></li>
		<li><a href="events.html"><img class="navbutton" alt="Events" src="./images/nav/events.png" /></a></li>
		<li><a href="stores.html"><img class="navbutton" alt="Stores" src="./images/nav/stores.png" /></a></li>
		<li><a href="Contact.php"><img class="navbutton" alt="Contact" src="./images/nav/contact.png" /></a></li>
        <li><a href="cart.php"><img id="cart" class="navbutton" alt="Shopping Cart" src="./images/nav/shoppingcart.png" /></a></li>
	</ul>
    <select id="navbarselect" style="display:none" onchange="javascript:navselect(this.value);">
  		 <option value="index.html">Home</option>
		<option selected="selected" value="shop.php">Shop</option>
		<option value="events.html">Events</option>
		<option value="stores.html">Stores</option>
		<option value="Contact.php">Contact</option>
        <option value="cart.php">Shopping Cart</option>
  </select>
</nav>
<section id="contents" class="row">
</section>
<section id="side_panel" class="content_box">
<ul id="category_list">
<li><h5>Categories</h5></li>
<li><ul>
	<li><a href="javascript:category_chooser('all');">All</a></li>
	<li><a href="javascript:category_chooser('gifts');">Gifts</a></li>
    <li><a href="javascript:category_chooser('collectibles');">Collectibles</a></li>
    <li><a href="javascript:category_chooser('antiques');">Antiques</a></li>
	</ul>
</li>
<li><h5>Sort By</h5></li>
<select id="sort_select" onchange="javascript:sorting_chooser(this.value);">
  		 <option value="price_low">Price-Low</option>
         <option value="price_high">Price-High</option>
		<option value="oldest">Oldest First</option>
		<option value="newest">Newest First</option>
  </select></ul>
</section>
<section id="side_select">
<select id="category_select" onchange="javascript:category_chooser(this.value);">
		<option value="all">All</option>
  		 <option value="gifts">Gifts</option>
		<option value="collectibles">Collectibles</option>
		<option value="antiques">Antiques</option>
  </select>
 <select id="sort_select" onchange="javascript:sorting_chooser(this.value);">
  		 <option value="price_low">Lowest Price</option>
         <option value="price_high">Highest Price</option>
		<option value="oldest">Oldest First</option>
		<option value="newest">Newest First</option>
  </select>
  </section>
<section id="catalog" class="content_box row">

</section>

<footer>
<ul>
<li><a href="">Sitemap</a>
</li>
<li>
<a href="index.html">About</a></li>
<li>
<a href="contact.php">Contact Us</a></li>
</ul>
</footer>
</body>
</html>
<?php
require_once './read.php';
?>