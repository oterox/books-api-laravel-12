# Laragon PATH Setup Script
# This script adds Laragon PHP and Composer to your Windows PATH permanently

Write-Host "🔧 Setting up Laragon PATH variables..." -ForegroundColor Green

# Define the paths to add
$phpPath = "C:\laragon\bin\php\php-8.3.16-Win32-vs16-x64"
$composerPath = "C:\laragon\bin\composer"

# Check if paths already exist
$currentPath = [Environment]::GetEnvironmentVariable("PATH", [EnvironmentVariableTarget]::User)

if ($currentPath -like "*$phpPath*") {
    Write-Host "✅ PHP path already exists in PATH" -ForegroundColor Yellow
} else {
    # Add PHP to PATH
    [Environment]::SetEnvironmentVariable("PATH", "$currentPath;$phpPath", [EnvironmentVariableTarget]::User)
    Write-Host "✅ Added PHP to PATH: $phpPath" -ForegroundColor Green
}

if ($currentPath -like "*$composerPath*") {
    Write-Host "✅ Composer path already exists in PATH" -ForegroundColor Yellow
} else {
    # Add Composer to PATH
    $newPath = [Environment]::GetEnvironmentVariable("PATH", [EnvironmentVariableTarget]::User)
    [Environment]::SetEnvironmentVariable("PATH", "$newPath;$composerPath", [EnvironmentVariableTarget]::User)
    Write-Host "✅ Added Composer to PATH: $composerPath" -ForegroundColor Green
}

Write-Host ""
Write-Host "🎉 PATH setup completed!" -ForegroundColor Green
Write-Host ""
Write-Host "📝 To apply changes to current session, run:" -ForegroundColor Cyan
Write-Host "   refreshenv" -ForegroundColor White
Write-Host "   OR restart your terminal/PowerShell" -ForegroundColor White
Write-Host ""
Write-Host "🧪 Test the setup with:" -ForegroundColor Cyan
Write-Host "   php --version" -ForegroundColor White
Write-Host "   composer --version" -ForegroundColor White
Write-Host "   php artisan --version" -ForegroundColor White 