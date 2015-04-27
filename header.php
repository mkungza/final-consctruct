<?php
if(!isset($_SESSION)){
	session_start();
}
?>
<?php if(isset($_SESSION['role'])) { 
		if($_SESSION['role'] != "customer") {?>
	
		<div class="headerem">
			<nav id="main-nav">
				<ul>
					<li><a id="manage" href="#0">Management</a></li>
				</ul>
			</nav>
			<div id="cart">
				<a href ="#" class="a-image" id="carticon">CART</a>
			</div>
		</div>
<?php
		}
	
 else { ?>
<div class="preheader">
	<div id="cart">
		<a href ="#" class="a-image" id="carticon">CART</a>
	</div>
</div>
<?php }
}?>
<div id="dialog" title="Dialog Title" style="display:none"> Some text</div>
<header class="clearfix">
	<span>SOMETIME <span class="bp-icon bp-icon-about" data-content="This website for sell contruction product"></span></span>
		<h1>CONSTRUCTION.COM</h1>
		<?php if(isset($_SESSION['userid'])){ ?>
			<nav>
				<span>Hi <?php echo $_SESSION["username"];?></span>
				<a href="/construct/editprofile/editprofile.php"> Profile </a>
				<a style="width:7.2em;" href="/construct/changepassword/changepassword.php"> Change password </a>
				<a style="width:7.1em;" href="/construct/logout/logout.php"> Logout</a>
			</nav>
		<?php }
		else { ?>
			<nav>
				<a href="/construct/login/login.php">Login</a>
				<a href="/construct/register/register.php">Register</a>
			</nav>
		<?php } ?>
</header>	
	<div id="tabs" class="tabs">
		<nav>
			<ul>
				<li><a href="/construct/index.php" class="icon-home"><span>Home</span></a></li>
				<li><a href="/construct/gallery/gallery.php" class="icon-gallery"><span>Gallary</span></a></li>
				<li><a href="/construct/design/design.php" class="icon-design"><span>Design</span></a></li>
				<li><a href="/construct/calculate/calculate.php" class="icon-cal"><span>Calculate</span></a></li>
				<li><a href="#section-5" class="icon-contact"><span>Contact us</span></a></li>
					</ul>
				</nav>
	</div><!-- /tabs -->


<script>
	$("#carticon").click(function () {
		window.open("/construct/cart/cart.php", "MY CART", "menubar=no,statusbar=yes,width=800px,height=600px,left=300,top=50");
	});


	$("#manage").click(function() {
		var mywindow = window.open("/construct/admin/checkstock/checkstock.php","STOCK DETAIL", "menubar=no,statusbar=yes,width=1000px,height=600px,left=300,top=50");	
	});

</script>