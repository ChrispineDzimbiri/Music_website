   <?php
   
   db_query("UPDATE songs SET views = views + 1 WHERE id = :id LIMIT 1",['id'=>$row['id']]);
      
  ?>
      <!--start music card-->
        <div class="music-card-full" style="max-width: 350px;">

                  <h2 class="card-title" style="margin: 0px;"><?=esc($row['title'])?></h2>
                  <div class="card-subtitle" style="margin-bottom: 5px;">By:<?=esc(get_artist($row['artist_id']))?></div>

            <div style="overflow: hidden;">
                <a href="<?=ROOT?>/song/<?=$row['slug']?>"><img src="<?=ROOT?>/<?=$row['image']?>" alt=""></a>
            </div>
            <div class="card-content">
              <audio controls style="width: 100%">
                <source src="<?=ROOT?>/<?=$row['file']?>" type="audio/mpeg">
              </audio>
            <div class="" style="color: black;">Views: <?=$row['views']?></div>
            <div class="" style="color: black;margin: 5px"><svg style="margin: 0px" xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-calendar3-week" viewBox="0 0 16 16">
  <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
  <path d="M12 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-5 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m2-3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-5 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
</svg> <?=get_date($row['date'])?></div>

            <a href="<?=ROOT?>/download/<?=$row['slug']?>">
          <button class="btn bg-purple">Download</button>
          </a>
            </div>
        </div>
        <!--end music card-->