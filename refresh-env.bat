@echo off
echo Refreshing environment variables...
call refreshenv
echo Environment refreshed!
echo.
echo Testing PHP and Composer...
php --version
echo.
composer --version
echo.
echo If you see version information above, the PATH setup is working!
pause 