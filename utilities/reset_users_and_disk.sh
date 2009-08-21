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

for USER in bianca.b enzo.dalo paolo.stefanutti juri.daldan federico.missio asdasd juri.domodossola stefano.ospitino blip blip2 blip3 giulia.d alice.alessandrini bebe.lasow bianca.brindisi bob.bernardi bruna.bagala cristina.bonucci fabio.adriani francesco.genova giorgio.botto giorgio.simonacci juri.dom lucio.stelli marco.defilippis mario.rossi alessandra.tassanzg giorgio.piccoli giorgio.piccoletti bianca.benzo.dalo finn.myklegaard flavia.g francesco.g helen.abram john.test kenny.mcbain loris.tissino marcis.decarrabas marin.djakovo susanne.zacharias vincenzo.decarolis wladyslaw.leczewski
	do
		if getent passwd $USER; then
			echo 'removing user ' $USER '...'
			sudo userdel -r $USER
		fi
	done

cd "$POSIX_HOMEDIR"
pwd

sudo find . -type d -name "$POSIX_BASEFOLDER" -exec chattr -i {} \;
sudo find . -mindepth 1 -type d -exec rm -r {} \;


