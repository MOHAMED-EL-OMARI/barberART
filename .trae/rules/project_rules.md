# Database Schema

## Core Tables

### Users

-   `id` (PK)
-   `name`
-   `email` (unique)
-   `email_verified_at`
-   `password`
-   `role` (default: 'client')
-   `phone`
-   `profile_picture`
-   `remember_token`
-   `created_at`
-   `updated_at`

### Barbers

-   `id` (PK, FK to users.id)
-   `bio`
-   `experience`
-   `location`
-   `verified` (default: 0)
-   `created_at`
-   `updated_at`

## Service Management

### Services

-   `id` (PK)
-   `barber_id` (FK to barbers.id)
-   `serviceName`
-   `description`
-   `price`
-   `duration`
-   `created_at`
-   `updated_at`

### Availability

-   `id` (PK)
-   `barber_id` (FK to barbers.id)
-   `day`
-   `startTime`
-   `endTime`
-   `created_at`
-   `updated_at`

## Booking System

### Appointments

-   `id` (PK)
-   `user_id` (FK to users.id)
-   `barber_id` (FK to barbers.id)
-   `appointmentDate`
-   `status` (default: 'pending')
-   `paymentStatus` (default: 'pending')
-   `created_at`
-   `updated_at`

### Payments

-   `id` (PK)
-   `appointment_id` (FK to appointments.id)
-   `amount`
-   `paymentMethod`
-   `paymentStatus`
-   `transactionId`
-   `created_at`
-   `updated_at`

## User Interaction

### Reviews

-   `id` (PK)
-   `user_id` (FK to users.id)
-   `barber_id` (FK to barbers.id)
-   `rating`
-   `comment`
-   `created_at`
-   `updated_at`

### Notifications

-   `id` (PK)
-   `user_id` (FK to users.id)
-   `message`
-   `isRead` (default: 0)
-   `created_at`
-   `updated_at`

## System Tables

-   `cache`
-   `cache_locks`
-   `failed_jobs`
-   `jobs`
-   `job_batches`
-   `migrations`
-   `personal_access_tokens`
-   `sessions`
    .
    this is my database schema so take it in consideration every time you make a change.
    after you do something explain the things that you did and also give me the
    "Make sure to:" that I have to do after and explain them in detail.
