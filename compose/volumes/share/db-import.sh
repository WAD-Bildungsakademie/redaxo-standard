#!/bin/bash

# Check if a file path is provided as an argument
if [ $# -ne 1 ]; then
    echo "Usage: $0 <sql-file-path>"
    exit 1
fi

# Check if the file exists
if [ ! -f "$1" ]; then
    echo "Error: File '$1' not found"
    exit 1
fi

# Import the SQL file
mysql -u root -pd3v_p455 < "$1"

# Check if the import was successful
if [ $? -eq 0 ]; then
    echo "SQL import completed successfully"
else
    echo "Error: SQL import failed"
    exit 1
fi