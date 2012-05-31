#!/bin/bash
MYENV=$1
if [[ -z "$MYENV" ]]
	then
		echo "Manca specificazione environment"
		exit 1
	fi

symfony propel:data-load --env=$MYENV
symfony schoolmesh:import-users --env=$MYENV
symfony schoolmesh:import-classes --env=$MYENV
symfony schoolmesh:import-appointments --env=$MYENV
symfony schoolmesh:import-workplans --replace=true --importer=loris.tissino --env=$MYENV

