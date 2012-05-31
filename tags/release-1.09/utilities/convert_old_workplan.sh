#!/bin/bash

FILE=$1
cp "$FILE" "$FILE.back.$$"

sed -i \
	-e "s/Recupero/'Recupero programmato'/" \
	-e "s/Commenti/'Commenti (progettazione)'/" \
	-e "s/Considerazioni finali/Situazione finale della classe/" \
	-e "s/Tipologia delle verifiche/Tipologia delle verifiche previste/" \
	-e "s/Strumenti/Strumenti previsti/" \
	$FILE
	
	
