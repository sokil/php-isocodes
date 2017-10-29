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
mkdir -p $LOCALES_DIR
rm -rf $DATABASES_DIR
mkdir -p $DATABASES_DIR

# move database files
cp $PKG_ISOCODES_DIR/data/iso_*.json $DATABASES_DIR

# move locale files
for database_file in `ls -1 $DATABASES_DIR`; do
    database_name=`echo $database_file | sed "s/.json//g"`
    source_locale_dir=$PKG_ISOCODES_DIR/$database_name
    for locale_file in `ls -1 $source_locale_dir | grep .po`; do
        locale_name=`echo $locale_file | sed "s/.po//g"`
        # copy locale file
        target_locale_dir=$CURRENT_DIR/locales/$locale_name/LC_MESSAGES
        mkdir -p $target_locale_dir
        cp ${source_locale_dir}/${locale_file} ${target_locale_dir}/${database_name}.po
        msgfmt ${target_locale_dir}/${database_name}.po -o ${target_locale_dir}/${database_name}.mo
    done;
done

# start tests
composer.phar test

# success
if [[ $? -eq 0 ]]; then
    echo -e "\033[0;32m\n\nDatabase successfully updated. Verify difference and commit.\033[0m\n\n"
fi



