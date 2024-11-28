<?php
// Include database connection file
include('config.php');

// Fetch total count of hotels and food
$query_hotels = "SELECT COUNT(*) AS total_hotels FROM hotel";
$query_food = "SELECT COUNT(*) AS total_food FROM food";

// Execute the queries and check for success
$result_hotels = mysqli_query($conn, $query_hotels);
if (!$result_hotels) {
    die("Error fetching total hotels: " . mysqli_error($conn));
}

$result_food = mysqli_query($conn, $query_food);
if (!$result_food) {
    die("Error fetching total food items: " . mysqli_error($conn));
}

$data_hotels = mysqli_fetch_assoc($result_hotels);
$data_food = mysqli_fetch_assoc($result_food);

// Monthly data for graph
$query_monthly = "SELECT MONTH(created_at) AS month, COUNT(*) AS count FROM hotel GROUP BY MONTH(created_at)";
$monthly_result = mysqli_query($conn, $query_monthly);
if (!$monthly_result) {
    die("Error fetching monthly data: " . mysqli_error($conn));
}

$monthly_data = [];
while ($row = mysqli_fetch_assoc($monthly_result)) {
    $monthly_data[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                        <a class="nav-link active" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hotel_list.php">Hotels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="food_list.php">Food</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Total Hotels
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $data_hotels['total_hotels'] ?> Hotels</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Total Food Items
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $data_food['total_food'] ?> Food Items</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Graph -->
        <div class="mt-5">
            <h3>Monthly Hotel Count</h3>
            <canvas id="monthlyChart"></canvas>
        </div>

    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('monthlyChart').getContext('2d');
        var monthlyData = <?= json_encode($monthly_data); ?>;

        var labels = monthlyData.map(function(item) {
            return 'Month ' + item.month;
        });
        var counts = monthlyData.map(function(item) {
            return item.count;
        });

        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Hotel Count',
                    data: counts,
                    borderColor: '#007bff',
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { beginAtZero: true },
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
