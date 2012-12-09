#!/bin/bash
cd /var/schoolmesh
LIST=$(find . -iname '*dist')
for FILE in $(echo $LIST); do 
#  echo    'Dist-file: ' $FILE
  REALNAME=${FILE%-dist}
  test -f "$REALNAME" && echo -n 'OK:         ' || echo -n 'MISSING:    '
  echo    $REALNAME
done

