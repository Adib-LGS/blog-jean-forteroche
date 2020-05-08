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

<div class="panel panel-default" >
	<div class="panel-body">

      <?php foreach ($articles as $article):?>					
			<ul>
				<li>
			<h4 class="title"><a href="index.php?request=admincontroller&action=show&id=<?= $article['id'] ?>"><b><?= $article['title'] ?></b></a></h4>
				</li>
				<li>
              		<a class="btn btn-primary" style="margin-left: 200px;" href="index.php?request=admincontroller&action=editArticle&id=<?= $article['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir modifier cet Article ?!`)">Modifier Article</a>
				</li>
			</ul>
		<?php endforeach ?>
		</div>
</div>
</section>

<br/>

<section style="margin-left: 50px;">
	<h3>Listes des Commentaires Signalés:</h3>
	<br />
	<p>Vous pouvez Modifier ou Supprimer les commentaires en cliquant sur leurs titres</p>
	<br />
<div class="panel panel-default">
	<div class="panel-body">
	  <?php foreach ($commentaires as $commentaire) : ?>
                      <h3>Commentaire de <?= $commentaire['author'] ?></h3>
                      <small>Le <?= $commentaire['created_at'] ?></small>
                      <blockquote>
                          <em><?= $commentaire['content'] ?></em>
                      </blockquote>
                      
                    <p>
						<a class="btn btn-danger" href="index.php?request=admincontroller&action=deleteComment&id=<?= $commentaire['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
					</p>
					<p>
						<a class="btn btn-primary" href="index.php?request=admincontroller&action=deleteComment&id=<?= $commentaire['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Approuver</a>
					</p>
                      
        <?php endforeach ?>
	</div>
</div>
</section>
