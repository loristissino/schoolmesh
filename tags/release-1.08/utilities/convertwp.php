#!/usr/bin/env php
<?php

require_once('/usr/share/php/symfony/yaml/sfYaml.class.php');

$subjects=Array(
'IRC'=>'Insegnamento della Religione Cattolica',
'ITA' =>'Italiano',
'STO' =>'Storia',
'ING'=>'Lingua e civiltà inglese',
'TED'=>'Lingua e civiltà tedesca',
'FRA'=>'Lingua e civiltà francese',
'SPA'=>'Lingua e civiltà spagnola',
'GEO'=>'Geografia economica',
'MAT'=>'Matematica applicata',
'FIS'=>'Fisica',
'AST'=>'Astronomia',
'SDM'=>'Scienze della materia',
'SDN'=>'Scienze della natura',
'INF'=>'Informatica gestionale',
'LIG'=>'Laboratorio di informatica gestionale',
'ECZ'=>'Economia aziendale',
'LAB'=>'Laboratorio di Economia aziendale',
'DIR'=>'Diritto',
'ECP'=>'Economia politica',
'SFZ'=>'Scienza delle finanze',
'TRT'=>'Trattamento testi e dati',
'EDF'=>'Educazione fisica',
);


$wp=@$_SERVER["argv"][1];

if ($wp=='')
	die("I need the name of the file to convert to yaml\n");
	
if (!file_exists($wp))
	die("File $wp does not exist\n");

if (!is_file($wp))
	die("File $wp is not a regular file\n");

if (!is_readable($wp))
	die("Cannot read file $wp\n");

echo "Converting file $wp... \n";

$data['workplan_report']=Array();

$pathparts=pathinfo($wp);

$outfile=$pathparts['dirname'].'/'.$pathparts['filename'].'.yml';

if (file_exists($outfile))
	die("File $outfile already exists\n");



list($firstname, $lastname, $subject, $class)=explode('_', $pathparts['filename']);

$data['workplan_report']['year']='2008_09';
$data['workplan_report']['teacher']['firstname']=$firstname;
$data['workplan_report']['teacher']['lastname']=$lastname;
$data['workplan_report']['subject']['description']=$subjects[$subject];
$data['workplan_report']['class']['id']=$class;
$data['workplan_report']['exported_at']=date('r');

$contents=file($wp);

$state='';
$previous='';
$text='';

foreach($contents as $line)
	{
//		echo $line;
		echo "--> CURRENT STATE: $state\n";
		if (preg_match('/LIVELLI DI PARTENZA RILEVATI/', $line))
			$state='Livelli di partenza rilevati';

		if (preg_match("/EVENTUALI PROPOSTE E CONTRIBUTI PER L'AREA DI PROGETTO/", $line))
			$state='Area di progetto';
			
		if (preg_match("/ATTIVITÀ INTEGRATIVE EXTRACURRICOLARI PREVISTE/", $line)
			or preg_match("/ATTIVITA' INTEGRATIVE EXTRACURRICOLARI PREVISTE/", $line))
			$state='Attività extracurricolari';
			
		if (preg_match("/TAVOLA DI PROGRAMMAZIONE DELLA DISCIPLINA/", $line))
			$state='_programmazione';
			
		if (preg_match("/METODOLOGIA DI LAVORO/", $line))
			$state='_metodologia';
			
		if (preg_match("/CRITERI E STRUMENTI ADOTTATI PER LA VALUTAZIONE/", $line))
			$state='Valutazione';

		if (preg_match("/TEMPI E MODALITÀ PER IL RECUPERO/", $line)
			or preg_match("/TEMPI E MODALITA' PER IL RECUPERO/", $line))
			$state='Recupero';
	
		if (preg_match("/^Pordenone,/", $line) or preg_match("/^Data/", $line))
			$state='fine';
	
		if ($state==$previous)
			$text.=$line;
		else
			{
			$mycontents[$previous]=$text;
			$text='';
				
			}
			
		$previous=$state;
	}


$programmazione=explode("\n", $mycontents['_programmazione']);

$num_modulo=0;

