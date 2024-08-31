<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('config.php');
?>

<head>
	<title>Shoping Cart</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.png" />
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body class="animsition">

	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container dis-flex justify-content-center">
					<div class="left-top-bar">
						Free shipping for standard order over $100
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">

					<!-- Logo desktop -->
					<a href="index.php" class="logo">
						<img src="images/icons/logo-01.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="index.php">Home</a>
							</li>

							<li>
								<a href="product.php">Shop</a>
							</li>

							<li class="label1" data-label1="hot">
								<a href="shoping-cart.php">Your Cart</a>
							</li>

							<li>
								<a href="blog.php">Blog</a>
							</li>

							<li>
								<a href="about.php">About</a>
							</li>

							<li>
								<a href="contact.php">Contact</a>
							</li>
						</ul>
					</div>

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<?php
						$cart_user = $_SESSION['cart'];
						$cart_db = "usercart";
						// Prepare the SQL query
						$cart_table_query = $con->prepare("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = ? AND table_name = ?");
						$cart_table_query->bind_param("ss", $cart_db, $cart_user);
						$cart_table_query->execute();
						$cart_table_result = $cart_table_query->get_result();
						$cart_table_row = $cart_table_result->fetch_assoc();
						if ($cart_table_row['count'] > 0) {
							$cart_details = mysqli_query($cart_info, "SELECT COUNT(*) FROM $cart_user");
							?>
							<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
								data-notify="<?php echo mysqli_num_rows($cart_details) ?>">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
							<?php
						} else {
							?>
							<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 js-show-cart">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
							<?php
						}
						?>
						<?php
						$wish_user = $_SESSION['wishlist'];
						$wish_db = "wishlist";
						// Prepare the SQL query
						$wish_table_query = $con->prepare("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = ? AND table_name = ?");
						$wish_table_query->bind_param("ss", $wish_db, $wish_user);
						$wish_table_query->execute();
						$wish_table_result = $wish_table_query->get_result();
						$wish_table_row = $wish_table_result->fetch_assoc();
						if ($wish_table_row['count'] > 0) {
							$wish_details = mysqli_query($wishlist_info, "SELECT * FROM $wish_user");
							?>
							<span
								class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-wishlist"
								data-notify="<?php echo mysqli_num_rows($wish_details) ?>">
								<i class="zmdi zmdi-favorite-outline"></i>
							</span>
							<?php
							// }
						} else {
							?>
							<span class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-wishlist">
								<i class="zmdi zmdi-favorite-outline"></i>
							</span>
							<?php
						}
						?>
						<a href="logout.php"
							class="dis-block d-flex align-items-center icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-22">
							<i class="zmdi zmdi-account-circle"></i>
							<span class="h6 m-0 ml-2"><?php echo $_SESSION['name']; ?></span>
						</a>
					</div>
				</nav>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->
			<div class="logo-mobile">
				<a href="index.php"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>
				<?php
				$cart_user = $_SESSION['cart'];
				$cart_db = "usercart";
				// Prepare the SQL query
				$cart_table_query = $con->prepare("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = ? AND table_name = ?");
				$cart_table_query->bind_param("ss", $cart_db, $cart_user);
				$cart_table_query->execute();
				$cart_table_result = $cart_table_query->get_result();
				$cart_table_row = $cart_table_result->fetch_assoc();
				if ($cart_table_row['count'] > 0) {
					$cart_details = mysqli_query($cart_info, "SELECT COUNT(*) FROM $cart_user");
					?>
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
						data-notify="<?php echo mysqli_num_rows($cart_details) ?>">
						<i class="zmdi zmdi-shopping-cart"></i>
					</div>
					<?php
				} else {
					?>
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 js-show-cart">
						<i class="zmdi zmdi-shopping-cart"></i>
					</div>
					<?php
				}
				?>

				<?php
				$wish_user = $_SESSION['wishlist'];
				$wish_db = "wishlist";
				$wish_table_query = $con->prepare("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = ? AND table_name = ?");
				$wish_table_query->bind_param("ss", $wish_db, $wish_user);
				$wish_table_query->execute();
				$wish_table_result = $wish_table_query->get_result();
				$wish_table_row = $wish_table_result->fetch_assoc();
				if ($wish_table_row['count'] > 0) {
					$wish_details = mysqli_query($wishlist_info, "SELECT COUNT(*) FROM $wish_user");
					?>
					<span
						class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-wishlist"
						data-notify="<?php echo mysqli_num_rows($wish_details) ?>">
						<i class="zmdi zmdi-favorite-outline"></i>
					</span>
					<?php
					// }
				} else {
					?>
					<span class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-wishlist">
						<i class="zmdi zmdi-favorite-outline"></i>
					</span>
					<?php
				}
				?>
				<a href="#"
					class="dis-block d-flex align-items-center icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10">
					<i class="zmdi zmdi-account-circle"></i>
					<span class="h6 m-0 ml-2"><?php echo $_SESSION['name']; ?></span>
				</a>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="main-menu-m">
				<li>
					<a href="index.php">Home</a>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>

				<li>
					<a href="product.php">Shop</a>
				</li>

				<li>
					<a href="shoping-cart.php" class="label1 rs1" data-label1="hot">Features</a>
				</li>

				<li>
					<a href="blog.php">Blog</a>
				</li>

				<li>
					<a href="about.php">About</a>
				</li>

				<li>
					<a href="contact.php">Contact</a>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>

	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>

			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<?php
					$cart_user = $_SESSION['cart'];
					$cart_db = "usercart";
					// Prepare the SQL query
					$cart_table_query = $con->prepare("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = ? AND table_name = ?");
					$cart_table_query->bind_param("ss", $cart_db, $cart_user);
					$cart_table_query->execute();
					$cart_table_result = $cart_table_query->get_result();
					$cart_table_row = $cart_table_result->fetch_assoc();
					if ($cart_table_row['count'] > 0) {
						$cart_details = mysqli_query($cart_info, "SELECT * FROM usercart.$cart_user uw JOIN product.product_item pi ON uw.cp_detail = pi.id WHERE uw.cp_detail AND pi.id ");
						while ($cart_fetch = mysqli_fetch_assoc($cart_details)) {
							?>
							<li class="header-cart-item flex-w flex-t m-b-12">
								<div class="header-cart-item-img">
									<img src="image/product/<?php echo $cart_fetch['product_img']; ?>" alt="IMG">
								</div>

								<div class="header-cart-item-txt p-t-8">
									<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
										<?php echo $cart_fetch['product_name']; ?>
									</a>

									<span class="header-cart-item-info">
									₹ <?php echo $cart_fetch['product_price']; ?>
									</span>
								</div>
							</li>
							<?php
						}
						?>
					</ul>
					<?php
					} else {
						?>
					<h1>Add Product</h1>
					<?php
					}
					?>
			</div>
		</div>
	</div>

	<!-- Wishlist -->
	<div class="wrap-header-wishlist js-panel-wishlist">
		<div class="s-full js-hide-wishlist"></div>

		<div class="header-wishlist flex-col-l p-l-65 p-r-25">
			<div class="header-wishlist-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Wishlist
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-wishlist">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>

			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<?php
					$wish_user = $_SESSION['wishlist'];
					$wish_db = "wishlist";
					// Prepare the SQL query
					$wish_table_query = $con->prepare("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = ? AND table_name = ?");
					$wish_table_query->bind_param("ss", $wish_db, $wish_user);
					$wish_table_query->execute();
					$wish_table_result = $wish_table_query->get_result();
					$wish_table_row = $wish_table_result->fetch_assoc();
					if ($wish_table_row['count'] > 0) {
						$wish_details = mysqli_query($wishlist_info, "SELECT * FROM wishlist.$wish_user uw JOIN product.product_item pi ON uw.wp_detail = pi.id WHERE uw.wp_detail AND pi.id ");
						while ($wish_fetch = mysqli_fetch_assoc($wish_details)) {
							?>
							<li class="header-cart-item flex-w flex-t m-b-12">
								<div class="header-cart-item-img">
									<img src="image/product/<?php echo $wish_fetch['product_img']; ?>" alt="IMG">
								</div>

								<div class="header-cart-item-txt p-t-8">
									<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
										<?php echo $wish_fetch['product_name']; ?>
									</a>

									<span class="header-cart-item-info">
									₹ <?php echo $wish_fetch['product_price']; ?>
									</span>
								</div>
							</li>
							<?php
						}
						?>
					</ul>
					<?php
					} else {
						?>
					<h1>Add Product</h1>
					<?php
					}
					?>
			</div>
		</div>
	</div>

	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Shoping Cart
			</span>
		</div>
	</div>


	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-12 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
								</tr>
								<?php
								$cart_user = $_SESSION['cart'];
								$cart_db = "usercart";
								// Prepare the SQL query
								$cart_table_query = $con->prepare("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = ? AND table_name = ?");
								$cart_table_query->bind_param("ss", $cart_db, $cart_user);
								$cart_table_query->execute();
								$cart_table_result = $cart_table_query->get_result();
								$cart_table_row = $cart_table_result->fetch_assoc();
								if ($cart_table_row['count'] > 0) {
									$cart_details = mysqli_query($cart_info, "SELECT * FROM usercart.$cart_user uw JOIN product.product_item pi ON uw.cp_detail = pi.id WHERE uw.cp_detail AND pi.id ");
									while ($cart_fetch = mysqli_fetch_assoc($cart_details)) {
										?>
										<tr class="table_row">
											<td class="column-1">
												<div class="how-itemcart1">
													<img src="image/product/<?php echo $cart_fetch['product_img'];?>" alt="IMG">
												</div>
											</td>
											<td class="column-2 text-truncate p-r-11" style="max-width: 150px;"><?php echo $cart_fetch['product_name'];?></td>
											<td class="column-3">₹ <?php echo $cart_fetch['product_price'];?></td>
											<td class="column-4">
												<div class="wrap-num-product flex-w m-l-auto m-r-0">
													<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
														<i class="fs-16 zmdi zmdi-minus"></i>
													</div>

													<input class="mtext-104 cl3 txt-center num-product" type="number"
														name="num-product1" value="1">

													<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
														<i class="fs-16 zmdi zmdi-plus"></i>
													</div>
												</div>
											</td>
											<td class="column-5">₹ <?php echo $cart_fetch['product_price'];?></td>
										</tr>
										<?php
									}
									?>
									<?php
								} else {
									?>
									<h1>Add Product</h1>
									<?php
								}
								?>
							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
									name="coupon" placeholder="Coupon Code">

								<div
									class="flex-c-m">
									<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Apply Coupon
						</button>
								</div>
							</div>

							<div
								class="flex-c-m">
								<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Proceed to Checkout
						</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>




	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Categories
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Women
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Men
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Shoes
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Watches
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Help
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Track Order
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Returns
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Shipping
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								FAQs
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						GET IN TOUCH
					</h4>

					<p class="stext-107 cl7 size-201">
						Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us
						on (+1) 96 716 6879
					</p>

					<div class="p-t-27">
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-pinterest-p"></i>
						</a>
					</div>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Newsletter
					</h4>

					<form>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email"
								placeholder="email@example.com">
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Subscribe
							</button>
						</div>
					</form>
				</div>
			</div>

			<div class="p-t-40">
				<div class="flex-c-m flex-w p-b-18">
					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-01.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-02.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-03.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-04.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-05.png" alt="ICON-PAY">
					</a>
				</div>

				<p class="stext-107 cl6 txt-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;
					<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i
						class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
						target="_blank">Colorlib</a> &amp; distributed by <a href="https://themewagon.com"
						target="_blank">ThemeWagon</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

				</p>
			</div>
		</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function () {
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function () {
			$(this).css('position', 'relative');
			$(this).css('overflow', 'hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function () {
				ps.update();
			})
		});
	</script>
	<script src="js/main.js"></script>

</body>

</html>