<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Music website</title>
  <link rel="stylesheet" type="text/css" href="<?=ROOT?>/assets/css/style.css?344">
</head>
<body>
  <style>
    header a{
      color: white;
    }

    .dropdown-list{
      background-color: #444;
    }
  </style>


<header style="background-color: #b9490b; color: white;">
  <div class="logo-holder">
 <a href="<?=ROOT?>"> <img class="logo" src="<?=ROOT?>/assets/images/logo.png" alt=""></a>
  </div>

  <div class="header-div">
    <div class="main-title">
      
    <div class="socials">
     
  </div>
    </div>
    <div class="main-nav" >
        <div class="nav-item"><a href="<?=ROOT?>/admin">Dashboard</a></div>
        <div class="nav-item"><a href="<?=ROOT?>/admin/users">Users</a></div>
        <div class="nav-item"><a href="<?=ROOT?>/admin/songs">Songs</a></div>
        <div class="nav-item"><a href="<?=ROOT?>/admin/categories">Categories</a></div>
      
        <div class="nav-item"><a href="<?=ROOT?>/admin/artists">Artists</a></div>
        <div class="nav-item dropdown">
          <a href="#">Hi, <?=user('username')?></a>
          <div class="dropdown-list">
            <div class="nav-item"><a href="<?=ROOT?>/profile">Profile</a></div>
            <div class="nav-item"><a href="<?=ROOT?>">Website</a></div>
            <div class="nav-item"><a href="<?=ROOT?>/logout">Logout</a></div>
          </div>
        </div>
    </div>
  </div>
</header>



  <?php if(message()): ?>
  <div class="alert"><?= message('', true) ?></div>
<?php endif ?>
