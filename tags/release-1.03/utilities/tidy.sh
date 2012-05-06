#!/bin/bash
cat "$1" | tr '\n' ' '|sed -e 's/<?php/ñ/g' -e 's/?>/ł/g' | sed -e 's/ñ[^ł]*ł/PHPCODE/g'| tidy -i -w 0
