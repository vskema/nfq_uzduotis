<?php
require 'classes/Database.php';
require 'classes/Queue.php';
require 'includes/url.php';
session_start();
$queue = new Queue();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = require 'includes/db.php';


    $queue->name = $_POST['name'];

    if ($queue->create($conn)) {

        redirect("/nfq/show-guest.php?id={$queue->id}");

        exit();
    }
}
?>
<?php require 'includes/auth.php'; ?>
<?php require 'includes/header.php';?>

<h2>New registration</h2>

<form method="post">

    <div>
        <label for="name">Name</label>
        <input name="name" id="name" placeholder="Name" value="<?= htmlspecialchars($queue->name) ?>">
    </div>

    <button>Save</button>


</form>


