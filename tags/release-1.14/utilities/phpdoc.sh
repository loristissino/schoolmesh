#!/bin/bash
SOURCES=/var/schoolmesh/lib/model/
TARGET=/home/loris/schoolmesh/phpdocs
DN=schoolmesh
phpdoc -o HTML:frames:earthli -d $SOURCES -i '*.svn/' -t $TARGET -dn $DN

