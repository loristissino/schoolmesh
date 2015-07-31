# MySQL #

1. Be sure that MySQL server is running:

```sh

sudo service mysql status
```

2. Create, with the interface you like (phpMyAdmin, for instance), a user `schoolmesh` and a database `schoolmesh_prod`:

This commands should be enough (just change the password):

```
CREATE USER 'schoolmesh'@'localhost' IDENTIFIED BY  'SuPeRsEcReT';

GRANT USAGE ON * . * TO  'schoolmesh'@'localhost' IDENTIFIED BY  'SuPeRsEcReT' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

GRANT ALL PRIVILEGES ON  `schoolmesh\_%` . * TO  'schoolmesh'@'localhost';

CREATE DATABASE  `schoolmesh_prod` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

```

3. Edit the file _config/databases.yml_ setting the password chosen for the user _schoolmesh_:

```
dev:
  propel:
    param:
      classname: DebugPDO
test:
  propel:
    class: sfPropelDatabase
    param:
      classname: DebugPDO
      dsn: 'mysql:host=localhost;dbname=schoolmesh_test'
prod:
  propel:
    class: sfPropelDatabase
    param:
      dsn: 'mysql:host=localhost;dbname=schoolmesh_prod'
all:
  propel:
    class: sfPropelDatabase
    param:
      dsn: 'mysql:dbname=schoolmesh;host=localhost'
      username: schoolmesh
      password: SuPeRsEcReT
      encoding: utf8
      persistent: true
      pooling: true
      classname: PropelPDO
```

4. Create the structure of the database:

```sh

cd /var/schoolmesh
schoolmesh_application_createtables prod
```

5. Load demo data into the database:

```sh

cd /var/schoolmesh
wget http://www.schoolmeshdemo.tuxfamily.org/schoolmeshbase.sql.gz -O /tmp/schoolmeshbase.sql.gz
schoolmesh_application_importtables prod /tmp/schoolmeshbase.sql.gz
```

6. Point your browser to the page http://localhost/index.php or https://localhost/index.php and try to login with the credentials shown in  http://www.schoolmesh.mattiussilab.net/demo

7. Generate the index files used by the internal search engine, based on Lucene:

```
symfony schoolmesh:rebuild-indexes --application=frontend --env=prod
```