<?php 
namespace Location\Services;
use Location\Repositories\LocationRepository;
use Location\Services\LocationAction;
use Exception;

/*
	@note Want to Break this Responder service out a bit but don't have time 
*/
class Responder {
 	
	protected $repo;
	protected $hierarchyService;
	protected $action;

	public function __construct( LocationRepository  $repo, HierarchyService $hierarchyService, LocationAction $locAction) 
	{
		$this->hierarchyService = $hierarchyService;
		$this->repo = $repo;
		$this->action = $locAction;
	}

	//@todo better validation w/ service
	public function store ( $inputs ) 
  	{
  		return $this->action->store($inputs);
  	}

  	public function getAllByUser ( $user_id ) 
  	{
	    return $this->action->getAll($user_id);
  	}   

  	public function getByUser( $user_id, $location_id, $inputs ) 
  	{
  		try 
  		{
	  		if ( in_array( 'all' , $inputs ) )
	  		{
	  			return $this->getAllAncestors($user_id, $location_id);
	  		}
	  		else if ( in_array( 'common' , $inputs ) ) 
	  		{
	  			return $this->getCommonAncestor($user_id, $location_id, $inputs["id"]);
	  		}
	  		else 
	  		{
	  			return $this->action->getOne($user_id, $location_id);
	  		}
	  	}
	  	catch( Exception $e ) 
	    {
	    	return array(
		        'error' => $e->getMessage(),
		        'message' => "An Error Occurred while getting data from Database."

		    );
	    }

  	}

  	public function update ( $inputs ) 
    {
    	return $this->action->update($inputs);
    }

  	public function delete ( $user_id, $location_id )  
    {
    	return $this->action->delete($user_id, $location_id);
    }

  	public function getCommonAncestor ( $user_id, $location_id, $location2_id ) 
  	{
  		$error = true;
  		$data = [];
  		try 
  		{
  			$location1 = $this->repo->getOne($user_id, $location_id);
  			if($location1) {
  				$location2 = $this->repo->getOne($user_id, $location2_id);
  			}

	    	$ancestor = $this->hierarchyService->getCommonAncestor($location1, $location2);

	    	if ( $ancestor ) {
	    		$data = array_merge($data, array(
	    			'ancestor' => $ancestor
	    		));

	    		$data = array_merge($data, array(
	    			'error' => false
	    		));
	    		
	    		return array(
			        'data' => $data
			    );
	    	}

	    	//Else Return Error
			return array(
		        'data' => array(
		        	'error' => $error,
		        	'message' => "An Error Occurred while getting data from Database."
		        )
	    	);
	    }
	    catch ( Exception $e ) 
	    {
	    	//Else Return Error
			return array(
		        'data' => array(
		        	'error' => $e->getMessage(),
		        	'message' => "An Error Occurred while getting data from Database."
		        )
	    	);
	    }
  	}


  	public function getAllAncestors ( $user_id, $location_id ) 
  	{
  		$error = true;
  		try 
  		{
  			$locations = $this->action->getAll($user_id);
  			$data = $locations['data']['locations'];
  			// $location = $data[$location_id];
  			foreach($data as $key => $value) {
  				if($value->location_id == $location_id) {
  					unset($data[$location_id]);
  					$location = $value;
  				}
  			}
  			

	    	$data = $this->hierarchyService->addAllParents($location);

	    	if ( $data ) {
	    		return $data;
	    	}

	    	//Else Return Error
			return array(
		        'data' => array(
		        	'error' => $error,
		        	'message' => "An Error Occurred while getting data from Database."
		        )
	    	);
	    }
	    catch ( Exception $e ) 
	    {
	    	//Else Return Error
			return array(
		        'data' => array(
		        	'error' => $e->getMessage(),
		        	'message' => "An Error Occurred while getting data from Database."
		        )
	    	);
	    }
  	}
}