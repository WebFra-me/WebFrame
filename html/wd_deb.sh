#! /usr/bin/env sh
echo "WebDesk install is making sure you have all the required packages and that everything is up to date"
sudo apt-get clean
sudo apt-get --yes update
sudo apt-get --yes dist-upgrade
sudo apt-get clean
sudo apt-get install --yes apache2 php7.0 php7.0-curl php7.0-gd php7.0-imap php7.0-json php7.0-mcrypt php7.0-mysql php7.0-opcache php7.0-xmlrpc libapache2-mod-php7.0 php-zip php-dom unzip php-memcached memcached libapache2-mod-security2 libapache2-modsecurity libapache2-mod-evasive
sudo a2enmod mod-security deflate
sudo apt-get --yes update
sudo apt-get --yes dist-upgrade
echo "cleaning up"
sudo apt-get --yes autoremove
sudo apt-get clean
echo "installing WebDesk"
cd /var/www/html/
sudo wget "https://github.com/WebFra-me/WebFra-me/archive/master.zip"
sudo unzip /var/www/html/master.zip -d /var/www/html/
sudo cp -a /var/www/html/WebFra-me-master/. /var/www/html/
sudo rm -f /var/www/html/master.zip
sudo rm -rf /var/www/html/WebFra-me-master/
sudo rm -f /var/www/html/index.html
sudo chgrp -R www-data /var/www/
echo "Fixing Permissions"
sudo chmod -R g+w /var/www/
sudo find /var/www -type d -exec chmod 2775 {} \;
sudo find /var/www -type f -exec chmod ug+rw {} \;
sudo apachectl -k restart
echo "Crontab setup"
crontab << EOS
* * * * * php /var/www/html/cronJob.php
EOS
echo " "
echo " "
echo "Everything should be installed!"
echo " "
echo "This is state of your servers storage."
df -h
echo "This is your ip address. Please enter it in the url field of your web browser and click enter."
hostname -I
echo "To remove this file please type in your terminal: sudo rm -f wd_deb.sh"
