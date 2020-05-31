<?php if(!isset($_SESSION['id']) && $_SESSION['id'] != "1" || $_SESSION['role_id'] != "1"):?>
	<?php header('Location: index.php?'); die()?>
<?php endif ?>
<?php if(isset($_SESSION['role_id']) && $_SESSION['role_id'] === "1" ): ?>
	<header>
		<div class="container-fluid position-relative no-side-padding">
			<a href="#" class="logo"><img src="images/logo.png" alt="Logo Image"></a>
			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>
			<ul class="main-menu visible-on-click" id="main-menu">
				<li>
					<a href="index.php?action=Aindex">Accueil</a>
				</li>
				<li>
					<a href="index.php?action=AindexModerate">Moderation</a>
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
<br>

<?php if(!empty($errors)): ?>

<div class="arlert alert-danger">
    <p>Vous devez remplir tout les champs du formulaire</p>
<ul>
<?php foreach($errors as $error): ?>
    <li><?= $error ?></li>
<?php endforeach ?>
</ul>

</div>
  <?php endif ?>
  <br>

<section class="article" style="width: 50%; margin-left:20%" >
	<p><strong><?= $pageTitle ?></strong></p>

    <br />   
        <form action="index.php?action=AaddArticle" method="POST" class="form-group">
        <div class="form-group" >   
          <input  name="title" placeholder="Titre" ></input>
        </div>
          <div class="form-group" >
          <input  name="introduction" placeholder="Introduction" ></input>
		  </div>
		  <div class="form-group" >
		  <textarea id="tiny" name="content" id="" placeholder="Contenu"></textarea>
		  <div>
        <br/>
       
      <button class="btn btn-primary" type="submit" id="form-submit" name="author_id"  value="<?= $_SESSION['id'] ?>" >Poster</button>
        </form>
</section>