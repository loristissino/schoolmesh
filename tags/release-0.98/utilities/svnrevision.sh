#!/bin/bash

# there should be a better way - I mean, without checking the web server...

cd /var/schoolmesh
find apps lib config bin plugins web utilities doc ! -path '*.svn*' -exec  svn info {} \; 2>/dev/null| grep ^Revision: | cut -d: -f2 | sort -n | uniq | tail

