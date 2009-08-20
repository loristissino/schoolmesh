#!/bin/bash

CONFIG_READ=0
source /var/schoolmesh/config/schoolmesh.rc $@
if [ $CONFIG_READ -ne 1 ]; then echo "Error in reading configuration"; exit 1; fi

for GROUP in docenti allievi ds dsga ata
	do
		if getent group $GROUP; then
			echo 'group ' $GROUP ' exists'
		else
			echo 'adding group ' $GROUP '...'
			sudo groupadd -r $GROUP
		fi
	done

sudo service quota stop
sudo umount "$POSIX_HOMEDIR"
sudo chmod -v 755 "$POSIX_HOMEDIR"
sudo chown -v root:root "$POSIX_HOMEDIR"
sudo mount -v -t ext3 -o loop,acl,usrjquota=aquota.user,jqfmt=vfsv0 /home/discovirtuale "$POSIX_HOMEDIR"
sudo quotacheck -avug
sudo service quota start

for USER in antonio.d loris.tissino john.test francesco.g bianca.b juri.d marin.djakovo vincenzo.decarolis marcis.decarrabas enzo.dalo wladyslaw.leczewski kenny.mcbain finn.myklegaard susanne.zacharias flavia.g helen.abram gabriella.v pinco pinco2
	do
		if getent passwd $USER; then
			echo 'removing user ' $USER '...'
			sudo userdel -r $USER
		fi
	done

cd "$POSIX_HOMEDIR"
pwd

sudo find -type d -name "$POSIX_BASEFOLDER" -exec chattr -i {} \;
sudo find -type d -exec rm -r {} \;


