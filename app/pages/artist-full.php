
      <!--start music card-->
        <div class="music-card-full" style="max-width: 400px;">

                  <h2 class="card-title" style="margin-bottom: 0px;"><?=esc($row['name'])?></h2>

            <div style="overflow: hidden;">
            <img src="<?=ROOT?>/<?=$row['image']?>" alt="">
            </div>
            <div class="card-content">
             <div style="color: black;"><?=esc($row['bio'])?></div>

             <div>Artist Songs:</div>
             		<div style="display: flex;flex-wrap: wrap; justify-content: center;">
                <?php

                  $query = "select * from songs where artist_id = :artist_id order by views desc limit 20";
                  $songs = db_query($query,['artist_id'=>$row['id']]);

                  ?>

                  <?php if(!empty($songs)):?>
                    <?php foreach($songs as $row):?>
                      <?php include page('includes/song')?>
                    <?php endforeach;?>
                  <?php endif;?>
                  </div>
            </div>
        </div>
        <!--end music card-->