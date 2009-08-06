#!/bin/bash
WORKFLOW=wpfr_workflow

php gd_generate $WORKFLOW

cd $WORKFLOW/target

for FILE in *png
	do
		BASENAME=`basename $FILE .png`
		convert "$FILE" -scale '128!x16!' "${BASENAME}r.png"
	done

mv *png /var/schoolmesh/web/images -v
