<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des objet</title>
</head>
<body>
    <h1>Bienvenue <?=$username?></h1>

    <?php foreach($listProduct as $listProduct):?>
        <ul>
            <li><?= $listProduct['name']?></li>
        </ul>

    <?php endforeach?>
</body>
</html>