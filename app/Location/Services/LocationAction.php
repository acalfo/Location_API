<?php 
namespace Location\Services;
use Location\Repositories\LocationRepository;
use Location\Services\HierarchyService;

class LocationAction {
 	
	protected $repo;

	public function __construct(LocationRepository $repo, HierarchyService $HierarchyService) {
		$this->repo = $repo;
    $this->hierarchyService = $HierarchyService;
	}

  //@todo better validation w/ service
  public function store ( $inputs ) 
    {
      $data = [];
      $error = true;
      try 
      {   
        //Store
        $location = $this->repo->store($inputs);

        //Validate store call.
        if ( !$location ) 
        {
          $data = array_merge($data, array(
            'message' => $message
          ));

          $data = array_merge($data, array(
            'error' => $error
          ));
        
          return array(
              'data' => $data
          );
      }
        else if ( $location->emptyInputs($inputs) ) 
        {
          $location->delete();
          $data = array_merge($data, array(
            'error' => $error
          ));

          $data = array_merge($data, array(
            'message' => $message
          ));
          
          return array(
              'data' => $data
          );
        } 

        //Validate level input.
        $validatedLevel = $this->hierarchyService->getLevel($location);
        if ( $location->level != $validatedLevel ) 
        {
          $location->level = $validatedLevel;
          $location->push();
        }

        //Update parent values w/ new entry info.
        $this->hierarchyService->setParents();

        $error = false;
        $data = array_merge($data, array(
          'location' => $location 
        ));

        $data = array_merge($data, array(
          'error' => false
        ));
        
        return array(
            'data' => $data
        );
        return array(
            'error' => $error,
            'location' => $location->toArray()
        );
      }
      catch ( Exception $e ) 
      {
        if ( $location ) {
          $location->delete();
        }
        return array(
            'error' => $e->getMessage(),
            'message' => "An Error Occurred while insterting into Database."
        );
      }
    }


  public function getOne ( $user_id, $location_id ) 
    {
      $data = [];
      $location = $this->repo->getOne($user_id, $location_id);
      if ( $location ) {
        //Add Locations to $data.
        $data = array_merge($data, array(
          'location' => $location 
        ));

        $data = array_merge($data, array(
          'error' => false
        ));
        
        return array(
            'data' => $data
        );
      } 
      else 
      {
        return undefined;
      }
    }

  public function getAll ($user_id) 
    { 
      $data = [];
      if($user_id)
      {
        $locations = $this->repo->getAll($user_id);

        if ( $locations ) {
          $data = array_merge($data, array(
            'locations' => $locations
          ));

          $data = array_merge($data, array(
            'error' => false
          ));
          
          return array(
              'data' => $data
          );
        }
      }
      return undefined;
    }

    public function update ( $inputs ) 
    {
      $data = [];
      $error = true;
      try 
      {   
        $location = $this->repo->update($inputs);
        
        if ( $location ) {
          //Update Parents on success
          $this->hierarchyService->setParents();

          $data = array_merge($data, array(
            'location' => $location 
          ));

          $data = array_merge($data, array(
            'error' => false
          ));
        
          return array(
              'data' => $data
          );
        } 
        else 
        {
          return array(
              'error' => $error,
              'message' => "An Error Occurred while saving to Database. " . $location
          );
        }
      }
      catch ( Exception $e ) 
      {
        return array(
            'error' => $e->getMessage(),
            'message' => "An Error Occurred while saving to Database."
        );
      }
    }

    public function delete ( $user_id, $location_id )  
    {
      $data = [];
      $message;
      $error = true;
      try 
      {
        if ( $this->repo->delete($user_id, $location_id) ) 
        {
          $error = false;    
          $message = "Deleted Location Successfully"; 
        }
        else 
        {
          $message = "An Error Occurred while deleting from Database.";
        }

      }
      catch( Exception $e ) 
      {
        $error = $e->getMessage();
        $message = "An Error Occurred while deleting from Database.";
      }

    $data = array_merge($data, array(
      'error' => $error
    ));

    $data = array_merge($data, array(
      'message' => $message
    ));
    
    return array(
          'data' => $data
      );
    }
}