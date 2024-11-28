<?php
// Include database connection
include('config.php');

// Handle search and filter
$search_term = '';
$food_type = ''; // Initialize food_type variable

if (isset($_POST['search'])) {
    $search_term = mysqli_real_escape_string($conn, $_POST['search']);
}

// Handle filtering for Veg/Non-Veg
if (isset($_POST['filter'])) {
    $food_type = mysqli_real_escape_string($conn, $_POST['filter']);
}

// Build query based on search and filter
$query = "SELECT food.*, hotel.hotel_name FROM food
          JOIN hotel ON food.hotel_id = hotel.hotel_id
          WHERE food.food_name LIKE '%$search_term%'";

if ($food_type !== '') {
    $query .= " AND food.type = '$food_type'"; // Apply the food type filter
}

$query .= " ORDER BY food.food_name"; // Sort by food_name

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    // Query failed, display the error
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Listing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Hotel & Food Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hotel_list.php">Hotels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="food_list.php">Food</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Food Search and Sort -->
    <div class="container mt-5">
        <h3>Food List</h3>

        <!-- Search and Filter Form -->
        <form method="POST" class="mb-4">
            <input type="text" name="search" class="form-control search-input" placeholder="Search Food" value="<?= $search_term ?>">
            <div class="mt-3">
                <button type="submit" class="btn btn-primary search-button">Search</button>

                <!-- Filter by Veg/Non-Veg -->
                <button type="submit" name="filter" value="Veg" class="btn btn-success ms-3">Veg</button>
                <button type="submit" name="filter" value="Non-Veg" class="btn btn-danger ms-3">Non-Veg</button>
            </div>
        </form>

        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header"><?= $row['food_name'] ?></div>
                        <div class="card-body">
                            <p><strong>Hotel:</strong> <?= $row['hotel_name'] ?></p> <!-- Display hotel name -->
                            <p><strong>Type:</strong> <?= $row['type'] ?></p>
                            <p><strong>Description:</strong> <?= $row['description'] ?></p>
                            <p><strong>Price:</strong> $<?= number_format($row['price'], 2) ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
