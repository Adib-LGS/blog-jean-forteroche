
  <?= $pageTitle  ?>
<div>
    <form class="form-group" method="post" action="index.php?controller=usercontroller&action=login">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" class="form-control"><br>
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password" class="form-control" ><br>
        <button type="submit"  id="submit" name="submit" class="btn btn-primary">Connexion</button>
    </form>
    <a href="../index.php">Retour à l'accueil</a>
</div>

