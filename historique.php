<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Historique</title>
</head>

<body class="histo">
    <?php

    require_once "connect.php";
    require_once "classes/LodgeManager.php";
    require_once "classes/class.lodge.php";

    $manager = new LodgeManager($db);
    $lodge = $manager->getListLodge();
    /* --------------------------------- DELETE --------------------------------- */
    if (!empty($_GET['id'])) {
        $lodge = $manager->getListId($_GET['id']);
        $lodge=$manager->deleteLodge($lodge);
    }
    ?>
    <header>
        <nav>
            <ul>
                <li><a href="historique.php">Historique</a></li>
                <li><a href="form.php">Gestion des gîtes</a></li>
                <li><a href="">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>HISTORIQUE</h1>
        <div>
            <table class="histoire">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Localisation</th>
                        <th scope="col">Caractéristique</th>
                        <th scope="col">Images</th>
                        <th scope="col">Disponibilité</th>
                        <th scope="col">MODIFIER</th>
                        <th scope="col">SUPPRIMER</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lodge as $data) : ?>
                        <tr>
                            <td><?= $data->getIdlodge(); ?></td>
                            <td><?= $data->getLodgename(); ?></td>
                            <td><?= $data->getLocation(); ?></td>
                            <td><?= $data->getSpecificity(); ?></td>
                            <td>Image</td>
                            <td>Disponibilité</td>
                            <td><button><a href="historique.php?id=<?= $data->getIdlodge(); ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ?'));">Supprimer </a></button></td>
                            <td><button><a href="form.php?id=<?= $data->getIdlodge(); ?>">Modifier</a></button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>