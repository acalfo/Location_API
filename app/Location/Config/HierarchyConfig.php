<?php 
namespace Location\Config;


class HierarchyConfig {

	protected $hierarchy_config;

	public function __construct() {
		$this->hierarchy_config = array(
			1 => "country_name",
			2 => "state_name",
			3 => "city_name",
			4 => "street_name",
			5 => "street_number",
			6 => "room_number"
		);
	}

	public function getConfig() 
  	{
  		return $this->hierarchy_config;
  	}

}