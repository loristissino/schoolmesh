#!/bin/bash

BASEDIR=/var/schoolmesh

sudo find "$BASEDIR" ! -user loris -exec chown loris  {} \;
sudo find "$BASEDIR" ! -group www-data -exec chgrp www-data  {} \;

sudo find "$BASEDIR" -type d ! -perm 2770 -exec chmod  2770 {} \;
sudo find "$BASEDIR" -type f ! -perm 660 -exec chmod 660 {} \;

cd "$BASEDIR/utilities"
chmod +x *sh *php

chmod +x "$BASEDIR/symfony"

sudo chmod 755 $BASEDIR/bin/*

sudo chmod 1777 /var/schoolmesh/cache/files/tmp

sudo cp --preserve=mode $BASEDIR/bin/* /usr/local/bin

~/bin/fixmattiussilab.sh
