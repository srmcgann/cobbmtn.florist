#!/bin/bash
mkdir /var/www/html/cobbmtn.new/dist_public
chmod 777 /var/www/html/cobbmtn.new/dist/studio -R
chmod 777 /var/www/html/cobbmtn.new/dist/wedding -R
cp /var/www/html/cobbmtn.new/dist/. /var/www/html/cobbmtn.new/dist_public/ -r
chmod 777 /var/www/html/cobbmtn.new/dist_public/studio -R
chmod 777 /var/www/html/cobbmtn.new/dist_public/wedding -R

