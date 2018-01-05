#!/usr/bin/env bash

CURRENT_DIR=$(dirname $(readlink -f $0))
PKG_ISOCODES_DIR=$CURRENT_DIR/build/iso-codes
MESSAGES_PATH=$CURRENT_DIR/messages
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
rm -rf $MESSAGES_PATH
mkdir -p $MESSAGES_PATH
rm -rf $DATABASES_DIR
mkdir -p $DATABASES_DIR

# move database files
cp $PKG_ISOCODES_DIR/data/iso_*.json $DATABASES_DIR

# move locale message files
for database_file in `ls -1 $DATABASES_DIR`; do
    database_name=`echo $database_file | sed "s/.json//g"`
    gettext_domain=`echo $database_name | sed "s/iso_//g"`
    source_locale_dir=$PKG_ISOCODES_DIR/$database_name
    for locale_file in `ls -1 $source_locale_dir | grep .po`; do
        locale_name=`echo $locale_file | sed "s/.po//g"`
        # copy locale file
        target_locale_dir=$MESSAGES_PATH/$locale_name/LC_MESSAGES
        mkdir -p $target_locale_dir
        cp ${source_locale_dir}/${locale_file} ${target_locale_dir}/${gettext_domain}.po
        msgfmt ${target_locale_dir}/${gettext_domain}.po -o ${target_locale_dir}/${gettext_domain}.mo
    done;
done

# start tests
composer.phar test

# update version in README.md
cd $PKG_ISOCODES_DIR
VERSION=`git describe --tags`
BUILD_DATE=`date "+%Y-%m-%d %H:%M"`
cd $CURRENT_DIR
sed -i -E "s/Database version: .*/Database version: ${VERSION} from ${BUILD_DATE}/" README.md

# success
if [[ $? -eq 0 ]]; then
    echo -e "\033[0;32m\n\nDatabase successfully updated. Verify difference and commit.\033[0m\n\n"
fi



