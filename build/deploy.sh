#!/bin/bash
#export BLOG_ROOT_DIR="$( cd "$(dirname "$( dirname "${BASH_SOURCE[0]}" )")" && pwd )"
export BLOG_ROOT_DIR=/var/www/html/cyannyblog
export BLOG_DATABASES_DIR=$BLOG_ROOT_DIR/wp-content/backup-db
# Git update
rm -Rf cyannyblog
git clone git@github.com:lgrcyanny/CyannyLive.git cyannyblog

# Change mod, grant access right
chmod -R 755 $BLOG_ROOT_DIR
chmod -R 775 $BLOG_ROOT_DIR/wp-content

# Add config
rm -f $BLOG_ROOT_DIR/wp-config.php
cp $BLOG_ROOT_DIR/wp-config-prod.php $BLOG_ROOT_DIR/wp-config.php

# Import data to mysql
cd $BLOG_DATABASES_DIR
tar -xvf db.tar.gz
mysql -u cyannyblog -pcyannyblog2013 -h localhost cyannyblog < db.sql