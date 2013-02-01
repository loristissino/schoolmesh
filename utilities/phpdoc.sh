#!/bin/bash
SOURCES=/var/schoolmesh/lib/model/,/var/schoolmesh/lib/schoolmesh/,/var/schoolmesh/lib/account/,/var/schoolmesh/lib/email/,/var/schoolmesh/lib/form/,/var/schoolmesh/plugins/sfOdfPlugin
TARGET=/home/loris/schoolmesh/phpdocs
DN=schoolmesh
phpdoc -o HTML:frames:earthli -d $SOURCES -i '*.svn/' -t $TARGET -dn $DN

