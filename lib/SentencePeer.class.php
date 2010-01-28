<?php 
class SentencePeer{
	

	static private $sentences=array(
	'ga_csv_upload'=>'Upload the file of users in CSV format that you previosly downloaded from the Google Apps dashboard.',
	'ga_csv_upload_after'=>'After upload, it is recommended that you run standard user checks.',
	'ga_csv_download'=>'Download the file of users whose accounts have been approved and need to be created on Google Apps.',
	'users_new'=>'Create a new user.',
	'users_bulk_upload_users'=>'Upload a file in CSV format containing updated information about users.',
	'users_bulk_upload_users_format'=>'type,first_name,middle_name,last_name,gender,birthdate,birthplace,email,import_code,group,extra_info',
	'users_bulk_upload_users_example'=>"T,Francesco,Pietro,Genova,M,19651230,Valvasone(PN),francesco.genova@istruzione.it,GNVFRN,dipinfo,\nO,Pasquale,,De Rolandis,M,,,DRLPSQ,,\nS,Alice,,Alessandrini,F,,,LSSLCA,4AP,IRC\n...",
	
	'users_bulk_upload_appointments'=>'Upload a file in CSV format containing updated information about appointments.',
	'users_bulk_upload_appointments_format'=>'username,class,subject_id,hours,year_id',
	'users_bulk_upload_appointments_example'=>"bruna.bagala,3AP,ING,99,2008_09\nmarco.defilippis,4AP,INF,165,2008_09\n...",

	'users_bulk_upload_classes'=>'Upload a file in CSV format containing updated information about classes.',
	'users_bulk_upload_classes_format'=>'id,grade,section,track,description',
	'users_bulk_upload_classes_example'=>"1AI,1,A,I,Classe 1^A IGEA\n2AI,2,A,I,Classe 2^A IGEA\n...",
	
	'run_user_checks'=>'Run all system checks about users to see whether everything is ok.',
	'run_team_checks'=>'Run all system checks about teams to see whether everything is ok.',
	'create_accounts'=>'Create all missing children accounts (in the database)',
	);

	public static function getSentence($key)
	{
		if (array_key_exists($key, self::$sentences))
		{
			return self::$sentences[$key];
		}
		else
		{
			return 'UNDEFINED MESSAGE';
		}
		
	}

}