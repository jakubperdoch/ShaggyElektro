<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ElektroShop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style/main.css">
  <link rel="stylesheet" href="style.css?a=<?php echo time(); ?>">
</head>

<nav class="navbar navbar-expand-lg bg-black " data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand text-light" style="font-size:1.4rem" href="index.php">ElektroShop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a style="font-size:1rem" class="nav-link text-light" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a style="font-size:1rem" class="nav-link text-light" href="orders.php">Objednávky a Produkty</a>
        </li>
        <li class="nav-item">
          <a style="font-size:1rem" class="nav-link text-light" href="addProduct.php">Pridať Produkt</a>
        </li>
        <li class="nav-item">
          <a style="font-size:1rem" class="nav-link text-light" href="createCategory.php">Pridať Kategoriu</a>
        </li>
        <li class="nav-item">
          <a style="font-size:1rem" class="nav-link text-light" href="updateCategory.php">Aktualizovat Kategoriu</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<body>