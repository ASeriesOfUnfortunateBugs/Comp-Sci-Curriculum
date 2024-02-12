<!DOCTYPE html>
<html lang="en">
<head>

    <title>Comp Sci Curriculum | Admin - Holds</title>

    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
	<link rel="stylesheet" href="./views/global.css">
    <link rel="stylesheet" href="./views/Cart.css">
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
    <h1 class="h2">Current Holds</h1>
    <table>
        <thead>
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Student ID</th>
                <th>Qty</th>
                <th>Pickup</th>
            </tr>
        </thead>
        <?php foreach ($holds as $hold) : ?>
            <tr>
                <td><p><?php echo $hold['isbn']; ?></p></td>
                <td><strong><?php echo $hold['title']; ?></strong></td>
                <td><?php echo $hold['stuID']; ?></td>
                <td><strong><?php echo $hold['quantity']; ?></strong></td>
                <td><?php echo $hold['pickup']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<footer>
    <p><a href="?action=admin" class="admin">Admin</a></p>
    <p><a href="http://www.omfgdogs.com/#">Comp Sci Curriculum</a> &copy; 2021</p>
</footer>
</body>
</html>
