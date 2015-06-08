# db2cloud
Backup your db (mysql, mongo) to cloud (google cloud storage)

##Formats
* %host - computers host
* %rand - random value
* d, D, Y, y - Year, month, etc.

##Example

```bash
#MongoDB
db2cloud mongodb "mongodb_backup/%host/%Y/%m/backup-%rand.zip" --db database_name --gsutil="/usr/bin/gsutil"

#MySQL
db2cloud mysql "mongodb_backup/%host/mysql.sql.gz" --mysqldump="/usr/local/mysql/bin/mysqldump" --user="root" --pass="securePassword" --db="database_name"
```

You can mix it with crontab for cyclic backups!
