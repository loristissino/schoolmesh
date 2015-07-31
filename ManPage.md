# Man Pages #

These are the man pages for the scripts used by the application and available for command line activities.

## schoolmesh ##

```
SCHOOLMESH(8)																	      SCHOOLMESH(8)



NAME
       schoolmesh - command line utilities to be used with SchoolMesh web application

UTILITY LIST
       schoolmesh_application_createtables - Create empty tables for the database

       schoolmesh_application_dumptables - Backup data from the database in gzipped SQL format

       schoolmesh_application_importtables - Import data from a backup sql file

       schoolmesh_application_setstate - Enable/disable the application

       schoolmesh_loginaccount_changeshell - Change the shell for the login account of a user

       schoolmesh_loginaccount_getinfo - Get info about the login account of a user

       schoolmesh_loginaccount_setpassword - Change the login password for a user

       schoolmesh_loginaccounts_getshells - Get a list of available shells on the system

       schoolmesh_moodleaccount_create - Create a moodle account for a user

       schoolmesh_odf_check - Get a specific portion of an OpenOffice.org document's content.xml file

       schoolmesh_odf_converter - start, stop or show the status of Unoconv Odf converter

       schoolmesh_posixaccount_changefullname - Change full name for a posix account of a user

       schoolmesh_posixaccount_changegroup - Change the primary group of a user

       schoolmesh_posixaccount_changeusername - Change username for the posix account of a user

       schoolmesh_posixaccount_create - Create a posix account for a user

       schoolmesh_posixaccount_createbasefolder - Create the basefolder for a user

       schoolmesh_posixaccount_createhomedir - Create the home directory for a user

       schoolmesh_posixaccount_getinfo - Get info about the posix account of a user

       schoolmesh_posixaccount_lockuser - Lock a user

       schoolmesh_posixaccount_quotausercheck - Check if the quota of a user was exceeded

       schoolmesh_posixaccount_repairbasefolder - Repair the basefolder of a user

       schoolmesh_posixaccount_repairhomedir - Repair the basefolder of a user

       schoolmesh_posixaccount_setquota - Set the quota of a user

       schoolmesh_posixaccount_unlockuser - Unlock a user

       schoolmesh_posixaccounts_list - Get a list of posix users belonging to a specified group

       schoolmesh_posixaccounts_quotachecks - Get a list of users specifying who of them exceeds their quota

       schoolmesh_posixfolder_copyfile - Copy a user's file in cache, applying read permission for webserver

       schoolmesh_posixfolder_getinfo - Get info about a posix user's folder's contents

       schoolmesh_posixfolder_makedir - Make a directory in a user's home (sub)directory

       schoolmesh_posixfolder_putfile - Copy an uploaded file to a user's home (sub)directory

       schoolmesh_posixfolder_removefile - Remove a file from a user's home (sub)directory

       schoolmesh_sambaaccount_create - Create a samba account for a user

       schoolmesh_sambaaccount_delete - Delete a samba account for a user

       schoolmesh_sambaaccount_getinfo - Get info about the samba (SMB/CIFS) account of a user

       schoolmesh_sambaaccount_unlock - Unlock the samba (SMB/CIFS) account of a user

       schoolmesh_unoconv_launch - launch Unoconv and locks the screen at once

       schoolmesh_workstation_disableinternetaccess - Disable Internet access for a workstation

       schoolmesh_workstation_enableinternetaccess - Enable internet access for a workstation

       schoolmesh_workstation_removejobs - Remove all scheduled jobs for a workstation

       schoolmesh_workstations_getinternetenabled - Get the list of workstations for which Internet access is enabled

       schoolmesh_workstations_getjobs - Get the list of jobs scheduled for all the workstations

DESCRIPTION
       These  utilities  are  really only basic wrapper scripts to be used together with SchoolMesh.  The idea is to provide flexibility.  For instance, instead of
       calling directly useradd, we call schoolmesh_posixaccount_create.  This way, if one day we need to change the behaviour needed to add  a  system  user  (for
       instance, using ldap, or contacting a different server), we just need to change the wrapper scripts.

       Each utility should have its own man page (work in progress).

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino <loris.tissino@gmail.com>.




Schoolmesh utilities User Manuals					   December 2011							      SCHOOLMESH(8)
```



## schoolmesh\_application\_createtables ##

