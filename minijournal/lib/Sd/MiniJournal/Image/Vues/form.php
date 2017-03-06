<form action="index.php?objet=image&amp;action=enregistrer" enctype="multipart/form-data" method="post">
    <?php if (!empty($image->getId())) { ?>
        <input type="hidden" id="id" name="id" value="<?php echo $image->getId(); ?>" required/>
    <?php } ?>
    <div>
        <label for="titre">Titre</label>
        <input type="text" id="titre" name="titre" value="<?php echo $image->getTitre(); ?>" required/>
        <?= isset($erreurs['titre']) ? $erreurs['titre'] : null ?>
    </div>
    <div>
        <label for="auteur">Auteur</label>
        <input type="text" id="auteur" name="auteur" value="<?php echo $image->getAuteur(); ?>" required/>
        <?= isset($erreurs['auteur']) ? $erreurs['auteur'] : null ?>
    </div>
    <div>
        <label for="auteur">Image</label>
        <input type="file" id="fichier" name="fichier" required/>
        <?= isset($erreurs['fichier']) ? $erreurs['fichier'] : null ?>
    </div>
    <div class="button">
        <button type="submit"><?= !empty($image->getId()) ? 'Modifier' : 'Enregistrer' ?></button>
    </div>
</form>