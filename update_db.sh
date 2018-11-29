#!/usr/bin/env bash

CURRENT_DIR=$(dirname $(readlink -f $0))
PKG_ISOCODES_DIR="${CURRENT_DIR}/build/iso-codes"
PKG_ISOCODES_REPO="https://salsa.debian.org/iso-codes-team/iso-codes.git"

if [[ -z $1 ]]; then
    UPDATE_BASE_DIR=$CURRENT_DIR
else
    UPDATE_BASE_DIR=$1

    if [[ ! -d $UPDATE_BASE_DIR ]]; then
        echo -e "Passed directory \033[0;31m${UPDATE_BASE_DIR}\033[0m is not exists"
        exit 1
    fi

    if [[ ! -w $UPDATE_BASE_DIR ]]; then
        echo -e "Passed directory \033[0;31m${UPDATE_BASE_DIR}\033[0m is not writable"
        exit 1
    fi
fi

MESSAGES_DIR="${UPDATE_BASE_DIR}/messages"
DATABASES_DIR="${UPDATE_BASE_DIR}/databases"

echo -e "\033[0;32mMessages directory: \033[0m ${MESSAGES_DIR}"
echo -e "\033[0;32mDatabase directory: \033[0m ${DATABASES_DIR}"

# update pkg-isocodes source
echo -e "\033[0;32mUpdate pkg-isocodes repository\033[0m"

if [[ -d $PKG_ISOCODES_DIR ]]; then
    git pull origin master
else
    mkdir -p $PKG_ISOCODES_DIR
    git clone $PKG_ISOCODES_REPO $PKG_ISOCODES_DIR/iso-codes
fi

# clear previous database and locales files
rm -rf $MESSAGES_DIR
mkdir -p $MESSAGES_DIR
rm -rf $DATABASES_DIR
mkdir -p $DATABASES_DIR

# move database files
echo -e "\033[0;32mCopy database files to target dir ${DATABASES_DIR}\033[0m"

cp $PKG_ISOCODES_DIR/data/iso_*.json $DATABASES_DIR

# move locale message files
echo -e "\033[0;32mCopy message files to target dir ${MESSAGES_DIR}\033[0m"

for database_file in `ls -1 $DATABASES_DIR`; do
    database_name=`echo $database_file | sed "s/.json//g"`
    gettext_domain=`echo $database_name | sed "s/iso_//g"`
    source_locale_dir=$PKG_ISOCODES_DIR/$database_name

    echo -e "   * Copying ${source_locale_dir} ..."

    for locale_file in `ls -1 $source_locale_dir | grep .po`; do
        locale_name=`echo $locale_file | sed "s/.po//g"`
        # copy locale file
        target_locale_dir=$MESSAGES_DIR/$locale_name/LC_MESSAGES
        mkdir -p $target_locale_dir
        cp ${source_locale_dir}/${locale_file} ${target_locale_dir}/${gettext_domain}.po
        msgfmt ${target_locale_dir}/${gettext_domain}.po -o ${target_locale_dir}/${gettext_domain}.mo
    done;
done

# add copyright notice
echo -e "This files is part of iso-codes library.\nSee license agreement at ${PKG_ISOCODES_REPO}" > $DATABASES_DIR/LICENSE
echo -e "This files is part of iso-codes library.\nSee license agreement at ${PKG_ISOCODES_REPO}" > $MESSAGES_DIR/LICENSE

# test updated database and message files
echo -e "\033[0;32mTest updated database\033[0m"

cd ${CURRENT_DIR}
COMPOSER_PATH=`which composer`
if [[ $? -eq 1 ]]; then
    COMPOSER_PATH=`which composer.phar`
    if [[ $? -eq 1 ]]; then
        echo -e "\033[0;31m\n\nCan not locate composer for testing build.\033[0m\n\n"
        exit 1
    fi
fi

$COMPOSER_PATH test

# message on success test
if [[ $? -eq 0 ]]; then
    echo -e "\033[0;32m\n\nDatabase successfully updated. Verify difference and commit.\033[0m\n\n"
fi

# update version in README.md
cd $PKG_ISOCODES_DIR
VERSION=`git describe --tags`
BUILD_DATE=`date "+%Y-%m-%d %H:%M"`
cd $CURRENT_DIR
sed -i -E "s/Database version: .*/Database version: ${VERSION} from ${BUILD_DATE}/" README.md
