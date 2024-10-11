<?php

namespace App\Http\Controllers;

abstract class Controller
{
	protected $phone;
	
	public function __construct($data = []) {
		$this->validateData = new \App\Http\Requests\Data\General();
	}
}
