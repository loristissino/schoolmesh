#!/bin/bash
FN="saved_stuff_`date +'%Y%m%d_%H%M%S'`.tgz"
tar cvzf $FN config data apps
uuenview -m loris.tissino@mattiussilab.net -s "$FN" $FN
rm $FN

