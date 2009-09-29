#!/bin/bash

FILELIST=`mktemp`
echo "" > $FILELIST

cd /var/schoolmesh/bin/

for FILE in schoolmesh_*
	do
	if grep '^#@' $FILE >/dev/null; then
	echo "making man page for " $FILE "..."
	echo $FILE >> $FILELIST
	echo "" >>$FILELIST
	
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

	fi

	done


cd /var/schoolmesh/doc/pandoc.man

cat > schoolmesh.8 <<EOT
% SCHOOLMESH(8) Schoolmesh utilities User Manuals
% Loris Tissino
% September 29, 2009

# NAME

schoolmesh - command line utilities to be used with SchoolMesh web application 

# UTILITY LIST

# DESCRIPTION

These utilities are really only basic wrapper scripts to be used together with
SchoolMesh. The idea is to provide flexibility. For instance, instead of calling
directly __useradd__, we call __schoolmesh\_posixaccount\_create__. This way, if one day we 
need to change the behaviour needed to add a system user (for instance, using _ldap_,
or contacting a different server), we just need to change the wrapper scripts.

Each utility should have its own man page (work in progress).

# BUGS

Probably many.

# SEE ALSO

The SchoolMesh project is described at <http://schoolmesh.mattiussilab.net/>.
EOT

sed -i "/# UTILITY LIST/ r $FILELIST" schoolmesh.8

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

rm $FILELIST