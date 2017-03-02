<?php if (empty($articles)){ ?>
    <p>Aucun article</p>
<?php } else { ?>
<ul>
    <?php foreach ($articles as $article) {
        $id = $article->getId(); ?>
        <li>
            <a href="index.php?objet=article&amp;action=afficherDetail&amp;idArticle=<?= $id ?>"><?= $article->getTitre() ?></a>
            <a href="index.php?objet=article&amp;action=editer&amp;idArticle=<?= $id ?>"> - Modifier -</a>
            <a href="index.php?objet=article&amp;action=supprimer&amp;idArticle=<?= $id ?>"> Supprimer -</a>
        </li>
    <?php } ?>
</ul>
<?php } ?>
<div><a href="index.php?objet=article&amp;action=editer"> Nouvel article</a></div>
