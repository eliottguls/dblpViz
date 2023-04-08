<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            body {
                background-color: grey;
                color: #fff;
            }

            h2 {
                text-align: center;
                padding-top : 100px;
            }

            .btn-primary {
                background-color: #718096;
                border-color: #2d3748;
            }
        
        </style>
    </head>
    <body>
            <h2><?php echo $title ?></h2>
            <?php if (is_array($rank_array)) { // don't need because i use result_array() in the model but i prefer
                $length = sizeof($rank_array);
            } else {
                $length = 0;
            } 
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
                <h3><?php echo $name_acronym . ' : ' . $rank_array[0]['rank'] ?> </h3>
            <?php } ?>
    </body>
</html>
