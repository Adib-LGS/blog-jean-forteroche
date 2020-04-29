  

<h1>Bienvenu Sur mon Blog !</h1>
<p>Vous trouverez en dessous mes dérniers Posts</p>

<a href="profil.php?id=">Profil Administrateur</a>

<h2>Liste des Articles:</h2>

<?php foreach ($articles as $article) : ?>
    <h2><?= $article['title'] ?></h2>
    <small>Ecrit le <?= $article['created_at'] ?></small>
    <p><?= $article['introduction'] ?></p>
    <a href="article.php?id=<?= $article['id'] ?>">Lire la suite</a>
    <a href="delete-article.php?id=<?= $article['id'] ?>" onclick="return window.confirm(`Êtes vous sur de vouloir supprimer cet article ?!`)">Supprimer</a>
<?php endforeach ?>