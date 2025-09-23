#!/bin/bash

# Redaxo Sync Script
# Uploads specific folders for Redaxo development

# ==============================================
# CONFIGURATION - Loaded from .env
# ==============================================

# Determine project root (directory of this script)
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ENV_FILE="$SCRIPT_DIR/.env"

# Load environment variables from .env if available
if [ -f "$ENV_FILE" ]; then
    # shellcheck disable=SC1090
    set -a
    . "$ENV_FILE"
    set +a
else
    echo "⚠️  Warning: .env file not found at $ENV_FILE. Using built-in defaults."
fi

# Server connection details (can be overridden in .env)
: "${SERVER:=92.205.175.59}"
: "${USERNAME:=wkwc1wgfc0c9}"

# Remote base path (where your Redaxo installation is located)
: "${REMOTE_BASE:=/home/wkwc1wgfc0c9/public_html/redaxo-standard}"

# Local base path (your local Redaxo project root)
: "${LOCAL_BASE:=$SCRIPT_DIR}"

# ==============================================
# FOLDER DEFINITIONS
# ==============================================

# Define the folders to sync (relative to base paths)
FOLDERS=(
    "web/assets/local"
    "web/redaxo/data/addons/developer"
    "web/redaxo/src/addons/project"
)

# ==============================================
# SYNC FUNCTION
# ==============================================

sync_folder() {
    local folder="$1"
    local local_path="$LOCAL_BASE/$folder"
    local remote_path="$REMOTE_BASE/$folder"

    echo "📁 Syncing: $folder"
    echo "   Local:  $local_path"
    echo "   Remote: $USERNAME@$SERVER:$remote_path"

    # Check if local folder exists
    if [ ! -d "$local_path" ]; then
        echo "   ⚠️  Warning: Local folder does not exist, skipping..."
        return 1
    fi

    # Sync with rsync
    rsync -avz --progress --delete \
        "$local_path/" \
        "$USERNAME@$SERVER:$remote_path/"

    if [ $? -eq 0 ]; then
        echo "   ✅ Successfully synced"
    else
        echo "   ❌ Error syncing folder"
        return 1
    fi
    echo ""
}

# ==============================================
# MAIN SCRIPT
# ==============================================

echo "🚀 Starting Redaxo Development Sync"
echo "=================================================="
echo "Server: $USERNAME@$SERVER"
echo "Remote Base: $REMOTE_BASE"
echo "Local Base: $LOCAL_BASE"
echo "=================================================="
echo ""

# Check if SSH key is set up (optional check)
ssh -o BatchMode=yes -o ConnectTimeout=5 "$USERNAME@$SERVER" exit 2>/dev/null
if [ $? -ne 0 ]; then
    echo "⚠️  Warning: SSH key authentication might not be set up."
    echo "   You may be prompted for password multiple times."
    echo ""
fi

# Sync each folder
for folder in "${FOLDERS[@]}"; do
    sync_folder "$folder"
done

echo "🎉 Sync completed!"
echo ""
echo "💡 Tips:"
echo "   - Configure SERVER, USERNAME, REMOTE_BASE, LOCAL_BASE in .env (project root)"
echo "   - Set up SSH keys to avoid password prompts"
echo "   - Use --dry-run flag with rsync for testing"