<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Additional CSS styles for beautification */
        body {
            padding-top: 56px; /* Adjusted for fixed navbar */
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .carousel-item {
            height: 550px;
            position: relative;
            background-size: cover;
            background-position: center;
        }

        .carousel-caption {
            position: absolute;
            bottom: 20px;
            left: 50px;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 10px;
            border-radius: 5px;
        }

        .welcome-section {
            text-align: center;
            margin-top: 50px;
            padding: 50px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .welcome-section h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #007bff;
        }

        .welcome-section p {
            font-size: 18px;
            color: #6c757d;
        }

        .card-section {
            margin-top: 30px;
        }

        .card {
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">GROCERY MANAGEMENT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="products.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orders.php">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='register.php'>Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='login.php'>Login</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Image Carousel -->
<div id="homeCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" style="background-image: url('./front/1.jpg');">
            <div class="carousel-caption">
                <h5>Streamline Your Inventory</h5>
                <p>Efficient management at your fingertips.</p>
            </div>
        </div>
        <div class="carousel-item" style="background-image: url('./front/2.jpg');">
            <div class="carousel-caption">
                <h5>Track Orders with Ease</h5>
                <p>Stay updated on all your orders.</p>
            </div>
        </div>
        <div class="carousel-item" style="background-image: url('./front/3.jpg');">
            <div class="carousel-caption">
                <h5>Manage Products Seamlessly</h5>
                <p>Keep your stock organized and accessible.</p>
            </div>
        </div>
        <div class="carousel-item" style="background-image: url('./front/4.jpg');">
            <div class="carousel-caption">
                <h5>Analyze Sales Data</h5>
                <p>Make informed decisions with real-time data.</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#homeCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#homeCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!-- Welcome Section -->
<div class="container welcome-section">
    <h1>Welcome to the Grocery Management System</h1>
    <p>Manage your grocery store efficiently with our comprehensive system. From inventory tracking to order management, we provide the tools to make your job easier.</p>
</div>

<!-- Card Section -->
<div class="container card-section">
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Manage Inventory</h5>
                    <p class="card-text">Keep track of all products and stock levels with ease.</p>
                    <a href="inventory.php" class="btn btn-primary">Go to Inventory</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">View Orders</h5>
                    <p class="card-text">Stay updated with all incoming and outgoing orders.</p>
                    <a href="orders.php" class="btn btn-primary">View Orders</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Analyze Sales</h5>
                    <p class="card-text">Gain insights into sales performance and trends.</p>
                    <a href="sales.php" class="btn btn-primary">Analyze Sales</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
