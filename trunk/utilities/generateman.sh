#!/bin/bash

cd /var/schoolmesh/doc
for file in *pandoc.txt
	do
		pandoc -s --write man $file -o ${file%pandoc.txt}1
	done

sudo cp -v /var/schoolmesh/doc/*1 /usr/local/share/man/man1/

