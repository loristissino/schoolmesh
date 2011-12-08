#!/bin/bash

OWNER=$(whoami)
INSTALLDIR=/var/schoolmesh
CONFIGDIR=/etc/schoolmesh

echo "Creating the basic directories if necessary..."
[[ -d "$INSTALLDIR" ]] || sudo mkdir -v "$INSTALLDIR"

echo "Creating the local configuration directories if necessary..."
# We create the local configuration directory if necessary
# (all local files must be kept here, in order to avoid conflicts when upgrading)
[[ -d "$CONFIGDIR" ]] || sudo mkdir -pv "$CONFIGDIR/apps/"{frontend,backend}/config && sudo mkdir -pv "$CONFIGDIR/config"

sudo chown -R $OWNER "$INSTALLDIR" "$CONFIGDIR"

cd "$INSTALLDIR"

svn checkout http://schoolmesh.googlecode.com/svn/trunk/ "$INSTALLDIR"

if [[ $? -ne 0 ]]
  then
    echo 'Problems with downloading sources.'
    exit 1
  fi

echo "Copying man pages..."
for i in 1 8
  do
    sudo mkdir -p /usr/local/share/man/man$i
    sudo cp -lv /var/schoolmesh/doc/man/man$i/* /usr/local/share/man/man$i/ 2>/dev/null
  done

echo "Copying scripts..."
sudo cp  -lv bin/schoolmesh* /usr/local/bin

echo "Downloading Zend files..."
cd "$INSTALLDIR/lib/vendor/Zend"
cat README | bash

echo "Copying and linking main configuration files..."
for FILE in schoolmesh.rc databases.yml timeslots.yml ProjectConfiguration.class.php; do
  sudo cp -v "$INSTALLDIR/config/$FILE-dist" "$CONFIGDIR/config/$FILE"
  sudo ln -s "$CONFIGDIR/config/$FILE" "$INSTALLDIR/config/$FILE"
done

for FILE in app.yml factories.yml; do
  sudo cp -v "$INSTALLDIR/apps/frontend/config/$FILE-dist" "$CONFIGDIR/apps/frontend/config/$FILE"
  sudo ln -s "$CONFIGDIR/apps/frontend/config/$FILE" "$INSTALLDIR/apps/frontend/config/$FILE"
done

for FILE in app.yml; do
  sudo cp -v "$INSTALLDIR/apps/backend/config/$FILE-dist" "$CONFIGDIR/apps/backend/config/$FILE"
  sudo ln -s "$CONFIGDIR/apps/backend/config/$FILE" "$INSTALLDIR/apps/backend/config/$FILE"
done

sudo chown -R $OWNER:www-data "$INSTALLDIR"
sudo chown -R $OWNER:www-data "$CONFIGDIR"

sudo chmod -R 770 "$INSTALLDIR"/{cache,log}

echo "SchoolMesh setup done."

