<?= $pageTitle ?>
<div>
    <form class="form-group" method="post" action="index.php?controller=usercontroller&action=subscription&id=JF">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" class="form-control"><br>
        <label for="email">Adresse email</label>
        <input type="email" name="email" class="form-control"  /><br />
        <label for="password">Mot de passe</label><br>
        <input type="password" id="pass" name="pass" class="form-control" ><br>
        <label for="password">Confirmer Mot de passe</label><br>
        <input type="password" id="pass2" name="pass2" class="form-control" ><br>
        <button type="submit"  id="submit" name="submit" class="btn btn-primary">Connexion</button>
    </form>
    <a href="../index.php">Retour à l'accueil</a>
</div>