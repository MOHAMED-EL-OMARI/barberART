@extends('layouts.app')

@section('content')
    <div class="barbers-section">
        <h2>Our Professional Barbers</h2>

        <div class="barber-cards">
            @foreach ($barbers as $barber)
                <div class="barber-card">
                    <!-- Barber Image -->
                    <div class="barber-image">
                        <img src="{{ $barber->user->profile_picture ? asset('storage/' . $barber->user->profile_picture) : asset('images/default-avatar.png') }}"
                            alt="{{ $barber->user->name }}">
                    </div>

                    <!-- Barber Info -->
                    <div class="barber-info">
                        <h3>{{ $barber->user->name }}</h3>

                        <!-- Reviews Section -->
                        <div class="reviews">
                            @php
                                $rating = $barber->reviews->avg('rating') ?? 0;
                                $fullStars = floor($rating);
                                $hasHalfStar = $rating - $fullStars >= 0.5;
                            @endphp

                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $fullStars)
                                        <span class="star">★</span>
                                    @elseif($hasHalfStar && $i == $fullStars + 1)
                                        <span class="star half">★</span>
                                    @else
                                        <span class="star empty">☆</span>
                                    @endif
                                @endfor
                            </div>
                            <span class="review-count">({{ $barber->reviews->count() }} reviews)</span>
                        </div>

                        <a href="{{ route('barber.dashboard', $barber->id) }}" class="book-btn">Book Now</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        /* Barbers Section */
        .barbers-section {
            padding: 2rem;
        }

        .barbers-section h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
        }

        /* Barber Cards Grid */
        .barber-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }

        /* Individual Barber Card */
        .barber-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s;
        }

        .barber-card:hover {
            transform: translateY(-5px);
        }

        /* Barber Image */
        .barber-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .barber-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Barber Info */
        .barber-info {
            padding: 1rem;
            text-align: center;
        }

        .barber-info h3 {
            margin: 0 0 0.5rem;
            color: #333;
        }

        /* Reviews */
        .reviews {
            margin: 0.5rem 0;
        }

        .stars {
            color: #ffd700;
            font-size: 1.2rem;
        }

        .star.empty {
            color: #ddd;
        }

        .star.half {
            position: relative;
            color: #ddd;
        }

        .star.half:before {
            content: '★';
            position: absolute;
            color: #ffd700;
            width: 50%;
            overflow: hidden;
        }

        .review-count {
            color: #666;
            font-size: 0.9rem;
        }

        /* Book Button */
        .book-btn {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            margin-top: 1rem;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.2s;
        }

        .book-btn:hover {
            background: #444;
        }
    </style>
@endsection
