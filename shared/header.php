<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css?v=<?php echo time(); ?>">
    <title>VastBook - <?php echo $title ?></title>
    <link rel="icon" href="<?php echo BASE_URL; ?>/assets/img/vb.png"> 
</head>
<body>
<div class="container">
    <header class="vastbook-header">
        <h1 class="vastbook-name"><img src="<?php echo BASE_URL;?>/assets/img/vastbook-1.png" alt="logo"></h1>
        <p class="vastbook-description">Your Online Bookstore</p>
        <img class="vastbook-book-img" src="<?php echo BASE_URL;?>/assets/img/book.png" alt="book">
        <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                echo '
                <nav class="navbar navbar-expand-md vastbook-main-nav-container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#tmMainNav" aria-controls="tmMainNav" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse vastbook-main-nav" id="tmMainNav">
                        <ul class="nav nav-fill vastbook-main-nav-ul">
                            <li class="nav-item"><a class="nav-link active" href="'.BASE_URL.'/views/user/">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Catalogs</a></li>
                            <li class="nav-item"><a class="nav-link" href="'.BASE_URL.'/logout.php">Logout</a></li>
                        </ul>
                    </div>
                </nav>
                ';
            }
        ?>
    </header>