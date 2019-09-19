<?php
require 'classes/Database.php';
require 'classes/Queue.php';

$conn = require 'includes/db.php';

$queues = Queue::getAll($conn);
?>

<ul>
    <?php foreach ($queues as $queue): ?>
        <li>

            <a href="/nfq/admin.php?id=<?= $queue['id'] ?>"> <?='#'.htmlspecialchars($queue['id']) .' '.  htmlspecialchars($queue['name']) ?></a>


        </li>
    <?php endforeach; ?>
</ul>
