<?php
        class ChooseUserForm extends sfForm
        {
          public function configure()
          {
			$accounts=sfConfig::get('app_config_accounts');
			
			$accountChoices=array('0'=>'Choose the account type');
			
			foreach($accounts as $account)
			{
				$accountChoices[$account]=$account;
			}
			
			$userlist=sfGuardUserProfilePeer::retrieveUsersOfGuardGroup('student');
			
			$userChoices=array('0'=>'Choose a user');
			foreach($userlist as $user)
			{
				$userChoices[$user->getsfGuardUser()->getUsername()]=$user->getsfGuardUser()->getUsername() . ' ('. $user->getsfGuardUser()->getProfile()->getFullname() . ')';
			}
			
            $this->setWidgets(array(
			  'username' => new sfWidgetFormSelect(array('choices'=>$userChoices)),
			  'account' => new sfWidgetFormSelect(array('choices'=>$accountChoices))
           ));

			$this->widgetSchema->setNameFormat('info[%s]');
			
			$this->setValidators(array(
				'username' => new sfValidatorChoice(array('choices'=>array_keys($userChoices))), 
				'account' => new sfValidatorChoice(array('choices'=>array_keys($accountChoices))), 
			));
			
			}

	}