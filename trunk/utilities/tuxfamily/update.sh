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
echo "Updating $STARTDIR"
svn update

echo "Resetting the symlinks..."
ln -sfv ../php-include/plugins/sfJqueryReloadedPlugin/web/ sfJqueryReloadedPlugin
ln -sfv ../php-include/plugins/sfOdfPlugin/web/ sfOdfPlugin
ln -sfv ../php-include/lib/vendor/symfony/lib/plugins/sfPropelPlugin/web/ sfPropelPlugin
ln -sfv ../php-include/plugins/sfTCPDFPlugin/web/ sfTCPDFPlugin
ln -sfv ../php-include/lib/vendor/symfony/data/web/sf/ sf

cd images
for FILE in default delete desc edit error first last list new next previous tick
  do
    ln -sfv ../../php-include/lib/vendor/symfony/lib/plugins/sfPropelPlugin/web/images/$FILE.png $FILE.png
  done

ln -sfv ../../php-include/extra4demo/Arial.ttf Arial.ttf

cd ../../php-include/apps/frontend/templates
ln -sfv layout_demo.php layout.php


