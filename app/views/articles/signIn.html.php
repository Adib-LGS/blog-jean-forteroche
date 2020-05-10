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
    <form method="post" action="index.php?request=usercontroller&action=signIn&id=JF" style="width: 20%; margin-left:1%">
    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" id="pseudo" name="pseudo" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Adresse email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" id="pass1" name="pass1" class="form-control" >
    </div>
    <div class="form-group">
        <label for="password">Confirmer Mot de passe</label>
        <input type="password" id="pass2" name="pass2" class="form-control" >
    </div>
        <button type="submit"  id="submit" name="submit" class="btn btn-primary">Connexion</button>
    </form>
    <a href="index.php?request=usercontroller&action=index">Retour à l'accueil</a>
</div>