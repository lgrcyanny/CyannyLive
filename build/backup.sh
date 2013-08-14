#!/bin/sh
export DATABASE_DIR=/Users/lgrcyanny/Sites/myblog/wp-content/backup-db
cd $DATABASE_DIR
mysqldump -u root -proot cyannyblog > db.sql
tar -czvf db.tar.gz db.sql
rm db.sql