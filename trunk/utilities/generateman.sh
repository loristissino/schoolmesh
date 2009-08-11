#!/bin/bash

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

