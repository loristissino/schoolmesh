<?php

/**
 * Wpinfo class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


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
    
  public function isCurrentlyEditable()
  {
		return ($this->getAppointment()->getState()==$this->getWpinfoType()->getStateMin());
  }

  public function isCurrentlyVisible()
  {
		if ($this->getAppointment()->getState() <= $this->getWpinfoType()->getStateMax() and $this->getAppointment()->getState() >= $this->getWpinfoType()->getStateMin())
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  
  public function isViewableBy($sf_user)
  {
    if($this->getContent()=='')
    {
      return false;
    }
    
    if(!$this->getWpinfoType()->getIsConfidential())
    {
      return true;
    }
    else
    {
      if($sf_user->hasCredential('wp_sm_ok') || $sf_user->hasCredential('wp_adm_ok'))
      {
        return true;
      }
      if($sf_user->getProfile()->getUserId()==$this->getAppointment()->getUserId())
      {
        return true;
      }
    }
    
    return false;
    
  }
  
	
	public function setCheckedContent($user, $v)
	{
		
		$user_id=$user->getProfile()->getSfGuardUser()->getId();
		
		if (!$this->isCurrentlyEditable() && !($user->hasCredential('backadmin')))
		{
					$result['result']='error_info';
					$result['message']='This content is not editable in this state.';
					return $result;
		}
		
		if ($this->getAppointment()->getUserId()!=$user_id && !($user->hasCredential('backadmin')))
		{
					$result['result']='error_info';
					$result['message']='This content is editable only by the owner.';
					return $result;
		}

		$v=str_replace(array('</p>', '<br/>', '<br>'), '<br />', $v);

		$v=html_entity_decode(Generic::strip_tags_and_attributes($v, '<br><em>'));
				
		$lines=explode('<br />', $v);
		
		if (sizeof($lines)>1)
			{
				$newcontent='';
				foreach($lines as $line)
					{
						$line=ltrim(rtrim($line));
						if (!(($line=='')||($line==' ')||($line==chr(194).chr(160))))  // don't know why, but these chars are added up...
							{
								$newcontent .= $line .'<br />';
							}
					}
			$newcontent = substr($newcontent, 0, -6);
			$v=$newcontent;
			}

		$this->setContent($v);

		if (!$this->checkContentAgainstTemplate($v))
			{
				$result['result']='error_info';
				$result['message']='Content did not match the template.';
				return $result;
			}
			
		
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
					if (isset($w))
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
		$c->add(WpinfoTypePeer::STATE_MIN, $this->getAppointment()->getState());
		$c->addAscendingOrderByColumn(WpinfoTypePeer::RANK);
		$c->add(WpinfoTypePeer::RANK, $this->getWpinfoType()->getRank(), Criteria::GREATER_THAN);
		$t=WpinfoPeer::doSelectOne($c);
		return $t;
	}

	
}
