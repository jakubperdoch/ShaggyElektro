<?php
include "components/header.php";
include '_inc/config.php';

$err = false;

if (isset($_POST['submit'])) {
  $nazov = $_POST['nazov'];
  $popis = $_POST['popis'];

  if ($nazov == '' || $popis == '') {
    $err = true;
  } else {
    $sql = "INSERT INTO Kategorie (Nazov_Kategorie, Popis_Kategorie) VALUES (:nazov, :popis)";
    $insert = $DB->prepare($sql);
    $insert->bindParam(':nazov', $nazov, PDO::PARAM_STR);
    $insert->bindParam(':popis', $popis, PDO::PARAM_STR);
    $insert->execute();
    header('Location: orders.php');
    exit;
  }
}

?>

<div class="container d-flex flex-column gap-3 p-3 mt-3">
  <h1>Pridat Kategoriu</h1>
  <?php if ($err) { ?>
    <div class="alert alert-danger" role="alert">
      Vsetky polia musia byt vyplnene
    </div>
  <?php } ?>


  <form action="" method="POST">
    <div class="mb-3">
      <label for="nazov" class="form-label">Názov Kategorie</label>
      <input type="text" class="form-control" id="nazov" name="nazov">
    </div>
    <div class="mb-3">
      <label for="popis" class="form-label">Popis</label>
      <textarea class="form-control" id="popis" name="popis"></textarea>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Pridat</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>