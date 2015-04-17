<?php

use Location\Services\Responder;
use Location\Services\HierarchyService;

class LocationController extends \BaseController {

	protected $responder;

	public function __construct(Responder  $responder, HierarchyService $hiService) {
		$this->responder = $responder;

		//Initialize Location model parents
		$hiService->setParents();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(
	        $this->responder->getAllByUser(Auth::user()->id),
	        200
	    );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = array_add(Request::all(), 'user_id', Auth::user()->id);
		return Response::json(
	        $this->responder->store($inputs),
	        200
	    );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$inputs = Request::all();
		return Response::json(
	        $this->responder->getByUser(Auth::user()->id, $id, $inputs),
	        200
	    );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{		
		$inputs = array_add(Request::all(), 'user_id', Auth::user()->id);
	    return Response::json(
	        $this->responder->update($inputs),
	        200
	    );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return Response::json(
	        $this->responder->delete(Auth::user()->id, $id),
	        200
	    );
	}


}
