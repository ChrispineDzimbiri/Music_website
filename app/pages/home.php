<?php require page('includes/header')?>

<section>
  <img class="back" src="<?=ROOT?>/assets/images/back5" alt="">
</section>

<div class="section-title">Featured</div>

<section class="content">

<?php

$rows = db_query("SELECT * FROM songs WHERE featured = 1 ORDER BY id DESC LIMIT 16");

?>

<?php if(!empty($rows)):?>
      <?php foreach($rows as $row):?>
          <?php include page('includes/song')?>
    <?php endforeach;?>
<?php else:?>
  <div class="m-2">No songs found</div>
<?php endif;?>
</section>

<?php require page('includes/footer')?>

