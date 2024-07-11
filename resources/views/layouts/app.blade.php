<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineMax Style Layout</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mt- 3">
    <div class="container">
        <img src="{{ asset('images/icona_ciak.png') }}" alt="Logo" height="30">
        <a class="navbar-brand" href="#">CineMax</a>       
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('home') ? 'active' : ''}}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('admin.dashboard') ? 'active' : ''}}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('email') ? 'active' : ''}}" href="{{ route('email') }}">Contatti</a>
                </li>
                <li>
                    <form id="searchForm" class="d-flex" action="{{ route('films.search') }}" method="GET">
                        <input id="searchInput" class="form-control me-2" type="search" placeholder="Cerca un film" aria-label="Search" name="search">
                        <button class="btn btn-outline-success" type="submit">Cerca</button>
                    </form>                    
                    
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container text-center">
        {{-- <img src="{{ asset('images/hero-image.jpeg') }}" alt="Immagine Hero" class="img-fluid"> --}}
        <h1>Benvenuto su CineMax</h1>
        <h5>Guarda online o acquista i migliori film</h5>
    </div>
</section>

<!-- Content Section -->
<section class="content-section py-5">
    <div class="container">
        @yield('content')
    </div>
</section>

<!-- Footer -->
<footer class="footer-section">
    <div class="container text-center">
        <p>&copy; 2024 CineMax. All Rights Reserved.</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>