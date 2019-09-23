<?php
require 'classes/Database.php';
require 'classes/Queue.php';
require 'includes/url.php';

session_start();

$conn = require 'includes/db.php';


if (isset($_GET['id']) ) {

    $queue = Queue::getById($conn, $_GET['id']);

} else {
    $queue = NULL;
}

?>
<?php require 'includes/auth.php'; ?>
<?php require 'includes/header.php'; ?>

<?php if ($queue): ?>

    <p>
    <h2><?= htmlspecialchars($queue->name) ?></h2>
    </p>
    <table border="1px">
        <th>Number</th><th>Name</th><th>Recommended visit time</th>
        <tr><td><?= htmlspecialchars($queue->id) ?></td><td><?= htmlspecialchars($queue->name) ?></td><td><?= $queue->visitTime($conn); ?></td></tr>
    </table>


<?php else: ?>

    <p>User not found.</p>

<?php endif; ?>





