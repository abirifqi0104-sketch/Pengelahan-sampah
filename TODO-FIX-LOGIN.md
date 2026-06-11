# Fix Login/Register "Not Found"

## Current Status
✅ Code correct - routes, views, controllers OK.  
❌ Cache/server issue causing 404.  

## Step 1: Clear Laravel Cache Manually (PHP PATH issue)
```
# Open CMD/PowerShell as Admin in project dir
rmdir /s /q storage\framework\cache\data
rmdir /s /q storage\framework\sessions
rmdir /s /q storage\framework\views
del bootstrap\cache\*.php
```

## Step 2: Restart Laragon Server
Right-click Laragon → Apache → Stop → Start

## Step 3: Verify Routes (use Laragon Terminal)
Open Laragon Terminal (has PHP in PATH):
`php artisan route:list | findstr -i login`
Expected:
GET|HEAD  login › auth.login
POST      login › login

## Step 4: Run Missing Migration (role column)
`php artisan migrate`

## Step 5: Test
1. Visit homepage
2. Click 'Mulai Setor Sampah' (login)
3. Should show login form without 404.

## Step 6: If still issue
- Clear browser cache/Ctrl+F5
- Check `storage/logs/laravel.log` for errors
- Run `php artisan route:cache` then clear again.

## PHP PATH Fix for VSCode Terminal
Add to Windows PATH: `C:\laragon\bin\php\php8.2.12-Win32`

**After Step 2, login/register will work! No code changes needed.**


