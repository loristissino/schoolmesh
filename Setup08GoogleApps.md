# Google Apps Education Edition #

The basic idea of SchoolMesh is to use existing resources, if possible.

One interesting resource available for schools is [Google Apps Education Edition](http://www.google.com/apps/intl/en/edu/), which is offered for free by Google Inc.

SchoolMesh aims to be fully integrated with Google Apps, in order to use features like shared documents, email, calendar, tasks, etc.

The integration is only partial at the moment:

  1. it is easy to export teachers' and students' data to a spreadsheet in the format needed by Google Apps to perform a bulk upload
  1. it is possible for people who have a google apps account to keep in sync the passwords with Google's servers
  1. it is easy to send email from within the application using a Google Apps account

Projects for the future are as follows:

  1. to setup a [Single-Sign-On](http://code.google.com/intl/it/googleapps/domain/sso/saml_reference_implementation.html) infrastructure to be able to login only once for both systems
  1. to integrate due dates for projects and other activities in Google calendar
  1. to use Google Apps APIs to keep data in sync
  1. to create groups automatically, based on internal groups, like classes or departments

Since SchoolMesh is written in PHP, most of these things will be done using [Zend GData](http://framework.zend.com/manual/en/zend.gdata.gapps.html) and, probably, [SimpleSAMLphp](http://simplesamlphp.org/).

If you have any ideas or comments on this topic, please [contact us](http://www.schoolmesh.mattiussilab.net/en/contacts). Thank you.