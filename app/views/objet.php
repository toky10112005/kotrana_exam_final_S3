<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des objet</title>
</head>
<body>
    <h1>Bienvenue <?=$username?></h1>

<h2><a href="/Liste?username=<?= $username ?>&id=<?= $id ?>">Voir objets des autres</a></h2>

    <?php foreach($listProduct as $listProduct):?>
        <ul>
            <li><?= $listProduct['name']?></li>
            <li><?= $listProduct['price']?></li>
            <li><?= $listProduct['description']?></li>
            <li><img src="/sary/<?= $listProduct['picture']?>" alt="sary"></li>
        </ul>
    <?php endforeach?>
</body>
</html>