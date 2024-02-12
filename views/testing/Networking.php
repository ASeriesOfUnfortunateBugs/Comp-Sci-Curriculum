<!doctype html>
<html>
    <head>
        <title>Testing</title>
    </head>
    <body>
        <?php print_r($_SESSION['cart']); ?>
        <?php print_r($inventory); ?>
        <form action="." method="post">
            <input type="hidden" name="action" value="add" />
            <table>
            <?php foreach ($books as $book) : ?>
                <tr>
                    <td><input type="hidden" name="isbn" value="<?php echo $book['isbn']; ?>" /></td>
                    <td><?php echo $book['title']; ?></td>
                    <td><?php echo $book['author']; ?></td>
                    <td><?php echo $book['cost']; ?></td>
                    <td><input type="number" name="qty" placeholder="0" /></td>
                </tr>
            <?php endforeach; ?>
            </table>
            <input type="submit" value="Add to cart" />
        </form>
    </body>
</html>