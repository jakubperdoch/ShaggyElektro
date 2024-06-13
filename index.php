<?php
include "components/header.php";
include "_inc/config.php";
?>


<div class="heading"><span class="heading-title">ElektroShop</span></div>
<div class="container py-4 home">
  <h1>Produkty</h1>
  <div class="d-flex flex-row gap-5 mt-5">
    <ul class="items list-unstyled w-100 ">
      <?php
      $sql = "SELECT Nazov_produktu,Cena FROM `Produkty`";
      $products = $DB->prepare($sql);
      $products->execute();
      $index_products = $products->fetchAll(PDO::FETCH_OBJ);
      foreach ($index_products as $pkt) {
      ?>
        <li class="item" style="height: 7rem; width:14rem;">
          <div class="card border border-black border-2 rounded">
            <div class="card-body d-flex justify-content-center flex-column align-items-center gap-2">
              <h5 class="card-title
              ">
                <?php echo $pkt->Nazov_produktu; ?>
              </h5>
              <p class="card-text">
                <?php echo $pkt->Cena . '$'; ?>
              </p>
            </div>
        </li>
      <?php } ?>
    </ul>
    <?php
    include "components/sidebar.php";
    ?>
  </div>
</div>
<?php
include "components/footer.php";
?>