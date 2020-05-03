<?php session_start()?> 
<?= $pageTitle ?>

<h4><b>Créer un Article</b></h4>
      <div class="comment-form">
            <div class="row">
              <div class="col-sm-6">
            
              <form action="index.php?controller=admincontroller&action=addArticle" method="POST" class="form-group">

                <br />
                <input type="text" aria-required="true" name="title" class="form-control"
                placeholder="Titre de l'article" aria-invalid="true"  required >
                <br />
                <input type="text" aria-required="true" name="slug" class="form-control"
                placeholder="slug de l'article" aria-invalid="true" required >
              </div><!-- col-sm-6 -->

              <div class="col-sm-12">
                    

                    <input name="introduction" id="" rows="2" class="text-area-messge form-control" placeholder="Intro"></input>
                    <input type="hidden" name="introduction" ><br>

                    <textarea name="content" id="" rows="2" class="text-area-messge form-control" placeholder="Votre Article"></textarea>
                    <input type="hidden" name="article_id" value=""><br>

                    <button class="btn btn-primary" type="submit" id="form-submit" ><b>Poster</button>

                </form>
              
                </div><!-- col-sm-12 -->
              </div><!-- col-sm-12 -->
        </div>
        <br>