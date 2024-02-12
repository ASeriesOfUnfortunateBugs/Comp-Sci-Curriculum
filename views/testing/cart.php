<!doctype html>
<html>
    <head>
        <title>Testing</title>
    </head>
    <body>
        <?php if (empty($_SESSION['cart']) || count($_SESSION['cart']) == 0) : ?>
            <p>You have no items in your cart.</p>
            <?php print_r($_SESSION['cart']); ?>
        <?php else: ?>
            <form action="." method="post">
                <input type="hidden" name="action" value="update" />
                <table>
                    <tr>
                        <td>Title</td>
                        <td>Author</td>
                        <td>Quantity</td>
                        <td>Item total</td>
                    </tr>
                    <?php foreach ($_SESSION['cart'] as $key => $item) :
                        $cost = number_format($item['cost'], 2);
                        $total = number_format($item['total'], 2);?>

                    <tr>
                        <td>
                            <?php echo $item['title']; ?>
                        </td>
                        <td>
                            <?php echo $item['author']; ?>
                        </td>
                        <td>
                            <input type="text" name="newQty[<?php echo $key; ?>]" placeholder="<?php echo $item['qty']; ?>" />
                        </td>
                        <td>
                            <?php echo $total; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td>Subtotal:</td>
                        <td>$<?php echo calcSubtotal(); ?></td>
                    </tr>
                    <tr>
                        <input type="submit" value="Update cart" />
                    </tr>
                </table>
            </form>
        <?php endif; ?>
    </body>
</html>