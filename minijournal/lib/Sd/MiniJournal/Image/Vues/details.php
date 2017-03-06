<article>
    <header>
        <h3><?php echo $image->getTitre(); ?></h3>
        <h2><?php echo $image->getAuteur(); ?></h2>
    </header>
    <figure>
        <img src="<?php echo $image->getFichier(); ?>" alt="<?php echo $image->getTitre(); ?>">
    </figure>
    <footer>
        <table>
            <tr>
                <th>Date de création</th>
            </tr>
            <tr>
                <td><?php echo $image->getDateCreation(); ?></td>
            </tr>
        </table>
    </footer>
</article>
