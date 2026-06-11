# Pengelahan Sampah - EcoWaste Management

## Setup
1. Start Laragon (Apache + MySQL).
2. Edit .env:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pengelahan_sampah
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Terminal (Laragon):
   ```
   php artisan key:generate
   php artisan migrate:fresh --seed
   php artisan storage:link
   ```
4. Access http://pengelahan-sampah.test or http://localhost/pengelahan-sampah/public

## Login
- Admin: admin@ecowaste.com / password → /admin/dashboard (monitor all, confirm).
- Register new user → /user/dashboard (deposit points).

## Features
- User: Submit waste, history, points (no cash).
- Admin: Dashboard stats, confirm transactions, centralized DB.
- All data saved, admin updates categories/prices if needed.

Fixed DB/login/dashboard errors!
