# URL Shortner API

**A URL Shortner API.**

## Overview
This project is a URL shortner API built using Laravel 11

**Features:**
* User Registration.
* User Login (returns API key using Sanctum).
* Using the API key, one can send a long URL and will get a shortened one in response. (If the long URL is already in the system, don’t create a new shortened URL, return the previous one). Only the users with a valid API key can use this service. 
* Ensure that all shortened URLs are unique so that they do not collide and cause unwanted bugs. But if a user submits the same Long URL multiple times, they'll get the same short URL for that long URL.
* The user can see the list of URLs they registered using an Endpoint.
* If we browse any shortened URL in the browser, it should redirect us to the actual URL (You should create a simple redirect web route for this, not an API route).

## Prerequisites
* PHP
* Composer


## Installation (File)
1. Clone the repository
2. Run **composer install**
3. Copy .env.example to .env
4. Add database configuration
5. Run **php artisan key:generate**
6. Run **php artisan migrate**
7. Run **php artisan serve**
8. All done!