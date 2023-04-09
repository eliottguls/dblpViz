
            <h2><?php echo $title ?></h2>
            <a href="http://localhost:3000/app/Publication" class="btn btn-primary">Retour à la recherche</a>
            <h3>Nombre de résultats : <?php echo $publications['result']['hits']['@total']; ?></h3>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Author(s)</th>
                        <th scope="col">Score</th>
                        <th scope="col">Type</th>
                        <th scope="col">DOI</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Venue</th>
                        <th scope="col">Année</th>
                        <th scope="col">Pages</th>
                        <th scope="col">EE</th>
                        <th scope="col">URL DBLP</th>
                        <th scope="col">Key</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <pre>
                    <?php print_r($publications);?>
                    </pre> -->
                    <?php
$j = 0;
foreach ($publications['result']['hits']['hit'] as $publication) {
    $i = 0;
    ?>
                        <tr>
                            <th scope="row"><?php if (isset($publication['@id'])) {echo $publication['@id'];} else {echo '<strong>non renseigné</strong>';}?></th>
                            <th scope="row"><?php
                            $j = $j + 1; ?></th>
                            <td><ul><?php foreach ($publication['info']['authors']['author'] as $author) {?> <li> <?php echo $publication['info']['authors']['author'][$i]['text']; ?></li><br><?php $i++;}?></ul></td>
                            <th><?php if (isset($publication['@score'])) {echo $publication['@score'];} else {echo "<strong>non renseigné</strong>";}?></th>
                            <td><?php if (isset($publication['info']['type'])) {echo $publication['info']['type'];} else {echo "<strong>non renseigné</strong>";}?></td>
                            <td><?php if (isset($publication['info']['doi'])) {echo $publication['info']['doi'];} else {echo "<strong>non renseigné</strong>";}?></td>
                            <td><?php if (isset($publication['info']['title'])) {echo $publication['info']['title'];} else {echo "<strong>non renseigné</strong>";}?></td>
                            <td><?php if (isset($publication['info']['venue'])) {echo $publication['info']['venue'];} else {echo "<strong>non renseigné</strong>";}?></td>
                            <td><?php if (isset($publication['info']['year'])) {echo $publication['info']['year'];} else {echo "<strong>non renseigné</strong>";}?></td>
                            <td><?php if (isset($publication['info']['pages'])) {echo $publication['info']['pages'];} else {?> <strong> <?php echo 'non renseignée';} ?></strong></td>
                            <td><?php if (isset($publication['info']['ee'])) {echo $publication['info']['ee'];} else {echo "<strong>non renseigné</strong>";}?></td>
                            <td><?php if (isset($publication['info']['url'])) {echo $publication['info']['url'];} else {echo "<strong>non renseigné</strong>";}?></td>
                            <td><?php if (isset($publication['info']['key'])) {echo $publication['info']['key'];} else {echo "<strong>non renseigné</strong>";}?></td>
                            <td><a href="<?php 'http://localhost:3000/app/Publication/get_article_by_key_to_bibtex/' . $publication['info']['key']?>" class="btn btn-primary">Convertir en BibTex</a></td>
                        </tr>
                    <?php
}
?>
                </tbody>
            </table>
