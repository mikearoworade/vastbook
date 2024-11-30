<?php
require_once(__DIR__ . '/../../../config/config.php');
require_once(__DIR__ . '/../../../config/database.php');

include(ROOT_PATH . '/controllers/AuthorController.php');

$title = "Add Author";
$pageName = "Author / Create";

include(ROOT_PATH . '/shared/admin-header.php');

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

?>
<div class="vastbook-form">
<h4 class="vastbook-admin-h text-center">Add Author</h4>
    <p class="error-message"><?php if(isset($_SESSION['error'])) echo $_SESSION['error']; ?></p>
    <form id="authorForm" action="<?php echo BASE_URL;?>/controllers/AuthorController.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="create"/>
        <div class="text-danger"></div>
        <div class="form-group">
            <label for="firstname" class="control-label">Firstname</label>
            <input name="firstname" id="firstname" class="form-control" value="<?php if(isset($_SESSION['authorfirstname'])){echo $_SESSION['authorfirstname'];}?>"/>
            <span class="text-danger error" id="firstnameError"></span>
        </div>
        <div class="form-group">
            <label for="lastname" class="control-label">Lastname</label>
            <input name="lastname" id="lastname" class="form-control" value="<?php if(isset($_SESSION['authorlastname'])){echo $_SESSION['authorlastname'];}?>"/>
            <span class="text-danger error" id="lastnameError"></span>
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email</label>
            <input name="email" id="email" class="form-control" value="<?php if(isset($_SESSION['authoremail'])){echo $_SESSION['authoremail'];}?>"/>
            <span class="text-danger error" id="emailError"></span>
        </div>
        <div class="form-group">
            <label for="bio" class="control-label">Bio</label>
            <textarea name="bio" id="bio" class="form-control"><?php if(isset($_SESSION['authorbio'])){echo $_SESSION['authorbio'];}?></textarea>
            <span class="text-danger error" id="bioError"></span>
        </div>
        <!-- File input for author photo -->
        <div class="form-group">
            <label for="image">Upload Photo</label>
            <input class="form-control" id="image" type="file" name="image" accept="image/*"/>
            <span class="text-danger error" id="imageError"></span>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Add Author</button>
        </div>
        <div class="mt-3">
            <a href="index.php">Back to List</a>
        </div>
    </form>
</div>
<?php
include(ROOT_PATH . '/shared/admin-footer.php');
?>
