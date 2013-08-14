#!/bin/bash
export BLOG_ROOT_DIR="$( cd "$(dirname "$( dirname "${BASH_SOURCE[0]}" )")" && pwd )"
export BLOG_DATABASES_DIR=$BLOG_ROOT_DIR/build/databases
# Git update
git checkout -f
git pull origin master
# Change mod, grant access right
chmod -R 755 $BLOG_ROOT_DIR
chmod -R 775 $BLOG_ROOT_DIR/wp-content
# Add config
rm -f $BLOG_ROOT_DIR/wp-config.php
cp $BLOG_ROOT_DIR/wp-config-prod.php $BLOG_ROOT_DIR/wp-config.php
# Import data to mysql
tar -C $BLOG_ROOT_DIR/build -xvf $BLOG_DATABASES_DIR/db.tar.gz
mysql -u root -proot2013 -h localhost cyannyblog < $BLOG_DATABASES_DIR/db.sql