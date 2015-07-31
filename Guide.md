# Introduction to SchoolMesh #

SchoolMesh is a web application aimed to allow the governance of a school. It is based on the experience of an Italian high school, but it is quite easily customizable.

## How an Italian school is organized ##

Probably a quick introduction about how an Italian school is organized may be useful if you want to use SchoolMesh in another country. Please let us know if there are big differences in your country.

| **year** | **students' age** | **kind of school** |
|:---------|:------------------|:-------------------|
| 1        | 6                 | primary school     |
| 2        | 7                 | primary school     |
| 3        | 8                 | primary school     |
| 4        | 9                 | primary school     |
| 5        | 10                | primary school     |
| 6        | 11                | secondary school, first level |
| 7        | 12                | secondary school, first level |
| 8        | 13                | secondary school, first level |
| 9        | 14                | secondary school, second level, first two-year period |
| 10       | 15                | secondary school, second level, first two-year period |
| 11       | 16                | secondary school, second level, second two-year period |
| 12       | 17                | secondary school, second level, second two-year period |
| 13       | 18                | secondary school, second level, pre-university year |

The examples below refer to a secondary school, second level.

In a typical Italian secondary school you find students, teachers and other staff.

Students are grouped in _classes_, of more or less 25-30 people. For most activities, the students of the same class do the same thing together: they all have history lessons, or maths, etc. Classes have usually a name composed with the grade, the section and the track.

For instance, if 50 students of the first grade are enrolled to follow the 'linguistic' track of a school, they might be divided in two classes, 1AL and 1BL.

Schools have typically from 500 to 2000 students, and therefore from about 15 to 70 classes.

At the beginning of the year, teachers are given teaching appointments (_incarichi di insegnamento_), which sound like:

  1. teacher John Smith will teach History in class 1AL for 2 hours per week
  1. teacher Samantha Green will teach Maths in class 2AL for 4 hours per week

### Work plans ###

At the beginning of the school year, teachers are required to write down a work plan for the year. Usually, they have to write about:

  1. how the class is
  1. what kind of activities will be done in the class
  1. what kind of homework will be required
  1. how the students will be helped if they have difficulties

The work plan usually contains also a detailed list of learning modules, where the teacher details what they will teach, what kind of skills / competencies they will try to let students develop, etc.

All the teachers who teach in the same class need to cooperate in the achieving of some standard competencies, defined by the Ministry of Education or, in some extent, by the school itself. Teachers' work plans should take care of this coordination.

### Final reports ###

At the end of the year, teachers are required to write a final report, in which they described what they actually did.

If the school is well organized, it might be important to compare what was planned with what was actually achieved. Of course, teachers may say, in their reports, that they did something new (not planned), and that they did not do something planned, if there are reasons to justify these choices.

### Projects ###

The school is assigned every year some money for extra activities (like sport events, theatre, dance, cinema, library enhancement, and the like).

All the staff are encouraged to prepare projects describing these activities, in which they have to declare:

  1. the resources needed (expressed in hours of work or money)
  1. the goals, which should be [smart](http://en.wikipedia.org/wiki/SMART_criteria)
  1. the due dates for the most important tasks

The principal of the school needs:

  1. to understand if there is money enough for the projects, making a complete budget
  1. to see how things are going, during the year
  1. to see which goals have been achieved, at the end of the year

## What you can do with SchoolMesh ##

Many of the things described above are easily obtained by using SchoolMesh. All data are written, through a web interface, into a database, from which they are extracted to have budgets, to allow monitoring, to produce documentation.

For instance:

  1. the principal can manage teaching appointments
  1. the teachers can write on line their work plans and final reports
  1. the staff can prepare projects, with goals, resources, etc. From the projects you can get a budget
  1. the organization of the school is defined in the database (roles, expiries, etc.)

If the school is certified UNI EN ISO 9001:2008, the advantages in using SchoolMesh should be clear. But even if it is not, you'll probably understand them.

## Execution environments ##

The application, based on symfony 1.4, has different environments of execution. You'll probably use the production environement, unless you wanted to contribute some code or make some tests. Please refer to symfony documentation.

## Users, groups, credentials and permissions ##

Each user of the application logs in with a username, and gets granted some credentials depending on who they are. Credentials may be individual or inherited: when a user belongs to a so-called _GuardGroup_, they inherit the group's credentials.

Please note that in symfony's terminology, credentials are the ones that a user has once they logged in, while permissions are the ones that are stored in the database.