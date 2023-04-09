<h2><?php echo $title ?></h2>
<?php $length = sizeof($rank_array);
if (isset($rank_array['rank']) || isset($rank_array[0]['rank'])){
if ($length > 1 ) { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Conference</th>
                <th scope="col">Acronym</th>
                <th scope="col">Rank</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rank_array as $key => $value) { ?>
                <tr>
                    <td><?php echo $value['name_conference'] ?></td>
                    <td><?php echo $value['acronym'] ?></td>
                    <td><?php echo $value['rank'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <h3><?php echo $rank_array[0]['name_conference'] . ' | ' . $rank_array[0]['acronym'] . ' : ' . $rank_array[0]['rank'] ?> </h3>
<?php } }
else { ?>
    <h3> <?php echo 'No rank found for : ' . $input; ?></h3>
<?php } ?>
