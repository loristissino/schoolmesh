<?php

class Wpinfo extends BaseWpinfo
{
	
	public function setCheckedContent($user_id, $v)
	{
		
		if ($this->getAppointment()->getState()!=$this->getWpinfoType()->getState())
		{
					$result['result']='error_info';
					$result['message']='This content is not editable in this state.';
					return $result;
		}
		

		if ($this->getAppointment()->getUserId()!=$user_id)
		{
					$result['result']='error_info';
					$result['message']='This content is editable only by the owner';
					return $result;
		}


		$v=chop(html_entity_decode(strip_tags(str_replace('</p>', '<br />',$v), '<br><em>')));
		
		$template=$this->getWpinfoType()->getTemplate();
		
		if ($template!='')
			{
				
			$template=str_replace('<', '\<', $template);
			$template=str_replace('>', '\>', $template);
			$template=str_replace('.', '\.', $template);
			
			$template='|'.$template.'|';

			if (!preg_match($template, $v))
				{
					$result['result']='error_info';
					$result['message']='Content did not match the template.';
					return $result;
				}
			}
	
		$this->setContent($v);
		
		$result['result']='notice_info';
		$result['message']='Content saved.';

		return $result;
	}
	
	public function getHints()
	{
		
	    $c = new Criteria();
		$c->add(WpinfoPeer::WPINFO_TYPE_ID, $this->getWpinfoTypeId());
		$c->add(WpinfoPeer::ID, $this->getId(), Criteria::NOT_EQUAL);
		$c->add(WpinfoPeer::CONTENT, '', Criteria::NOT_EQUAL);
		$c->addJoin(WpinfoPeer::APPOINTMENT_ID, AppointmentPeer::ID); 
		$c->add(AppointmentPeer::USER_ID, $this->getAppointment()->getUserId());
		$c->addAscendingOrderByColumn(WpinfoPeer::CONTENT);
		$t=WpinfoPeer::doSelect($c);

		return $t;


	}
	
	public function getNext()
	{
		
	    $c = new Criteria();
		$c->add(WpinfoPeer::APPOINTMENT_ID, $this->getAppointmentId());
		$c->addJoin(WpinfoTypePeer::ID, WpinfoPeer::WPINFO_TYPE_ID); 
		$c->add(WpinfoTypePeer::STATE, $this->getAppointment()->getState());
		$c->addAscendingOrderByColumn(WpinfoTypePeer::RANK);
		$c->add(WpinfoTypePeer::RANK, $this->getWpinfoType()->getRank(), Criteria::GREATER_THAN);
		$t=WpinfoPeer::doSelectOne($c);
		return $t;
	}

	
}
