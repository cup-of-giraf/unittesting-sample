#!/usr/bin/env bash

# get root
SOURCE="${BASH_SOURCE[0]}"
while [ -h "$SOURCE" ] ; do SOURCE="$(readlink "$SOURCE")"; done
ROOT_DIR="$(dirname $( cd -P "$( dirname "$SOURCE" )" && pwd ))"
PREVIOUS_LOCATION=`pwd`
cd $ROOT_DIR

# get composer
if [ ! -f bin/composer.phar ] ; then
    curl -s https://getcomposer.org/installer | php -- --install-dir=bin
    chmod +x bin/consposer.phar
fi
php bin/composer.phar install


cd $PREVIOUS_LOCATION
