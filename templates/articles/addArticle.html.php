<?php session_start()?> 
<?= $pageTitle ?>

<h4><b>Créer un Article</b></h4>
      <div class="comment-form">
            <div class="row">
              <div class="col-sm-6">
              <form action="index.php?controller=admincontroller&action=addArticle" method="POST" class="form-group">
                <input type="text" aria-required="true" name="author" class="form-control"
                placeholder="Titre de l'article" aria-invalid="true" required >
              </div><!-- col-sm-6 -->
              <div class="col-sm-12">
                    <textarea name="content" id="" rows="2" class="text-area-messge form-control" placeholder="Votre Article"></textarea>
                    <input type="hidden" name="article_id" value="<?= $article_id ?>">
                    <textarea name="content" id="" rows="2" class="text-area-messge form-control" placeholder="Auteur"></textarea>
                    <input type="hidden" name="article_id" value="<?= $author ?>">
                    <button class="btn btn-primary" type="submit" id="form-submit"><b>Poster</button>
                </form>
                </div><!-- col-sm-12 -->
              </div><!-- col-sm-12 -->
        </div>