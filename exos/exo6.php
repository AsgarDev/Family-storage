<?php
require_once '../inc/functions.php';

function getChildrenData() {
    require '../inc/children.php';
    return $data;
}

function getParentsData() {
    require '../inc/parents.php';
    return $dataForParents;
}

// Je charge le tableau contenant la liste de leurs parents
    $parentsData = getParentsData();

// Je charge le tableau contenant les infos sur mes petits-enfants
    $childrenData = getChildrenData();

// Si le form est soumis
    if (!empty($_GET)) {
    if (!empty($_GET['parent-name'])) {
        $parentName = $_GET['parent-name'];

// On parcours le tableau des enfants
$newChildrenData = []; // tableau temporaire permettant de filtrer
foreach ($childrenData as $currentKey => $currentChild) {
// Je vérifie que l'enfant courant a comme parent le parent sélectionné
if (($currentChild['mother'] == $parentName) || ($currentChild['father'] == $parentName))
    { $newChildrenData[] = $currentChild; }

        }
// On affecte le tableau filtré au tableau d'origine
$childrenData = $newChildrenData;

    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">

    <title>Mes petits-enfants</title>
</head>

<body>
    <div class="container">
        <div class="card my-3">
            <div class="card-header">
                Recherche
            </div>
            <div class="card-body">
                <h2 class="card-title">Aide mémoire sur mes petits-enfants</h2>
                <form action="" method="get" id="form-exo6" class="exo">
                    <div class="form-group">
                        <label for="child-select">Filtrer par leur parent</label>
                        <select name="parent-name" id="child-select" class="form-control">
                            <option value="">Tous</option>
                            <?php if (!empty($parentsData)) : ?>
                            <?php foreach ($parentsData as $currentParent) : ?>
                            <option value="<?= $currentParent ?>"<?php if ($parentName == $currentParent) : ?> selected="selected"<?php endif; ?>>
                                <?= $currentParent ?>
                            </option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <button class="btn btn-success btn-block">Filtrer</button>
                </form>
            </div>
        </div>

        <div class="card my-3">
            <div class="card-header">
                Liste de mes petits enfants chéris <span class="text-danger h3">&hearts;</span>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Prénom</th>
                            <th scope="col">Age</th>
                            <th scope="col">Ville</th>
                            <th scope="col">Maman</th>
                            <th scope="col">Papa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($childrenData as $currentChild) : ?>
                        <tr>
                            <th scope="row"><?= $currentChild['name'] ?></th>
                            <td><?= $currentChild['age'] ?></td>
                            <td><?= $currentChild['city'] ?></td>
                            <td><?= $currentChild['mother'] ?></td>
                            <td><?= $currentChild['father'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>

</html>