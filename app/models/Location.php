<?php

class Location extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'location';

	protected $hierarchyService;

	protected $primaryKey = 'location_id';

	protected $guarded = ['location_id'];
	protected $fillable = array(
		'country_name', 
		'state_name',
		'city_name',
		'street_name',
		'street_number',
		'room_number',
		'user_id',
		'level'
	);
	protected $emptyOk = array(
		'level' => 1,
		'user_id' => 1
	);

	public function __construct($attributes = array(), $exists = false)  {
	 	// Eloquent
        parent::__construct($attributes); 
        
    }

    //param: {array} $inputs => form inputs
    //@return True if All inputs in form that are required are EMPTY
    public function emptyInputs($inputs) 
    {
    	foreach($inputs as $key => $value) 
    	{
    		if(!empty(trim($value)) && in_array($key, $this->fillable) && !in_array($key, $this->emptyOk)) {
    			return false;
    		}
    	}
    	return true;
    }
}
