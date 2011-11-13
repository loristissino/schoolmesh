#!/bin/bash
#This script is used to update the demo application on the tuxfamily.org server.

STARTDIR=/home/schoolmesh/schoolmeshdemo.tuxfamily.org-web/php-include

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

STARTDIR=/home/schoolmesh/schoolmeshdemo.tuxfamily.org-web/htdocs
cd "$STARTDIR"
svn update