```
SCHOOLMESH_APPLICATION_CREATETABLES(8)											     SCHOOLMESH_APPLICATION_CREATETABLES(8)



NAME
       schoolmesh_application_createtables - Create empty tables for the database

SYNOPSIS
       schoolmesh_application_createtables environment [—no-confirmation]

DESCRIPTION
       Use  this  script to create empty tables in the database (using the schoolmesh symfony-generated script).  If the option —no-confirmation is set, the dialog
       with the confirmation question is not shown.

WARNINGS
       This will delete all the contents of the database.  Be sure to make a backup before using it.

EXAMPLES
       schoolmesh_application_createtables prod schoolmesh_application_createtables dev

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				     SCHOOLMESH_APPLICATION_CREATETABLES(8)
```



## schoolmesh\_application\_dumptables ##

```
SCHOOLMESH_APPLICATION_DUMPTABLES(8)											       SCHOOLMESH_APPLICATION_DUMPTABLES(8)



NAME
       schoolmesh_application_dumptables - Backup data from the database in gzipped SQL format

SYNOPSIS
       schoolmesh_application_dumptables environment outfile

DESCRIPTION
       This  script  makes  a backup of the data of SchoolMesh database, in the form of a SQL plaintext gzipped file, with foreign key checks disabled.  The output
       can be used with schoolmesh_application_importtables(8).

EXAMPLES
       schoolmesh_application_dumptables prod /var/backups/myfile.sql.gz

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				       SCHOOLMESH_APPLICATION_DUMPTABLES(8)
```



## schoolmesh\_application\_importtables ##

```
SCHOOLMESH_APPLICATION_IMPORTTABLES(8)											     SCHOOLMESH_APPLICATION_IMPORTTABLES(8)



NAME
       schoolmesh_application_importtables - Import data from a backup sql file

SYNOPSIS
       schoolmesh_application_importtables environment inputfile

DESCRIPTION
       Use  this script to import data into the database.  The input file SQL must be in gzipped format.  The output of schoolmesh_application_dumptables(8) should
       be adequate.

WARNINGS
       The database should have the tables, but empty.	It's possible to re-create the tables with schoolmesh_application_createtables(8).

EXAMPLES
       schoolmesh_application_importtables prod /var/backups/myfile.sql.gz

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				     SCHOOLMESH_APPLICATION_IMPORTTABLES(8)
```



## schoolmesh\_application\_setstate ##

```
SCHOOLMESH_APPLICATION_SETSTATE(8)												 SCHOOLMESH_APPLICATION_SETSTATE(8)



NAME
       schoolmesh_application_setstate - Enable/disable the application

SYNOPSIS
       schoolmesh_application_setstate enabled | disabled environment

DESCRIPTION
       Use this script to enable or disable the application.

WARNINGS
       This will delete all the contents of the database.  Be sure to make a backup before using it.

EXAMPLES
       schoolmesh_application_setstate enabled prod schoolmesh_application_setstate disabled prod

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					 SCHOOLMESH_APPLICATION_SETSTATE(8)
```



## schoolmesh\_loginaccount\_changeshell ##

```
SCHOOLMESH_LOGINACCOUNT_CHANGESHELL(8)											     SCHOOLMESH_LOGINACCOUNT_CHANGESHELL(8)



NAME
       schoolmesh_loginaccount_changeshell - Change the shell for the login account of a user

SYNOPSIS
       schoolmesh_loginaccount_changeshell username shell

DESCRIPTION
       Use this script to change the shell of a user.  The shell must be one of those defined in /etc/shells.

EXAMPLES
       schoolmesh_loginaccount_changeshell john /bin/bash

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				     SCHOOLMESH_LOGINACCOUNT_CHANGESHELL(8)
```



## schoolmesh\_loginaccount\_getinfo ##

```
SCHOOLMESH_LOGINACCOUNT_GETINFO(8)												 SCHOOLMESH_LOGINACCOUNT_GETINFO(8)



NAME
       schoolmesh_loginaccount_getinfo - Get info about the login account of a user

SYNOPSIS
       schoolmesh_loginaccount_getinfo username

DESCRIPTION
       This script generates a list of pairs key=value about a login account.  If the user is not found, returns found=0.

EXAMPLES
       schoolmesh_loginaccount_getinfo john

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					 SCHOOLMESH_LOGINACCOUNT_GETINFO(8)
```



## schoolmesh\_loginaccount\_setpassword ##

