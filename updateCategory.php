<?php
include "components/header.php";
include '_inc/config.php';

$id = $_GET['ID'];
$err = false;


$sql = "SELECT KategorieID, Nazov_Kategorie, Popis_Kategorie FROM Kategorie WHERE KategorieID = :id";
$category_fetch = $DB->prepare($sql);
$category_fetch->execute(['id' => $id]);
$row = $category_fetch->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
  $nazov = $_POST['nazov'];
  $popis = $_POST['popis'];

  if ($nazov == '' || $popis == '') {
    $err = true;
  } else {

    $sql = "UPDATE Kategorie SET Nazov_Kategorie = :nazov, Popis_Kategorie = :popis WHERE KategorieID = :id";
    $update = $DB->prepare($sql);
    $update->execute(['nazov' => $nazov, 'popis' => $popis, 'id' => $id]);
    header('Location: orders.php');
    exit;
  }
}
?>

?>

<div class="container d-flex flex-column gap-3 p-3 mt-3">
  <h1>Úprava Kategórie</h1>

  <?php if ($err) { ?>
    <div class="alert alert-danger" role="alert">
      Všetky polia musia byť vyplnené
    </div>
  <?php } ?>

  <form method="POST">
    <div class="mb-3">
      <label for="nazov" class="form-label">Názov kategórie</label>
      <input type="text" class="form-control" id="nazov" name="nazov" value="<?php echo htmlspecialchars($row['Nazov_Kategorie']); ?>">
    </div>
    <div class="mb-3">
      <label for="popis" class="form-label">Popis</label>
      <textarea class="form-control" id="popis" name="popis" rows="3"><?php echo htmlspecialchars($row['Popis_Kategorie']); ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Uložiť</button>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>