<?php
// start session
$expire = strtotime('+1 week');
session_set_cookie_params($expire, '/');
session_start();

// create cart array
if (empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// connect to database
require('model/database.php');
require('model/accessDB.php');

// array of inventory
$inventory = getInventory();

// get action value or assign default value if action is null
$action = filter_input(INPUT_POST, 'action');
if ($action === null) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === null) {
        $action = 'menu';
    } // endif
} // endif

// code to execute depending on action
switch ($action) {
    case 'menu':
        $subjects = getSubjects();
        include('views/home.php');
        break;
    case 'Networking':
        $subjects = getSubjects();
        $books = getBooksBySubject($action);
        include('views/Networking.php');
        break;
    case 'Programming':
        $subjects = getSubjects();
        $books = getBooksBySubject($action);
        include('views/Programming.php');
        break;
    case 'Security':
        $subjects = getSubjects();
        $books = getBooksBySubject($action);
        include('views/Security.php');
        break;
    case 'add':
        $subjects = getSubjects();
        for ($c = 0; $c <= 4; $c++) {
            $qty = filter_input(INPUT_POST, "qty$c");
            if ($qty == 0 || $qty == null) {
                continue;
            } else {
                $isbn = filter_input(INPUT_POST, "isbn$c");
                addBooks($isbn, (int) $qty);
            }
        }
        include('views/cart.php');
        break;
    case 'cart':
        $subjects = getSubjects();
        include('views/cart.php');
        break;
    case 'update':
        $subjects = getSubjects();
        $count = filter_input(INPUT_POST, 'count');
        for ($c = 0; $c <= $count; $c++) {
            $isbn = filter_input(INPUT_POST, "isbn$c");
            $newQty = filter_input(INPUT_POST, "newQty$c");
            $oldQty = $_SESSION['cart'][$isbn]['qty'];
            if ($newQty == $oldQty) {
                continue;
            } else if ($newQty == 0) {
                unset($_SESSION['cart'][$isbn]);
            } else if ($newQty !== $oldQty) {
                $cost = $_SESSION['cart'][$isbn]['cost'];
                $_SESSION['cart'][$isbn]['qty'] = $newQty;
                $_SESSION['cart'][$isbn]['total'] = (float) $cost * (float) $newQty;
            } // endif
        } // endfor
        include('views/cart.php');
        break;
    case 'empty':
        $subjects = getSubjects();
        unset($_SESSION['cart']);
        include('views/cart.php');
        break;
    case 'order':
        $subjects = getSubjects();
        $charge = filter_input(INPUT_POST, 'acctCharge');
        if ($charge) {
            $confirmMsg = 'You may call once you reach our location for curb-side pickup.';
        } else {
            $confirmMsg = 'Your order will be placed on reserve for up to 24 hours.';
        } // endif
        foreach ($_SESSION['cart'] as $key => $item) {
            $isbn = $key;
            $title = $item['title'];
            $stuID = filter_input(INPUT_POST, 'stuID');
            $qty = $item['qty'];
            booksToHold($isbn, $title, $stuID, $qty);
        }
        include('views/orderConfirm.php');
        unset($_SESSION['cart']);
        break;
    case 'uLogin':
        $subjects = getSubjects();
        include('views/login.php');
        break;
    case 'uLogout':
        $subjects = getSubjects();
        unset($_SESSION['validLogin']);
        include('views/home.php');
        break;
    case 'register':
        $subjects = getSubjects();
        $un = filter_input(INPUT_POST, 'un');
        $pass = filter_input(INPUT_POST, 'pass');
        registerUser($un, $pass);
        include('views/home.php');
        break;
    case 'login':
        $subjects = getSubjects();
        $un = filter_input(INPUT_POST, 'un');
        $pass = filter_input(INPUT_POST, 'pass');
        if (validLogin($un, $pass)) {
            loginUser($un, $pass);
        } else {
            $errorMsg = 'Invalid login! Please try again!';
            include('views/error.php');
        } // endif
        include('views/home.php');
        break;
    case 'admin':
        if (isset($_SESSION['validLogin']) && isset($_SESSION['validAdmin'])) {
            $subjects = getSubjects();
            $holds = getHolds();
            include('views/holds.php');
        } else {
            $subjects = getSubjects();
            $errorMsg = 'You are not authorized to view this page!';
            include('views/error.php');
        } // endif
        break;
    default:
        $subjects = getSubjects();
        $errorMsg = 'Page not found!';
        include('views/error.php');
        break;
}

?>