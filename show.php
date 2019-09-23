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


//    if ($_SERVER["REQUEST_METHOD"] == "POST") {
//        if ($queue->update($conn)) {
//            redirect("/nfq/show.php?id={$queue->id}");
//        }
//    }
?>
<?php require 'includes/auth.php'; ?>
<?php require 'includes/header.php'; ?>

<?php if ($queue): ?>

    <p>
        <h2><?= htmlspecialchars($queue->name) ?></h2>
    </p>
    <table border="1px">
        <th>Number</th><th>Name</th>
        <tr><td><?= htmlspecialchars($queue->id) ?></td><td><?= htmlspecialchars($queue->name) ?></td></td></tr>


    </table>

    <form method="POST" action="includes/time.php">
        <input hidden name="id" value="<?= $queue->id ?>">
        <?php if($queue->updated_at == null): ?>
        <button>Start</button>
        <?php else: ?>
        <button>Complete</button>
        <?php endif; ?>
    </form>

    <?php if($queue->completed_at != null): ?>
    <form method="POST" action="includes/calculate.php">
        <input hidden name="id" value="<?= $queue->id ?>">
        <input hidden name="duration" value="<?= (strtotime($queue->completed_at) - strtotime($queue->updated_at)) ?>">
        <button>Waiting queue</button>
    <?php endif; ?>


    </form>



<?php else: ?>

    <p>User not found.</p>

<?php endif; ?>





