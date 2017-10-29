#!/usr/bin/env bash

CURRENT_DIR=$(dirname $(readlink -f $0))
PKG_ISOCODES_DIR=$CURRENT_DIR/build/iso-codes
LOCALES_DIR=$CURRENT_DIR/locales
DATABASES_DIR=$CURRENT_DIR/databases

# update pkg-isocodes source
if [[ -d $PKG_ISOCODES_DIR ]]; then
    cd $PKG_ISOCODES_DIR
    git pull origin master
else
    mkdir -p $PKG_ISOCODES_DIR
    cd $PKG_ISOCODES_DIR
    git clone https://anonscm.debian.org/git/pkg-isocodes/iso-codes.git .
fi

cd $CURRENT_DIR

# clear previous database and locales files
rm -rf $LOCALES_DIR
rm -rf $DATABASES_DIR

# move database files
cd $PKG_ISOCODES_DIR/data/iso_*.json $DATABASES_DIR

# start tests
composer.phar test

# success
if [[ $? -eq 0 ]]; then
    echo -e "\033[0;32m\n\nDatabase successfully updated. Verify difference and commit.\033[0m\n\n"
fi



