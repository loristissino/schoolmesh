#!/bin/bash

FILENAME=~/Desktop/schoolmesh$(date +%Y%m%d-%H%M%S).cpio
echo $FILENAME

/var/schoolmesh/utilities/svnshow.sh | sed 's/^.      //' | cpio --create > "$FILENAME"

md5sum "$FILENAME"

# To use the archive produced, just:

# cd /var/schoolmesh
# cpio -idv < FILENAME


