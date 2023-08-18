#!/bin/bash

input_file="$1"
output_file="$2"

# Check if arguments are provided
if [ -z "$input_file" ] || [ -z "$output_file" ]; then
  echo "Please provide the input file path and the output file path."
  exit 1
fi

# Check if input file exists
if [ ! -f "$input_file" ]; then
  echo "The input file '$input_file' does not exist."
  exit 1
fi

# Read lines from the input file into an array
mapfile -t options < "$input_file"

jsonData="["

for option in "${options[@]}"; do
  label="$option"
  value="tsz-$option"
  optionData="{ \"label\": \"$label\", \"value\": \"$value\" }"
  jsonData="$jsonData $optionData,"
done

# Remove the trailing comma
jsonData="${jsonData%,}"

jsonData="$jsonData ]"

# Write the JSON to the output file
echo "$jsonData" > "$output_file"

echo "The JSON file '$output_file' has been successfully created."
