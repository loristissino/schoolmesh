#!/bin/bash
FILE="$1"
BASE=${1%.txt}
YML=$BASE.yml

/var/schoolmesh/utilities/convertwp.php "$FILE"
echo "cleaning $YML..."
sed -i \
-e 's|||g' \
-e 's|||g' \
-e 's|\\n\\n|<br />|g' \
-e 's|\\n|<br />|g' \
-e 's|\\n||g' \
-e 's|<br /><br />|<br />|g' \
-e 's|<br /><br />|<br />|g' \
-e 's|<br /><br />|<br />|g' \
-e 's|<br />"|"|g' \
-e 's|"<br />|"|g' \
-e "s|’|''|g" \
"$YML"