```
SCHOOLMESH_LOGINACCOUNT_SETPASSWORD(8)											     SCHOOLMESH_LOGINACCOUNT_SETPASSWORD(8)



NAME
       schoolmesh_loginaccount_setpassword - Change the login password for a user

SYNOPSIS
       schoolmesh_loginaccount_setpassword username password

DESCRIPTION
       This script changes the password of a user.

EXAMPLES
       schoolmesh_loginaccount_setpassword john 89jka76_23A

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				     SCHOOLMESH_LOGINACCOUNT_SETPASSWORD(8)
```



## schoolmesh\_loginaccounts\_getshells ##

```
SCHOOLMESH_LOGINACCOUNTS_GETSHELLS(8)											      SCHOOLMESH_LOGINACCOUNTS_GETSHELLS(8)



NAME
       schoolmesh_loginaccounts_getshells - Get a list of available shells on the system

SYNOPSIS
       schoolmesh_loginaccounts_getshells

DESCRIPTION
       This script generates a list of pairs key=value with the shells available on the system.

EXAMPLES
       schoolmesh_loginaccounts_getshells

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				      SCHOOLMESH_LOGINACCOUNTS_GETSHELLS(8)
```



## schoolmesh\_moodleaccount\_create ##

```
SCHOOLMESH_MOODLEACCOUNT_CREATE(8)												 SCHOOLMESH_MOODLEACCOUNT_CREATE(8)



NAME
       schoolmesh_moodleaccount_create - Create a moodle account for a user

SYNOPSIS
       schoolmesh_moodleaccount_create username firstname lastname password institution department email

DESCRIPTION
       Use this script to create a moodle account.  Some checks are done before the creation.

EXAMPLES
       schoolmesh_moodleaccount_create john `John' `Doe' ck33LmrdH_45 john.doe@example.com

TO DO
       Passwords should not be passed on the command line.  This must be modified,probably by passing a file name containing the password.

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					 SCHOOLMESH_MOODLEACCOUNT_CREATE(8)
```



## schoolmesh\_odf\_check ##

```
SCHOOLMESH_ODF_CHECK(8) 														    SCHOOLMESH_ODF_CHECK(8)



NAME
       schoolmesh_odf_check - Get a specific portion of an OpenOffice.org document's content.xml file

SYNOPSIS
       schoolmesh_odf_check path/to/document row column

DESCRIPTION
       When  generating documents from templates, sometimes weird errors occur, and the generated document cannot be opened (OpenOffice.org complains saying Format
       error discovered in the file in the sub-document content.xml at ... (row, col)).

       This utility might be handy to find the specific error.

       When preparing templates, you may want to uncheck Size optimization for XML format in the General tab of the Load/Save  section	of  OpenOffice.org  options
       dialog.

EXAMPLES
       schoolmesh_odf_check ~/Desktop/myfile.odt 2 5218

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011						    SCHOOLMESH_ODF_CHECK(8)
```



## schoolmesh\_odf\_converter ##

```
SCHOOLMESH_ODF_CONVERTER(8)														SCHOOLMESH_ODF_CONVERTER(8)



NAME
       schoolmesh_odf_converter - start, stop or show the status of Unoconv Odf converter

SYNOPSIS
       schoolmesh_odf_converter start | stop | status

DESCRIPTION
       Use this script to start or stop Unoconv Odf converter.

WARNINGS
       This should be used by an unprivileged user with a minimal X configuration and little privileges

EXAMPLES
       schoolmesh_odf_converter start schoolmesh_odf_converter stop

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011						SCHOOLMESH_ODF_CONVERTER(8)
```



## schoolmesh\_posixaccount\_changefullname ##

```
SCHOOLMESH_POSIXACCOUNT_CHANGEFULLNAME(8)										  SCHOOLMESH_POSIXACCOUNT_CHANGEFULLNAME(8)



NAME
       schoolmesh_posixaccount_changefullname - Change full name for a posix account of a user

SYNOPSIS
       schoolmesh_posixaccount_changefullname username fullname

DESCRIPTION
       Use this script to change the full name (aka Gecos field) of a posix account.

EXAMPLES
       schoolmesh_posixaccount_changefullname john “John Doe”

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				  SCHOOLMESH_POSIXACCOUNT_CHANGEFULLNAME(8)
```



## schoolmesh\_posixaccount\_changegroup ##

```
SCHOOLMESH_POSIXACCOUNT_CHANGEGROUP(8)											     SCHOOLMESH_POSIXACCOUNT_CHANGEGROUP(8)



