#!/bin/bash

DB_USER="root"
DB_PASS="d3v_p455"
DB_NAME="redaxo_main"
DB_HOST="localhost"

# Create tmp directory if it doesn't exist
mkdir -p ./tmp

# Export database with date in filename
mysqldump -h $DB_HOST -u $DB_USER -p$DB_PASS $DB_NAME > "/mnt/share/tmp/$DB_NAME-$(date +%Y-%m-%d).sql"

echo "Database exported to /mnt/share/tmp/$DB_NAME-$(date +%Y-%m-%d).sql"