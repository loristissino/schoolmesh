#!/bin/bash

BASEHOME=/home/testhome
BASEFOLDER=Mattiussi

echo -------
date 
echo -------

OPCOUNT=0
OPOK=0
OPFAILED=0

function msg()
	{
	OPCOUNT=$(($OPCOUNT + 1))	
	echo -e "\033[1;34m*** $OPCOUNT) $1\033[0m"
	}

function msg_ok()
	{
	OPOK=$(($OPOK + 1))	
	echo -e "\033[1;32m:-) $1\033[0m"	
	}

function msg_failed()
	{
	OPFAILED=$(($OPFAILED + 1))	
	echo -e "\033[1;31m:-( $1\033[0m"	
	}

msg "Operazioni docente"

USER=john.test
sudo -u $USER ls -l "$BASEHOME/$USER/$BASEFOLDER" > /dev/null  2>&1 && msg_ok "ha la directory $BASEFOLDER" || msg_failed "non ha la directory $BASEFOLDER"

sudo -u $USER rm -rf "$BASEHOME/$USER/$BASEFOLDER" > /dev/null  2>&1 && msg_failed "può rimuovere la directory $BASEFOLDER" || msg_ok "non può rimuovere la directory $BASEFOLDER"

msg "Operazioni studente"

USER=marin.djakovo
sudo -u $USER ls -l "$BASEHOME/$USER/$BASEFOLDER" > /dev/null  2>&1 /dev/null && msg_ok "ha la directory $BASEFOLDER" || msg_failed "non ha la directory $BASEFOLDER"

sudo -u $USER rm -rf "$BASEHOME/$USER/$BASEFOLDER" > /dev/null  2>&1 /dev/null && msg_failed "può rimuovere la directory $BASEFOLDER" || msg_ok "non può rimuovere la directory $BASEFOLDER"


msg "Rapporto finale"
echo "Ok: $OPOK"
echo "Falliti: $OPFAILED"