NAME
       schoolmesh_posixaccount_changegroup - Change the primary group of a user

SYNOPSIS
       schoolmesh_posixaccount_changegroup username group

DESCRIPTION
       Use this script to change the primary group of a user.

EXAMPLES
       schoolmesh_posixaccount_changegroup john students

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				     SCHOOLMESH_POSIXACCOUNT_CHANGEGROUP(8)
```



## schoolmesh\_posixaccount\_changeusername ##

```
SCHOOLMESH_POSIXACCOUNT_CHANGEUSERNAME(8)										  SCHOOLMESH_POSIXACCOUNT_CHANGEUSERNAME(8)



NAME
       schoolmesh_posixaccount_changeusername - Change username for the posix account of a user

SYNOPSIS
       schoolmesh_posixaccount_changeusername new_username old_username

DESCRIPTION
       Use this script to change the username of a user.

WARNINGS
       If  the	user  has  also  external  accounts,  theese  won't be affected.  Internal accounts, like samba, that depend on the existence of posix one, will be
       deleted, but not recreated.

EXAMPLES
       schoolmesh_posixaccount_changeusername johnn john

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				  SCHOOLMESH_POSIXACCOUNT_CHANGEUSERNAME(8)
```



## schoolmesh\_posixaccount\_create ##

```
SCHOOLMESH_POSIXACCOUNT_CREATE(8)												  SCHOOLMESH_POSIXACCOUNT_CREATE(8)



NAME
       schoolmesh_posixaccount_create - Create a posix account for a user

SYNOPSIS
       schoolmesh_posixaccount_create username group fullname

DESCRIPTION
       Use this script to create a posix account.  Some checks are done before the creation.

EXAMPLES
       schoolmesh_posixaccount_create john students `John Doe'

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					  SCHOOLMESH_POSIXACCOUNT_CREATE(8)
```



## schoolmesh\_posixaccount\_createbasefolder ##

```
SCHOOLMESH_POSIXACCOUNT_CREATEBASEFOLDER(8)										SCHOOLMESH_POSIXACCOUNT_CREATEBASEFOLDER(8)



NAME
       schoolmesh_posixaccount_createbasefolder - Create the basefolder for a user

SYNOPSIS
       schoolmesh_posixaccount_createbasefolder username

DESCRIPTION
       Use  this script to create the basefolder inside a user's directory.  The basefolder will have the name specified in schoolmesh.rc and will be the immutable
       flag.

EXAMPLES
       schoolmesh_posixaccount_createbasefolder john

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				SCHOOLMESH_POSIXACCOUNT_CREATEBASEFOLDER(8)
```



## schoolmesh\_posixaccount\_createhomedir ##

```
SCHOOLMESH_POSIXACCOUNT_CREATEHOMEDIR(8)										   SCHOOLMESH_POSIXACCOUNT_CREATEHOMEDIR(8)



NAME
       schoolmesh_posixaccount_createhomedir - Create the home directory for a user

SYNOPSIS
       schoolmesh_posixaccount_createhomedir username

DESCRIPTION
       Use this script to create the home directory for a user.  The home directory will be placed in the directory specified in schoolmesh.rc and will be named as
       the username.  It will be assigned root group owner and 711 permissions.

EXAMPLES
       schoolmesh_posixaccount_createhomedir john

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				   SCHOOLMESH_POSIXACCOUNT_CREATEHOMEDIR(8)
```



## schoolmesh\_posixaccount\_getinfo ##

```
SCHOOLMESH_POSIXACCOUNT_GETINFO(8)												 SCHOOLMESH_POSIXACCOUNT_GETINFO(8)



NAME
       schoolmesh_posixaccount_getinfo - Get info about the posix account of a user

SYNOPSIS
       schoolmesh_posixaccount_getinfo username

DESCRIPTION
       This script generates a list of pairs key=value about a posix account.  If the user is not found, returns found=0.

EXAMPLES
       schoolmesh_posixaccount_getinfo john

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					 SCHOOLMESH_POSIXACCOUNT_GETINFO(8)
```



## schoolmesh\_posixaccount\_lockuser ##

