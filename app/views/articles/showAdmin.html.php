<?php session_start() ?>
<?php if(!isset($_SESSION['role_id'])):?>
  <?php header('Location: index.php?'); die()?>
<?php endif ?>
<?php if(isset($_SESSION['role_id'])): ?>
	<header>
		<div class="container-fluid position-relative no-side-padding">
			<a href="#" class="logo"><img src="../public/images/logo.png" alt="Logo Image"></a>
			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>
			<ul class="main-menu visible-on-click" id="main-menu">
				<li>
					<a href="index.php?request=admincontroller&action=index">Accueil</a>
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
<?php endif ?>
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
                <a class="avatar" href="#"><img src="../public/images/avatar-1-120x120.jpg" alt="Profile Image"></a>
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
            <br />
          <?php if(isset($_SESSION['role_id']) && $_SESSION['role_id'] === "1" ): ?>
            <p>
              <a class="btn btn-danger" href="index.php?request=admincontroller&action=deleteArticle&id=<?= $article['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer cet Article ?!`)">Supprimer Article</a>
            </p>
          <?php endif ?>
          <br />
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
                      <?php if(isset($_SESSION['role_id']) && $_SESSION['role_id'] === "1" ): ?>
                      <a class="btn btn-danger" href="index.php?request=admincontroller&action=deleteComment&id=<?= $commentaire['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
                      <?php endif ?>
                      <!--Signaler un commentaire--> 
                      <?php if(isset($_SESSION['role_id']) && $_SESSION['role_id'] === "0" AND $commentaire['reports_id'] === "0" ):?>
                      <a class="btn btn-danger" href="index.php?request=usercontroller&action=reportComment&id=<?= $commentaire['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir signaler ce commentaire ?!`)">Signaler Commentaire</a>
                      <?php endif ?>

                  <?php endforeach ?>
              <?php endif ?>
            </div><!-- post-info -->
         
        </div><!-- commnets-area -->
      </div><!-- col-lg-8 col-md-12 -->
      <br>
      <h4><b>LAISSER UN COMMENTAIRES</b></h4>
      <br>
      <?php if(isset($_SESSION['role_id']) && $_SESSION['role_id'] === "0" || $_SESSION['role_id'] === "1"): ?>
      <div class="comment-form">
            <div class="row">
              <div class="col-sm-6">
              <form action="index.php?request=usercontroller&action=insert" method="POST" class="form-group">
                <input type="text" aria-required="true" name="author" class="form-control"
                placeholder="Votre pseudo !" aria-invalid="true" required >
              </div><!-- col-sm-6 -->
              <div class="col-sm-12">
                    <textarea name="content" id="" rows="2" class="text-area-messge form-control" placeholder="Votre commentaire ..."></textarea>
                    <input type="hidden" name="article_id" value="<?= $article_id ?>">
                    <button class="btn btn-primary" type="submit" id="form-submit"><b>COMMENTER</b></button>
                </form>
                </div><!-- col-sm-12 -->
              </div><!-- col-sm-12 -->
        </div>
      <?php endif ?>
    </div><!-- row -->
  </div><!-- container -->
</section>
