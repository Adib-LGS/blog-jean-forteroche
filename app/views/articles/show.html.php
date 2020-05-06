<?php session_start() ?>
<header>
		<div class="container-fluid position-relative no-side-padding">
			<a href="#" class="logo"><img src="public/images/logo.png" alt="Logo Image"></a>
			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>
			<ul class="main-menu visible-on-click" id="main-menu">
			
				<li>
					<a href="index.php?controller=usercontroller&action=index">Accueil</a>
				</li>
				<li>
					<a href="index.php?controller=usercontroller&action=signIn">Inscription</a>
				</li>
				<li>
					<a href="index.php?controller=usercontroller&action=login">Connexion</a>
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
    <h1 class="title display-table-cell"><b>DESIGN</b></h1>
  </div>
</div><!-- slider -->

<section class="post-area section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-12 no-right-padding">
        <div class="main-post">
          <div class="blog-post-inner">
            <div class="post-info">
              <div class="left-area">
                <a class="avatar" href="#"><img src="public/images/avatar-1-120x120.jpg" alt="Profile Image"></a>
              </div>
              <div class="middle-area">
              </div>
            </div><!-- post-info -->
            <br>
            <p class="para">
            <h3 class="title"><a href="#"><b><h1><?= $article['title'] ?></h1>
                  <small>Ecrit le <?= $article['created_at'] ?></small>
                  <p><?= $article['introduction'] ?></p>
                  <hr></b></a></h3>
            </p>
          </div><!-- blog-post-inner -->
        </div><!-- main-post -->
    </div><!-- row -->
  </div><!-- container -->
</section><!-- post-area -->
<section class="comment-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-12">
        </div><!-- row -->
        </div><!-- comment-form -->
        <div class="col-lg-8 col-md-12">
        <div class="commnets-area">
          <div class="comment">
            <div class="post-info">
            <?= $article['content'] ?>
<!--Admin peut Supprimer un Article -->
              <?php if (count($commentaires) === 0) : ?>
                  <h2>Il n'y a pas encore de commentaires pour cet article ... SOYEZ LE PREMIER ! :D</h2>
              <?php else : ?>
                  <h2>Il y a déjà <?= count($commentaires) ?> réactions : </h2>
                  <?php foreach ($commentaires as $commentaire) : ?>
                      <h3>Commentaire de <?= $commentaire['author'] ?></h3>
                      <small>Le <?= $commentaire['created_at'] ?></small>
                      <blockquote>
                          <em><?= $commentaire['content'] ?></em>
                      </blockquote>
<!-- Admin peut Supprimer un commentaire -->
                  <?php endforeach ?>
              <?php endif ?>
              
            </div><!-- post-info -->
         
        </div><!-- commnets-area -->
      </div><!-- col-lg-8 col-md-12 -->
      <h4><b>LAISSER UN COMMENTAIRES</b></h4>

      <div class="aler alert-link">
      <p>Si vous souhaitez laisser un commentaire n'hésiter pas à vous inscrire ici<a href="index.php?controller=usercontroller&action=signIn">Inscription</a></p>
      </div>
      
    </div><!-- row -->
  </div><!-- container -->
</section>