```
SCHOOLMESH_POSIXACCOUNT_LOCKUSER(8)												SCHOOLMESH_POSIXACCOUNT_LOCKUSER(8)



NAME
       schoolmesh_posixaccount_lockuser - Lock a user

SYNOPSIS
       schoolmesh_posixaccount_lockuser username

DESCRIPTION
       Use this script to lock a user.

EXAMPLES
       schoolmesh_posixaccount_lockuser john

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					SCHOOLMESH_POSIXACCOUNT_LOCKUSER(8)
```



## schoolmesh\_posixaccount\_quotausercheck ##

```
SCHOOLMESH_POSIXACCOUNT_QUOTAUSERCHECK(8)										  SCHOOLMESH_POSIXACCOUNT_QUOTAUSERCHECK(8)



NAME
       schoolmesh_posixaccount_quotausercheck - Check if the quota of a user was exceeded

SYNOPSIS
       schoolmesh_posixaccount_quotausercheck username

DESCRIPTION
       Use  this  script to check if a user has used more space than what is assumed to.  (This could be the result when you copy files of a user using administra‐
       tive privileges).

EXAMPLES
       schoolmesh_posixaccount_quotausercheck john

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				  SCHOOLMESH_POSIXACCOUNT_QUOTAUSERCHECK(8)
```



## schoolmesh\_posixaccount\_repairbasefolder ##

```
SCHOOLMESH_POSIXACCOUNT_REPAIRBASEFOLDER(8)										SCHOOLMESH_POSIXACCOUNT_REPAIRBASEFOLDER(8)



NAME
       schoolmesh_posixaccount_repairbasefolder - Repair the basefolder of a user

SYNOPSIS
       schoolmesh_posixaccount_repairbasefolder username

DESCRIPTION
       Use this script to fix the permissions and the extended attributes for the basefolder of a user.

EXAMPLES
       schoolmesh_posixaccount_repairbasefolder john

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				SCHOOLMESH_POSIXACCOUNT_REPAIRBASEFOLDER(8)
```



## schoolmesh\_posixaccount\_repairhomedir ##

```
SCHOOLMESH_POSIXACCOUNT_REPAIRHOMEDIR(8)										   SCHOOLMESH_POSIXACCOUNT_REPAIRHOMEDIR(8)



NAME
       schoolmesh_posixaccount_repairhomedir - Repair the basefolder of a user

SYNOPSIS
       schoolmesh_posixaccount_repairhomedir username

DESCRIPTION
       Use this script to fix the permissions and the extended attributes for the home directory of a user.

EXAMPLES
       schoolmesh_posixaccount_repairhomedir john

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				   SCHOOLMESH_POSIXACCOUNT_REPAIRHOMEDIR(8)
```



## schoolmesh\_posixaccount\_setquota ##

```
SCHOOLMESH_POSIXACCOUNT_SETQUOTA(8)												SCHOOLMESH_POSIXACCOUNT_SETQUOTA(8)



NAME
       schoolmesh_posixaccount_setquota - Set the quota of a user

SYNOPSIS
       schoolmesh_posixaccount_setquota username soft-blocks-quota hard-blocks-quota soft-files-quota hard-files-quota

DESCRIPTION
       Use this script to set the quota for a user.  Blocks quota are expressed in KiB.  The number of files is the number of i-nodes.

EXAMPLES
       schoolmesh_posixaccount_setquota john 80000 100000 5000 6000

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					SCHOOLMESH_POSIXACCOUNT_SETQUOTA(8)
```



## schoolmesh\_posixaccounts\_list ##

```
SCHOOLMESH_POSIXACCOUNTS_LIST(8)												   SCHOOLMESH_POSIXACCOUNTS_LIST(8)



NAME
       schoolmesh_posixaccounts_list - Get a list of posix users belonging to a specified group

SYNOPSIS
       schoolmesh_posixaccounts_list primary | secondary | all group

DESCRIPTION
       Use this script to get a list of users belonging to a specified group.  You can decide to check only primary groups, only secondary, or both.

EXAMPLES
       schoolmesh_posixaccounts_list primary students
       schoolmesh_posixaccounts_list secondary students
       schoolmesh_posixaccounts_list all students

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					   SCHOOLMESH_POSIXACCOUNTS_LIST(8)
```



## schoolmesh\_posixaccounts\_quotachecks ##

