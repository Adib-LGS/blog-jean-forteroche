<?php session_start() ?>

<header>
		<div class="container-fluid position-relative no-side-padding">
			<a href="#" class="logo"><img src="images/logo.png" alt="Logo Image"></a>
			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>
			<ul class="main-menu visible-on-click" id="main-menu">
			
				<li>
					<a href="index.php?action=Uindex">Accueil</a>
				</li>
				<li>
					<a href="index.php?action=UsignIn">Inscription</a>
				</li>
				<li>
					<a href="index.php?action=Ulogin">Connexion</a>
				</li>
			</ul><!-- main-menu -->
			<div class="src-area">
				<form>
					<button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
					<input class="src-input" type="text" placeholder="Type of search">
				</form>
			</div>
		</div><!-- conatiner -->
	</header>
<!--Show User ce que voit l'utilisateur -->
<div class="slider">
  <div class="display-table  center-text">
    <h1 class="title display-table-cell"><b>Un Billet Simple Pour L'Alaska</b></h1>
  </div>
</div><!-- slider -->

<section class="post-area section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-12 no-right-padding">
        <div class="main-post">
          <div class="blog-post-inner">
           
            <br>
            <p class="para">
            <h1 class="title">
              <a href="#"><?= $article['title'] ?> </a>
                </h1>
                <p>
                  <small>Ecrit le <?= $article['created_at'] ?></small>
                  </p>
                  <p>
                    <?= $article['introduction'] ?>
                  </p>
            </p>
          </div><!-- blog-post-inner -->
        </div><!-- main-post -->
    </div><!-- row -->
  </div><!-- container -->
</section><!-- post-area -->




<section class="comment-section">
  <div class="container">
<!--Admin peut Supprimer un Article -->
              <?php if (count($commentaires) === 0) : ?>
                  <h3><strong>Il n'y a pas encore de commentaires pour cet article ...</strong></h3>
              <?php else : ?>
                  <h3><strong>Il y a déjà <?= count($commentaires) ?> réactions : </strong></h3>
                  <?php foreach ($commentaires as $commentaire) : ?>
                      <h3>Commentaire de <?= $commentaire['pseudo'] ?></h3>
                      <small>Le <?= $commentaire['created_at'] ?></small>
                      <blockquote>
                          <em><?= $commentaire['content'] ?></em>
                      </blockquote>
<!-- Admin peut Supprimer un commentaire -->
                  <?php endforeach ?>
              <?php endif ?>
    <div class="row">

        <div class="col-lg-8 col-md-12">
        <div class="commnets-area">
          <div class="comment">
            <div class="post-info">
            
              
            </div><!-- post-info -->
         
        </div><!-- commnets-area -->
      </div><!-- col-lg-8 col-md-12 -->
      <h4><b>LAISSER UN COMMENTAIRE</b></h4>
      <br>
      <div class="aler alert-link">
      <p>Si vous souhaitez laisser un commentaire n'hésiter pas à vous inscrire en cliquant sur Inscription</p>
      <br>
      <a class="btn btn-primary" href="index.php?action=UsignIn">Inscription</a>
      </div>
      <br/>
    </div><!-- row -->
  </div><!-- container -->
</section>
