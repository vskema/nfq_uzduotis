<?php

require 'classes/Database.php';
require 'classes/Queue.php';


session_start();

$conn = require 'includes/db.php';


$queues = Queue::getAll($conn);

?>
<?php require 'includes/auth.php'; ?>
<?php require 'includes/header.php'?>

<body>

<header>
    <h1 class="display-4">Waiting Queue</h1>
</header>
<div>
<ul class="list-group">
    <?php foreach ($queues as $queue): ?>
        <li class="list-group-item">

            <p><?=htmlspecialchars($queue['id']) .' ' . htmlspecialchars($queue['name'])   ?></p>


        </li>
    <?php endforeach; ?>
</ul>
</div>
<h4>Total number of clients waiting in the queue: <?= Queue::getTotal($conn); ?></h4>

<main>
