<?php

class Wpinfo extends BaseWpinfo
{
	
	public function setCheckedContent($user_id, $v)
	{
		
		if ($this->getAppointment()->getState()!=Workflow::WP_DRAFT)
		{
					$result['result']='error_info';
					$result['message']='This content is not editable for a workplan not in draft state.';
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
	
}
