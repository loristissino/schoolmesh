#!/bin/bash
svn stat | grep ^? | grep -v 'cache' | grep -v 'lib/vendor' | grep -v 'web/uploads' | grep -v 'web/images/sources' | grep -v 'plugins' | sed 's/^?      //'  | xargs svn add 
