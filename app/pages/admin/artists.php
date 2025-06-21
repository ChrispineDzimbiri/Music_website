<?php

if($action=='add')
{

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
      $errors = [];

      // data validation
      if(empty($_POST['name']))
      {
        $errors['name'] = "a name is required";
      }else
      if(!preg_match("/^[a-zA-Z \&\-]+$/", $_POST['name']))
      {
        $errors['name'] = "a name can only have letters and spaces";
      }

      // image
      if(!empty($_FILES['image']['name']))
      {
        $folder = "uploads/";
        if(!file_exists($folder))
        {
          mkdir($folder,0777,true);
          file_put_contents($folder."index.php", "");
        }
        $allowed = ['image/jpeg','image/png'];
        if($_FILES['image']['error'] == 0 && in_array($_FILES['image']['type'], $allowed))
        {
          $destination = $folder. $_FILES['image']['name'];

          move_uploaded_file($_FILES['image']['tmp_name'], $destination);
        }else{
          $errors['name'] = "image not valid";
        }

      }else{
        $errors['name'] = "image is required. allowed types are ". implode(",", $allowed);
      }

      

    if(empty($errors))
    {

      $values = [];
      $values['name'] = trim($_POST['name']);
      $values['bio'] = trim($_POST['bio']);
      $values['image']     = $destination;
      $values['user_id']     = user('id');


      $query = "insert into artists (name,image,user_id, bio) values (:name,:image,:user_id, :bio)";
      db_query($query,$values);

      message("artist created successfully");
      redirect('admin/artists');
    }
    }
}else
if($action=='edit')
{
  $query= "SELECT * FROM artists WHERE id = :id LIMIT 1";
  $row = db_query_one($query,['id'=>$id]);

    if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
    {
      $errors = [];

      // data validation
      if(empty($_POST['name']))
      {
        $errors['name'] = "a name is required";
      }else
      if(!preg_match("/^[a-zA-Z \&\-]+$/", $_POST['name']))
      {
        $errors['name'] = "a name can only have letters with no spaces";
      }

       // image
       if(!empty($_FILES['image']['name']))
       {
         $folder = "uploads/";
         if(!file_exists($folder))
         {
           mkdir($folder,0777,true);
           file_put_contents($folder."index.php", "");
         }
         $allowed = ['image/jpeg','image/png'];
         if($_FILES['image']['error'] == 0 && in_array($_FILES['image']['type'], $allowed))
         {
           $destination = $folder. $_FILES['image']['name'];
 
           move_uploaded_file($_FILES['image']['tmp_name'], $destination);

          // deleting an old file
           if(file_exists($row['image']))
          {
            unlink($row['image']);
          }

         }else{
           $errors['name'] = "image not valid. allowed types are ". implode(",", $allowed);
         }
 
       }
 
    if(empty($errors))
    {

      $values = [];
      $values['name'] = trim($_POST['name']);
      $values['bio'] = trim($_POST['bio']);
      $values['user_id']     = user('id');
      $values['id']     = $id;

      $query = "UPDATE artists SET name = :name,bio = :bio,user_id = :user_id WHERE id = :id LIMIT 1";

      if(!empty($destination)){
        $query = "UPDATE artists SET name = :name,bio = :bio,user_id = :user_id, image = :image WHERE id = :id";

        $values['image']     = $destination;
      }
     
      db_query($query,$values);

      message("artist edited successfully");
      redirect('admin/artists');
    }
    }
}else
if($action=='delete')
{
  $query= "SELECT * FROM artists WHERE id = :id LIMIT 1";
  $row = db_query_one($query,['id'=>$id]);

    if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
    {
      $errors = [];

     
    if(empty($errors))
    {


      $values = [];
      $values['id']     = $id;

      $query = "DELETE FROM artists WHERE id = :id";
      db_query($query,$values);

    // deleting image
     if(file_exists($row['image']))
     {
      unlink($row['image']);
     }


      message("artist deleted successfully");
      redirect('admin/artists');
    }
    }
}

?>


<?php require page('includes/admin-header')?>

<section class="admin-content" style="min-height: 200px;">

