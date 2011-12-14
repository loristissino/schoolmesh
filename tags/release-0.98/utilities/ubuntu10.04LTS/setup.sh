#!/bin/bash

OWNER=$(whoami)
INSTALLDIR=/var/schoolmesh
CONFIGDIR=/etc/schoolmesh

echo "Updating the sources..."
sudo apt-get update
echo "Upgrading installed software..."
sudo apt-get upgrade
echo "Installed needed software..."
sudo apt-get install subversion gawk pandoc php5-common php5-cli php5-gd \
php5-mcrypt libapache2-mod-php5 php5-ldap php5-mysql php5-xsl dialog \
apache2 apache2-utils mysql-server libdbd-mysql-perl libdbi-perl \
libhtml-template-perl libnet-daemon-perl libplrpc-perl \
mysql-client-5.1 mysql-server-5.1  phpmyadmin dbconfig-common \
libgd2-xpm libmcrypt4 quota tidy msttcorefonts

echo "Creating basic directories if necessary..."
[[ -d "$INSTALLDIR" ]] || sudo mkdir -v "$INSTALLDIR"

echo "Creating local configuration directories if necessary..."
# We create the local configuration directory if necessary
# (all local files must be kept here, in order to avoid conflicts when upgrading)
[[ -d "$CONFIGDIR" ]] || sudo mkdir -pv "$CONFIGDIR/apps/"{frontend,backend}/config && sudo mkdir -pv "$CONFIGDIR/config"

sudo chown -R $OWNER "$INSTALLDIR" "$CONFIGDIR"

cd "$INSTALLDIR"

echo "Downloading schoolmesh, symfony and zend libraries..."

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

cp -v "$INSTALLDIR/config/ProjectConfiguration.class.php-dist" "$INSTALLDIR/config/ProjectConfiguration.class.php"

for FILE in schoolmesh.rc databases.yml timeslots.yml; do
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

sudo mkdir -v "$INSTALLDIR"/data/lucene

sudo chown -R $OWNER:www-data "$INSTALLDIR"
sudo chown -R $OWNER:www-data "$CONFIGDIR"

sudo chmod -R 770 "$INSTALLDIR"/{cache,log}
sudo chmod -R 777 "$INSTALLDIR"/data/lucene

sudo chmod +x "$INSTALLDIR"/symfony
sudo ln -sf "$INSTALLDIR"/symfony /usr/local/bin/symfony



echo "SchoolMesh setup done."

