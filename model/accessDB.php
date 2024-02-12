<?php

/* return all of inventory */
function getInventory() {
    global $db;
    $query = 'SELECT * FROM books';
    $statement = $db->prepare($query);
    $statement->execute();
    $inventory = $statement->fetchAll(PDO::FETCH_UNIQUE);
    $statement->closeCursor();

    return $inventory;
}

/* return an array of the distinct entries in the subject column */
function getSubjects() {
    global $db;
    $query = 'SELECT DISTINCT subject FROM books';
    $statement = $db->prepare($query);
    $statement->execute();
    $subjects = $statement->fetchAll();
    $statement->closeCursor();
    return $subjects;
}

/* get books by subject */
function getBooksBySubject($subject) {
    global $db;
    $query = 'SELECT * FROM books WHERE subject = :subject';
    $statement = $db->prepare($query);
    $statement->bindValue(':subject', $subject);
    $statement->execute();
    $books = $statement->fetchAll();
    $statement->closeCursor();
    return $books;
}

/* add books to cart */
function addBooks($isbn, int $qty) {
    global $inventory;

    // update quantity if item is in cart already
    if (isset($_SESSION['cart'][$isbn])) {
        $qty += (int) $_SESSION['cart'][$isbn]['qty'];
        cartUpdate($isbn, $qty);
        return;
    }

    // add to cart
    (float) $cost = $inventory[$isbn]['cost'];
    (float) $total = (float) $cost * (float) $qty;
    $item = array(
        'title' => $inventory[$isbn]['title'],
        'author' => $inventory[$isbn]['author'],
        'cost' => $cost,
        'qty' => $qty,
        'total' => $total
    );
    $_SESSION['cart'][$isbn] = $item;
}

/* update cart when quatities change */
function cartUpdate($title, $qty) {
    // make sure quantity is an integer
    $qty = (int) $qty;
    // check if quantity is set and remove item if quantity is 0
    if (isset($_SESSION['cart'][$isbn])) {
        if ($qty <= 0) {
            unset($_SESSION['cart'][$isbn]);
        } else {
            $_SESSION['cart'][$isbn]['qty'] = $qty;
            $total = $_SESSION['cart'][$isbn]['cost'] * $_SESSION['cart'][$isbn]['qty'];
            $_SESSION['cart'][$isbn]['total'] = $total;
        }
    }
}

/* calculate the subtotal */
function calcSubtotal() {
    $subtotal = 0;
    foreach ($_SESSION['cart'] as $item) {
        (float) $cost = (float) $item['cost'] * (float) $item['qty'];
        $subtotal += $cost;
    } // endforeach
    $subtotal = number_format($subtotal, 2);
    return $subtotal;
}
/* calculate the subtotal with a discount */
function discSubtotal() {
    $subtotal = 0;
    foreach ($_SESSION['cart'] as $item) {
        $cost = $item['cost'] * $item['qty'];
        $subtotal += $cost;
    } // endforeach
    $discount = $subtotal * .15;
    $subtotal = $subtotal - $discount;
    $subtotal = number_format($subtotal, 2);
    return $subtotal;
}

/* calculate cart quantity */
function cartQty() {
    (int) $qty = 0;
    foreach ($_SESSION['cart'] as $item) {
        $qty += (int) $item['qty'];
    } // endforeach
    return $qty;
}

/* regiser user */
function registerUser($un, $pass) {
    global $db;
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $query = 'INSERT INTO users (userID, password) VALUES (:userID, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':userID', $un);
    $statement->bindValue(':password', $hash);
    $statement->execute();
    $statement->closeCursor();
}

/* verify login information */
function validLogin($un, $pass) {
    global $db;
    $query = 'SELECT password FROM users WHERE userID = :userID';
    $statement = $db->prepare($query);
    $statement->bindValue(':userID', $un);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();
    $hash = $row['password'];
    return password_verify($pass, $hash);
}

/* log in */
function loginUser($un, $pass) {
    if (validLogin($un, $pass)) {
        $_SESSION['validLogin'] = true;
    } // endif
    if ($un === 'admin') {
        $_SESSION['validAdmin'] = true;
    } // endif
}

/* place books on hold */
function booksToHold($isbn, $title, $stuID, $qty) {
    global $db;
    // $holdLmt = new DateInterval('P24H');
    $pickup = new DateTime('+1 day');
    $pickup = $pickup->format('Y-m-d H:i');
    // $pickup->add($holdLmt);

    $query = 'INSERT INTO holds (isbn, title, stuID, quantity, pickup) VALUES (:isbn, :title, :stuID, :qty, :pickup)';
    $statement = $db->prepare($query);
    $statement->bindValue(':isbn', $isbn);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':stuID', $stuID);
    $statement->bindValue(':qty', $qty);
    $statement->bindValue(':pickup', $pickup);
    $statement->execute();
    $statement->closeCursor();
}

/* get holds */
function getHolds() {
    global $db;
    $query = 'SELECT * from holds';
    $statement = $db->prepare($query);
    $statement->execute();
    $holds = $statement->fetchAll();
    $statement->closeCursor();
    return $holds;
}
?>