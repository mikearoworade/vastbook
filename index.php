<?php
require_once(__DIR__ . '/config/config.php');
require_once(__DIR__ . '/config/database.php');

require_once(ROOT_PATH . '/controllers/UserController.php');

$error = isset($_SESSION['error']) ? $_SESSION['error'] : false;

include(ROOT_PATH . '/shared/header.php');
?>
<div class="vastbook-main-content">
    <div class="vastbook-form">
        <h5>Login</h5>
        <p class="error-message"><?php if($error !== false) echo $error; ?></p>
        <form id="loginForm" action="<?php echo BASE_URL;?>/controllers/UserController.php" method="POST">
            <input type="hidden" name="login" />
            <label for="email">Email: <span id="emailError" class="error"></span></label>
            <input type="text" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">

            <label for="password">Password: <span id="passwordError" class="error"></span></label>
            <input type="password" id="password" name="password">

            <button type="submit" id="login" name="login">Login</button>
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </form>
    </div>
</div>
<?php 
include(ROOT_PATH . '/shared/footer.php');
?>
