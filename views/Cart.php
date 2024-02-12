<!DOCTYPE html>
<html lang="en">
<head>

    <title>Comp Sci Curriculum | Cart</title>

    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    
    <link rel="stylesheet" href="./views/global.css">
    <link rel="stylesheet" href="./views/cart.css">
    <link rel="stylesheet" href="./views/menu.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"/>

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

<div class="container">
<section>
  <h1 class="h2">Shopping Cart</h1>
    <?php if (!isset($_SESSION['validLogin']) && !empty($_SESSION['cart'])) : ?>
      <p>Register for an account to get 15% off your order!</p>
    <?php endif; ?>
    <?php if (empty($_SESSION['cart']) || count($_SESSION['cart']) == 0) : ?>
      <p>You have no items in your cart.</p>
    <?php else: ?>
      <form action="." method="post">
        <input type="hidden" name="action" value="update" />
        <table>
          <thead>
            <tr>
              <th>Product Details</th>
              <th>Quantity</th>
              <th class="align-right">Cost</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          <?php $c = 0; ?>
          <?php foreach ($_SESSION['cart'] as $key => $item) :
            $cost = number_format($item['cost'], 2);
            $total = number_format($item['total'], 2); ?>
              <input type="hidden" name="count" value="<?php echo $c ?>" />
              <input type="hidden" name="isbn<?php echo $c; ?>" value="<?php echo $key; ?>" />
              <tr>
                <td>
                  <p><strong><?php echo $item['title']; ?></strong></p>
                  <p>By: <?php echo $item['author']; ?></p>
                </td>
                <td>
                  <p class="align-center"><input type="text" name="newQty<?php echo $c; ?>" value="<?php echo $item['qty']; ?>" /></p>
                </td>
                <td>
                  <p class="align-right"><strong>$<?php echo $total; ?></strong></p>
                </td>
                <td class="align-right">
                <button class="submitBtn" name="action" value="update">Update</button>
                </td>
              </tr>
              <?php $c++; ?>
          <?php endforeach; ?>
            <tr>
              <td>
                <p class="h6"><strong>Grand Total</strong></p>
              </td>
              <td>
                <p class="align-center"><?php echo cartQty(); ?></p>
              </td>
              <td>
                <?php if (!isset($_SESSION['validLogin'])) : ?>
                  <p class="align-right"><strong>$<?php echo calcSubtotal(); ?></strong></p>
                <?php elseif ($_SESSION['validLogin']) : ?>
                  <p class="align-right"><strong>$<?php echo discSubtotal(); ?></strong></p>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <td>
                Enter your student ID: <input type="number" name="stuID" />
              </td>
              <td><label>
                <input type="checkbox" checked="checked" name="acctCharge"> Charge to my account!
              </label></td>
              <td class="align-right">
                <button class="submitBtn" name="action" value="order">Checkout</button>
              </td>
              <td class="align-right">
                <button class="submitBtn" name="action" value="empty">Empty Cart</button>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    <?php endif; ?>
  <div class="align-right">

  </div>
</section>
</div>
<footer>
  <p><a href="?action=admin" class="admin">Admin</a></p>
  <p><a href="http://www.omfgdogs.com/#">Comp Sci Curriculum</a> &copy; 2021</p>
</footer>
</body>
</html>