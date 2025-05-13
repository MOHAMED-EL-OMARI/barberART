<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BarberController extends Controller
{
    public function home()
    {
        $barbers = \App\Models\Barber::with(['user', 'reviews'])->get();
        return view('pages.home', compact('barbers'));
    }
    public function showBarberInfo()
    {
        // Only allow barbers to access this page
        if (Auth::user()->role !== 'barber') {
            return redirect('/')->with('error', 'Only barbers can access this page');
        }
        return view('barber.barber_info');
    }

    public function storeBarberInfo(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'experience' => 'required|integer|min:0',
            'bio' => 'required|string|max:1000',
            'location' => 'required|string|max:255',
            'working_day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'services' => 'required|array',
            'services.*.name' => 'required|string|max:255',
            'services.*.description' => 'required|string',
            'services.*.price' => 'required|numeric|min:0',
            'services.*.duration' => 'required|integer|min:0',
        ]);

        try {
            // Handle profile photo upload
            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');

            // Update user's profile picture
            $user = Auth::user();
            if (!$user) {
                throw new \Exception('User not authenticated');
            }

            $user->profile_picture = $photoPath;
            $user->save();

            // Create or update barber record
            $barber = \App\Models\Barber::updateOrCreate(
                ['id' => $user->id],
                [
                    'bio' => $validatedData['bio'],
                    'experience' => $validatedData['experience'],
                    'location' => $validatedData['location'],
                    'verified' => 0 // Default to unverified
                ]
            );

            // Store availability
            \App\Models\Availability::create([
                'barber_id' => $barber->id,
                'day' => $validatedData['working_day'],
                'startTime' => $validatedData['start_time'],
                'endTime' => $validatedData['end_time']
            ]);

            // Store services
            foreach ($validatedData['services'] as $service) {
                \App\Models\Service::create([
                    'barber_id' => $barber->id,
                    'serviceName' => $service['name'],
                    'description' => $service['description'],
                    'price' => $service['price'],
                    'duration' => $service['duration']
                ]);
            }

            return redirect()->route('barber.dashboard')
                ->with('success', 'Barber profile created successfully!');
        } catch (\Exception $e) {
            \Log::error('Barber profile creation failed: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Failed to create barber profile: ' . $e->getMessage());
        }
    }

    public function dashboard()
    {
        $barber = Auth::user()->barber;

        return view('barber.dashboard', [
            'todayAppointments' => $barber->appointments()
                ->whereDate('appointmentDate', today())
                ->count(),
            'totalReviews' => $barber->reviews()->count(),
            'averageRating' => $barber->reviews()->avg('rating') ?? 0,
            'totalServices' => $barber->services()->count(),
            'recentAppointments' => $barber->appointments()
                ->with('user')
                ->latest()
                ->take(5)
                ->get()
        ]);
    }
}
