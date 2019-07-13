FROM ubuntu:latest
MAINTAINER Adam Telford <info@webfra.me>

RUN apt-get update && apt-get -y upgrade && DEBIAN_FRONTEND=noninteractive apt-get -y install \
    apache2 php php-gd php-imap php-json php-opcache php-xmlrpc php-zip php-curl mcrypt php-dom unzip php-memcached memcached libapache2-mod-evasive
RUN sed -i "s/display_errors = Off/display_errors = on/" /etc/php/7.2/apache2/php.ini
RUN rm /var/www/html/index.html
ADD html /var/www/html
RUN chgrp -R www-data /var/www/
RUN chmod -R g+w /var/www/
RUN chown -R www-data /var/www/
RUN chmod 2775 /var/www/
RUN chmod ug+rw /var/www/
RUN apt-get -y install cron
RUN (crontab -l ; echo "* * * * * php /var/www/html/cronJob.php") | crontab
EXPOSE 80

CMD /usr/sbin/apache2ctl -D FOREGROUND
