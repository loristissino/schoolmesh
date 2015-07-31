# Apache web server configuration #

The following instructions assume that the installation directory is _/var/schoolmesh_. If you have a different configuration, change them accordingly.

We will create a specific file for _schoolmesh_, instead of changing the _default_ settings.

1. Download the file _schoolmesh_, add it to the sites-available section of apache configuration and restart the server::

```sh

wget http://schoolmesh.googlecode.com/svn/trunk/utilities/ubuntu10.04LTS/apache2/schoolmesh -O /tmp/schoolmesh
sudo mv /tmp/schoolmesh /etc/apache2/sites-available
sudo chown root:root /etc/apache2/sites-available/schoolmesh
sudo chmod 644 /etc/apache2/sites-available/schoolmesh
sudo a2ensite schoolmesh
sudo service apache2 restart
```

2. If you have a path in the URL different from _/schoolmesh_, you might need to change the _web/.htaccess_ file in the line with the _RewriteRule_:

```
  RewriteRule ^(.*)$ /schoolmesh/index.php [QSA,L]
```

3. Edit the PHP configuration files (_/etc/php5/apache2/php.ini_ e _/etc/php5/cli/php.ini_) so that they contain the following settings:

```
short_open_tag = Off
```

Commmand:

```
sudo vi /etc/php5/apache2/php.ini
sudo vi /etc/php5/cli/php.ini
```

4. Restart the web server.

Command:

```
sudo service apache2 restart
```

5. If you desire it, configure _sudo_ so that the user _www-data_ may get information from the system about users and their directories.

The file _/etc/sudoers_ (that has to be edited with `sudo visudo`!) should contain the following lines:

```
# User alias specification
User_Alias WEBSERVER=www-data

# Cmnd alias specification
Cmnd_Alias SCHOOLMESH_INFO = /usr/bin/stat, /usr/bin/lsattr, /usr/bin/getfacl, /usr/bin/quota, /usr/bin/chage --list, /usr/bin/pdbedit -Lvu *

Cmnd_Alias SCHOOLMESH_RESETSAMBAPASSWORD = /usr/bin/smbpasswd
Cmnd_Alias SCHOOLMESH_RESETLOGINPASSWORD = /usr/sbin/chpasswd

# Cmnd_Alias SCHOOLMESH_APPLY = /usr/local/bin/schoolmesh*

Cmnd_Alias SCHOOLMESH_POSIXFOLDER = /bin/cp /home/users/*, /bin/chmod, /usr/bin/test, /usr/bin/stat, /usr/bin/file, /usr/bin/find, /bin/mkdir, /bin/rm

# User privilege specification
root    ALL=(ALL) ALL

# Members of the admin group may gain root privileges
%admin    ALL=(ALL) ALL
WEBSERVER ALL=NOPASSWD: SCHOOLMESH_INFO, SCHOOLMESH_APPLY, SCHOOLMESH_POSIXFOLDER
```

Remove the symbol `#` from the line

```
# Cmnd_Alias SCHOOLMESH_APPLY = /usr/local/bin/schoolmesh*
```

only if you want that SchoolMesh executes some scripts directly (**not recommended at the moment**).

## SSL ##

(To be completed)

Enable ssl module of Apache:

```
$ sudo a2enmod ssl
Module ssl installed; run /etc/init.d/apache2 force-reload to enable.

$ sudo /etc/init.d/apache2 force-reload
 * Reloading web server config apache2                                   [ OK ] 

```

