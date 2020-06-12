<?php if(!isset($_SESSION['id'])):?>
	<?php header('Location: index.php?') ?>
<?php endif ?>
<?php if(isset($_SESSION['id']) && $_SESSION['role_id'] === "0" ): ?>
	<header>
		<div class="container-fluid position-relative no-side-padding">
			<a href="#" class="logo"><img src="images/logo.png" alt="Logo Image"></a>
			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>
			<ul class="main-menu visible-on-click" id="main-menu">
				<li>
					<a href="index.php?action=Aindex">Accueil</a>
				</li>
				<li>
					<a href="index.php?action=Udisconnect">Deconnexion</a>
				</li>
			</ul>

			<div class="src-area">
				<form>
					<button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
					<input class="src-input" type="text" placeholder="Type of search">
				</form>
			</div>
		</div><!-- conatiner -->
	</header>
<?php endif ?>

<?php if(isset($_SESSION['id']) && $_SESSION['role_id']=== "1"): ?>
	<header>
		<div class="container-fluid position-relative no-side-padding">
			<a href="#" class="logo"><img src="images/logo.png" alt="Logo Image"></a>
			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>
			<ul class="main-menu visible-on-click" id="main-menu">
				<li>
					<a href="index.php?action=Aindex">Accueil</a>
				</li>
				<li>
					<a href="index.php?action=AindexModerate">Moderation</a>
				</li>
				<li>
					<a href="index.php?action=Udisconnect">Deconnexion</a>
				</li>
			</ul>
				<div class="src-area">
				<form>
					<button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
					<input class="src-input" type="text" placeholder="Type of search">
				</form>
			</div>
		</div><!-- conatiner -->
	</header>
<?php endif ?>


<div class="slider">
  <div class="display-table  center-text">
    <h1 class="title display-table-cell"><b>Un Billet Simple Pour L'Alaska</b></h1>
  </div>
</div><!-- slider -->
	<section class="blog-area section">
		<div class="container">
		<?php if(isset($_SESSION['role_id'])): ?>
			<?= '<p>Bonjour ' . $_SESSION['pseudo'] .'</p>' ?>
		<?php endif ?>
		<br>
			<div class="row">
<!-- ICI ON AFFICHE LES ARTICLES VISIBLES INDEX.PHP-->
		<?php foreach ($articles as $article):?>
			
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">
							<div class="blog-image"><img src="images/denali3.jpeg" alt="Blog Image"></div>
							
							<a class="avatar" href="index.php?action=Ashow&id=<?= $article['id'] ?>"><img src="images/denali6.jpeg" alt="Profile Image"></a>
							<div class="blog-info">

								<h4 class="title"><a href="index.php?action=Ashow&id=<?= $article['id'] ?>"><b><?= $article['title'] ?></b></a></h4>

								<ul class="post-footer">
									<li><a href="#"><i class="ion-heart"></i>57</a></li>
									<li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
									<li><a href="#"><i class="ion-eye"></i>138</a></li>
								</ul>
							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-lg-4 col-md-6 -->
        <?php endforeach ?>
			</div><!-- row -->
			<a class="load-more-btn" href="#"><b>VOIR PLUS</b></a>
		</div><!-- container -->
	</section><!-- section -->
