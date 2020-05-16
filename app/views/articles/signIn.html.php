<?= $pageTitle ?>

<?php if(!empty($errors)): ?>

    <div class="arlert alert-danger">
        <p>Vous n'avez pas rempli le formulaire correctement</p>
    <ul>
<?php foreach($errors as $error): ?>
        <li><?= $error ?></li>
<?php endforeach ?>
    </ul>

    </div>
<?php endif ?>

<div>
    <form method="post" action="index.php?request=usercontroller&action=signIn&id=JF" style="width: 20%; margin-left:39%">
    <div class="text-center mb-4">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Se connecter</h1>
      </div>

    <div class="form-label-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" id="pseudo" name="pseudo" class="form-control">
    </div>

    <div class="form-label-group">
        <label for="email">Adresse email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="form-label-group">
        <label for="password">Mot de passe</label>
        <input type="password" id="pass1" name="pass1" class="form-control" >
    </div>

    <div class="form-label-group">
        <label for="password">Confirmer Mot de passe</label>
        <input type="password" id="pass2" name="pass2" class="form-control" >
    </div>
    <br />
        <button type="submit"  id="submit" name="submit" class="btn btn-lg btn-primary btn-block">S'inscrire</button>
        <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
    </form>
    <a href="index.php?request=usercontroller&action=index">Retour à l'accueil</a>
</div>