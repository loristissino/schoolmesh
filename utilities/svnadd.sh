#!/bin/bash
svn stat | grep ^? | grep -v cache | grep -v 'lib/vendor' | sed 's/^?      //' | xargs svn add 
