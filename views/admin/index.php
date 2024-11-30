<?php
require_once(__DIR__ . '/../../config/config.php');
require_once(__DIR__ . '/../../config/database.php');
require_once(__DIR__ . '/../../config/functions.php');

// Initiaze the database connection
$db = new Database($conn);
$pdo = $db->connect();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false){
    $url = BASE_URL;
    header("Location: $url");
    exit;
}

$title = "Welcome";
$pageName = "Dashboard";

$usersCount = getTotalNumberOfUsers($pdo);
$categoriesCount = getTotalNumberOfCategories($pdo);
$authorsCount = getTotalNumberOfAuthors($pdo);
$booksCount = getTotalNumberOfBooks($pdo);
$totalBooksRead = getBooksReadCount($pdo);

$fiveUsers = getFiveRecentRegisteredUsers($pdo);
 
include(ROOT_PATH . '/shared/admin-header.php');

?>

 <!-- Dashboard Content -->
 <div class="content">
    <div class="card">
        <h3>Total Users</h3>
        <p><?= $usersCount ?></p>
    </div>
    <div class="card">
        <h3>Total Categories</h3>
        <p><?= $categoriesCount ?></p>
    </div>
    <div class="card">
        <h3>Total Authors</h3>
        <p><?= $authorsCount ?></p>
    </div>
    <div class="card">
        <h3>Total Books</h3>
        <p><?= $booksCount ?></p>
    </div>
   
    <div class="card">
        <h3>Total Books Read</h3>
        <p><?= $totalBooksRead?></p>
    </div>
</div>

<!--New Registered User-->
<div class="table-container">
    <table class="responsive-table">
        <thead>
            <tr>
                <th><i class="fas fa-user"></i></th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Date Joined</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($fiveUsers as $user)
                {
                    $user["image"] = $user["image"] !== NULL ? $user["image"] : "default.png"; 
                    echo '
                    <tr>
                        <td><img src="'.BASE_URL .'/assets/img/user/'. $user["image"] .'" alt="user"></td>
                        <td>'. $user["firstname"]. " " . $user["lastname"] .'</td>
                        <td>'.$user["username"] .'</td>
                        <td>'.$user["created_at"].'</td>
                    </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
</div>

<!-- Chart of most read categories -->
<?php 
 // Assuming you have a PDO connection $dbh
    $sql = "SELECT c.categoryname, SUM(b.times_loaded) AS total_loaded
        FROM bookcategory c
        LEFT JOIN books b ON c.id = b.category_id
        GROUP BY c.categoryname
        ORDER BY total_loaded DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare data for the chart
    $categories = [];
    $reads = [];
    foreach ($results as $row) {
        $categories[] = $row['categoryname'];
        $reads[] = $row['total_loaded'];
    }
 ?>
<canvas id="categoryChart" height="375" width="1477" style="display: block; box-sizing: border-box; height: 300px; width: 1181px;"></canvas>

<!--Frontend Chart (Using JavaScript and Chart.js)-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // PHP code will output these arrays as JSON
    var categories = <?php echo json_encode($categories); ?>;
    var reads = <?php echo json_encode($reads); ?>;

    var ctx = document.getElementById('categoryChart').getContext('2d');
    var categoryChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: categories, // Categories from PHP
            datasets: [{
                label: 'Most Read Book Categories',
                data: reads, // Total reads for each category from PHP
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php 
include(ROOT_PATH . '/shared/admin-footer.php');
?>
