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


<div>
    <form  method="post" action="index.php?request=usercontroller&action=login" style="width: 20%; margin-left:1%">
    <div class="form-group">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password" class="form-control" ><br>
    </div>
        <button type="submit"  id="submit" name="submit" class="btn btn-primary">Connexion</button>
    </form>
    <a href="index.php?request=usercontroller&action=index">Retour à l'accueil</a>
</div>

