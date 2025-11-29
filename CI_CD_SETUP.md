# CI/CD Setup Guide

## Step 1: Configure GitHub Repository

1. Push your code to GitHub:
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   git remote add origin https://github.com/your-username/your-repo.git
   git branch -M main
   git push -u origin main
   ```

## Step 2: Set Up GitHub Actions

The workflow is already configured in `.github/workflows/laravel.yml`. No additional steps needed.

## Step 3: Configure Automatic Deployment

### Option A: For Shared Hosting (Most Common)

1. Update the webhook script in `public/deploy.php`:
   - Change `DEPLOY_SECRET` to a random secret string
   - Update the deployment commands as needed

2. Set up the webhook in GitHub:
   - Go to your GitHub repository Settings
   - Click "Webhooks" in the left sidebar
   - Click "Add webhook"
   - Payload URL: `https://yourdomain.com/deploy.php`
   - Content type: `application/json`
   - Secret: The same secret you used in deploy.php
   - Events: Just the push event
   - Click "Add webhook"

### Option B: For VPS/Dedicated Server

1. Set up SSH keys for GitHub Actions:
   - Generate SSH keys on your server
   - Add the public key to your GitHub repository as a deploy key
   - Store the private key as a GitHub secret

2. Update the deployment section in `.github/workflows/laravel.yml`:
   ```yaml
   - name: Deploy to Production
     run: |
       echo "Deploying to production environment..."
       ssh -o StrictHostKeyChecking=no user@your-server-ip "cd /path/to/your/project && git pull origin main && composer install --no-dev --optimize-autoloader && php artisan migrate --force && php artisan config:cache"
   ```

## Step 4: Configure Environment Variables

1. Copy `.env.example` to `.env` and configure your production database settings
2. Generate app key: `php artisan key:generate`
3. For GitHub Actions, set secrets in your repository settings:
   - DB_HOST
   - DB_PORT
   - DB_DATABASE
   - DB_USERNAME
   - DB_PASSWORD

## Step 5: Test the Setup

1. Make a small change to your code
2. Commit and push to GitHub
3. Check the Actions tab to see the workflow running
4. Verify that your changes are deployed to your server

## Troubleshooting

1. If deployment fails, check the GitHub Actions logs
2. Ensure your server has the correct permissions for the web server user
3. Make sure all required PHP extensions are installed on your server
4. Verify that your database connection works from your server

## Security Notes

1. Never commit sensitive information like passwords or API keys to your repository
2. Use environment variables and GitHub secrets for sensitive data
3. Protect your webhook endpoint with a secret token
4. Regularly rotate your secrets and tokens