```
SCHOOLMESH_POSIXACCOUNTS_QUOTACHECKS(8) 										    SCHOOLMESH_POSIXACCOUNTS_QUOTACHECKS(8)



NAME
       schoolmesh_posixaccounts_quotachecks - Get a list of users specifying who of them exceeds their quota

SYNOPSIS
       schoolmesh_posixaccounts_quotachecks primary | secondary | all group

DESCRIPTION
       Use this script to get a list of users with information about disk quota exceeded.  You can decide to check only primary groups, only secondary, or both.

EXAMPLES
       schoolmesh_posixaccounts_quotachecks primary students
       schoolmesh_posixaccounts_quotachecks secondary students
       schoolmesh_posixaccounts_quotachecks all students

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				    SCHOOLMESH_POSIXACCOUNTS_QUOTACHECKS(8)
```



## schoolmesh\_posixaccount\_unlockuser ##

```
SCHOOLMESH_POSIXACCOUNT_UNLOCKUSER(8)											      SCHOOLMESH_POSIXACCOUNT_UNLOCKUSER(8)



NAME
       schoolmesh_posixaccount_unlockuser - Unlock a user

SYNOPSIS
       schoolmesh_posixaccount_unlockuser username

DESCRIPTION
       Use this script to unlock a user.

EXAMPLES
       schoolmesh_posixaccount_unlockuser john

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				      SCHOOLMESH_POSIXACCOUNT_UNLOCKUSER(8)
```



## schoolmesh\_posixfolder\_copyfile ##

```
SCHOOLMESH_POSIXFOLDER_COPYFILE(8)												 SCHOOLMESH_POSIXFOLDER_COPYFILE(8)



NAME
       schoolmesh_posixfolder_copyfile - Copy a user's file in cache, applying read permission for webserver

SYNOPSIS
       schoolmesh_posixfolder_copyfile username filepath

DESCRIPTION
       This script copies a file in cache directory, in order to allow the webserver to serve it.  The user must exist.  The path is relative to user's home direc‐
       tory.

WARNINGS
       The user who runs this (typically, www-data or apache) must be allowed to run commands on behalf of other users (through sudo).

EXAMPLES
       schoolmesh_posixfolder_copyfile john.test `/letter.doc'

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					 SCHOOLMESH_POSIXFOLDER_COPYFILE(8)
```



## schoolmesh\_posixfolder\_getinfo ##

```
SCHOOLMESH_POSIXFOLDER_GETINFO(8)												  SCHOOLMESH_POSIXFOLDER_GETINFO(8)



NAME
       schoolmesh_posixfolder_getinfo - Get info about a posix user's folder's contents

SYNOPSIS
       schoolmesh_posixfolder_getinfo  username  path directoryname schoolmesh_posixfolder_getinfo username list directoryname schoolmesh_posixfolder_getinfo user‐
       name file directoryname/filename

DESCRIPTION
       This script generates a list of pairs key=value about a posix folder.  The user must exist.

WARNINGS
       The user who runs this (typically, www-data or apache) must be allowed to run commands on behalf of other users (through sudo).

EXAMPLES
       schoolmesh_posixfolder_getinfo john.test path `/'
       schoolmesh_posixfolder_getinfo john.test list `/mydocs' schoolmesh_posixfolder_getinfo john.test file `/mydocs/myfile.odt'

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					  SCHOOLMESH_POSIXFOLDER_GETINFO(8)
```



## schoolmesh\_posixfolder\_makedir ##

```
SCHOOLMESH_POSIXFOLDER_MAKEDIR(8)												  SCHOOLMESH_POSIXFOLDER_MAKEDIR(8)



NAME
       schoolmesh_posixfolder_makedir - Make a directory in a user's home (sub)directory

SYNOPSIS
       schoolmesh_posixfolder_makedir username path

DESCRIPTION
       This script makes a directory in a user's directory.  The user must exist.  The path is relative to user's home directory.

WARNINGS
       The user who runs this (typically, www-data or apache) must be allowed to run commands on behalf of other users (through sudo).

EXAMPLES
       schoolmesh_posixfolder_makedir john.test `/mydocs/my letters'

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					  SCHOOLMESH_POSIXFOLDER_MAKEDIR(8)
```



## schoolmesh\_posixfolder\_putfile ##

