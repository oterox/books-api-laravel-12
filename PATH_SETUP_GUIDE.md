# 🛠️ Laragon PATH Setup Guide

This guide shows you how to add Laragon PHP and Composer to your Windows PATH so you can use them from anywhere.

## ✅ What We've Done

We've successfully added the following to your Windows PATH:
- **PHP**: `C:\laragon\bin\php\php-8.3.16-Win32-vs16-x64`
- **Composer**: `C:\laragon\bin\composer`

## 🚀 How to Use

### Current Session (Already Working)
In your current PowerShell session, you can now use:
```bash
php --version
composer --version
php artisan --version
```

### For New Sessions
The PATH changes are permanent, but you need to refresh environment variables in new sessions:

#### Option 1: Use the Batch File
```bash
# Run this in any directory
refresh-env.bat
```

#### Option 2: Manual Refresh
```bash
# In PowerShell
refreshenv

# OR restart your terminal/PowerShell
```

#### Option 3: System Properties (Manual)
1. Press `Win + R`
2. Type `sysdm.cpl`
3. Click "Environment Variables"
4. Under "User variables", find "Path"
5. Click "Edit" and verify these paths are there:
   - `C:\laragon\bin\php\php-8.3.16-Win32-vs16-x64`
   - `C:\laragon\bin\composer`

## 🧪 Testing Your Setup

Run these commands to verify everything is working:

```bash
# Test PHP
php --version

# Test Composer
composer --version

# Test Laravel Artisan
cd C:\laragon\www\books-api
php artisan --version

# Test your API
php test_api.php
```

## 📝 Common Commands

Now you can use these simplified commands from anywhere:

### Laravel Commands
```bash
# Create new Laravel project
composer create-project laravel/laravel my-project

# Run migrations
php artisan migrate

# Clear caches
php artisan config:clear
php artisan route:clear
php artisan cache:clear

# Start development server
php artisan serve

# List all routes
php artisan route:list

# Create model, migration, controller
php artisan make:model Book -mcr
```

### Composer Commands
```bash
# Install dependencies
composer install

# Update dependencies
composer update

# Add new package
composer require package-name

# Remove package
composer remove package-name
```

### PHP Commands
```bash
# Run PHP script
php script.php

# Start PHP built-in server
php -S localhost:8000

# Check PHP configuration
php -i
```

## 🔧 Troubleshooting

### If commands don't work in new sessions:
1. Run `refresh-env.bat`
2. Or restart your terminal/PowerShell
3. Or manually refresh: `refreshenv`

### If you get "command not found":
1. Check if the paths are in your PATH variable
2. Verify Laragon is installed in `C:\laragon\`
3. Check if the PHP version folder exists

### If you get permission errors:
1. Run PowerShell as Administrator
2. Check file permissions on Laragon folders

## 📁 Files Created

- `setup-path-simple.ps1` - PowerShell script to add paths
- `refresh-env.bat` - Batch file to refresh environment
- `PATH_SETUP_GUIDE.md` - This guide

## 🎉 Benefits

Now you can:
- ✅ Use `php` and `composer` from any directory
- ✅ Run Laravel Artisan commands from anywhere
- ✅ Create new Laravel projects easily
- ✅ Manage dependencies with Composer
- ✅ No more long paths like `C:\laragon\bin\php\php-8.3.16-Win32-vs16-x64\php.exe`

## 🔄 Updating PHP Version

If Laragon updates to a new PHP version, you'll need to update the PATH:

1. Find the new PHP folder in `C:\laragon\bin\php\`
2. Update the path in the script or manually
3. Run the setup script again

## 📚 Next Steps

Now that you have PHP and Composer in your PATH, you can:

1. **Create new Laravel projects** anywhere on your system
2. **Use Composer** to manage PHP packages
3. **Run Laravel commands** from any project directory
4. **Develop more efficiently** with shorter commands

Happy coding! 🚀 