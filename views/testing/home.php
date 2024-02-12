<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Comp Sci Books</title>



<style>
p,dt,dd,dl,a,h1,li{
color: black}

.teams{font-weight:Bold}
</style>

<link rel="stylesheet" href="./views/menu.css" type="text/css" media="screen"/>

</head>
<body>


<div class="navigation">
<img src="./imgs/logo.png" alt="Comp Sci Logo"
 height="200 px" Width="200 px">

<nav>
	<ul>
	<?php foreach ($subjects as $subject) : ?>
        <li>
            <a href="?action=<?php echo $subject['subject']; ?>">
            	<?php echo $subject['subject']; ?>
            </a>
        </li>
    <?php endforeach; ?>
	</ul>
</nav>
</div>


</body>
</html>