```
SCHOOLMESH_POSIXFOLDER_PUTFILE(8)												  SCHOOLMESH_POSIXFOLDER_PUTFILE(8)



NAME
       schoolmesh_posixfolder_putfile - Copy an uploaded file to a user's home (sub)directory

SYNOPSIS
       schoolmesh_posixfolder_putfile username tempname destinationpath

DESCRIPTION
       This script copies an uploaded file to a user's directory.  The user must exist.  The path is relative to user's home directory.

WARNINGS
       The user who runs this (typically, www-data or apache) must be allowed to run commands on behalf of other users (through sudo).

EXAMPLES
       schoolmesh_posixfolder_putfile john.test /tmp.Vm6STjrivF `/mydocs/My report.odt'

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					  SCHOOLMESH_POSIXFOLDER_PUTFILE(8)
```



## schoolmesh\_posixfolder\_removefile ##

```
SCHOOLMESH_POSIXFOLDER_REMOVEFILE(8)											       SCHOOLMESH_POSIXFOLDER_REMOVEFILE(8)



NAME
       schoolmesh_posixfolder_removefile - Remove a file from a user's home (sub)directory

SYNOPSIS
       schoolmesh_posixfolder_removefile username filepath

DESCRIPTION
       This script removes a file from a user's directory.  The user must exist.  The path is relative to user's home directory.

WARNINGS
       The user who runs this (typically, www-data or apache) must be allowed to run commands on behalf of other users (through sudo).

EXAMPLES
       schoolmesh_posixfolder_removefile john.test `/mydocs/My report.odt'

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				       SCHOOLMESH_POSIXFOLDER_REMOVEFILE(8)
```



## schoolmesh\_sambaaccount\_create ##

```
SCHOOLMESH_SAMBAACCOUNT_CREATE(8)												  SCHOOLMESH_SAMBAACCOUNT_CREATE(8)



NAME
       schoolmesh_sambaaccount_create - Create a samba account for a user

SYNOPSIS
       schoolmesh_sambaaccount_create username fullname password

DESCRIPTION
       Use this script to create a posix account.  Some checks are done before the creation.

EXAMPLES
       schoolmesh_sambaaccount_create john `John Doe' ck33LmrdH_45

TO DO
       Passwords should not be passed on the command line.  This must be modified,probably by passing a file name containing the password.

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					  SCHOOLMESH_SAMBAACCOUNT_CREATE(8)
```



## schoolmesh\_sambaaccount\_delete ##

```
SCHOOLMESH_SAMBAACCOUNT_DELETE(8)												  SCHOOLMESH_SAMBAACCOUNT_DELETE(8)



NAME
       schoolmesh_sambaaccount_delete - Delete a samba account for a user

SYNOPSIS
       schoolmesh_sambaaccount_delete username

DESCRIPTION
       Use this script to delete a samba account.

EXAMPLES
       schoolmesh_sambaaccount_delete john

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					  SCHOOLMESH_SAMBAACCOUNT_DELETE(8)
```



## schoolmesh\_sambaaccount\_getinfo ##

```
SCHOOLMESH_SAMBAACCOUNT_GETINFO(8)												 SCHOOLMESH_SAMBAACCOUNT_GETINFO(8)



NAME
       schoolmesh_sambaaccount_getinfo - Get info about the samba (SMB/CIFS) account of a user

SYNOPSIS
       schoolmesh_sambaaccount_getinfo username

DESCRIPTION
       This script generates a list of pairs key=value about a samba (SMB/CIFS) account.  If the user is not found, returns found=0.

EXAMPLES
       schoolmesh_sambaaccount_getinfo john

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					 SCHOOLMESH_SAMBAACCOUNT_GETINFO(8)
```



## schoolmesh\_sambaaccount\_unlock ##

```
SCHOOLMESH_SAMBAACCOUNT_UNLOCK(8)												  SCHOOLMESH_SAMBAACCOUNT_UNLOCK(8)



NAME
       schoolmesh_sambaaccount_unlock - Unlock the samba (SMB/CIFS) account of a user

SYNOPSIS
       schoolmesh_sambaaccount_unlock username

DESCRIPTION
       This script unlocks a samba (SMB/CIFS) account.

EXAMPLES
       schoolmesh_sambaaccount_unlock john

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					  SCHOOLMESH_SAMBAACCOUNT_UNLOCK(8)
```



## schoolmesh\_unoconv\_launch ##

```
SCHOOLMESH_UNOCONV_LAUNCH(8)													       SCHOOLMESH_UNOCONV_LAUNCH(8)



NAME
       schoolmesh_unoconv_launch - launch Unoconv and locks the screen at once

