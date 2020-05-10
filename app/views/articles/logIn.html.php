<?= $pageTitle ?>

<?php if(!empty($errors2)): ?>

<div class="arlert alert-danger">
    
<ul>
<?php foreach($errors2 as $error): ?>
    <li><?= $error ?></li>
<?php endforeach ?>
</ul>

</div>
<?php endif ?>

<form  method="post" action="index.php?request=usercontroller&action=login" style="width: 20%; margin-left:39%">
      <div class="text-center mb-4">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Se connecter</h1>
      </div>

      <div class="form-label-group">
      <label for="pseudo">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" class="form-control">
      </div>

      <div class="form-label-group">
      <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password" class="form-control" >
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button type="submit"  id="submit" name="submit" class="btn btn-lg btn-primary btn-block">Connexion</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
    </form>

    <a href="index.php?request=usercontroller&action=index">Retour à l'accueil</a>