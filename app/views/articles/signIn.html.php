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
    <form class="form-group" method="post" action="index.php?request=usercontroller&action=signIn&id=JF">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" class="form-control"><br>
        <label for="email">Adresse email</label>
        <input type="email" name="email" class="form-control"  /><br />
        <label for="password">Mot de passe</label><br>
        <input type="password" id="pass1" name="pass1" class="form-control" ><br>
        <label for="password">Confirmer Mot de passe</label><br>
        <input type="password" id="pass2" name="pass2" class="form-control" ><br>
        <button type="submit"  id="submit" name="submit" class="btn btn-primary">Connexion</button>
    </form>
    <a href="../index.php">Retour à l'accueil</a>
</div>