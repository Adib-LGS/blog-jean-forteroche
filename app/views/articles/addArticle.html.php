<?php session_start()?> 
<?= $pageTitle ?>

    <h4>Créer un Article</h4>
    <br />   
        <form action="index.php?request=admincontroller&action=addArticle" method="POST" class="form-group" style="width: 50%; margin-left:20%" >
        <div class="form-group" >   
          <input  name="title" placeholder="Titre" ></input>
        </div>
          <div class="form-group" >
          <input  name="introduction" placeholder="Introduction" ></input>
          </div>
          
          <textarea id="tiny" name="content" id="" placeholder="Contenu"></textarea>
        <br/>
       
      <button class="btn btn-primary" type="submit" id="form-submit" name="article_id"  >Poster</button>
        </form>
