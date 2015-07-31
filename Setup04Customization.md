# Customization #

The most important settings concern the way a user is authenticated and where some files are kept.

Edit the following files:

  * _apps/frontend/config/app.yml_ (frontend application configuration)
  * _apps/backend/config/app.yml_ (backend application configuration)
  * the _templates_ of the documents and of the emails (that should be in _templates_)

By pointing your browser to the page http://localhost/index.php/content/checksetup you should see the current configuration.

If you change something, clear the cache in order to see the results:

```
symfony cc
```

## Authentication ##

User authentication can be done with different methods.

In the file app.yml you may specify the username/password checking method to call:

```
  sf_guard_plugin:
#    check_password_callable: [Authentication, testOnly]

# Choose one of the following functions:
# testOnly: all users are authenticated whatever password (but null) they provide
# checkDBPassoword: users are authenticated against the internal DB
# checkLdapPassword: users are authenticated against a LDAP server, specified in the lines below
# checkSambaPassword: users are authenticated against a Samba server (probably working also against a Windows authentication server)
# checkFirstSambaThenDBPassword: it they have a Samba Account, users are authenticated with that, otherwise against the DB

  authentication:
    ldap_host: localhost
    ldap_domain: dc=example,dc=com
    samba_share: //example_server/homes
    samba_address: 127.0.0.1
```

If you don't specify anything, a classical database lookup is done.

## POSIX configuration ##

Edit the configuration of POSIX accounts under the file _config/schoolmesh.rc_, if you want SchoolMesh to create POSIX accounts for your users:

```
# This file contains settings for schoolmesh-related shell scripts (schoolmesh_*).
# It must be sourced in order to have a common configuration.

if [ $# -eq 0 ]
	then
		echo "This script is a wrapper. See schoolmesh(1) for details."
		exit 1
	fi

CONFIG_READ=1
POSIX_HOMEDIR=/home/testhome
POSIX_HOMEDIR_USERS="$POSIX_HOMEDIR/users"
POSIX_HOMEDIR_TEAMS="$POSIX_HOMEDIR/teams"
POSIX_BASEFOLDER=Mattiussi
POSIX_BASEFOLDER_OWNER=root:root
POSIX_DEFAULT_QUOTA_SBQ=2000
POSIX_DEFAULT_QUOTA_HBQ=3000
POSIX_DEFAULT_QUOTA_SFQ=1000
POSIX_DEFAULT_QUOTA_HFQ=1500

# DO NET EDIT PASS THIS LINE
```

Edit the lines as needed

## Administration ##

In order to allow the web server to query the system about the users, it must be configured to perform some operations with _sudo_.

In the file _apps/frontend/config/app.yml_ two lines might be changed:

```
  system:
    commands_view: true
    commands_apply: false
```

## Layout customization ##

Some changes may be done by editing the _app.yml_ file.

The logo of the school is in file _web/images/logo.png_.

The main layout is in the file _apps/frontend/templates/layout\_orig.php_.
Do not edit this. It's better to create a new one and make a symbolic link to _layout.php_.

## Localization ##

The application can be easily localized in other languages. Contact the author if you need information about this.
