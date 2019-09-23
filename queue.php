<?php
require 'classes/Database.php';
require 'classes/Queue.php';
session_start();
$conn = require 'includes/db.php';
require 'includes/auth.php';
require 'includes/header.php';

$queues = Queue::getAll($conn);
$completed_ones = Queue::getUpdatedUsers($conn);

?>
<div>
    <h4>Waiting list</h4>
<ul>
    <?php foreach ($queues as $queue): ?>
        <li>

            <a href="/nfq/show.php?id=<?= $queue['id'] ?>"> <?='#'.htmlspecialchars($queue['id']) .' '.  htmlspecialchars($queue['name']) ?></a>


        </li>
    <?php endforeach; ?>
</ul>
</div>

<div>
    <h4>Completed list</h4>
    <ul>
        <?php foreach ($completed_ones as $completed_one): ?>
            <li>

               <?='#'.htmlspecialchars($completed_one['id']) .' '.  htmlspecialchars($completed_one['name']) ?>


            </li>
        <?php endforeach; ?>
    </ul>
</div>
