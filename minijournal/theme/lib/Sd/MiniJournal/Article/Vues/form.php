<form action="index.php?action=enregistrer" method="post">
    <?php if (!empty($this->document->getId())) { ?>
        <input type="hidden" id="id" name="id" value="<?php echo $this->document->getId(); ?>" required/>
    <?php } ?>
    <div>
        <label for="titre">Titre</label>
        <input type="text" id="titre" name="titre" value="<?php echo $this->document->getTitre(); ?>" required/>
        <?php echo $this->getErreur('titre'); ?>
    </div>
    <div>
        <label for="auteur">Auteur</label>
        <input type="text" id="auteur" name="auteur" value="<?php echo $this->document->getAuteur(); ?>" required/>
        <?php echo $this->getErreur('auteur'); ?>
    </div>
    <div>
        <label for="chapo">Chapo</label>
        <input type="text" id="chapo" name="chapo" value="<?php echo $this->document->getChapo(); ?>" required/>
        <?php echo $this->getErreur('chapo'); ?>
    </div>
    <div>
        <label for="contenu">Contenu principal</label>
        <textarea id="contenu" name="contenu" required><?php echo $this->document->getContenu(); ?></textarea>
        <?php echo $this->getErreur('contenu'); ?>
    </div>
    <div>
        <label for="statutPublication">Statut de publication</label>
        <select id="statutPublication" name="statutPublication" required>
            <option value="1" <?= $this->document->getStatutPublication() === '1' ? 'selected' : null ?>>Brouillon</option>
            <option value="2" <?= $this->document->getStatutPublication() === '2' ? 'selected' : null ?>>Publié</option>
        </select>
        <?php echo $this->getErreur('statutPublication'); ?>
    </div>
    <div class="button">
        <button type="submit"><?= !empty($this->document->getId()) ? 'Modifier' : 'Enregistrer' ?></button>
    </div>
</form>