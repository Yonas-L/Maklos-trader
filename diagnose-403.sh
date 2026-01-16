#!/bin/bash

echo "=== Additional Diagnostics for 403 Error ==="
echo ""

echo "1. Checking SELinux status..."
getenforce 2>/dev/null || echo "SELinux not installed or not available"
echo ""

echo "2. Checking Apache/Nginx error logs (last 20 lines)..."
echo "--- Apache Error Log ---"
sudo tail -20 /var/log/httpd/error_log 2>/dev/null || echo "Apache error log not found at /var/log/httpd/error_log"
echo ""
echo "--- Nginx Error Log ---"
sudo tail -20 /var/log/nginx/error.log 2>/dev/null || echo "Nginx error log not found at /var/log/nginx/error.log"
echo ""

echo "3. Checking .htaccess file..."
cat public/.htaccess
echo ""

echo "4. Checking bootstrap/cache permissions..."
ls -la bootstrap/cache/
echo ""

echo "5. Testing if PHP can access the admin route..."
php artisan route:list --path=adminPanel | head -5
echo ""

echo "=== Possible Fixes ==="
echo ""
echo "If SELinux is enforcing, run:"
echo "  sudo setenforce 0  # Temporarily disable"
echo "  # Or permanently fix context:"
echo "  sudo chcon -R -t httpd_sys_rw_content_t storage/"
echo "  sudo chcon -R -t httpd_sys_rw_content_t bootstrap/cache/"
echo ""
echo "If .htaccess is the issue, ensure mod_rewrite is enabled:"
echo "  sudo a2enmod rewrite"
echo "  sudo systemctl restart apache2"
echo ""
echo "Check your Apache/Nginx vhost config allows .htaccess overrides:"
echo "  AllowOverride All"
