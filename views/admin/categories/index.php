<?php
require_once(__DIR__ . '/../../../config/config.php');
require_once(__DIR__ . '/../../../config/database.php');

include(ROOT_PATH . '/controllers/CategoryController.php');

$title = "Categories";
$pageName = "Book Catergories";

$success = isset($_SESSION['success']) ? $_SESSION['success'] : false;
$error = isset($_SESSION['error']) ? $_SESSION['error'] : false;
$categoryName = $error !== false ? $_SESSION['categoryname'] : '';

$successEdit = isset($_SESSION['successEdit']) ? $_SESSION['successEdit'] : false;
$errorEdit = isset($_SESSION['errorEdit']) ? $_SESSION['errorEdit'] : false;
$categoryNameEdit = $errorEdit !== false ? $_SESSION['categorynameEdit'] : '';
$categoryIdEdit = isset($_SESSION['errorEdit']) ? $_SESSION['categoryIdEdit'] : '';

$successDelete = isset($_SESSION['successDelete']) ? $_SESSION['successDelete'] : false;

include(ROOT_PATH . '/shared/admin-header.php');

if($success !== false){
    echo '<p class="successfully">Category added Successfully</p>';
}

if($successEdit !== false){
    echo '<p class="successfully">Category Updated Successfully</p>';
}

if($successDelete !== false){
    echo '<p class="successfully">Category Deleted Successfully</p>';
}


if($errorEdit !== false)
{
    echo '
    <style>
    #editModal {
    display: block;
        }
    </style>
    ';
}

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
?>

<h3 class="vastbook-admin-h">Create Category</h3>
<div class="row">
    <div class="col-md-6">
        <form action="<?php echo BASE_URL;?>/controllers/CategoryController.php" method="POST">
            <input type="hidden" name="create">
            <div class="text-danger error"></div>
            <div class="form-group">
                <label for="categoryname" class="control-label">Category Name</label>
                <input class="form-control" name="categoryname" value="<?php echo htmlspecialchars($categoryName); ?>"/>
                <span class="error"><?php if($error !== false) echo $error; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Create" class="btn btn-primary" />
            </div>
        </form>
    </div>
</div>

<!-- <p class="vastbook-admin-p">
    <a href="create.php" class="btn btn-primary">Add New Category</a>
</p> -->
<div class="category-table">
    <table class="table table-striped table-bordered responsive-table-1">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 0;
                foreach ($categories as $category):
            ?>
                <tr>
                    <td><?php echo ++$i; ?> </td>
                    <td><?php echo $category["categoryname"] ?></td>
                    <td>
                        <a href="#" class="btn btn-primary edit-link"
                        data-id="<?php echo $category['id']; ?>"
                        data-name="<?php echo htmlspecialchars($category['categoryname']); ?>">Edit</a>
                        <a href="#" class="btn btn-danger delete-link"
                        data-id="<?php echo $category['id']; ?>"
                        data-name="<?php echo htmlspecialchars($category['categoryname']); ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- The Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h4 class="vastbook-admin-h">Edit Category</h4>
        <form id="editForm" method="POST" action="<?php echo BASE_URL;?>/controllers/CategoryController.php">
            <input type="hidden" name="edit" />
            <input type="hidden" name="id" id="categoryId" value="<?php echo $categoryIdEdit; ?>">
            
            <div class="form-group">
                <label for="categoryName">Category Name</label>
                <input type="text" id="categoryName" name="categoryname" value="<?php echo htmlspecialchars($categoryNameEdit); ?>" required>
                <span class="error"><?php if($errorEdit !== false) echo $errorEdit; ?></span>
            </div>
            
            <button type="submit">Update Category</button>
        </form>
    </div>
</div>

<!-- The Modal DELETE -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModalDelete()">&times;</span>
        <h4 class="vastbook-admin-h">Delete Category</h4>
        <form id="deleteForm" method="POST" action="<?php echo BASE_URL;?>/controllers/CategoryController.php">
            <input type="hidden" name="delete" />
            <input type="hidden" name="id" id="categoryIdDelete">
            <div class="form-group">
                <label for="categoryName">Category Name</label>
                <input type="text" id="categoryNameDelete" name="categoryname" Disabled>
            </div>
            
            <button type="submit" class="btn btn-danger">Delete Category</button>
        </form>
    </div>
</div>

<?php
include(ROOT_PATH . '/shared/admin-footer.php');
?>
