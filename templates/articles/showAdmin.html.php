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
    <h4><b>LAISSER UN COMMENTAIRES</b></h4>
    <div class="row">
      <div class="col-lg-8 col-md-12">
        <div class="comment-form">
            <div class="row">
              <div class="col-sm-6">
              <form action="save-comment.php" method="POST">
                <input type="text" aria-required="true" name="author" class="form-control"
                placeholder="Votre pseudo !" aria-invalid="true" required >
              </div><!-- col-sm-6 -->
              <div class="col-sm-12">
                    <textarea name="content" id="" rows="2" class="text-area-messge form-control" placeholder="Votre commentaire ..."></textarea>
                    <input type="hidden" name="article_id" value="<?= $article_id ?>">
                    <button class="submit-btn" type="submit" id="form-submit"><b>COMMENTER</b></button>
                </form>
                </div><!-- col-sm-12 -->
              </div><!-- col-sm-12 -->
            </div>
        </div><!-- row -->
        </div><!-- comment-form -->
        <div class="col-lg-8 col-md-12">
        <div class="commnets-area">
          <div class="comment">
            <div class="post-info">
            <?= $article['content'] ?>
<!--Admin peut Supprimer un Article -->
            <a href="index.php?controller=admincontroller&action=deleteArticle&id=<?= $article['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer cetArticle ?!`)">Supprimer Article</a>
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
                      <a href="index.php?controller=admincontroller&action=deleteComment&id=<?= $commentaire['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
                  <?php endforeach ?>
              <?php endif ?>
            </div><!-- post-info -->
          </div>
        </div><!-- commnets-area -->
      </div><!-- col-lg-8 col-md-12 -->
    </div><!-- row -->
  </div><!-- container -->
</section>
