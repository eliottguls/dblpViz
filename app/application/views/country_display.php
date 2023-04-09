<h2><?php echo $title ?></h2>
<?php $length = sizeof($array);
if (isset($array['title']) || isset($array[0]['title'])){
if ($length > 1 ) { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> Title </th>
                <th scope="col"> Country </th>
                <th scope="col"> Region</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($array as $key => $value) { ?>
                <tr>
                    <td> <?php echo $value['title'] ?></td>
                    <td><?php echo $value['country'] ?></td>
                    <td><?php echo $value['region']?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <h3> <?php echo $array[0]['title'] . ' : ' . $array[0]['country'] . ' | ' . $array[0]['region']  ?> </h3>
<?php } }
    else { ?>
    <h3> No Country and Region found for <?php echo ' : ' . $name ?></h3>
<?php } ?>

