#!/bin/bash

#
# How to exclude files from svn commits:
# cd to a directory
# edit a text file, called "ignore.txt" (or whatever) in it
# write the list of the files you want to ignore (*.o is ok)
# svn propset svn:ignore -F ignore.txt .
# If you want to have a confirmation, try
# svn status --no-ignore
#

# should use svn:property instead of this!

svn status | grep ^? | \
grep -v 'cache' | \
grep -v 'web/uploads' | \
grep -v 'web/images/sources' | \
grep -v 'lib/vendor/symfony' | \
sed 's/^?      //'
