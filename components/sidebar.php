<?php
include "_inc/config.php";
?>



<div class="container  w-25">
  <ul class="list-unstyled nav border border-black border-2 rounded">
    <?php
    $sql = "SELECT Nazov_Kategorie FROM `Kategorie`";
    $categories = $DB->prepare($sql);
    $categories->execute();
    $index_categories = $categories->fetchAll(PDO::FETCH_OBJ);
    foreach ($index_categories as $pkt) {
    ?>
      <li class="item">
        <a href="#" class="text-decoration-none text-dark nav-item">
          <?php echo $pkt->Nazov_Kategorie; ?>
        </a>
      </li>
    <?php } ?>
  </ul>
</div>