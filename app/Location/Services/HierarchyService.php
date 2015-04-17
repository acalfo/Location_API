<?php 
namespace Location\Services;

use Location\Config\HierarchyConfig;
use Location\Repositories\LocationRepository;
use Location;

class HierarchyService {
 	
	protected $config;
	protected $repo;
	protected $row;

	public function __construct(HierarchyConfig $hierarchy_config, LocationRepository $repo) {
		$this->config = $hierarchy_config->getConfig();
		$this->repo = $repo;
	}

	public function setParents() 
  	{
  		$this->rows = Location::all();

  		//For Each row process data with config
  		foreach($this->rows as $location) 
  		{
  			$parent = $this->findClosestParent($location);

  			//Set $parent to the model
  			$location->parent = $parent;
  			$location->push();
  		}
  	}

  	public function findClosestParent($entry) {
  		$current_parent = 0;

  		foreach($this->rows as $row) 
  		{
  			//only check rows at a lower level than entry (Hierarchy is bottom up).
  			if($row['level'] < $entry['level']) 
  			{
  				if($this->parentCompare($row, $entry) != false) 
  				{
  					//Set entry's parent to row
  					if(!$current_parent)
  					{
  						$current_parent = $row;
  					} 
  					else if($current_parent['level'] < $row['level'])
  					{
  						$current_parent = $row;
  					}
  				}
  			}
  		}
  		//convert parent to primary key if it exists
		if(is_object($current_parent)) 
		{
			$current_parent = $current_parent['location_id'];
		}
  		return $current_parent;
  	}

  	//Returns true if parent input is a valid parent for entry.
  	public function parentCompare($parent, $entry) 
  	{
  		$current_level = $entry['level']-1;

		while( $current_level > 0 ) 
  		{
  			$current_field = $this->config[$current_level];

  			$entry_value = $entry->$current_field;
  			$parent_value = $parent->$current_field;
  				
  			if($this->notEmpty($parent_value)) 
  			{ 
  				if( strcmp ( strtolower($parent_value) , strtolower($entry_value) ) != 0)
  				{
  					return false;
  				}
  			}
	  			
  			$current_level --;
  		}

  		return true;
  	}

  	public function addAllParents($location)
  	{
  		$data = [];

  		$data = array_merge($data, array(
    			'location' => $location
    	));

  		$parents = [];
  		$current_level = $location->level;
  		while($current_level > 0 && $location->parent != 0) 
  		{
  			$location = $this->repo->getOne($location->user_id, $location->parent);
  			if($location) 
  			{
  				$parents = array_merge($parents, array($location));
  			} 
  			else 
  			{
  				return undefined;
  			}
  			$current_level--;
  		}
  		$data = array_merge($data, array(
    			'ancestors' => $parents
    	));
    	
    	return array(
	        'data' => $data
	    );
  	}

  	public function getCommonAncestor($loc1, $loc2) 
  	{
  		//Init 
  		if ( $loc1->level >= $loc2->level )
  		{
  			$parent = $loc2;
  			$child = $loc1;
  		}
  		else 
  		{
  			$parent = $loc1;
  			$child = $loc2;
  		}

  		//Process
  		while( $child->parent != 0) 
  		{
  			$current_level = $parent->level;
  			$parentRunner = $parent;

  			while ( $current_level > 0 && $parentRunner  )
  			{
  				if($child->parent == $parentRunner->location_id) 
	  			{
	  				return $parentRunner;
	  			}
	  			$current_level--;
	  			$parentRunner = $this->repo->getOne($parentRunner->user_id, $parentRunner->parent);
	  		}
	  		$child = $this->repo->getOne($child->user_id, $child->parent);
  		}
  		return false;
  	}

  	public function getLevel($location) 
  	{
		$current_level = count($this->config);

		while($current_level > 0) {
			$current_field = $this->config[$current_level];

			if(!empty(trim($location[$current_field]))) 
			{
				return $current_level;
			}

			$current_level--;
		}
		return 1;
  	}

  	//@todo move functions like this into a helper function service
  	public function notEmpty($value1) 
  	{
  		if( !$value1 || strcmp ( $value1, "" ) == 0 )
  		{
  			return false;
  		}
  		return true;
  	}

}