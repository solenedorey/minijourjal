<form action="index.php?objet=article&amp;action=enregistrer" method="post">
    <?php if (!empty($article->getId())) { ?>
        <input type="hidden" id="id" name="id" value="<?php echo $article->getId(); ?>"/>
    <?php } ?>
    <div>
        <label for="titre">Titre</label>
        <input type="text" id="titre" name="titre" value="<?php echo $article->getTitre(); ?>" required/>
        <?= isset($erreurs['titre']) ? $erreurs['titre'] : null ?>
    </div>
    <div>
        <label for="auteur">Auteur</label>
        <input type="text" id="auteur" name="auteur" value="<?php echo $article->getAuteur(); ?>" required/>
        <?= isset($erreurs['auteur']) ? $erreurs['auteur'] : null ?>
    </div>
    <div>
        <label for="chapo">Chapo</label>
        <input type="text" id="chapo" name="chapo" value="<?php echo $article->getChapo(); ?>" required/>
        <?= isset($erreurs['chapo']) ? $erreurs['chapo'] : null ?>
    </div>
    <div>
        <label for="contenu">Contenu principal</label>
        <textarea id="contenu" name="contenu" required><?php echo $article->getContenu(); ?></textarea>
        <?= isset($erreurs['contenu']) ? $erreurs['contenu'] : null ?>
    </div>
    <div>
        <label for="statutPublication">Statut de publication</label>
        <select id="statutPublication" name="statutPublication">
            <option value="1" <?= $article->getStatutPublication() === '1' ? 'selected' : null ?>>Brouillon</option>
            <option value="2" <?= $article->getStatutPublication() === '2' ? 'selected' : null ?>>Publié</option>
        </select>
        <?= isset($erreurs['statutPublication']) ? $erreurs['statutPublication'] : null ?>
    </div>
    <div class="button">
        <button type="submit"><?= !empty($article->getId()) ? 'Modifier' : 'Enregistrer' ?></button>
    </div>
</form>
<script type="text/javascript">
    CKEDITOR.replace('contenu');
</script>