<!DOCTYPE HTML>
<html lang="en">
<head>
<title> <?= $pageTitle ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	<!-- Stylesheets -->
	<link href="public/common-css/bootstrap.css" rel="stylesheet">
	<link href="public/common-css/ionicons.css" rel="stylesheet">
	<link href="public/layout-1/css/styles.css" rel="stylesheet">
	<link href="public/layout-1/css/responsive.css" rel="stylesheet">
</head>
<body >
	<header>
		<div class="container-fluid position-relative no-side-padding">
			<a href="#" class="logo"><img src="public/images/logo.png" alt="Logo Image"></a>
			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>
			<ul class="main-menu visible-on-click" id="main-menu">
				<li>
					<a href="index.php?controller=usercontroller&action=index">Accueil</a>
				</li>
				<li>
					<a href="index.php?controller=usercontroller&action=subscription">Inscription</a>
				</li>
				<li>
					<a href="index.php?controller=usercontroller&action=login">Connexion</a>
				</li>
			<?php if(isset($_SESSION['id']) && $_SESSION['id_role'] == 0): ?>
				<li>
					<a href="index.php?controller=admincontroller&action=index">Accueil</a>
				</li>
				<li>
					<a href="index.php?controller=usercontroller&action=login">Deconnexion</a>
				</li>
				<?php endif ?>
				<?php if(isset($_SESSION['id']) && $_SESSION['id_role'] == 1): ?>
				<li>
					<a href="index.php?controller=admincontroller&action=index">Accueil</a>
				</li>
				<li>
					<a href="index.php?controller=usercontroller&action=login">Deconnexion</a>
				</li>
				<li>
					<a href="index.php?controller=admincontroller&action=addArticle&id=jf">Ajouter un article</a>
				</li>
				<?php endif ?>
			</ul><!-- main-menu -->
			<div class="src-area">
				<form>
					<button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
					<input class="src-input" type="text" placeholder="Type of search">
				</form>
			</div>
		</div><!-- conatiner -->
    </header>
    
  <?= $pageContent ?>

	<footer>
		<div class="container">
			<div class="row">

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">

						<a class="logo" href="#"><img src="public/images/logo.png" alt="Logo Image"></a>
						<p class="copyright">Bona @ 2017. All rights reserved.</p>
						<p class="copyright">Designed by <a href="public/https://colorlib.com" target="_blank">Colorlib</a></p>
					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">
					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->
			</div><!-- row -->
		</div><!-- container -->
	</footer>
	<!-- SCIPTS -->
	<script src="public/common-js/jquery-3.1.1.min.js"></script>
	<script src="public/common-js/tether.min.js"></script>
	<script src="public/common-js/bootstrap.js"></script>
	<script src="public/common-js/scripts.js"></script>
</body>
</html>
