#!/bin/bash
sudo service quota stop
sudo umount /home/testhome || exit
sudo chmod -v 755 /home/testhome
sudo chown -v root:root /home/testhome
sudo mount -v -t ext3 -o loop,acl,usrjquota=aquota.user,jqfmt=vfsv0 /home/discovirtuale /home/testhome
sudo quotacheck -avug
sudo service quota start

