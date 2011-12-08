#!/bin/bash
#This script is used to update the demo application on a Ubuntu10.04LTS server.

STARTDIR=/var/schoolmesh

for DIR in apps bin config data doc error graph plugins templates utilities
  do
    cd "$STARTDIR/$DIR"
    echo "Updating $STARTDIR/$DIR..."
    svn update
  done
  
STARTDIR="$STARTDIR/lib"
for DIR in account  email  filter  form  helper  model  schoolmesh  task  test
  do
    cd "$STARTDIR/$DIR"
    echo "Updating $STARTDIR/$DIR..."
    svn update
  done

STARTDIR="$STARTDIR/web"
cd "$STARTDIR"
echo "Updating $STARTDIR"
svn update

