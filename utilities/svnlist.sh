#!/bin/bash
svn status | grep ^? | grep -v 'cache' | grep -v 'lib/vendor' | grep -v 'web/uploads' | grep -v 'web/images/sources' | grep -v 'plugins' | grep -v 'mysymfony/' | sed 's/^?      //' #  | xargs svn add 

echo '====> plugins are excluded!' >&2

