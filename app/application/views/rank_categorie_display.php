<h2><?php echo $title ?></h2>
<?php $length = sizeof($array);
if (isset($array['name_journal']) || isset($array[0]['name_journal'])){
if ($length > 1 ) { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> Name Journal </th>
                <th scope="col"> Name Categorie </th>
                <th scope="col"> Rank </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($array as $key => $value) { ?>
                <tr>
                    <td> <?php echo $value['name_journal'] ?></td>
                    <td><?php echo $value['name_categorie'] ?></td>
                    <td><?php echo $value['rank']?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <h3> <?php echo $array[0]['name_journal'] . ' : ' . $array[0]['name_category'] . ' | ' . $array[0]['rank']  ?> </h3>
<?php } }
    else { ?>
    <h3> No Journal found for <?php echo ' : ' . $name ?></h3>
<?php } ?>