SYNOPSIS
       schoolmesh_unoconv_launch

DESCRIPTION
       This  script  should  be  used by an unprivileged user just in order to have a working instance of Unoconv converter running and listening to client unoconv
       calls.

       The user might have an automatic login, and therefore the script locks the screen immediately after.

       WARNINGS

       This assumes that the user uses GNOME.  For other desktop environments, the command to lock the screen must be found.

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   September 2011					       SCHOOLMESH_UNOCONV_LAUNCH(8)
```



## schoolmesh\_workstation\_disableinternetaccess ##

```
SCHOOLMESH_WORKSTATION_DISABLEINTERNETACCESS(8) 								    SCHOOLMESH_WORKSTATION_DISABLEINTERNETACCESS(8)



NAME
       schoolmesh_workstation_disableinternetaccess - Disable Internet access for a workstation

SYNOPSIS
       schoolmesh_workstation_disableinternetaccess ipaddress user

DESCRIPTION
       This script disables Internet access for a workstation.

EXAMPLES
       schoolmesh_workstation_disableinternetaccess 192.168.1.3 john

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011			    SCHOOLMESH_WORKSTATION_DISABLEINTERNETACCESS(8)
```



## schoolmesh\_workstation\_enableinternetaccess ##

```
SCHOOLMESH_WORKSTATION_ENABLEINTERNETACCESS(8)									     SCHOOLMESH_WORKSTATION_ENABLEINTERNETACCESS(8)



NAME
       schoolmesh_workstation_enableinternetaccess - Enable internet access for a workstation

SYNOPSIS
       schoolmesh_workstation_enableinternetaccess ipaddress from to user

DESCRIPTION
       This script enables internet access for a workstation.  It may schedule jobs for the future.

EXAMPLES
       schoolmesh_workstation_enableinternetaccess 192.168.1.3 9:10 11:10 john.doe

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011			     SCHOOLMESH_WORKSTATION_ENABLEINTERNETACCESS(8)
```



## schoolmesh\_workstation\_removejobs ##

```
SCHOOLMESH_WORKSTATION_REMOVEJOBS(8)											       SCHOOLMESH_WORKSTATION_REMOVEJOBS(8)



NAME
       schoolmesh_workstation_removejobs - Remove all scheduled jobs for a workstation

SYNOPSIS
       schoolmesh_workstation_removejobs ipaddress

DESCRIPTION
       This script removes all scheduled jobs concerning Internet access for a workstation.

EXAMPLES
       schoolmesh_workstation_removejobs 192.168.1.3

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011				       SCHOOLMESH_WORKSTATION_REMOVEJOBS(8)
```



## schoolmesh\_workstations\_getinternetenabled ##

```
SCHOOLMESH_WORKSTATIONS_GETINTERNETENABLED(8)									      SCHOOLMESH_WORKSTATIONS_GETINTERNETENABLED(8)



NAME
       schoolmesh_workstations_getinternetenabled - Get the list of workstations for which Internet access is enabled

SYNOPSIS
       schoolmesh_workstations_getinternetenabled go

DESCRIPTION
       This  script outputs a list of IP addresses of workstations for which Internet access is enabled.  It assumes that the firewall machine uses a special chain
       and a special command for rules that must be matched.  The names of the chain and of the comment are in schoolmesh.rc file.

EXAMPLES
       schoolmesh_workstations_getinternetenabled go

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011			      SCHOOLMESH_WORKSTATIONS_GETINTERNETENABLED(8)
```



## schoolmesh\_workstations\_getjobs ##

```
SCHOOLMESH_WORKSTATIONS_GETJOBS(8)												 SCHOOLMESH_WORKSTATIONS_GETJOBS(8)



NAME
       schoolmesh_workstations_getjobs - Get the list of jobs scheduled for all the workstations

SYNOPSIS
       schoolmesh_workstations_getjobs go

DESCRIPTION
       This script outputs a list of events, separated by commas, scheduled for the workstations.  The jobs are in time order.

EXAMPLES
       schoolmesh_workstations_getjobs go

BUGS
       Probably many.

SEE ALSO
       The SchoolMesh project is described at <http://www.schoolmesh.mattiussilab.net/>.

AUTHORS
       Loris Tissino (loris.tissino@gmail.com).




Schoolmesh User Manuals 						   December 2011					 SCHOOLMESH_WORKSTATIONS_GETJOBS(8)
```

