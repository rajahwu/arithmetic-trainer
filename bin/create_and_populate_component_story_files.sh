#!/bin/bash

# Source and destination directories
source_dir="resources/js/Components"
dest_dir="stories/Components"

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
        echo "import $filename from '../../resources/js/Components/$filename';" >> "$dest_dir/$filename.stories.tsx"
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
