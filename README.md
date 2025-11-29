# OCECF 20th Celebration Registration System

This is a Laravel-based registration system for the OCECF 20th Celebration event.

## Features

- Online registration form with validation
- Payment calculation system
- Admin panel for managing registrations
- File upload for passport photos and transaction screenshots
- Responsive design

## CI/CD Pipeline

This project uses GitHub Actions for continuous integration and deployment:

1. **Testing**: Runs PHPUnit tests on every push and pull request
2. **Staging Deployment**: Automatically deploys to staging environment on pushes to `develop` branch
3. **Production Deployment**: Automatically deploys to production environment on pushes to `main` branch

## Local Development

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env` and configure your database
4. Run `php artisan key:generate`
5. Run `php artisan migrate`
6. Run `php artisan serve`

## Testing

Run tests with:
```bash
php artisan test
```

## Deployment

The CI/CD pipeline handles automatic deployment. To manually deploy:

1. Push to `develop` branch for staging
2. Push to `main` branch for production