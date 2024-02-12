<!doctype html>
<html>
    <head>
        <title>Testing</title>
    </head>
    <body>
        <table>
            <?php foreach ($books as $book) : ?>
                <tr>
                    <td><?php echo $book['title']; ?></td>
                    <td><?php echo $book['author']; ?></td>
                    <td><?php echo $book['subject']; ?></td>
                    <td><?php echo $book['cost']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>