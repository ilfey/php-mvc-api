#!/bin/sh

a2enmod rewrite

a2ensite server.conf

# Restart service
service apache2 stop

/usr/sbin/apache2ctl -D FOREGROUND