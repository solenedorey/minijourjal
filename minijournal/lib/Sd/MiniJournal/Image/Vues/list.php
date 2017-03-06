<?php if (empty($images)) { ?>
    <p>Aucune image</p>
<?php } else { ?>
<ul>
    <?php foreach ($images as $image) {
        $id = $image->getId(); ?>
        <li>
            <a href="index.php?objet=image&amp;action=afficherDetail&amp;
            idImage=<?= $id ?>"><?= $image->getTitre() ?></a>
            <a href="index.php?objet=image&amp;action=editer&amp;idImage=<?= $id ?>"> - Modifier -</a>
            <a href="index.php?objet=image&amp;action=supprimer&amp;idImage=<?= $id ?>"> Supprimer -</a>
        </li>
    <?php } ?>
</ul>
<?php } ?>
<div><a href="index.php?objet=image&amp;action=editer"> Nouvelle image</a></div>
