@extends('layouts.app')

@section('content')
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="profile-section">
                <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/default-avatar.png') }}"
                    alt="Profile Picture" class="profile-pic">
                <h3>{{ Auth::user()->name }}</h3>
                <span class="status {{ Auth::user()->barber->verified ? 'verified' : 'pending' }}">
                    {{ Auth::user()->barber->verified ? 'Verified' : 'Pending Verification' }}
                </span>
            </div>

            <nav class="dashboard-nav">
                <a href="#overview" class="active">Overview</a>
                <a href="#appointments">Appointments</a>
                <a href="#services">Services</a>
                <a href="#reviews">Reviews</a>
                <a href="#settings">Settings</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Overview Section -->
            <section id="overview" class="dashboard-section">
                <h2>Dashboard Overview</h2>

                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Today's Appointments</h3>
                        <p class="stat-number">{{ $todayAppointments }}</p>
                    </div>
                    <div class="stat-card">
                        <h3>Total Reviews</h3>
                        <p class="stat-number">{{ $totalReviews }}</p>
                    </div>
                    <div class="stat-card">
                        <h3>Average Rating</h3>
                        <p class="stat-number">{{ number_format($averageRating, 1) }}</p>
                    </div>
                    <div class="stat-card">
                        <h3>Total Services</h3>
                        <p class="stat-number">{{ $totalServices }}</p>
                    </div>
                </div>
            </section>

            <!-- Recent Appointments -->
            <section id="appointments" class="dashboard-section">
                <h2>Recent Appointments</h2>
                <div class="appointments-list">
                    @foreach ($recentAppointments as $appointment)
                        <div class="appointment-card">
                            <div class="appointment-info">
                                <h4>{{ $appointment->user->name }}</h4>
                                <p>{{ $appointment->appointmentDate->format('M d, Y H:i') }}</p>
                                <span class="status {{ $appointment->status }}">{{ $appointment->status }}</span>
                            </div>
                            <div class="appointment-actions">
                                <button class="btn accept">Accept</button>
                                <button class="btn decline">Decline</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <style>
        /* Dashboard Layout */
        .dashboard {
            display: flex;
            min-height: calc(100vh - 60px);
            background: #f5f5f5;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: white;
            padding: 2rem;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .profile-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 1rem;
            object-fit: cover;
        }

        .status {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .status.verified {
            background: #e3f2fd;
            color: #1976d2;
        }

        .status.pending {
            background: #fff3e0;
            color: #f57c00;
        }

        /* Navigation */
        .dashboard-nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .dashboard-nav a {
            padding: 0.75rem 1rem;
            color: #666;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.2s;
        }

        .dashboard-nav a:hover,
        .dashboard-nav a.active {
            background: #f5f5f5;
            color: #333;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin: 0.5rem 0;
        }

        /* Appointments List */
        .appointments-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .appointment-card {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Buttons */
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 0.5rem;
        }

        .btn.accept {
            background: #4caf50;
            color: white;
        }

        .btn.decline {
            background: #f44336;
            color: white;
        }
    </style>
@endsection
