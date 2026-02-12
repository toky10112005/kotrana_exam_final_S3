<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Objets</title>
</head>
<body>
    <h1>Voici les objets des autres utililsateur</h1>

    <form action="/Liste" method="get">

    <input type="hidden" name="username" value="<?= htmlspecialchars($username) ?>">
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

    <select name="categorie" id="categorie">
        <?php foreach($categories as $categories){?>
            <option value="<?= htmlspecialchars($categories['id']) ?>"><?= htmlspecialchars($categories['categorie']) ?></option>
        <?php }?>
    </select>

    <input type="submit" value="Valider">
    </form>

     <?php if(isset($products)){
        foreach($products as $product){?>
        <ul>
            <li><?= htmlspecialchars($product['name'] ?? '') ?></li>
            <li><?= htmlspecialchars($product['description'] ?? '') ?></li>
            <li><?= htmlspecialchars($product['price'] ?? '') ?></li>
            <li><?= htmlspecialchars($product['picture'] ?? '') ?></li>
            <li><?= htmlspecialchars($product['created_at'] ?? '') ?></li>
            <li><?= htmlspecialchars($product['username'] ?? '') ?></li>
        </ul>

      <?php }}?>

</body>
</html>