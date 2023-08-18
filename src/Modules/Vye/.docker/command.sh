#!/bin/bash

echo Running Volcator Mode Developpement.
echo Checking default packages ...;
DIR="/home/node/app/node_modules/"
if [ -d "$DIR" ]; then
  echo "Default package already installed."
  echo "Running Project."
else
  echo "Installing Packages ..."
  yarn install
  echo "Done"
fi
echo "Start Volcator ..."
yarn dev --mode development
