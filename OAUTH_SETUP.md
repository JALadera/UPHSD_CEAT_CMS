# OAuth Setup Guide - Google & Microsoft Login

## Features Added
✅ Password visibility toggle (eye icon) in login and register forms
✅ Google and Microsoft OAuth buttons with links
✅ Backend OAuth controller and routes
✅ Laravel Socialite integration

## Required Setup Steps

### 1. Install Laravel Socialite (if not already installed)
```bash
php composer.phar require laravel/socialite
```

### 2. Google OAuth Setup

#### a) Get Google OAuth Credentials:
1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select an existing one
3. Enable the "Google+ API"
4. Go to "Credentials" → "Create Credentials" → "OAuth 2.0 Client ID"
5. Choose "Web Application"
6. Add authorized redirect URIs:
   - `http://127.0.0.1:8000/auth/google/callback` (local development)
   - `https://yourdomain.com/auth/google/callback` (production)
7. Copy the Client ID and Client Secret

#### b) Add to .env file:
```env
GOOGLE_CLIENT_ID=your_client_id_here
GOOGLE_CLIENT_SECRET=your_client_secret_here
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

### 3. Microsoft OAuth Setup

#### a) Get Microsoft OAuth Credentials:
1. Go to [Azure Portal](https://portal.azure.com/)
2. Navigate to "App registrations"
3. Click "New registration"
4. Enter app name: "UPHSD CMS"
5. Under "Redirect URI", select "Web" and add:
   - `http://127.0.0.1:8000/auth/microsoft/callback` (local)
   - `https://yourdomain.com/auth/microsoft/callback` (production)
6. Go to "Certificates & secrets"
7. Create a new client secret
8. Copy the Application (client) ID and client secret value

#### b) Add to .env file:
```env
MICROSOFT_CLIENT_ID=your_client_id_here
MICROSOFT_CLIENT_SECRET=your_client_secret_here
MICROSOFT_REDIRECT_URI=http://127.0.0.1:8000/auth/microsoft/callback
```

### 4. Update config/services.php
✅ Already done! Google and Microsoft OAuth configs are in place.

### 5. Test OAuth

1. Navigate to login or register page
2. Click the Google or Microsoft button
3. You should be redirected to the OAuth provider
4. After authentication, you'll be logged in and redirected to the dashboard

## File Structure
- `app/Http/Controllers/OAuthController.php` - Handles OAuth redirects and callbacks
- `routes/web.php` - OAuth routes:
  - GET `/auth/{provider}/redirect` → Redirect to OAuth provider
  - GET `/auth/{provider}/callback` → Handle OAuth callback
- `config/services.php` - OAuth service configuration
- `resources/views/auth/login.blade.php` - Password toggle + OAuth buttons
- `resources/views/auth/register.blade.php` - Password toggle + OAuth buttons

## User Model Requirements
The User model already has a `role` column and supports email_verified_at, which are required for OAuth integration.

## Notes
- Default role for OAuth users: 'student'
- Users are auto-created with verified email
- Password is randomly generated for OAuth users
- OAuth users can still update their profile

## Troubleshooting

**"OAuth provider not found" error:**
- Make sure Socialite is installed: `php composer.phar require laravel/socialite`

**"Invalid client credentials" error:**
- Double-check your .env file has correct CLIENT_ID and CLIENT_SECRET
- Ensure redirect URIs match exactly in OAuth provider settings

**Redirect loop or blank page:**
- Check that routes are correctly registered
- Verify OAuthController is properly imported in web.php
- Check browser console for JavaScript errors

## Local Development HTTPS
For testing OAuth with HTTPS locally, you can use:
```bash
php artisan serve --host=127.0.0.1 --port=8000 --secure
```
Or use a reverse proxy like ngrok to expose your local server.
