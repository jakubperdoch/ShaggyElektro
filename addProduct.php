<?php
include "components/header.php";
include '_inc/config.php';

$err = false;

if (isset($_POST['submit'])) {
  $nazov = $_POST['nazov'];
  $cena = $_POST['cena'];
  $popis = $_POST['popis'];
  $kategoria = $_POST['kategoria'];

  if ($nazov == '' || $cena == '' || $popis == '') {
    $err = true;
  } else {
    $sql = "INSERT INTO Produkty (Nazov_produktu, Cena, Popis, KategorieID) VALUES (:nazov, :cena, :popis, :kategoria)";
    $insert = $DB->prepare($sql);
    $insert->bindParam(':nazov', $nazov, PDO::PARAM_STR);
    $insert->bindParam(':cena', $cena, PDO::PARAM_STR);
    $insert->bindParam(':popis', $popis, PDO::PARAM_STR);
    $insert->bindParam(':kategoria', $kategoria, PDO::PARAM_INT);
    $insert->execute();
    header('Location: orders.php');
    exit;
  }
}

// select categories
$sql = "SELECT * FROM Kategorie";
$categories = $DB->prepare($sql);
$categories->execute();
$index_categories = $categories->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container d-flex flex-column gap-3 p-3 mt-3">
  <h1>Pridat Produkt</h1>
  <?php if ($err) { ?>
    <div class="alert alert-danger" role="alert">
      Vsetky polia musia byt vyplnene
    </div>
  <?php } ?>

  <form action="" method="POST">
    <div class="mb-3">
      <label for="nazov" class="form-label">Názov produktu</label>
      <input type="text" class="form-control" id="nazov" name="nazov">
    </div>
    <div class="mb-3">
      <label for="cena" class="form-label">Cena</label>
      <input type="number" class="form-control" id="cena" name="cena">
    </div>
    <div class="mb-3">
      <label for="popis" class="form-label">Popis</label>
      <textarea class="form-control" id="popis" name="popis"></textarea>
    </div>
    <div class="mb-3">
      <label for="kategoria" class="form-label">Kategoria</label>
      <select class="form-select" id="kategoria" name="kategoria">
        <?php foreach ($index_categories as $cat) { ?>
          <option value="<?php echo $cat->KategorieID ?>"><?php echo $cat->Nazov_Kategorie; ?></option>
        <?php } ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Pridať produkt</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>