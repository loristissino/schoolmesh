<?php 
class CheckList{
	
	protected $_checks;
		
	public function __construct()
		{
			$this->_checks = array();
		}
		
		public function addCheck($check)
		{
			
			if (!$check instanceof Check)
			{
				throw new Exception('you can add only Check instances');
			}
			$this->_checks[$check->getGroup()]['checks'][]=$check;
			$this->_checks[$check->getGroup()][$check->getResult()]++;

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
			return $this->_checks[$groupname]['checks'];
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
			return $this->_checks[$groupname][$result];
		}
	};
