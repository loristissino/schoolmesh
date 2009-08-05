#!/bin/bash

#for USER in antonio.d loris.tissino john.test francesco.g bianca.b juri.d marin.djakovo vincenzo.decarolis marcis.decarrabas enzo.dalo wladyslaw.leczewski kenny.mcbain finn.myklegaard susanne.zacharias flavia.g helen.abram gabriella.v pinco pinco2
#	do
#		if getent passwd $USER; then
#			echo 'removing user ' $USER '...'
#			sudo userdel -r $USER
#		fi
#	done


#for GROUP in docenti flavia lorist juri sambamachines alice bob studenti charlie allievi ds dsga ata
#
#	do
#		echo 'removing group' $GROUP '...'
#		sudo groupdel $GROUP
#
#	done

#exit


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
sudo umount /home/testhome
sudo chmod -v 755 /home/testhome
sudo chown -v root:root /home/testhome
sudo mount -v -t ext3 -o loop,acl,usrjquota=aquota.user,jqfmt=vfsv0 /home/discovirtuale /home/testhome
sudo quotacheck -avug
sudo service quota start

