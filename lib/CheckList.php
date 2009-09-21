<?php 
class CheckList{
	
	protected $_checks;
	
	protected $_longMessages=array(
		Check::FAILED=>'[0]No check failed.|[1]One check failed.|(1,+Inf]A total of %1 checks failed.',
		Check::PASSED=>'[0]No check passed.|[1]One check passed.|(1,+Inf]A total of %1 checks passed.',
		Check::WARNING=>'[0]There were no warnings.|[1]There was one warning.|(1,+Inf]There were %1 warnings.',
	);

	protected $_shortMessages=array(
		Check::FAILED=>'[0]ok|[1]one failed|(1,+Inf]%1 failed',
		Check::PASSED=>'[0]all wrong|[1]one check passed|(1,+Inf]%1 passed',
		Check::WARNING=>'[0]ok.|[1]one warning|(1,+Inf]%1 warnings',
	);
	
	public function __construct()
		{
			$this->_checks = array();
		}
		
	public function getLongMessage($result)
	{
		if (!in_array($result, array(Check::FAILED, Check::WARNING, Check::PASSED)))
		{
			throw new Exception('result invalid: '. $result);
		}
		return $this->_longMessages[$result];
	}

	public function getShortMessage($result)
	{
		if (!in_array($result, array(Check::FAILED, Check::WARNING, Check::PASSED)))
		{
			throw new Exception('result invalid: '. $result);
		}
		return $this->_shortMessages[$result];
	}

	public function addCheck(Check $check)
		{
			
			
			$this->_checks[$check->getGroup()]['checks'][]=$check;
			@$this->_checks[$check->getGroup()][$check->getResult()]++;

			return $this;
		}

		public function getAllChecks()
		{
			$fullList=array();
			foreach($this->_checks as $group)
			{
				foreach($group['checks'] as $check)
					{
						$fullList[]=$check;
					}
			}
			return $fullList;
		}
		

		public function getGroupNames()
		{
			return array_keys($this->_checks);
		}
		
		
		public function getChecksByGroupName($groupname)
		{
			if (isset($this->_checks[$groupname]['checks']))
			{
				return $this->_checks[$groupname]['checks'];
			}
			else
			{
				return array();
			}
		}
		
		public function countChecksByGroupName($groupname)
		{
			return sizeof($this->getChecksByGroupName($groupname));
		}
		
		public function getResultsByGroupName($groupname, $result)
		{
			if (!in_array($result, array(Check::FAILED, Check::WARNING, Check::PASSED)))
			{
				throw new Exception('result invalid: '. $result);
			}
			return @$this->_checks[$groupname][$result];
		}
		
		public function getTotalResults($result)
		{
			if (!in_array($result, array(Check::FAILED, Check::WARNING, Check::PASSED)))
			{
				throw new Exception('result invalid: '. $result);
			}
			$count=0;
			foreach($this->_checks as $group)
			{
				@$count+=$group[$result];
			}
			
			return $count;
		}
		
	};
