# Command line tasks #

General information about symfony tasks can be obtained at [symfony web site](http://www.symfony-project.org/reference/1_4/en/16-Tasks).

## SchoolMesh tasks list ##

Here's a list of SchoolMesh specific tasks:

```
Available tasks for the "schoolmesh" namespace:
  :add-attachment               Adds an attachment to an object
  :add-permission               Adds a permission to a user
  :approve-workplans            Approves workplans
  :change-syllabus-refs         Changes syllabus references, after a new syllabus is imported
  :check-attachments            Checks existance and md5 of attachments
  :check-mail                   Checks email of the SchoolMesh bot
  :convert-attachment           Changes the format of an attachment, specified either by id or uniqid
  :create-folders-for-teachers  Creates folders for teachers' materials to share with students
  :deactivate-accounts          Deactivates accounts for teachers with no-appointments and students not enrolled.
  :extract-info                 Extract informarmation from the database
  :fix-appointments             Fixes appointments, making all needed checks
  :fix-teams                    Fixes teams, removing expired items and creating new needed teams.
  :generate-db-script           Produces a script to use in order to backup the database, initialize it or restore it
  :generate-help-index          Generates help index file from a template and a directory with properly commented html pages
  :generate-limesurvey-tokens   Generates Limesurvey tokens for all active users
  :generate-workplans-index     Generate workplans index file from attachments
  :import-syllabus              Imports a syllabus from YML file into DB
  :publish-workplans            Publishes teacher's workplans as attachments
  :rebuild-indexes              Rebuilds Lucene indexes from scratch
  :reset-db-password            Resets the DB password of the user for the main Schoolmesh account
  :run-user-checks              Runs user checks from command line, generating a script file.
  :send-file                    Sends a file by email
  :send-reminders               Sends reminders about actions to perform
  :show-accounts                Shows the account of a user
  :show-permission              Shows if a user has a permission
  :sync-googleapps-accounts     Synchronizes google apps accounts
```


## Tasks descriptions ##

### add-attachment ###

```
Usage:
 symfony schoolmesh:add-attachment [--application="..."] [--env="..."] [--connection="..."] [--object-type="..."] [--object-id="..."] [--owner="..."] [--file="..."] 

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)
 --object-type  Object Type (default: )
 --object-id    Object Id (default: )
 --owner        Owner (default: )
 --file         File path (default: )

Description:
 The schoolmesh:add-attachment task can be used to attach files to objects of different kinds.
 Use it whenever you need to attach files to objects in a batch procedure.
 
 Call it with:
 
    symfony schoolmesh:add-attachment --application=frontend --env=prod object-type object-id owner file-path
 
 Examples:
 
    symfony schoolmesh:add-attachment --application=frontend --env=prod Appointment 145 john.doe /tmp/myfile.odt
    symfony schoolmesh:add-attachment --application=frontend --env=prod Schoolproject 14 john.doe /tmp/myfile.odt
    symfony schoolmesh:add-attachment --application=frontend --env=prod ProjDeadline 156 john.doe /tmp/myfile.odt
 

```

### add-permission ###

```
Usage:
 symfony schoolmesh:add-permission [--application="..."] [--env="..."] [--connection="..."] user permission

Arguments:
 user           User
 permission     Permission

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)

Description:
 The schoolmesh:add-permission task can be used to add a permission to a user.
 
 Call it with:
 
    symfony schoolmesh:add-permission --application=frontend --env=prod user permission
 
 Examples:
 
    symfony schoolmesh:add-permission --application=frontend --env=prod john.doe proj_view
 

```

### approve-workplans ###

```
Usage:
 symfony schoolmesh:approve-workplans [--application="..."] [--env="..."] [--connection="..."] [--approver="..."] 

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)
 --approver     Approver username (default: )

Description:
 The schoolmesh:approve-workplans approves all workplans submitted.
 
 Call it with:
 
   symfony schoolmesh:approve-workplans --application=frontend --env=prod --approver=john.smith

```

### change-syllabus-refs ###

```
Usage:
 symfony schoolmesh:change-syllabus-refs [--application="..."] [--env="..."] [--connection="..."] [--year="..."] [--dry-run] from to

Arguments:
 from           Base Syllabus Id
 to             Target Syllabus Id

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)
 --year         School year (default: )
 --dry-run      whether the command will be executed leaving the db intact

Description:
 The schoolmesh:change-syllabus-refs can be used when a new 
 syllabus is imported, updating a previous one. All references to the old
 syllabus must be updated to meet the new one (using refs to find the 
 right items).
 

```

### check-attachments ###

```
Usage:
 symfony schoolmesh:check-attachments [--application="..."] [--env="..."] [--connection="..."] 

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)

Description:
 This task checks whether the attachments are correctly stored.

```

### check-mail ###

```
Usage:
 symfony schoolmesh:check-mail [--application="..."] [--env="..."] [--connection="..."] [--dry-run] 

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)
 --dry-run      Whether the command will be executed leaving the db intact

Description:
 This task will check incoming email, in order to perform mail-based actions.

```

### convert-attachment ###

```
Usage:
 symfony schoolmesh:convert-attachment [--application="..."] [--env="..."] [--connection="..."] [--id[="..."]] [--uniqid[="..."]] [--format[="..."]] 

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)
 --id           The id of the attachment file (default: 0)
 --uniqid       The unique identifier of the attachment file (default: )
 --format       The format to use (default: pdf)

Description:
 This task will remove an attachment, placing in its place the equivalent 
 in another format, and updating the db consequently.

```

### create-folders-for-teachers ###

```
Usage:
 symfony schoolmesh:create-folders-for-teachers [--application="..."] [--env="..."] [--connection="..."] 

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)

Description:
 The schoolmesh:create-folders-for-teachers task can be used to folders in teachers' home directories that allow them
 to share documents with their students.
 It just generates on the standard output a bash script to execute.
 
 Call it with:
 
    symfony schoolmesh:create-folders-for-teachers --application=frontend --env=prod > /tmp/myscript.sh
 

```

### deactivate-accounts ###

```
Usage:
 symfony schoolmesh:deactivate-accounts [--application="..."] [--env="..."] [--connection="..."] [--year="..."] 

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)
 --year         School year (default: )

Description:
 This task will set is_active to false for teachers with no appointments and students not enrolled.

```

### extract-info ###

```
Usage:
 symfony schoolmesh:extract-info [--application="..."] [--env="..."] [--connection="..."] [--year="..."] [--role="..."] [--class="..."] [--state="..."] [--subject="..."] [--teacher="..."] infotype

Arguments:
 infotype       The information type requested

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)
 --year         School year (default: )
 --role         User's role (default: )
 --class        School class (default: )
 --state        Appointment state (default: )
 --subject      Subject shortcut (default: )
 --teacher      Teacher's username (default: )

Description:
 The schoolmesh:extract-info task can be used to to extract information from the database.
 Different options will control the actual output.
 
 Call it with:
 
    symfony schoolmesh:add-attachment --application=frontend --env=prod --year year users|appointments|enrolments
 
 Examples:
 
    symfony schoolmesh:add-attachment --application=frontend --env=prod --year 2011/12 users
    # extract all users
 
    symfony schoolmesh:add-attachment --application=frontend --env=prod --year 2011/12 --role allievi users
    # extract all users which have a role with posix name "allievi"
 
    symfony schoolmesh:add-attachment --application=frontend --env=prod --year 2011/12 --role docenti users
    # extract all users which have a role with posix name "docenti"
 
    symfony schoolmesh:add-attachment --application=frontend --env=prod --year 2011/12 appointments
    # extract all teaching appointments
 
    symfony schoolmesh:add-attachment --application=frontend --env=prod --year 2011/12 --teacher john.doe appointments
    # extract all teaching appointments of teacher john.doe
 
    symfony schoolmesh:add-attachment --application=frontend --env=prod --year 2011/12 enrolments
    # extract all enrolments of students
 
    symfony schoolmesh:add-attachment --application=frontend --env=prod --year 2011/12 --class 1AIG enrolments
    # extract all enrolments of class 1AIG
 

```

### fix-appointments ###

```
Usage:
 symfony schoolmesh:fix-appointments [--application="..."] [--env="..."] [--connection="..."] [--year="..."] [--subject="..."] [--dry-run] [--also-not-submitted] 

Options:
 --application         The application name
 --env                 The environment (default: dev)
 --connection          The connection name (default: propel)
 --year                School year (default: )
 --subject             Subject shortcut (default: )
 --dry-run             Whether the command will be executed leaving the db intact
 --also-not-submitted  Whether the documents not yet submitted must be considered

Description:
 This task can be used for several general checks and fixes about appointments.

```

### fix-teams ###

```
Usage:
 symfony schoolmesh:fix-teams [--application="..."] [--env="..."] [--connection="..."] [--dry-run] 

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)
 --dry-run      Whether the command will be executed leaving the db intact

Description:
 This task will remove people for teams when expiry is reached and create/populate new teams if needed.

```

### generate-db-script ###

```
Usage:
 symfony schoolmesh:generate-db-script [--application="..."] [--env="..."] [--connection="..."] [--backupfile[="..."]] type scriptfile

Arguments:
 type           The type of script needed (initdb, backup, restore)
 scriptfile     The file to write the script to

Options:
 --application  The application name (default: frontend)
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)
 --backupfile   The file to write the backup to or read the backup from (default: _BACKUPFILE_)

Description:
 This script produces on the standard output the script used to connect to the database from the command line.
 It can be useful for backups or other routines.

```

### generate-help-index ###

```
Usage:
 symfony schoolmesh:generate-help-index [--application="..."] [--env="..."] [--connection="..."] [--basehref[="..."]] templatefile directoryname outputfile

Arguments:
 templatefile   Index template file
 directoryname  Directory to search for help files
 outputfile     Output file

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)
 --basehref     The base href for documents (default: http://www.schoolmeshdemo.tuxfamily.org/help/)

```

### generate-limesurvey-tokens ###

```
Usage:
 symfony schoolmesh:generate-limesurvey-tokens [--application="..."] [--env="..."] [--connection="..."] [--valid-from[="..."]] [--valid-until[="..."]] [--url="..."] [--booklet] role filename

Arguments:
 role           Role
 filename       File name

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)
 --valid-from   Start validity date
 --valid-until  End validity date
 --url          URL for the survey
 --booklet      whether the labels will be grouped vertically

```

### generate-workplans-index ###

```
Usage:
 symfony schoolmesh:generate-workplans-index [--application="..."] [--env="..."] [--connection="..."] [--year="..."] outputfile directory

Arguments:
 outputfile     Output file
 directory      Directory for symlinks

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)
 --year         School year (default: )

```

### import-syllabus ###

```
Usage:
 symfony schoolmesh:import-syllabus [--application="..."] [--env="..."] [--connection="..."] filename

Arguments:
 filename       File name

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)

```

### publish-workplans ###

```
Usage:
 symfony schoolmesh:publish-workplans [--application="..."] [--env="..."] [--connection="..."] [--format[="..."]] 

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)
 --format       The format to use (default: odt)

Description:
 This task will publish teachers' workplans for archiviation purposes.

```

### rebuild-indexes ###

```
Usage:
 symfony schoolmesh:rebuild-indexes [--application="..."] [--env="..."] [--connection="..."] 

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)

Description:
 This task will re-index all documents and users' data from scratch, removing 
 previous indexes.

```

### reset-db-password ###

```
Usage:
 symfony schoolmesh:reset-db-password [--application="..."] [--env="..."] [--connection="..."] username password

Arguments:
 username       The user you must reset the password for
 password       The password

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)

Description:
 This task is useful only if you do not set an external authentication method.
 It is not secure, since we pass the password on the command line.
 (But we do not need security here at the moment)

```

### run-user-checks ###

```
Usage:
 symfony schoolmesh:run-user-checks [--application="..."] [--env="..."] [--connection="..."] scriptfile

Arguments:
 scriptfile     The name of the script file to generate

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)

Description:
 This task will run the user checks on all accounts, updating info on db and generating a script.

```

### send-file ###

```
Usage:
 symfony schoolmesh:send-file [--application="..."] [--env="..."] [--connection="..."] [--subject="..."] [--to="..."] [--from="..."] filename

Arguments:
 filename       The file to send

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)
 --subject      Subject
 --to           To
 --from         From

Description:
 The schoolmesh:send-file task sends a file by email.
 Call it with:
 
   php symfony schoolmesh:send-file

```

### send-reminders ###

```
Usage:
 symfony schoolmesh:send-reminders [--application="..."] [--env="..."] [--connection="..."] 

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)

Description:
 The schoolmesh:send-file task sends reminders by email to the users that need to do something with the application.
 Call it with:
 
   php symfony schoolmesh:send-reminders

```

### show-accounts ###

```
Usage:
 symfony schoolmesh:show-accounts [--application="..."] [--env="..."] [--connection="..."] user

Arguments:
 user           Username

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)

```

### show-permission ###

```
Usage:
 symfony schoolmesh:show-permission [--application="..."] [--env="..."] [--connection="..."] user permission

Arguments:
 user           User
 permission     Permission

Options:
 --application  The application name
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)

Description:
 The schoolmesh:hello task does things.
 Call it with:
 
   php symfony schoolmesh:addPermission

```

### sync-googleapps-accounts ###

```
Usage:
 symfony schoolmesh:sync-googleapps-accounts [--application="..."] [--env="..."] [--connection="..."] file

Arguments:
 file           The spreadsheet to import appointments from

Options:
 --application  The application name (default: frontend)
 --env          The environment (default: dev)
 --connection   The connection name (default: propel)

Description:
 The schoolmesh:sync-googleappas-accounts task syncronizes google apps accounts.
 Call it with:
 
   php symfony schoolmesh:sync-googleapps-accounts

```