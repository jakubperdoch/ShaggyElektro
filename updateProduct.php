<?php
include "components/header.php";
include '_inc/config.php';

$id = $_GET['ID'];
$err = false;

$sql = "SELECT ProduktID ,Nazov_produktu, Popis,Cena FROM Produkty WHERE ProduktID = $id;";
$Protuct_Update = $DB->prepare($sql);
$Protuct_Update->execute();
$row = $Protuct_Update->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
  $nazov = $_POST['nazov'];
  $cena = $_POST['cena'];
  $popis = $_POST['popis'];

  if ($nazov == '' || $cena == '' || $popis == '') {
    $err = true;
  } else {

    $sql = "UPDATE Produkty SET Nazov_produktu = '$nazov', Cena = '$cena', Popis = '$popis' WHERE ProduktID = $id;";
    $update = $DB->prepare($sql);
    $update->execute();
    header('Location: orders.php');
  }
}



?>

<div class="container d-flex flex-column gap-3 p-3 mt-3">
  <h1>Uprava Produktu</h1>

  <?php if ($err) { ?>
    <div class="alert alert-danger" role="alert">
      Vsetky polia musia byt vyplnene
    </div>
  <?php } ?>

  <form method="POST">
    <div class="mb-3">
      <label for="nazov" class="form-label">Názov produktu</label>
      <input type="text" class="form-control" id="nazov" name="nazov" value="<?php echo $row['Nazov_produktu']; ?>">
    </div>
    <div class="mb-3">
      <label for="cena" class="form-label">Cena</label>
      <input type="number" class="form-control" id="cena" name="cena" value="<?php echo $row['Cena']; ?>">
    </div>
    <div class="mb-3">
      <label for="popis" class="form-label">Popis</label>
      <textarea class="form-control" id="popis" name="popis" rows="3"><?php echo $row['Popis']; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Uložiť</button>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>