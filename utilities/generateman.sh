#!/bin/bash

PANDOCMANDIR=/home/loris/Importanti/SchoolMesh/pandoc.man
WIKIFILE=/home/loris/Importanti/SchoolMesh/wiki/ManPage.wiki

FILELIST=`mktemp`
echo "" > $FILELIST

sudo rm -fv /usr/local/share/man/man8/schoolmesh*
sudo rm -fv $PANDOCMANDIR/schoolmesh*

cd /var/schoolmesh/bin/

# the sed stuff here is because otherwise the order is not ok 
for FILE in $(ls schoolmesh_*| sed 's/_/0/g' | sort | sed 's/0/_/g')
	do
	if grep '^#@' $FILE >/dev/null; then
	echo "making man page for " $FILE "..."
	
	DESCRIPTION=$(grep '^#@ {} - ' $FILE| head -1 | sed 's/^#@ {} - //')

	echo $FILE >> $FILELIST
	echo "- _$DESCRIPTION"_ >> $FILELIST
	echo "" >>$FILELIST
	
		cat > /tmp/$FILE <<EOT
% {}(8) Schoolmesh User Manuals
% Loris Tissino (loris.tissino@gmail.com)
% {DATE}

EOT

	UPCASE=$(echo $FILE | tr [a-z] [A-Z])
	sed -i -e "s/{}/$UPCASE/" /tmp/$FILE

	grep '^#@' $FILE | sed -e 's/^#@ //' -e 's/^#@//' >> /tmp/$FILE

		cat >> /tmp/$FILE <<EOT

# BUGS

Probably many.

# SEE ALSO

The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

EOT

		CMDNAME=$(echo $FILE | sed s/_/\\\\\\\\_/g)
		echo $CMDNAME
		
		FILEDATE=$(LANG=C date +'%B %Y' -r $FILE)
		
		sed -e "s/{}/$CMDNAME/g" -e "s/{-}/$FILE/" /tmp/$FILE > $PANDOCMANDIR/$FILE.8
		sed -i "s/{DATE}/$FILEDATE/" $PANDOCMANDIR/$FILE.8

	fi

	done


cd $PANDOCMANDIR

cat > schoolmesh.8 <<EOT
% SCHOOLMESH(8) Schoolmesh utilities User Manuals
% Loris Tissino <loris.tissino@gmail.com>
% $(LANG=C date +'%B %Y')

# NAME

schoolmesh - command line utilities to be used with SchoolMesh web application 

# UTILITY LIST

# DESCRIPTION

These utilities are really only basic wrapper scripts to be used
together with SchoolMesh. The idea is to provide flexibility. For 
instance, instead of calling directly __useradd__, we call 
__schoolmesh\_posixaccount\_create__. This way, if one day we need to 
change the behaviour needed to add a system user (for instance, 
using _ldap_, or contacting a different server), we just need to change
the wrapper scripts.

Each utility should have its own man page (work in progress).

# BUGS

Probably many.

# SEE ALSO

The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.
EOT

sed -i "/# UTILITY LIST/ r $FILELIST" schoolmesh.8

for FILE in *
	do
		SECTION=${FILE#*.}
		echo "Producing man page: $FILE (section $SECTION)..."
		pandoc -s --write man $FILE -o /var/schoolmesh/doc/man/man$SECTION/$FILE
		chmod 644 /var/schoolmesh/doc/man/man$SECTION/$FILE
	done

for i in 1 8
	do
		sudo cp -v --preserve=all /var/schoolmesh/doc/man/man$i/* /usr/local/share/man/man$i/ 2>/dev/null
	done

rm $FILELIST

cat > $WIKIFILE <<EOT
= Man Pages =

These are the man pages for the scripts used by the application and available for command line activities.

EOT

cd /usr/local/share/man

for i in 8
	do
		echo "Entering directory man$i"
		cd man$i

		for FILE in schoolmesh*
		do
      echo $FILE
			CMDNAME=${FILE%.8}
			echo considering $CMDNAME
			echo -e "== $CMDNAME ==\n" >> $WIKIFILE
			echo "{{{" >> $WIKIFILE
			man $CMDNAME | col -b >> $WIKIFILE
			echo "}}}" >> $WIKIFILE
			echo -e "\n\n" >> $WIKIFILE
		done
	done


MANLIST=$(mktemp)
CMDLIST=$(mktemp)

ls /var/schoolmesh/doc/man/man8 | sed 's/\.8$//' | grep -v '^schoolmesh$' | sort > $MANLIST
ls /var/schoolmesh/bin | sort > $CMDLIST

echo "-------------------"
echo "Commands to execute":
diff $MANLIST $CMDLIST | grep '^<' | sed -e 's-< -svn rm /var/schoolmesh/doc/man/man8/-' -e 's/$/.8/'

echo "-------------------"
echo "Man pages missing":
diff $MANLIST $CMDLIST | grep '^>'
