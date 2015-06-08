# db2cloud
Backup your db (mysql, mongo) to cloud (google cloud storage)

##Formats
* %host - computers host
* %rand - random value
* d, D, Y, y, etc... - dates

##Example

```bash
db2cloud mongodb "mongodb_backup/%host/%Y/%m/backup-%rand.zip" --db database-name --gsutil="/usr/bin/gsutil"
```