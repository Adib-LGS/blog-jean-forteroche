<?php session_start() ?>

	<header>
		<div class="container-fluid position-relative no-side-padding">
			<a href="#" class="logo"><img src="images/logo.png" alt="Logo Image"></a>
			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>
			<ul class="main-menu visible-on-click" id="main-menu">
				<li>
					<a href="index.php?request=admincontroller&action=index">Accueil</a>
				</li>
				<li>
				<a href="index.php?request=admincontroller&action=addArticle&id=jf">Ajouter un article</a>
				</li>
				<li>
					<a href="index.php?request=usercontroller&action=index">Deconnexion</a>
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
	
	<br>


<section >
	<h2><?= $pageTitle ?></h2>
		<br />
	<h3>Listes des Articles :</h3>
		<br />
	<p>Vous pouvez Modifier ou Supprimer les articles, ou les lire en cliquant sur leurs titres</p>
		<br />
	<ul class="list-group">
<?php foreach ($articles as $article):?>
  	<li class="list-group-item d-flex justify-content-between align-items-center">
    		<a class="title" href="index.php?request=admincontroller&action=show&id=<?= $article['id'] ?>"><b><?= $article['title'] ?></a>
    	<div class="btn-group">
  		<button	button type="button" class="btn btn-primary"> 
	  		<a href="index.php?request=admincontroller&action=editArticle&id=<?= $article['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir modifier cet Article ?!`)">
	  		Modifier</a>
		</button>
  		<button type="button" class="btn btn-danger">
  			<a href="index.php?request=admincontroller&action=deleteArticle&id=<?= $article['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer cet Article ?!`)">
  			Supprimer</a>
		</button>
    	</div>
  	</li>
<?php endforeach ?>
	</ul>
</section>

<br/>

<section>

	<h3>Listes des Commentaires Signalés:</h3>
		<br />
	<p>Vous pouvez Modifier ou Supprimer les commentaires</p>
		<br />
	<ul class="list-group">
<?php foreach ($commentaires as $commentaire) : ?>
<?php if ($commentaire['reports_id'] === "1") : ?>
	<li class="list-group-item d-flex justify-content-between align-items-center">
			<h3>Commentaire de <?= $commentaire['pseudo'] ?></h3>
				<small>Le <?= $commentaire['created_at'] ?></small>
			<blockquote>
					<em><?= $commentaire['content'] ?></em>
			</blockquote>
		<div class="btn-group">
			<button type="button" class="btn btn-danger btn-sm" >
				<a  href="index.php?request=admincontroller&action=deleteComment&id=<?= $commentaire['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
			</button>
			<button type="button" class="btn btn-primary btn-sm"  >
				<a href="index.php?request=admincontroller&action=approuveComment&id=<?= $commentaire['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir approuver ce commentaire ?!`)">Approuver</a>
			</button>
		</div> 	
<?php endif ?>
<?php endforeach ?>
	</li>
	</ul>
</section>
