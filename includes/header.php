<!DOCTYPE html>
<html>
<head>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

    <title>Waiting Queue</title>
    <meta charset="utf-8">
</head>


<div class="container">
    <div class="row">
        <div class="col">
            <nav>
                <ul>

                    <li><a href="index.php">Main menu</a></li>
                    

                    <?php if(isLoggedIn()) : ?>

                        <li><a href="/nfq/logout.php">Log out</a></li>

                    <?php else : ?>

                        <li><a href="/nfq/login.php">Log in</a></li>

                    <?php endif; ?>

                    <?php if(isLoggedIn()): ?>
                        <li><a href="/nfq/queue.php">Administration</a></li>
                    <?php endif; ?>

                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <a href="/nfq/new-user.php" class="btn btn-primary btn-lg">New registration</a>
    </div>
</div>

<main>


