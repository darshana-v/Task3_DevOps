# Task 3


# installing apache and php
sudo apt update
sudo apt install apache2
sudo ufw allow 'Apache'
sudo ufw allow in "Apache Full" 

sudo apt install php libapache2-mod-php php-mysql

# enabling firewall
sudo ufw enable

# create a copy of apache's configuration file just in case as backup:
sudo cp /etc/apache2/apache2.conf /etc/apache2/apache2.backup.conf

# creating corona.html
sudo mkdir -p /var/www/localhost
sudo chown -R $USER:$USER /var/www/localhost
sudo chmod -R 755 /var/www

# Entering the contents of the file
echo "<!DOCTYPE html>
<html lang="en">
<head>
  <title>Quarantined? You better be.</title>
</head>
<body>
  <h1>Go Corona</h1>
  <h2>Ghar par rehna</h2>
</body>
</html>" | sudo tee /var/www/localhost/corona.html

# Setting up the VirtualHost Configuration File
sudo nano /etc/apache2/sites-available/localhost.conf

# Entering the contents of the virtualhost config file
echo "<VirtualHost *:80>

ServerName localhost
ServerAlias www.localhost
DirectoryIndex corona.html
DocumentRoot /var/www/localhost
ErrorLog ${APACHE_LOG_DIR}/error.log
CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>" | sudo tee /etc/apache2/sites-available/localhost.conf

# Enabling the domain configuration and disabling default site
sudo a2ensite localhost.conf
sudo a2dissite 000-default.conf

# reloading apache
sudo systemctl reload apache2

# Thus, the simple html page is hosted in apache
# and can be viewed by accessing "http://localhost/" or "www.localhost/" in browser




# Installing MySQL
sudo apt-get install mysql-server
# when prompted for a password, enter a password which would be required to access mysql
# this would be the root password to access mysql


# Accessing and entering into the MySQL shell
sudo mysql 
create database message_app;
CREATE USER 'user'@'%' IDENTIFIED WITH mysql_native_password BY 'pass';
GRANT ALL ON message_app.* TO 'user'@'%';

exit

### Now login with 'user' and 'pass'
mysql -u user -p
# provide password


# the following code happens in the mysql interface

use message_app;
create table users_table(id int(15) NOT NULL PRIMARY KEY AUTO_INCREMENT,
username TINYTEXT NOT NULL,
password LONGTEXT NOT NULL);

use message_app;
create table updates_table(id int(10),
receiver_id varchar(50),
datetime DATETIME);

exit;




sudo cp -R localhost /var/www/localhost








