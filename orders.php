<?php
include "components/header.php";
include '_inc/config.php';


if (isset($_POST['deleteProductButton'])) {
  $deletedProduct = $_POST["deleteProductID"];

  if (!empty($deletedProduct)) {
    $sql = "DELETE FROM Produkty WHERE ProduktID = :produktID";
    $delete = $DB->prepare($sql);
    $delete->bindParam(':produktID', $deletedProduct, PDO::PARAM_INT);
    $success = $delete->execute();

    if ($success) {
      header("Location: orders.php");
      exit;
    } else {
    }
  } else {
    echo "Error: Product ID is empty";
  }
}

if (isset($_POST['deleteCategoryButton'])) {
  $deletedCategory = $_POST["deleteCategoryID"];

  if (!empty($deletedCategory)) {
    $sql = "DELETE FROM Kategorie WHERE KategorieID = :kategoriaID";
    $delete = $DB->prepare($sql);
    $delete->bindParam(':kategoriaID', $deletedCategory, PDO::PARAM_INT);
    $success = $delete->execute();

    if ($success) {
      header("Location: orders.php");
      exit;
    } else {
    }
  } else {
    echo "Error: Category ID is empty";
  }
}

?>

<div class="container d-flex flex-column gap-3 p-3 mt-3">
  <h1>Objednavky Kategorie a Produkty</h1>
  <h5 class="text-decoration-underline" data-bs-toggle="collapse" href="#objednavky" role="button" aria-expanded="false" aria-controls="objednavky">Zobrazit Objednavky</h5>
  <h5 class="text-decoration-underline" data-bs-toggle="collapse" href="#produkty" role="button" aria-expanded="false" aria-controls="produkty">Zobrazit Produkty</h5>
  <h5 class="text-decoration-underline" data-bs-toggle="collapse" href="#kategorie" role="button" aria-expanded="false" aria-controls="kategorie">Zobrazit Kategorie</h5>

  <div class="table-responsive collapse" id="objednavky">
    <table class="table table-hover" style="border-radius: .5rem;overflow: hidden;">
      <thead>
        <tr>
          <th scope="col">Č.Objednavky</th>
          <th scope="col">Meno</th>
          <th scope="col">Priezvisko</th>
          <th scope="col">Email</th>
          <th scope="col">Celkova Cena</th>
          <th scope="col">Stav Objednavky</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT Zakaznici.Meno, Zakaznici.Priezvisko, Zakaznici.Email, Objednavky.ObjednakaID, Objednavky.Datum_Objednania, Objednavky.Adresa_Dorucenia, Objednavky.Celkova_Cena, Objednavky.Stav_Objednavky FROM Zakaznici INNER JOIN Objednavky ON Zakaznici.ZakaznikID = Objednavky.ZakaznikID;";
        $orders = $DB->prepare($sql);
        $orders->execute();
        $index_products = $orders->fetchAll(PDO::FETCH_OBJ);
        foreach ($index_products as $pkt) {
        ?>
          <tr>
            <td><?php echo $pkt->ObjednakaID ?></td>
            <td><?php echo $pkt->Meno ?></td>
            <td><?php echo $pkt->Priezvisko ?></td>
            <td><?php echo $pkt->Email ?></td>
            <td><?php echo $pkt->Celkova_Cena . '$' ?></td>
            <td><?php echo $pkt->Stav_Objednavky ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <div class="table-responsive collapse" id="produkty">
    <table class="table table-hover" style="border-radius: .5rem;overflow: hidden;">
      <thead>
        <tr>
          <th scope="col">Názov produktu</th>
          <th scope="col">Kategória</th>
          <th scope="col">Popis</th>
          <th scope="col">Cena</th>
          <th scope="col"></th>
          <th scope="col">Popis kategórie</th>
          <th scope="col">Vymazat Produkt</th>
          <th scope="col">Upravit Produkt</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $sql = "SELECT Produkty.ProduktID ,Produkty.Nazov_produktu, Produkty.Popis, Produkty.Cena, Kategorie.Nazov_Kategorie, Kategorie.Popis_Kategorie FROM Produkty INNER JOIN Kategorie ON Produkty.KategorieID = Kategorie.KategorieID;";
        $Product_Categories = $DB->prepare($sql);
        $Product_Categories->execute();
        $index_products = $Product_Categories->fetchAll(PDO::FETCH_OBJ);
        foreach ($index_products as $pkt) {
        ?>
          <tr>
            <td><?php echo $pkt->Nazov_produktu ?></td>
            <td><?php echo $pkt->Nazov_Kategorie ?></td>
            <td><?php echo $pkt->Popis ?></td>
            <td><?php echo $pkt->Email ?></td>
            <td><?php echo $pkt->Cena . '$' ?></td>
            <td><?php echo $pkt->Popis_Kategorie ?></td>
            <td>
              <form action="" method="POST">
                <button class="btn btn-danger" name="deleteProductButton" type="submit">Vymazat Produkt</button>
                <input type="hidden" name="deleteProductID" value="<?php echo $pkt->ProduktID  ?>">
              </form>
            </td>
            <td><a href="updateProduct.php?ID=<?php echo $pkt->ProduktID ?>" class="btn btn-primary">Upravit Produkt</a></td>
          </tr>
        <?php } ?>
      </tbody>

    </table>
  </div>

  <div class="table-responsive collapse" id="kategorie">
    <table class="table table-hover" style="border-radius: .5rem;overflow: hidden;">
      <thead>
        <tr>
          <th scope="col">Názov Kategórie</th>
          <th scope="col">Popis Kategórie</th>
          <th scope="col">Vymazat Kategóriu</th>
          <th scope="col">Upravit Kategóriu</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM Kategorie;";
        $categories = $DB->prepare($sql);
        $categories->execute();
        $index_categories = $categories->fetchAll(PDO::FETCH_OBJ);
        foreach ($index_categories as $cat) {
        ?>
          <tr>
            <td><?php echo $cat->Nazov_Kategorie ?></td>
            <td><?php echo $cat->Popis_Kategorie ?></td>
            <td>
              <form action="" method="POST">
                <button class="btn btn-danger" name="deleteCategoryButton" type="submit">Vymazat Kategoriu</button>
                <input type="hidden" name="deleteCategoryID" value="<?php echo $cat->KategorieID  ?>">
              </form>
            </td>
            <td><a href="updateCategory.php?ID=<?php echo $cat->KategorieID ?>" class="btn btn-primary">Upravit Kategoriu</a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

    </html>