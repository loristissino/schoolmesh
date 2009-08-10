#!/bin/bash
FILENAME=symfonylib_`date +%Y%m%d_%H%M%S`.tar.bz2
DESTINATION=/var/schoolmesh/mysymfony


cd "$DESTINATION"


fakeroot tar cjPvf "$FILENAME" /usr/share/php/symfony /var/schoolmesh/lib/vendor /var/schoolmesh/plugins /usr/bin/symfony
md5sum *bz2 > MD5SUMS.txt


