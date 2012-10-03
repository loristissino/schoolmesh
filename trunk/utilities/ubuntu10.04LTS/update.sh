#!/bin/bash
#This script is used to update the demo application on a Ubuntu10.04LTS server.

ATOM=http://code.google.com/feeds/p/schoolmesh/svnchanges/basic

STARTDIR=/var/schoolmesh

for DIR in apps bin config data doc error graph plugins templates utilities web
  do
    cd "$STARTDIR/$DIR"
    echo "Updating $STARTDIR/$DIR..."
    svn update
  done

# we remove these files because they are dangerous
rm -rf "$STARTDIR/utilities/ubuntu10.04LTS/setup.sh"
rm -rf "$STARTDIR/bin/schoolmesh_application_createtables"
rm -rf "$STARTDIR/bin/schoolmesh_application_importtables"

# we copy the other ones
sudo cp -v "$STARTDIR"/bin/schoolmesh* /usr/local/bin
  
LIBDIR="$STARTDIR/lib"
for DIR in account  email  filter  form  helper  model  schoolmesh  task  test
  do
    cd "$LIBDIR/$DIR"
    echo "Updating $LIBDIR/$DIR..."
    svn update
  done

cd "$STARTDIR"
grep Release doc/notes.txt | head -1 | sed 's/Release://' > doc/lastrelease.txt

SOURCE=$(mktemp)
XSL=$(mktemp)

cat > $XSL <<EOF
<xsl:stylesheet
  version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:atom="http://www.w3.org/2005/Atom"> 
<xsl:output method="text"/>
<xsl:template match="/">
<xsl:for-each select="atom:feed/atom:entry">
      <xsl:value-of select="atom:id"/>
      <xsl:text>
</xsl:text>
    </xsl:for-each>
  </xsl:template>
</xsl:stylesheet>
EOF

wget -O $SOURCE "$ATOM" 2>/dev/null

xsltproc -o /dev/stdout $XSL $SOURCE | head -1 | sed -e 's|.*\/||' > doc/lastrevision.txt
