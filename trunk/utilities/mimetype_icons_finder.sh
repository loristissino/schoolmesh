#!/bin/bash

# Thanks to the site http://www.stdicon.com/, we'll get some 16x16 icons for known mime types.

IMAGEDIR="/var/schoolmesh/web/images/mimetypes"

TEMPFILE=$(mktemp)

for SET in crystal gartoon nuvola tango neu humility apache g-flat
	do 
		echo "--------------"
		echo "using set $SET"

		for TYPE in $(cat "$IMAGEDIR/list.txt")
			do
				echo -n $TYPE
				FILENAME=$(echo $TYPE | sed 's|/|_|').png
				if [[ -f "$IMAGEDIR/$FILENAME" ]]; then
					echo " -> already here... skipped"
				else
					wget http://www.stdicon.com/$SET/$TYPE?size=16 -O $TEMPFILE 2> /dev/null
					if [[ $? -eq 0 ]]; then
						cp $TEMPFILE "$IMAGEDIR/$FILENAME"
						echo " <- downloaded"
					else
						echo " ** MISSING"
					fi
				fi
		done

	done