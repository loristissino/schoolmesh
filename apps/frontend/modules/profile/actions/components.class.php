<?php

class profileComponents extends sfComponents
        {
          public function executeInfo()
          {
            $this->softuser = softUser::getSoftUser();
            
            $this->current_user = $this->getUser()->isAuthenticated() ? $this->getUser()->getGuardUser() : $this->softuser;
            
            if (is_object($this->current_user))
            {
				
				$this->current_user->getProfile()
				->setLastActionAt(time())
				->save();
				
ob_start();


echo 'passato di qua: ' . time() . "\n";

$f=fopen('lorislog.txt', 'a'); fwrite($f, ob_get_contents());fclose($f);ob_end_clean();

				
				/* FIXME This should be refactored ...
				
                $this->disk_soft_quota_exceeded = $this->current_user->getProfile()->getDiskUsedBlocks() > $this->current_user->getProfile()->getDiskSetSoftBlocksQuota();

*/
            }
//            $this->softuser = softUser::getSoftUsername();
 //           $this->fullname = softUser::getFullname();
          }
        }
