<?php 
namespace Location\Repositories;

use Location;

class LocationRepository {

 	public function store($inputs) 
	{
		$location = new Location($inputs);
		
		if(!$location) 
	    {
	    	return false;
	    }

	    $location->save();
	    return $location;
	}
	public function getOne($user_id, $location_id) 
	{
	  	$location = Location::where('user_id', $user_id)
					->find($location_id);

	    if(!$location) 
	    {
	    	return false;
	    }

	    return $location;
	}
	public function getAll($user_id) 
	{
	    $location = Location::where('user_id', $user_id)
					->get();
		if(!$location) 
	    {
	    	return false;
	    }

	    return $location;
	}    
	public function update($inputs) 
	{
		$location = Location::where('user_id', $inputs['user_id'])
	    				->find($inputs['location_id']);
	    if(!$location) 
	    {
	    	return false;
	    }

	    $location->fill($inputs);
	    
	    $location->save();
	    return $location;
	}
	function delete($user_id, $location_id) 
	{
		$location = Location::where('user_id', $user_id)
						->where('location_id', $location_id);
		if(!$location) 
	    {
	    	return false;
	    }		

    	$location->delete();
    	return true;
	}

}