#!/bin/bash

CONFIG_READ=0
source /var/schoolmesh/config/schoolmesh.rc $@
if [ $CONFIG_READ -ne 1 ]; then echo "Error in reading configuration"; exit 1; fi

USERNAME=flavia.g
echo abc | sudo -u $USERNAME dd of="$POSIX_HOMEDIR_USERS/$USERNAME/testfile.txt" 2>/dev/null && msg_ok "$USERNAME can write in their directory" || msg_failed "$USERNAME cannot write in their own directory"

echo abc | sudo -u $USERNAME dd of="$POSIX_HOMEDIR_USERS/$USERNAME/$POSIX_BASEFOLDER/testfile.txt" 2>/dev/null && msg_failed "$USERNAME can write in their basefolder" || msg_ok "$USERNAME cannot write in their own basefolder"

echo abc | sudo -u $USERNAME dd of="$POSIX_HOMEDIR_USERS/$USERNAME/$POSIX_BASEFOLDER/Consiglio di classe 3AP/testfile.txt" 2>/dev/null && msg_ok "$USERNAME can write in a team's folder where they belong" || msg_failed "$USERNAME cannot write in a team's folder where they belong"

GROUP=$(sudo stat -c %G "$POSIX_HOMEDIR_TEAMS/cdc3ap/testfile.txt")

[[ "$GROUP" = cdc3ap ]] && msg_ok "The group of the file is correctly set" || msg_failed "The group of the file is not correctly set"

USERNAME=bianca.b
echo abc | sudo -u $USERNAME dd of="$POSIX_HOMEDIR_USERS/$USERNAME/$POSIX_BASEFOLDER/Consiglio di classe 3AP/testfile.txt"  >/dev/null 2>&1 && msg_failed "$USERNAME can overwrite a file in a team's folder where they belong" || msg_ok "$USERNAME cannot overwrite a file in a team's folder where they belong"

sudo -u $USERNAME cat "$POSIX_HOMEDIR_USERS/$USERNAME/$POSIX_BASEFOLDER/Consiglio di classe 3AP/testfile.txt" 2>/dev/null && msg_ok "$USERNAME can read a file in a team's folder where they belong" || msg_failed "$USERNAME cannot read a file in a team's folder where they belong"

sudo -u $USERNAME rm -f "$POSIX_HOMEDIR_USERS/$USERNAME/$POSIX_BASEFOLDER/Consiglio di classe 3AP/testfile.txt" 2>/dev/null && msg_failed "$USERNAME can remove a file that they do not own" || msg_ok "$USERNAME cannot remove a file they do not own"



echo RESULTS:
echo OK: $OPOK
echo FAILED: $OPFAILED