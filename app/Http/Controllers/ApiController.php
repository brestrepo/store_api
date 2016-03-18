<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facades\Validator;

/**
 * Template for all api Controllers
 */
class ApiController extends Controller
{
	/**
	 * [$code default return status code if everything went fine]
	 * @var integer
	 */
	protected $code = 200;
	/**
	 * [$request]
	 * @var Request
	 */
	protected $request;
	/**
	 * [getStatus get for code var]
	 * @return [type] [description]
	 */
	protected function getCode() {
		return $this->code;
	}
	/**
	 * [setStatus set for code var]
	 * @param [type] $value [returns the object to be able to chain]
	 */
	protected function setCode($value) {
		$this->code = $value;
		return $this;
	}

	/*
	 *200 status
	 */
	/**
	 * [respondCreated respond with created code according to RFC]
	 * @param  [type] $data [description]
	 * @return [type]       [chains and respond json]
	 */
	protected function respondOk($data)
	{
		return $this->respond($data);
	}		
	/**
	 * [respondCreated respond with created code according to RFC]
	 * @param  [type] $data [description]
	 * @return [type]       [chains and respond json]
	 */
	protected function respondCreated($data)
	{
		return $this->setCode(201)->respond($data);
	}	
	/**
	 * [respondWithBadRequest respond with bad request]
	 * @return [type] [chains and respond with a bad request]
	 */
	protected function respondWithBadRequest($errors = [])
	{
		return $this->setCode(400)->respondWithError('Bad Request', $errors);
	}	
	/**
	 * [respondWith404 Respond with 404]
	 * @return [type] [chains and respond with 404]
	 */
	protected function respondWith404()
	{
		return $this->setCode(404)->respondWithError('Not found');
	}
	/**
	 * [respondWithError description]
	 * @param  [type] $message [Takes array and convert it in error stump]
	 * @return [type]          [chains respond with error message]
	 */
	protected function respondWithError($message, $errors = [])
	{
		return $this->respond([ 'errors' => array_merge([
				'message' => $message
			], $errors)
		]);		
	}
	/**
	 * [respond description]
	 * @param  [type] $data    [array]
	 * @param  array  $headers [array]
	 * @return [type]          [json response]
	 */
	protected function respond($data, $headers = [])
	{
		return Response::json($data, $this->code, $headers);
	}


}