#!/bin/sh
export DATABASE_DIR=databases
mysqldump -u root -proot cyannyblog > $DATABASE_DIR/db.sql
tar -czvf $DATABASE_DIR/db.tar.gz $DATABASE_DIR/db.sql
rm $DATABASE_DIR/db.sql