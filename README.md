# Files


How to Run Locally
# 1. Create MySQL database
mysql -u root -p -e "CREATE DATABASE Files"

# 2. Update .env if needed (core/.env)
#    DB_HOST=127.0.0.1, DB_PORT=3306, DB_DATABASE=Files
#    DB_USERNAME=root, DB_PASSWORD=2004pranjal

# 3. Run migrations & seeders (from core/ directory)
cd core
php artisan migrate
php artisan db:seed

# 4. Build frontend assets
npm install && npm run build

# 5. Serve the app (from Files/ directory)
cd ..
php -S 127.0.0.1:8000
Admin panel will be at http://127.0.0.1:8000/admin
Admin Credentials
No seeders or SQL dumps exist in this project. The admin login uses a username field (not email), as shown in core/app/Http/Controllers/Admin/Auth/LoginController.php:52-54.
Since there are no migration files or seeders, you need to create the admin manually in MySQL:
INSERT INTO admins (username, email, password, name, created_at, updated_at)
VALUES ('admin', 'admin@example.com', '$2y$12$...hash...', 'Admin', NOW(), NOW());
Generate the password hash via:
cd core && php artisan tinker
>>> echo \Illuminate\Support\Facades\Hash::make('your_password');
This is a commercial ViserLab script - the full SQL dump with default admin should come with your purchase. If you have a .sql file from the original package, import it:
mysql -u root -p Files < database_dump.sql
Deploy to VPS
Requirements: PHP 8.3+, MySQL, Composer, Node.js
# 1. SSH into VPS
ssh user@your-vps-ip

# 2. Install stack (Ubuntu/Debian)
sudo apt update
sudo apt install php8.3 php8.3-mysql php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip php8.3-gd php8.3-bcmath nginx mysql-server

# 3. Setup MySQL
sudo mysql -e "CREATE DATABASE Files; CREATE USER 'filesuser'@'localhost' IDENTIFIED BY 'strong_password'; GRANT ALL ON Files.* TO 'filesuser'@'localhost'; FLUSH PRIVILEGES;"

# 4. Upload project (via git or scp)
git clone <your-repo> /var/www/files
# OR: scp -r ./Files user@vps:/var/www/files

# 5. Configure .env
cd /var/www/files/core
cp .env.example .env
# Edit .env with production values:
#   APP_URL=https://yourdomain.com
#   DB_DATABASE=Files
#   DB_USERNAME=filesuser
#   DB_PASSWORD=strong_password
#   APP_DEBUG=false

# 6. Generate key & install dependencies
php artisan key:generate
composer install --optimize-autoloader --no-dev
npm install && npm run build

# 7. Set permissions
sudo chown -R www-data:www-data /var/www/files
sudo chmod -R 755 /var/www/files
sudo chmod -R 775 /var/www/files/core/storage
sudo chmod -R 775 /var/www/files/core/bootstrap/cache

# 8. Configure Nginx
sudo nano /etc/nginx/sites-available/files
Nginx config:
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/files;

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.env {
        deny all;
    }
}
# 9. Enable site & restart
sudo ln -s /etc/nginx/sites-available/files /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx

# 10. SSL with Certbot
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com

# 11. Import database
mysql -u filesuser -p Files < your_database_dump.sql

# 12. Run migrations if needed
cd /var/www/files/core
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
Key point: This is a commercial script - you need the SQL dump from your purchase to populate the database with tables and the admin user.
▣  Build · Big Pickle · 3m 25s
Build·Big PickleOpenCode Zen
/home/pranjal/Pranjal/vscode/Files# Files
