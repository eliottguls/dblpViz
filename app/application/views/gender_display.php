<h2><?php echo $title ?></h2>
<?php $length = sizeof($array);
if (isset($array['probability']) || isset($array[0]['probability'])){
if ($length > 1 ) { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> Name </th>
                <th scope="col"> Gender </th>
                <th scope="col"> Probability</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($array as $key => $value) { ?>
                <tr>
                    <?php if (isset($value['gender'])) { 
                    $value['probability'] = $value['probability'] * 100;?>
                    <td> <?php echo $value['name'] ?></td>
                    <td><?php echo $value['gender'] ?></td>
                    <td><?php echo '(' . $value['probability'] . '%)'?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { 
    $array[0]['probability'] = $array[0]['probability'] * 100;?>
    <h3> <?php echo $array[0]['name'] . ' : ' . $array[0]['gender'] . '(' . $array[0]['probability'] . '%)'  ?> </h3>
<?php } }
    else { ?>
    <h3> No Probability found for <?php echo ' : ' . $name ?></h3>
<?php } ?>

