<form action="index.php?action=enregistrer" method="post">
    <?php if (!empty($article->getId())) { ?>
        <input type="hidden" id="id" name="id" value="<?php echo $article->getId(); ?>" required/>
    <?php } ?>
    <div>
        <label for="titre">Titre</label>
        <input type="text" id="titre" name="titre" value="<?php echo $article->getTitre(); ?>" required/>
        <?php echo $erreurs['titre']; ?>
    </div>
    <div>
        <label for="auteur">Auteur</label>
        <input type="text" id="auteur" name="auteur" value="<?php echo $article->getAuteur(); ?>" required/>
        <?php echo $erreurs['auteur']; ?>
    </div>
    <div>
        <label for="chapo">Chapo</label>
        <input type="text" id="chapo" name="chapo" value="<?php echo $article->getChapo(); ?>" required/>
        <?php echo $erreurs['chapo']; ?>
    </div>
    <div>
        <label for="contenu">Contenu principal</label>
        <textarea id="contenu" name="contenu" required><?php echo $article->getContenu(); ?></textarea>
        <?php echo $erreurs['contenu']; ?>
    </div>
    <div>
        <label for="statutPublication">Statut de publication</label>
        <select id="statutPublication" name="statutPublication" required>
            <option value="1" <?= $article->getStatutPublication() === '1' ? 'selected' : null ?>>Brouillon</option>
            <option value="2" <?= $article->getStatutPublication() === '2' ? 'selected' : null ?>>Publié</option>
        </select>
        <?php echo $erreurs['statutPublication']; ?>
    </div>
    <div class="button">
        <button type="submit"><?= !empty($article->getId()) ? 'Modifier' : 'Enregistrer' ?></button>
    </div>
</form>
<script type="text/javascript">
    CKEDITOR.replace('contenu');
</script>