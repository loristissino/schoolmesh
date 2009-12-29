#!/bin/bash
svn status | grep ^? | grep -v 'cache' | grep -v 'web/uploads' | grep -v 'web/images/sources' | sed 's/^?      //' #  | xargs svn add 


