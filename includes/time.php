<?php

require '../show.php';

$conn = require '../includes/db.php';

$_GET['id'] = $_POST['id'];

if (isset($_GET['id']) ) {

    $queue = Queue::getById($conn, $_GET['id']);

} else {
    $queue = NULL;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $queue->updated_at == null) {

    if ($queue->update($conn)) {
        redirect("/nfq/show.php?id={$queue->id}");
    }
} else {

    if ($queue->complete($conn)) {

        redirect("/nfq/show.php?id={$queue->id}");
    }
}
