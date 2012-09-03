#!/bin/bash
BASICDIR=/var/schoolmesh

EXPR=$1

for FILE in $(find $BASICDIR -path '*.svn' -prune -o -name '*.php' | grep -v '.svn')
	do
		grep "$EXPR" "$FILE" > /dev/null
		if [[ $? -eq 0 ]]; then
			echo $FILE
		fi
	done
