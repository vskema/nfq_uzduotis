<?php

require '../show.php';

$conn = require '../includes/db.php';

$_GET['id'] = $_POST['id'];

if (isset($_GET['id']) ) {

    $queue = Queue::getById($conn, $_GET['id']);

} else {
    $queue = NULL;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $queue->duration = $_POST['duration'];

    if ($queue->count($conn)) {
        redirect("/nfq/queue.php");
    }
}

