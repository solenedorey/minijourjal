<article>
    <header>
        <h3><?php echo $article->getTitre(); ?></h3>
        <h2><?php echo $article->getAuteur(); ?></h2>
        <p><?php echo $article->getChapo(); ?></p>
    </header>
    <p><?php echo $article->getContenu(); ?></p>
    <footer>
        <table>
            <tr>
                <th>Date de création</th>
                <th>Date de publication</th>
            </tr>
            <tr>
                <td><?php echo $article->getDateCreation(); ?></td>
                <td><?php echo $article->getDatePublication(); ?></td>
            </tr>
        </table>
    </footer>
</article>
