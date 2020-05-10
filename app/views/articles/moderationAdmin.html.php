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
					<a href="index.php?request=usercontroller&action=index">Deconnexion</a>
				</li>
				<li>
				<a href="index.php?request=admincontroller&action=addArticle&id=jf">Ajouter un article</a>
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

<section style="margin-left: 50px;">
	<h2><?= $pageTitle ?></h2>
	<br />
	<h3>Listes des Articles :</h3>
	<br />
	<p>Vous pouvez Modifier ou Supprimer les articles en cliquant sur leurs titres</p>
	<br />

	<div class="list-group" style="width: 30%">
	  <?php foreach ($articles as $article):?>
		<ul class="list-group list-group-flush">
			<li class="list-group-item">
				<a class="title" href="index.php?request=admincontroller&action=show&id=<?= $article['id'] ?>"><b><?= $article['title'] ?></a>
			</li>
		</ul>							
		<?php endforeach ?>
		</div>

</section>

<br/>

<section>

	<h3>Listes des Commentaires Signalés:</h3>
	<br />
	<p>Vous pouvez Modifier ou Supprimer les commentaires en cliquant sur leurs titres</p>
	<br />

	<div class="list-group" style="width: 50%">
	  <?php foreach ($commentaires as $commentaire) : ?>
		<ul class="list-group list-group-flush">
		<?php if ($commentaire['reports_id'] === "1") : ?>
			<li class="list-group-item">
				<h3>Commentaire de <?= $commentaire['author'] ?></h3>
				<small>Le <?= $commentaire['created_at'] ?></small>
				<blockquote>
					<em><?= $commentaire['content'] ?></em>
				</blockquote>
			</li>
			</ul>
			
			<button type="button" class="btn btn-danger btn-sm" style="width: 20%" >
				<a  href="index.php?request=admincontroller&action=deleteComment&id=<?= $commentaire['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
			</button>
			
			<button type="button" class="btn btn-primary btn-sm" style="width: 20%" >
					<a href="index.php?request=admincontroller&action=deleteComment&id=<?= $commentaire['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Approuver</a>
			</button>
		  
		<?php endif ?>
		<?php endforeach ?>
		
	</div>
	</div>
</section>
