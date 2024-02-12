<!DOCTYPE html>
<html lang="en">
<head>

    <title>Comp Sci Curriculum | Home</title>

    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
	<link rel="stylesheet" href="./views/global.css">
    <link rel="stylesheet" href="./views/menu.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
  

</head>
<body>

<section id="nav">
    <div class="siteheader">
        <div class="siteheader__section">
            <div class="siteheader__item siteheaderlogo">
                <img src="./imgs/logo.png" style="width:10%">
            </div>
            <div class="siteheader__item siteheader__btn">
                        <a href="?action=menu"><?php echo 'Home'; ?></a>
            </div>
            <?php foreach ($subjects as $subject) : ?>
                <div class="siteheader__item siteheader__btn">
                    <a href="?action=<?php echo $subject['subject']; ?>"><?php echo $subject['subject']; ?></a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="siteheader__section">
            <div class="siteheader__item siteheader__btn"><a href="?action=cart">Cart</a></div>
            <?php if (!isset($_SESSION['validLogin'])) : ?>
                <a class="siteheader__item siteheader__btn" href="?action=uLogin">Log In</a>
            <?php elseif ($_SESSION['validLogin']) : ?>
                <a class="siteheader__item siteheader__btn" href="?action=uLogout">Log Out</a>
            <?php endif; ?>
        </div>
    </div>
</section>
  
  <div class="container">

 
<section id="list">

    <div class="feature-list-item">
        <img src="./imgs/check.png" style="width:20%">
        <div class="description">Place your order</div>
    </div>

    <div class="feature-list-item reverse">
        <img src="./imgs/check.png" style="width:20%">
        <div class="description">Pick up your books</div>
    </div>

    <div class="feature-list-item">
        <img src="./imgs/check.png" style="width:20%">
        <div class="description">Start learning computer science</div>
    </div>

</section>
<div class="image-container">
	<img src="./imgs/istockphoto.jpg" />
 </div>
 </div>
<footer>
    <p><a href="?action=admin" class="admin">Admin</a></p>
    <p><a href="http://www.omfgdogs.com/#">Comp Sci Curriculum</a> &copy; 2021</p>
</footer>
</body>
</html>
