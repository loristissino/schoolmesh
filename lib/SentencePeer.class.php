<?php 
class SentencePeer{
	

	static private $sentences=array(
	'ga_csv_upload'=>'Upload the file of users in CSV format that you previosly downloaded from the Google Apps dashboard.',
	'ga_csv_upload_after'=>'After upload, it is recommended that you run standard user checks.',
	'ga_csv_download'=>'Download the file of users whose accounts have been approved and need to be created on Google Apps.',
	'users_new'=>'Create a new user.',
	'users_bulk_upload_teachers'=>'Upload a file in CSV format containing updated information about teachers.',
	'users_bulk_upload_classes'=>'Upload a file in CSV format containing updated information about classes.',
	'users_bulk_upload_students'=>'Upload a file in CSV format containing updated information about students.',
	'users_bulk_upload_others'=>'Upload a file in CSV format containing updated information about other users.',
	'users_bulk_upload_appointments'=>'Upload a file in CSV format containing updated information about appointments.',

	'users_bulk_upload_classes_format'=>'id,grade,section,track,description',
	'users_bulk_upload_classes_example'=>"1AI,1,A,I,Classe 1^A IGEA\n2AI,2,A,I,Classe 2^A IGEA\n...",
	
	'run_user_checks'=>'Run all system checks to see whether everything is ok.',
	
	
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