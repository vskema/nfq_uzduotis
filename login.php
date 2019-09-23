<?php

require 'includes/url.php';
require 'includes/auth.php';

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if($_POST['username'] == 'admin' && $_POST['password'] == 'admin'){

        $_SESSION['is_logged_in'] = true;

        redirect('/nfq/queue.php');

    } else {

        $error = 'Login incorrect';

    }

}

require 'includes/header.php';

?>

<h4>Log in</h4>

<?php if(!empty($error)) : ?>

    <p><?= $error ?></p>

<?php endif; ?>

<form method="post">
    <div>
        <label for="username">Username</label>
        <input name="username" id="username">
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <button>Log in</button>
</form>
