#!/bin/bash

# Check if source_dir and dest_dir arguments are provided
if [ $# -ne 2 ]; then
    echo "Usage: $0 <source_dir> <dest_dir>"
    exit 1
fi

# Assign provided arguments to source_dir and dest_dir variables
source_dir="$1"
dest_dir="$2"

# Change directory to the root of the project
cd /var/www/html/apps/Sites/arithmitic || exit

# Loop through each .tsx file in the source directory
for file in "$source_dir"/*.tsx; do
    # Extract the filename without extension
    filename=$(basename "$file" .tsx)
    
    # Check if a file with the same name already exists in the destination directory
    if [ ! -e "$dest_dir/$filename.stories.tsx" ]; then
        # Create an empty file with the new name in the destination directory
        touch "$dest_dir/$filename.stories.tsx"

        # Write the content to the newly created file
        echo "import type { Meta, StoryObject } from '@storybook/react';" > "$dest_dir/$filename.stories.tsx"
        echo "" >> "$dest_dir/$filename.stories.tsx"
        echo "import $filename from '../../$source_dir/$filename';" >> "$dest_dir/$filename.stories.tsx"
        echo "" >> "$dest_dir/$filename.stories.tsx"
        echo "const meta: Meta = {" >> "$dest_dir/$filename.stories.tsx"
        echo "    component: $filename," >> "$dest_dir/$filename.stories.tsx"
        echo "};" >> "$dest_dir/$filename.stories.tsx"
        echo "" >> "$dest_dir/$filename.stories.tsx"
        echo "export default meta;" >> "$dest_dir/$filename.stories.tsx"
        echo "type Story = StoryObject;" >> "$dest_dir/$filename.stories.tsx"
        echo "" >> "$dest_dir/$filename.stories.tsx"
        echo "export const Basic: Story = { }" >> "$dest_dir/$filename.stories.tsx"
    fi
done

echo "Files created and populated successfully."
