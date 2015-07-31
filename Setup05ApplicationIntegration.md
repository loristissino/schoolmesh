# Application integration with Samba, Squid, etc. #

Network logon and logoff of users authenticated by Samba may be recognized by SchoolMesh in what is called "light authentication".

You just need to edit _sbm.conf_ file adding some lines saying what to do when a user accesses their home directory.

```
[homes]
  ... 
	root preexec =  /usr/bin/wget --no-check-certificate --post-data 'token=AtOkEn2kIp' https://schoolmeshserver/schoolmesh/index.php/lanlogon/username/%U/ip/%I/workstation/%m -O /tmp/logon%U.%m.%I.html
	root postexec = /usr/bin/wget --no-check-certificate --post-data 'token=AtOkEn2kIp' https://schoolmeshserver/schoolmesh/index.php/lanlogoff/username/%U/ip/%I/workstation/%m -O /tmp/logoff%U.%m.%I.html 

```

Doing that, when a user logs on or logs off on a local area network machine, the web application is called with a POST like the following:

```
  https://schoolmeshserver/schoolmesh/index.php/lanlogoff/username/filippo.monti/ip/192.168.1.12/workstation/pc12labinf1
```

The POST contains a secret token, that must be the same as the one specified in the file _app.yml_.

If a user has the internet credential, their machine is automatically enabled to access the web.

## Disk quotas and ACL ##

You might want to use SchoolMesh to see and set disk quotas of your users, and to use ACLs.

The file _/etc/fstab_ could need to be edited in order to have _usrquota_ and _acl_ settings.

Example:

```
# /dev/sdb5
UUID=73c413d6-a6d6-4279-ad84-0255d1db83de /home ext3 relatime,defaults,usrquota,acl       0       2
```