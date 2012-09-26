#!/bin/bash

cd /var/schoolmesh
symfony propel:graphviz

cd graph

TEMPFILE=$(mktemp)
dot -Tpng propel.schema.dot -o $TEMPFILE.png
convert $TEMPFILE.png -scale '50%x50%' propel.schema.png

mv -v propel.schema.png ~/Importanti/SchoolMesh/wiki

rm -f $TEMPFILE{,.png}