$state='';
$previous='';

foreach($programmazione as $line)
	{
		$line=chop($line);
		echo "\n--> CURRENT STATE: $state\n";
		echo $line;
		
/*
		if (in_array(chop($line), Array('Obiettivi disciplinari', 'Conoscenze', 'Abilità/Capacità', 'Competenze')))
			continue;
*/		
		if (preg_match('/Titolo del modulo/', $line))
			{
			$state='_titolo_modulo';
			}

		if (preg_match("/Periodo di svolgimento/", $line))
			$state='_periodo';
			
		if (preg_match("/^Contenuti/", $line))
			$state='Contenuti';

		if (preg_match("/^Note e commenti/", $line))
			$state='Note e commenti in fase di progettazione';
			
		if (preg_match("/(nuclei fondanti delle discipline-saperi essenziali)/", $line) or preg_match('/^Conoscenze/', $line))
			$state='Conoscenze';
			
		if (preg_match("/(nell’utilizzare e padroneggiare conoscenze anche per portare a termine compiti e risolvere problemi)/", $line) or
			preg_match('/^Abilità/', $line))
			$state='Abilità';
			
		if (preg_match("/(capacità di usare conoscenze, abilità e capacità personali in situazioni di lavoro.studio)/", $line) or
		   preg_match('/^Competenze/', $line))
			$state='Competenze';
	
		if ($state==$previous)
		{
			if (!in_array($line, array(
				'Obiettivi disciplinari', 
				'Conoscenze', 
				'Abilità/Capacità', 
				'Competenze',
				'Contenuti',
				'Note e commenti in fase di progettazione',
				'(nuclei fondanti delle discipline-saperi essenziali)',
				"(nell’utilizzare e padroneggiare conoscenze anche per portare a termine compiti e risolvere problemi)",
				"(capacità di usare conoscenze, abilità e capacità personali in situazioni di lavoro/studio)",
				))
				
				and
				
				$line!=''
				
				)
				
				
			$text.=$line;
			}
		else
			{
			$mymodules['modulo '. $num_modulo][$previous]=$text;
			
			$text='';
			
			echo "\n------> aggiunta riga per $previous\n";

			if ($previous=='Competenze')
				$num_modulo++;
			}
			
		$previous=$state;
	}


foreach(
	Array('Livelli di partenza rilevati', 'Area di progetto', 'Attività extracurricolari', 'Valutazione', 'Prove di verifica sommative', 'Recupero', 'Commenti', 'Considerazioni finali')
	as $group)
	{
		if (isset($mycontents[$group]))
			$data['workplan_report']['info'][$group]=$mycontents[$group];
		else
			$data['workplan_report']['info'][$group]="";
			
	}

foreach($mymodules as $mymodule)
	{

if($mymodule['_periodo']!='')
{

	if ($mymodule['_periodo']=='')
		$mymodule['_periodo']=='---';

	$data['workplan_report']['modules'][$mymodule['_titolo_modulo']]['period']=$mymodule['_periodo'];
}
	$mymodule_array=Array();
	foreach(
		Array('Contenuti', 'Conoscenze', 'Abilità', 'Competenze', 'Note e commenti in fase di progettazione')
		as $group)
		{
			if (isset($mymodule[$group]))
				{
				$built=Array();
				$rank=0;
				foreach(explode("\t", $mymodule[$group]) as $myitem)
					{
						$myitem=chop($myitem);
						if (in_array(substr($myitem, -1), array(';', '.')))
							$myitem=substr($myitem, 0, -1);
						$myitem=str_replace("’", "'", $myitem);

						if ($myitem!='')
							$built[]=Array('content'=>$myitem, 'rank'=>++$rank, 'evaluation'=>null);
					}
				$mymodule_array[]=Array($group=>$built);
				unset($built);
				}
		}
		$data['workplan_report']['modules'][$mymodule['_titolo_modulo']]['details']=$mymodule_array;
		unset($mymodule_array);
		
	}


//echo sfYaml::dump($data, 10);

file_put_contents($outfile, sfYaml::dump($data, 10));

echo "done --> $outfile.\n";
