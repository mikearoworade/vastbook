<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/admin-style.css?v=<?php echo time(); ?>">
    <title>VastBook - <?php echo $title ?></title>
    <link rel="icon" href="<?php echo BASE_URL; ?>/assets/img/vb.png"> 
</head>
<body>
    
    <!-- Navbar -->
    <div class="navbar" id="navbar">
        <div>
            <span class="hamburger" onclick="toggleSidebar()">&#9776; </span> <!-- Hamburger icon -->
            <span class="vastbook-breadcrumb"><?php echo $pageName; ?></span>
        </div>
        
        <div class="profile">
            <div class="profile-dropdown">
                <img src="<?= !empty($_SESSION['image']) ? $_SESSION['image'] : BASE_URL.'/assets/img/default.png'; ?>" alt="Profile" class="profile-img">
                <div class="dropdown-menu">
                    <h6 class="profile-username"><span><?= htmlspecialchars($_SESSION['username']); ?></span></h6>
                    
                    <a href="#">View Profile</a>
                    <a href="#">Settings</a>
                    <a href="<?php echo BASE_URL;?>/logout.php">Logout</a>
                </div>
            </div>
        </div>
        <!-- <a href="#home">Home</a>
        <a href="#services">Services</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a> -->
    </div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h1 class="vastbook-name"><img src="<?php echo BASE_URL;?>/assets/img/vastbook-1.png" alt="logo" width="150"></h1>
        <h1 class="vastbook-name-alt"><img src="<?php echo BASE_URL;?>/assets/img/vb-1.png" alt="logo" width="40"></h1>
        <hr>
        <a href="<?php echo BASE_URL;?>/views/admin/index.php"><i class="fas fa-home"></i><span>Dashboard</span></a>
        <a href="<?php echo BASE_URL;?>/views/admin/categories"><i class="fa-solid fa-list"></i><span>Categories</span></a>
        <a href="<?php echo BASE_URL;?>/views/admin/authors"><i class="fa-solid fa-at"></i></i><span>Authors</span></a>
        <a href="<?php echo BASE_URL;?>/views/admin/books"><i class="fa-solid fa-book"></i><span>Books</span></a>
        <a href="<?php echo BASE_URL;?>/views/admin/messages"><i class="fas fa-envelope"></i><span>Messages</span></a>
        <a href="<?php echo BASE_URL;?>/views/admin/users"><i class="fas fa-user"></i><span>Manage Users</span></a>
        <a href="<?php echo BASE_URL;?>/views/admin/reports"><i class="fa-solid fa-chart-line"></i><span>Report</span></a>
        <a href="<?php echo BASE_URL;?>/views/admin/settings"><i class="fa-solid fa-gear"></i><span>Settings</span></a>
        <a href="<?php echo BASE_URL;?>/logout.php"><i class="fa-solid fa-right-from-bracket"></i><span>Logout</span></a>
        
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        
   