#!/bin/bash
#This script is used to update the demo application on a Ubuntu10.04LTS server.

STARTDIR=/var/schoolmesh

for DIR in apps bin config data doc error graph plugins templates utilities web
  do
    cd "$STARTDIR/$DIR"
    echo "Updating $STARTDIR/$DIR..."
    svn update
  done

# we remove these files because they are dangerous
rm -rf "$STARTDIR/utilities/ubuntu10.04LTS/setup.sh"
rm -rf "$STARTDIR/bin/schoolmesh_application_createtables"
rm -rf "$STARTDIR/bin/schoolmesh_application_importtables"

# we copy the other ones
sudo cp -v "$STARTDIR"/bin/schoolmesh* /usr/local/bin
  
STARTDIR="$STARTDIR/lib"
for DIR in account  email  filter  form  helper  model  schoolmesh  task  test
  do
    cd "$STARTDIR/$DIR"
    echo "Updating $STARTDIR/$DIR..."
    svn update
  done

cd "$STARTDIR"
grep Release doc/notes.txt | head -1 > doc/lastrevision.txt
echo " - svn revision: " >> doc/lastrevision.txt
LANG=C svn info doc/notes.txt | grep Revision | cut -d: -f2 >> doc/lastrevision.txt
