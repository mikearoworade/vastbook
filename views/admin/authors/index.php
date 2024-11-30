<?php
require_once(__DIR__ . '/../../../config/config.php');
require_once(__DIR__ . '/../../../config/database.php');

include(ROOT_PATH . '/controllers/AuthorController.php');

$title = "Authors";
$pageName = "Authors";

include(ROOT_PATH . '/shared/admin-header.php');

$success = isset($_SESSION['success']) ? $_SESSION['success'] : false;
if($success !== false){
    echo '<p class="successfully">'.$_SESSION['success'].'</p>';
}


?>
<div class="vastbook-header-items clearfix">
    <h2 class="vastbook-admin-h">Authors</h2>
    <a href="create.php">Add Author</a>
</div>

<div class="table-container">
    <table class="table table-striped table-bordered responsive-table-1">
        <thead>
            <tr>
                <th width="5%">S/N</th>
                <th width="15%">Full Name</th>
                <th width="20%">Email</th>
                <th width="5%">Image</th>
                <th width="35%">Bio</th>
                <th width="20%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 0;
                foreach ($authors as $author)
                {
                    $author["image"] = $author["image"] !== "" ? $author["image"] : "default.png"; 
                    echo '
                    <tr>
                        <td>'.++$i.'</td>
                        <td>'. $author["firstname"]. " " . $author["lastname"] .'</td>
                        <td>'. $author["email"] .'</td>
                        <td><img src="'.BASE_URL .'/assets/img/author/'. $author["image"] .'" alt="author"></td>
                        <td>'.$author["bio"].'</td>
                        <td>
                            <a class="btn btn-primary" href="edit.php?id='.$author["id"].'">Edit</a>
                            <a class="btn btn-danger" href="delete.php?id='.$author["id"].'">Delete</a>
                        </td>
                    </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
</div>

<?php
include(ROOT_PATH . '/shared/admin-footer.php');
?>
