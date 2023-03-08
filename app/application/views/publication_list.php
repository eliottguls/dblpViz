<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            body {
                background-color: #e0f2e9;
            }
            h2 {
                color: #176d4b;
                text-align: center;
                margin-top: 40px;
            }
            th {
                background-color: #97d9ac;
                color: white;
            }
            td {
                background-color: #e5f7ea;
                color: #176d4b;
            }
            .btn-dark {
                background-color: #9ac0a7;
                border-color: #9ac0a7;
                text-align: center;
                display: block;
                margin: 0 auto;
                width : 200px;
            }
            .container {
                margin-top: 40px;
            }
            td {
                background-color: white;
            }

            tr:hover td {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2><?php echo $title ?></h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Type</th>
                        <th scope="col">DOI</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Venue</th>
                        <th scope="col">Année</th>
                        <th scope="col">Pages</th>
                        <th scope="col">EE</th>
                        <th scope="col">URL DBLP</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <pre>
                    <?php print_r($publications); ?>
                    </pre> -->
                    <?php 
                    foreach($publications['result']['hits']['hit'] as $publication) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $publication['@id']; ?></th>
                            <td><?php echo $publication['info']['type']; ?></td>
                            <td><?php echo $publication['info']['doi']; ?></td>
                            <td><?php echo $publication['info']['title']; ?></td>
                            <td><?php echo $publication['info']['venue']; ?></td>
                            <td><?php echo $publication['info']['year']; ?></td>
                            <td><?php echo $publication['info']['pages']; ?></td>
                            <td><?php echo $publication['info']['ee']; ?></td>
                            <td><?php echo $publication['info']['url']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
