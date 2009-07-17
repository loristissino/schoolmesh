<?php

class Wpinfo extends BaseWpinfo
{
	public function __toString()
	{
		if ($this->getContent())
			return $this->getContent();
		else
			return 'No value';
	
	}
	
	
	public function checkContentAgainstTemplate($content, $template='')
		{
			if ($template=='')
				{
					$template=$this->getWpinfoType()->getTemplate();
				}
				
			if ($template=='')
				{
					return true;
				};
				
			$template=str_replace('<', '\<', $template);
			$template=str_replace('>', '\>', $template);
			$template=str_replace('.', '\.', $template);
			
			$template='|'.$template.'|';

			return preg_match($template, $content);
		}
	
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


		$v=str_replace('</p>', '<br />',$v);
		$v=str_replace('<br/>', '<br />',$v);
		$v=str_replace('<br>', '<br />',$v);

		$v=html_entity_decode(strip_tags($v, '<br><em>'));
				
		$lines=explode('<br />', $v);
				
		$newcontent='';
		foreach($lines as $line)
			{
				$line=ltrim(rtrim($line));
				if (!(($line=='')||($line==' ')||($line==chr(194).chr(160))))  // don't know why, but these chars are added up...
					{
						$newcontent .= $line .'<br />';
					}
			}
			
		$v=$newcontent;

		if (!$this->checkContentAgainstTemplate($v))
			{
				$result['result']='error_info';
				$result['message']='Content did not match the template.';
				return $result;
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
		$c->add(WpinfoPeer::CONTENT, $this->getContent(), Criteria::NOT_EQUAL);
		$c->addJoin(WpinfoPeer::APPOINTMENT_ID, AppointmentPeer::ID); 
		$c->add(AppointmentPeer::USER_ID, $this->getAppointment()->getUserId());
		$c->addAscendingOrderByColumn(WpinfoPeer::CONTENT);
		$t=WpinfoPeer::doSelect($c);
		
		$r=Array();
		
		$previous='';
		foreach($t as $item)
			{
				if ($item->getContent()!=$previous)
					{
						if ($previous!='')
							{
								array_push($r, $w);
							}
						$w=new Hint($item->getContent(), $item->getId());
						$previous=$w->getContent();
					}
				$w->addUsedIn($item->getAppointment());
			}
		if (isset($w))
			{
				array_push($r, $w);
			}
		return $r;
	}

	public function getExample()
	{
		return $this->getWpinfoType()->getExample();
		
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
