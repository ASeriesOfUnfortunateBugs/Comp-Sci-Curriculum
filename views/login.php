<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="./views/global.css">
<link rel="stylesheet" href="./views/menu.css">
<style>
body {font-family: sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #494f5c;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}


/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<header>
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
</header>


<form action="." method="post">
 

  <div class="container">

    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter username" name="un" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter password" name="pass" required>
        
    <button type="submit" name="action" value="login">Login</button><br />
    <button type="submit" name="action" value="register">Register</button>
  </div>


</form>

<footer>
    <p><a href="?action=admin" class="admin">Admin</a></p>
    <p><a href="http://www.omfgdogs.com/#">Comp Sci Curriculum</a> &copy; 2021</p>
</footer>
</body>
</html>