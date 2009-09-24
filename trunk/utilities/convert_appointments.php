#!/usr/bin/env php
<?php
	$handle = fopen(@$_SERVER["argv"][1], "r") or die("no file\n");
	$row=0;
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
	
	{
		$row++;
		if ($row==1)
			{
				$subjects=$data;
				print_r($line);
			}
		else
			{
				$class=$data[0];
				for($i=1;$i<sizeof($data);$i++)
					{
						$teacher=$data[$i];
						$subject=$subjects[$i];
						if ($teacher>'')
						{
							echo "$teacher,$class,$subject\n";
						}
					}
			}

	
	}

