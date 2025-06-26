<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utama</title>
    <link rel="stylesheet" href="{{ asset('style/asside.css') }}">
    <link rel="stylesheet" href="{{ asset('style/dasboard.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">

        @include('components/asside')

        <main class="main-content" id="main-content">
            <header>
                <button id="toggleSidebar" class="sidebar-toggle"><img src="{{ asset('image/list.png') }}" alt="List"></button>
                <h1>Dashboard</h1>
                <div class="user-menu">
                    <span class="notification"><img src="{{ asset('image/notification.png') }}" alt="notification"></span>
                    <div class="user-profile">
                        <span><img src="{{ asset('image/user.png') }}" alt="User"></span>
                        <span><img src="{{ asset('image/dropdown.png') }}" alt="dropdown"></span>
                    </div>
                </div>
            </header>

            <div class="dashboard">
                <div class="summary-cards">
                    <div class="card">
                        <div class="card-header">
                            <span class="icon"><img src="{{ asset('image/asset.png') }}" alt="Asset"></span>
                            <h3>Total Asset</h3>
                        </div>
                        <div class="card-content">
                            <h2>{{$totalasset ?? 0}}</h2>
                            <p class="trend positive">+4.5% from last month</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <span class="icon"><img src="{{ asset('image/rent.png') }}" alt="Rent"></span>
                            <h3>Total Rent</h3>
                        </div>
                        <div class="card-content">
                            <h2>550</h2>
                            <p class="trend positive">+6.8% from last month</p>
                        </div>
                    </div>
                </div>

                <div class="charts">
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3>Total Overview</h3>
                            <a href="#" class="view-all">View all</a>
                        </div>
                        <canvas id="barChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3>Rent Distributions</h3>
                            <a href="#" class="view-all">View all</a>
                        </div>
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="{{ asset('js/asside.js') }}"></script>
    <script src="js/dasboard.js"></script>
</body>
</html>