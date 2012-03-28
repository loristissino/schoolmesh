#!/bin/bash
#This script is used to update the demo application on a Ubuntu10.04LTS server.

STARTDIR=/var/schoolmesh

for DIR in apps bin config data doc error graph plugins templates utilities web
  do
    cd "$STARTDIR/$DIR"
    echo "Updating $STARTDIR/$DIR..."
    svn update
  done

rm -rf "$STARTDIR/utilities/ubuntu10.04LTS/setup.sh" # we remove this file because it is dangerous
sudo cp -v "$STARTDIR"/bin/schoolmesh* /usr/local/bin
  
STARTDIR="$STARTDIR/lib"
for DIR in account  email  filter  form  helper  model  schoolmesh  task  test
  do
    cd "$STARTDIR/$DIR"
    echo "Updating $STARTDIR/$DIR..."
    svn update
  done


