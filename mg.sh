# home/bin/

#!/bin/bash
# Program:
# This program shows "Hello World!" in your screen.

#echo "Hello World! \a \n"
printf "Hello World! \a \n"
read -p "input dir: " dirused

test -d ${dirused} && echo "it exists" || echo "nothing"
if [ "${dirused}" == "app" ];
then
echo "${dirused} exists"
else
echo "not exists" && exit 0;
fi
sudo chown -R www-data: ./;sudo chgrp -hR www-data ./;sudo chmod -R 777 ./

php bin/magento cache:disable
php bin/magento cache:flush

test -d ./var/di && sudo rm -r ./var/di
test -d ./var/generation && sudo rm  -rf ./var/generation/*
test -d ./pub/static/frontend && sudo rm -rf ./pub/static/frontend
test -d ./var/view_preprocessing && sudo rm -rf ./var/vew_preprocessing

php bin/magento setup:upgrade
php bin/magento setup:di:compile

sudo chown -R www-data: ./;sudo chgrp -hR www-data ./;sudo chmod -R 777 ./

php bin/magento cache:flush
php bin/magento setup:static-content:deploy

sudo chown -R www-data: ./;sudo chgrp -hR www-data ./;sudo chmod -R 777 ./