<?php if($action == 'add'):?>

  <!-- form for adding artist -->
  <div style="max-width: 500px; margin:auto">
        <form action="" method="post" enctype="multipart/form-data">
          <h3>Add New Artist</h3>

          <input class="form-control my-1" value="<?=set_value('name')?>" type="text" name="name" placeholder="name">
          <?php if(!empty($errors['name'])):?>
          <small class="error"><?=$errors['name']?></small>
          <?php endif?>

          <input class="form-control my-1" type="file" name="image" placeholder="image">

          <textarea name="bio" id="" cols="30" rows="10" class="form-control my-1" placeholder="Artist Bio"><?=set_value('bio')?></textarea>


          <?php if(!empty($errors['image'])):?>
             <small class="error"><?=$errors['image']?></small>
          <?php endif?>

          <button class="btn bg-orange">Save</button>
          <a href="<?=ROOT?>/admin/artists">
          <button class="float-end btn bg-orange" type="button">Back</button>
    </a>
  </form>
  </div>

<?php elseif($action == 'edit'):?>



  <div style="max-width: 500px; margin:auto">
        <form action="" method="post" enctype="multipart/form-data">>
          <h3>Edit Artist</h3>

          <?php if(!empty($row)): ?>

          <input class="form-control my-1" value="<?=set_value('name',$row['name'])?>" type="text" name="name" placeholder="name">
          <?php if(!empty($errors['name'])):?>
          <small class="error"><?=$errors['name']?></small>
          <?php endif?>

          <img src="<?=ROOT?>/<?=$row['image']?>" style="width:200px; height: 200px; object-fit: cover;">

          <input class="form-control my-1" type="file" name="image" placeholder="image">

          <textarea name="bio" id="" cols="30" rows="10" class="form-control my-1" placeholder="Artist Bio"><?=set_value('bio',$row['bio'])?></textarea>

          <button class="btn bg-orange">Save</button>
          <a href="<?=ROOT?>/admin/artists">
          <button class="float-end btn bg-orange" type="button">Back</button>
    </a>
          <?php else:?>
            <div class="alert">That record was not found</div>
            <a href="<?=ROOT?>/admin/artists">
            <button class="float-end btn bg-orange" type="button">Back</button>
          <?php endif?>
  </form>
  </div>


<?php elseif($action == 'delete'):?>
<div style="max-width: 500px; margin:auto">
        <form action="" method="post">
          <h3>Delete Artist</h3>

          <?php if(!empty($row)): ?>

          <div class="form-control my-1"><?=set_value('name',$row['name'])?></div>
          <?php if(!empty($errors['name'])):?>
          <small class="error"><?=$errors['name']?></small>
          <?php endif?>
         

          <button class="btn bg-red">Delete</button>
          <a href="<?=ROOT?>/admin/artists">
          <button class="float-end btn bg-orange" type="button">Back</button>
    </a>
          <?php else:?>
            <div class="alert">That record was not found</div>
            <a href="<?=ROOT?>/admin/artists">
            <button class="float-end btn bg-orange" type="button">Back</button>
          <?php endif?>
  </form>
  </div>
<?php else:?>

<?php
  $query = "SELECT * FROM artists ORDER BY id DESC LIMIT 20";
  $rows  = db_query($query);
  ?>

    <h3>Artists
      <a href="<?=ROOT?>/admin/artists/add">
      <button class="float-end btn bg-purple">Add New</button></h3>
    </a> 
     
    <table class="table">
    <tr>
      <th>ID</th>
      <th>Artist</th>
      <th>Image</th>
      <th>Action</th>
    </tr>

    <?php if(!empty($rows)):?>
        <?php foreach($rows as $row):?>
        <tr>
            <td><?=$row['id']?></td>
            <td><?=$row['name']?></td>
            <td><a href="<?=ROOT?>/artist/<?=$row['id']?>">
            <img src="<?=ROOT?>/<?=$row['image']?>" style="width:100px; height: 100px; object-fit: cover;">
            </a>
            </td>
            <td>
              <a href="<?=ROOT?>/admin/artists/edit/<?=$row['id']?>">
                <img class="bi" src="<?=ROOT?>/assets/icons/pencil-square.svg" alt="">
              </a>

              <a href="<?=ROOT?>/admin/artists/delete/<?=$row['id']?>">
                <img class="bi" src="<?=ROOT?>/assets/icons/trash3.svg" alt="">
              </a>
              </td>
        </tr>
        <?php endforeach;?>
  <?php endif;?>
  </table>
  <?php endif;?>
</section>

<?php require page('includes/admin-footer')?>