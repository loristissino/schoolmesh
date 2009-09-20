#!/bin/bash

cd /var/schoolmesh/bin/

for FILE in schoolmesh_application_importtables 
	do
		cat > /tmp/$FILE <<EOT
% {}(8) Schoolmesh User Manuals
% Loris Tissino (loris.tissino@mattiussilab.net)
% August 6, 2009

EOT

	UPCASE=$(echo $FILE | tr [a-z] [A-Z])
	sed -i -e "s/{}/$UPCASE/" /tmp/$FILE

	grep '^#@' $FILE | sed -e 's/^#@ //' -e 's/^#@//' >> /tmp/$FILE

		cat >> /tmp/$FILE <<EOT

# BUGS

Probably many.

# SEE ALSO

The SchoolMesh project is described at <http://schoolmesh.mattiussilab.net/>.

EOT

		CMDNAME=$(echo $FILE | sed s/_/\\\\\\\\_/g)
		echo $CMDNAME
		sed -e "s/{}/$CMDNAME/g" -e "s/{-}/$FILE/" /tmp/$FILE > /var/schoolmesh/doc/pandoc.man/$FILE.8

	done

cd /var/schoolmesh/doc/pandoc.man

for FILE in *
	do
		SECTION=${FILE#*.}
		echo "Producing man page: $FILE (section $SECTION)..."
		pandoc -s --write man $FILE -o ../man/man$SECTION/$FILE
	done

for i in 1 8
	do
		sudo cp -v /var/schoolmesh/doc/man/man$i/* /usr/local/share/man/man$i/ 2>/dev/null
	done

