<?php session_start()?> 
<?= $pageTitle ?>

<script src="https://cdn.tiny.cloud/1/7y7wzz7wq0b0923cyy3t04n91woxhnkekhmppfwjifbl7gla/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#mytextarea'
    });
  </script>



    <h4>Créer un Article</h4>
    <br />   
        <form action="index.php?request=admincontroller&action=addArticle" method="POST" class="form-group" >
          
          <textarea  name="title" placeholder="Titre" ></textarea>

          <textarea  name="introduction" placeholder="Introduction" ></textarea>

          <textarea  name="content" id="" placeholder="Contenu"></textarea>
    <br/>
        
    <button class="btn btn-primary" type="submit" id="form-submit" name="article_id"  >
            Poster
          </button>
        </form>



    <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script>
        <br>