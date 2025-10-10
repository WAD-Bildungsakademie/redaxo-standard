#!/bin/bash

# Check if podman machine is running, if not initialize as rootful (required for port 80)
if ! podman info > /dev/null 2>&1; then
    echo "Initializing Podman machine in rootful mode (required for port 80)..."
    podman machine init --rootful
    podman machine start
fi

# Ensure log directories exist
mkdir -p ./volumes/log/mysql
mkdir -p ./volumes/log/php

# Start services with build
podman compose --env-file compose.env up --build

