<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste categorie</title>
</head>
<body>
    <h1>Admin</h1>
    <h2>Liste des categories</h2>
    <form action="/ChoixCategorie" method="get">

    <input type="hidden" name="username" value="<?= htmlspecialchars($username) ?>">
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

        <select name="categories" id="categories">
            <?php foreach ($categories as $categorie): ?>
             <option value="<?= htmlspecialchars($categorie['id']) ?>"><?= htmlspecialchars($categorie['categorie']) ?></option>
         <?php endforeach; ?>

         <input type="submit" value="Choisir">
     </select>
    </form>
    

    <?php if(isset($products)){
        foreach($products as $product){?>
        <ul>
            <li><?= htmlspecialchars($product['name'] ?? '') ?></li>
            <li><?= htmlspecialchars($product['description'] ?? '') ?></li>
            <li><?= htmlspecialchars($product['price'] ?? '') ?></li>
            <li><?= htmlspecialchars($product['picture'] ?? '') ?></li>
            <li><?= htmlspecialchars($product['created_at'] ?? '') ?></li>
        </ul>

      <?php }}?>
</body>
</html>