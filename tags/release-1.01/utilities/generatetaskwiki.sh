#!/bin/bash

OUTPUTFILE=~/Importanti/SchoolMesh/wiki/Tasks.wiki

cat > $OUTPUTFILE <<EOF
#summary Command line tasks descriptions.
#labels Featured

= Command line tasks =

General information about symfony tasks can be obtained at [http://www.symfony-project.org/reference/1_4/en/16-Tasks symfony web site].

== SchoolMesh tasks list ==

Here's a list of !SchoolMesh specific tasks:

EOF

echo "{{{" >> $OUTPUTFILE
symfony list schoolmesh | sed -n '/^Available tasks/,$p' >> $OUTPUTFILE
echo "}}}" >> $OUTPUTFILE

echo -e "\n\n== Tasks descriptions ==\n" >> $OUTPUTFILE

for task in $(symfony list schoolmesh | sed -n '/^Available tasks/,$p' | grep '  :' | sed -e 's/  ://' -e 's/[ ].*$//'); do

  echo "=== $task ===" >> $OUTPUTFILE
  echo -e "\n{{{" >> $OUTPUTFILE
  symfony help schoolmesh:$task >> $OUTPUTFILE
  echo -e "}}}\n" >> $OUTPUTFILE
done

