#!/bin/bash

usermod -a -G www-data username

chmod -Rf 775 /var/www/html/wp-content/languages

chmod -Rf 775 /var/www/html/wp-content/uploads/*

ls -la  /var/www/html/wp-content/

tail -f /dev/null
