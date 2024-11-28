<?php
// Include the database connection
include('config.php');

// Handle search
$search_term = '';
if (isset($_POST['search'])) {
    $search_term = mysqli_real_escape_string($conn, $_POST['search']);
    $query = "SELECT * FROM hotel WHERE hotel_name LIKE '%$search_term%' ORDER BY hotel_name";
} else {
    $query = "SELECT * FROM hotel ORDER BY hotel_name";
}

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    // Query failed, display the error message
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Listing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Include Font Awesome for star icons -->
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
                        <a class="nav-link active" href="hotel_list.php">Hotels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="food_list.php">Food</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hotel Search and Sort -->
    <div class="container mt-5">
        <h3>Hotel List</h3>
        <form method="POST" class="mb-4">
            <input type="text" name="search" class="form-control search-input" placeholder="Search Hotel" value="<?= $search_term ?>">
            <button type="submit" class="btn btn-primary mt-3 search-button">Search</button>
        </form>

        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><?= $row['hotel_name'] ?></div>
                        <div class="card-body">
                            <p>Description: <?= $row['description'] ?></p>
                            <p>Location: <?= $row['location'] ?></p>

                            <!-- Display rating as stars -->
                            <p><strong>Rating:</strong> 
                                <?php
                                $rating = $row['rating'];
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $rating) {
                                        echo '<i class="fas fa-star"></i>'; // Full star
                                    } else {
                                        echo '<i class="far fa-star"></i>'; // Empty star
                                    }
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
