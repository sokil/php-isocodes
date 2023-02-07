#!/usr/bin/env bash

#############################################################################
#                                                                           #
#    Update database on specified place.                                    #
#                                                                           #
#    This script may be used by any who want to update database             #
#    more frequently by himself.                                            #
#                                                                           #
#    Usage: ./bin/update_iso_codes_db.sh {mode} {base_dir} [{build_dir}]    #
#    mode: REQUIRED, "all" or "db_only", all updates also i18n files        #
#    base_dir: REQUIRED, dir where database and i18n messages stored        #
#    build_dir: OPTIONAL, dir where database and i18n messages              #
#               prepared, by default is "/tmp/iso-codes-build"              #
#############################################################################

CURRENT_DIR=$(dirname $(readlink -f $0))

PKG_ISOCODES_REPO="https://salsa.debian.org/iso-codes-team/iso-codes.git"

UPDATE_MODE=${1:-all}
BASE_DIR=$2
TMP_BUILD_DIR=${3:-/tmp/iso-codes-build}

# Prepare project dir
if [[ -z $BASE_DIR ]]; then
    echo -e "[Update] Base directory not specified"
    exit 1
else
    if [[ ! -d $BASE_DIR ]]; then
        # if not exists, create
        mkdir -p $BASE_DIR
    fi

    if [[ ! -w $BASE_DIR ]]; then
        echo -e "[Update] Passed base directory \033[0;31m${BASE_DIR}\033[0m is not writable"
        exit 1
    fi
fi

# Prepare build dir
if [[ ! -d $TMP_BUILD_DIR ]]; then
    # if not exists, create
    mkdir -p $TMP_BUILD_DIR
fi

if [[ ! -w $TMP_BUILD_DIR ]]; then
    echo -e "[Update] Passed base directory \033[0;31m${TMP_BUILD_DIR}\033[0m is not writable"
    exit 1
fi

echo -e "[Update] Build directory is \033[0;31m${TMP_BUILD_DIR}\033[0m"

# Clone from source debian repo
echo -e "[Update] \033[0;32mFetch changes from debian's repository\033[0m"

if [[ -d $TMP_BUILD_DIR/.git ]]; then
    cd $TMP_BUILD_DIR
    git pull origin main
    if [[ $? != 0 ]]; then
        echo -e "[Update] Can not pull from remote repository in \033[0;31m${TMP_BUILD_DIR}\033[0m, you may remove this dir manually"
        exit 1
    fi
    cd - > /dev/null
else
    mkdir -p $TMP_BUILD_DIR
    cd $TMP_BUILD_DIR
    git clone $PKG_ISOCODES_REPO $TMP_BUILD_DIR
    if [[ $? != 0 ]]; then
        echo -e "[Update] Can not clone repository to \033[0;31m${TMP_BUILD_DIR}\033[0m"
        exit 1
    fi
fi

# print source repo version
VERSION=`git describe --tags`

if [[ $? != 0 ]]; then
    echo -e "[Release] Can not detect database version"
    exit 1
fi

echo -e "[Update] New source repo version is $VERSION"

# define target database dir
DATABASES_DIR="${BASE_DIR}/databases"
echo -e "[Update] \033[0;32mDatabase directory: \033[0m ${DATABASES_DIR}"

# define target messages dir
MESSAGES_DIR="${BASE_DIR}/messages"
echo -e "[Update] \033[0;32mMessages directory: \033[0m ${MESSAGES_DIR}"

# update database
update_database () {
  echo -e "[Update] \033[0;32mCopy database files to target dir ${DATABASES_DIR}\033[0m"

  # clear previous database files
  rm -rf $DATABASES_DIR
  mkdir -p $DATABASES_DIR

  # move database files
  cp $TMP_BUILD_DIR/data/iso_*.json $DATABASES_DIR

  # database postprocessing
  echo -e "[Update] \033[0;32mDatabase post-processing\033[0m"

  # Split ISO 3166-2 to per-country files
  echo -e "   * Split ISO 3166-2 database"
  php $CURRENT_DIR/iso_3166-2_split.php $DATABASES_DIR

  # Split ISO639-3 to chunks
  echo -e "   * Split ISO 639-3 database"
  php $CURRENT_DIR/iso_639-3_split.php $DATABASES_DIR

  # license
  echo -e "This files is part of Debian's iso-codes library.\nSee license agreement at ${PKG_ISOCODES_REPO}" > $DATABASES_DIR/LICENSE
}

# move locale message files
update_i18n() {
  echo -e "[Update] \033[0;32mCopy message files to target dir ${MESSAGES_DIR}\033[0m"

  # clear previous locales files
  rm -rf $MESSAGES_DIR
  mkdir -p $MESSAGES_DIR

  for database_file in `find $DATABASES_DIR -maxdepth 1 -type f -name "*.json" -printf "%f\n"`; do
      database_name=`echo $database_file | sed "s/.json//g"`
      gettext_domain=`echo $database_name | sed "s/iso_//g"`
      source_locale_dir=$TMP_BUILD_DIR/$database_name

      echo -e "   * Copying ${source_locale_dir} to ${MESSAGES_DIR} ..."

      for locale_file in `ls -1 $source_locale_dir | grep .po`; do
          locale_name=`echo $locale_file | sed "s/.po//g"`
          # copy locale file
          target_locale_dir=$MESSAGES_DIR/$locale_name/LC_MESSAGES
          mkdir -p $target_locale_dir
          cp ${source_locale_dir}/${locale_file} ${target_locale_dir}/${gettext_domain}.po
          msgfmt ${target_locale_dir}/${gettext_domain}.po -o ${target_locale_dir}/${gettext_domain}.mo
      done;
  done

  # license
  echo -e "This files is part of Debian's iso-codes library.\nSee license agreement at ${PKG_ISOCODES_REPO}" > $MESSAGES_DIR/LICENSE
}

update_database

if [[ $UPDATE_MODE != "db_only" ]]; then
  update_i18n
fi

exit 0
