#!/usr/bin/env bash

#############################################
#                                           #
#    Update internal database for           #
#    publishing to GitHub.                  #
#                                           #
#    Used only by library maintainers       #
#                                           #
#############################################

CURRENT_DIR=$(dirname $(readlink -f $0))
PROJECT_DIR=$CURRENT_DIR/..
PKG_ISOCODES_DIR="${PROJECT_DIR}/build/iso-codes"

# update database
$CURRENT_DIR/update_iso_codes_db.sh

# locate composer
cd ${PROJECT_DIR}
COMPOSER_PATH=`which composer`
if [[ $? -eq 1 ]]; then
    COMPOSER_PATH=`which composer.phar`
    if [[ $? -eq 1 ]]; then
        echo -e "\033[0;31m\n\nCan not locate composer for testing build.\033[0m\n\n"
        exit 1
    fi
fi

# if required, install composer dependencies
if [[ ! -d ${PROJECT_DIR}/vendor ]]; then
    $COMPOSER_PATH install
fi

# test updated database and message files
echo -e "\033[0;32mTest updated database\033[0m"
$COMPOSER_PATH test

# message on success test
if [[ $? -eq 0 ]]; then
    # get new version of library
    cd $PKG_ISOCODES_DIR
    VERSION=`git describe --tags`
    BUILD_DATE=`date "+%Y-%m-%d %H:%M"`
    cd $PROJECT_DIR

    # update version in README.md
    sed -i -E "s/Database version: .*/Database version: ${VERSION} from ${BUILD_DATE}/" README.md

    # success message
    echo -e "\033[0;32m\n\nDatabase successfully updated. Now you can verify difference, commit and add new release.\033[0m"
    echo -e "\033[0;32mDatabase version: ${VERSION} from ${BUILD_DATE}.\033[0m\n\n"
fi

