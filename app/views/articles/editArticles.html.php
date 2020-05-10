<?php session_start()?> 
<?= $pageTitle ?>

    <h4><b>Modifier un Article</b></h4>
    <br />   
      <form action="index.php?request=admincontroller&action=editArticle&id=<?= $article_id ?>"  method="POST"  >
        <div class="form-group" > 
          <input  name="title" placeholder="Ici le Nouveau Titre"><?= $article['title'] ?></input>
        </div>
        <div class="form-group" > 
          <input  name="introduction" placeholder="Ici la Nouvelle Introduction"><?= $article['introduction'] ?></input>
        </div>
        <div class="form-group" > 
          <textarea id="tiny" name="content"  placeholder="Contenu"><?= $article['content'] ?></textarea>
        </div>
        <br/>
          <button class="btn btn-primary" type="submit" id="form-submit"  >Poster</button>
      </form>
        <br/>
