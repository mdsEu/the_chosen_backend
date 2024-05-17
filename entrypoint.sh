#!/bin/bash

usermod -a -G www-data username

chmod -Rf 775 /var/www/html/wp-content/languages
chown -Rf www-data:www-data /var/www/html/wp-content/languages

chmod -Rf 775 /var/www/html/wp-content/uploads
chown -Rf www-data:www-data /var/www/html/wp-content/uploads

chmod -Rf 775 /var/www/html/wp-content/uploads/*
chown -Rf www-data:www-data /var/www/html/wp-content/uploads/*

ls -la  /var/www/html/wp-content/
