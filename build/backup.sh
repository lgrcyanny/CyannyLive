#!/bin/sh
export DATABASE_DIR=/Users/lgrcyanny/Sites/myblog/wp-content/backup-db
cd $DATABASE_DIR
mysqldump -u root -proot cyannyblog > temp-db.sql
sed 's%http://cyanny/myblog%http://www.cyanny.com%g' temp-db.sql > db.sql
tar -czvf db.tar.gz db.sql
rm db.sql
rm temp-db.sql