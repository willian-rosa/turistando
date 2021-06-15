#!/bin/bash

#!/bin/bash

#RUN chown -R www-data:www-data /var/www
#
#

cd resources/site
npm install
npm run build

cd ../..
composer install

php artisan key:generate
php artisan migrate

php-fpm
