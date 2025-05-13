@extends('layouts.app')

@section('content')
    <!-- Add this section right after the form opening tag -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Barber Information Form Container -->
    <div class="barber-form-container">
        <h2>Complete Your Barber Profile</h2>

        <form action="{{ route('barber.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Profile Photo Section -->
            <div class="form-section">
                <h3>Profile Photo</h3>
                <div class="form-group">
                    <div class="image-preview-container">
                        <img id="preview" src="{{ asset('images/default-avatar.png') }}" alt="Profile Preview"
                            class="image-preview">
                    </div>
                    <label for="profile_photo" class="file-upload-label">Upload Profile Photo</label>
                    <input type="file" id="profile_photo" name="profile_photo" accept="image/*"
                        onchange="previewImage(this)" required>
                </div>
            </div>

            <!-- Personal Information Section -->
            <div class="form-section">
                <h3>Personal Information</h3>

                <div class="form-group">
                    <label for="experience">Years of Experience</label>
                    <input type="number" id="experience" name="experience" min="0"
                        placeholder="Enter your years of experience" required>
                </div>

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" placeholder="Tell us about yourself and your barbering journey" required></textarea>
                </div>
            </div>

            <!-- Location Section -->
            <div class="form-section">
                <h3>Location Information</h3>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" placeholder="Enter your working location" required>
                </div>

                <div class="form-group">
                    <label>Working Hours</label>
                    <div class="working-hours-inputs">
                        <select id="working_day" name="working_day" required>
                            <option value="">Select Day</option>
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                            <option value="saturday">Saturday</option>
                            <option value="sunday">Sunday</option>
                        </select>

                        <input type="time" id="start_time" name="start_time" required>

                        <span class="time-separator">to</span>

                        <input type="time" id="end_time" name="end_time" required>
                    </div>
                </div>

                <style>
                    .working-hours-inputs {
                        display: flex;
                        gap: 10px;
                        align-items: center;
                    }

                    .working-hours-inputs select,
                    .working-hours-inputs input {
                        padding: 8px;
                        border: 1px solid #ddd;
                        border-radius: 4px;
                    }

                    .time-separator {
                        color: #666;
                    }
                </style>
            </div>
            <!-- Services Section -->
            <div class="form-section">
                <h3>Services & Pricing</h3>
                <div id="services-container">
                    <div class="service-entry">
                        <div class="form-group">
                            <label for="service_name">Service Name</label>
                            <input type="text" name="services[0][name]" class="service-name"
                                placeholder="Enter service name" required>
                        </div>

                        <div class="form-group">
                            <label for="service_description">Description</label>
                            <textarea name="services[0][description]" class="service-description" placeholder="Describe the service" required></textarea>
                        </div>

                        <div class="form-group price-duration-container">
                            <div class="price-input">
                                <label for="service_price">Price ($)</label>
                                <input type="number" name="services[0][price]" class="service-price" min="0"
                                    step="0.01" placeholder="0.00" required>
                            </div>

                            <div class="duration-input">
                                <label for="service_duration">Duration (minutes)</label>
                                <input type="number" name="services[0][duration]" class="service-duration" min="0"
                                    placeholder="30" required>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" id="add-service" class="add-service-btn">+ Add Another Service</button>
            </div>

            <style>
                .service-entry {
                    padding: 15px;
                    margin-bottom: 15px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    background-color: #f9f9f9;
                }

                .price-duration-container {
                    display: flex;
                    gap: 20px;
                }

                .price-input,
                .duration-input {
                    flex: 1;
                }

                .add-service-btn {
                    background: #4CAF50;
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    margin-top: 10px;
                }

                .add-service-btn:hover {
                    background: #45a049;
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const servicesContainer = document.getElementById('services-container');
                    const addServiceBtn = document.getElementById('add-service');
                    let serviceCount = 1;

                    addServiceBtn.addEventListener('click', function() {
                        const serviceEntry = document.createElement('div');
                        serviceEntry.className = 'service-entry';
                        serviceEntry.innerHTML = `
                            <div class="form-group">
                                <label for="service_name">Service Name</label>
                                <input type="text" name="services[${serviceCount}][name]" class="service-name" placeholder="Enter service name" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="service_description">Description</label>
                                <textarea name="services[${serviceCount}][description]" class="service-description" placeholder="Describe the service" required></textarea>
                            </div>
                            
                            <div class="form-group price-duration-container">
                                <div class="price-input">
                                    <label for="service_price">Price ($)</label>
                                    <input type="number" name="services[${serviceCount}][price]" class="service-price" min="0" step="0.01" placeholder="0.00" required>
                                </div>
                                
                                <div class="duration-input">
                                    <label for="service_duration">Duration (minutes)</label>
                                    <input type="number" name="services[${serviceCount}][duration]" class="service-duration" min="0" placeholder="30" required>
                                </div>
                            </div>
                        `;
                        servicesContainer.appendChild(serviceEntry);
                        serviceCount++;
                    });
                });
            </script>

            <button type="submit" class="submit-btn">Complete Profile</button>
        </form>

        <script>
            function previewImage(input) {
                const preview = document.getElementById('preview');
                const file = input.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            }
        </script>

        <style>
            .image-preview-container {
                width: 200px;
                height: 200px;
                margin: 0 auto 20px;
                border-radius: 50%;
                overflow: hidden;
                border: 3px solid #ddd;
            }

            .image-preview {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .file-upload-label {
                display: inline-block;
                padding: 10px 20px;
                background: #333;
                color: white;
                border-radius: 4px;
                cursor: pointer;
                margin-bottom: 10px;
            }

            input[type="file"] {
                display: none;
            }
        </style>
    </div>

    <style>
        /* Form Container Styles */
        .barber-form-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Headings */
        h2 {
            color: #333;
            margin-bottom: 2rem;
            text-align: center;
        }

        h3 {
            color: #555;
            margin: 1rem 0;
        }

        /* Form Section Styles */
        .form-section {
            margin-bottom: 2rem;
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        /* Form Group Styles */
        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #666;
        }

        /* Input Styles */
        input[type="text"],
        input[type="tel"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        /* File Input Styles */
        input[type="file"] {
            border: 1px solid #ddd;
            padding: 0.5rem;
            width: 100%;
        }

        /* Submit Button Styles */
        .submit-btn {
            background: #333;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
        }

        .submit-btn:hover {
            background: #444;
        }

        /* Error Messages */
        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: 0.2rem;
        }
    </style>
    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert-danger ul {
            margin: 0;
            padding-left: 20px;
        }
    </style>
@endsection
