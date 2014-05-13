<?php
class AuthController extends BaseController 
{
	
	public function _construct() 
	{
		
		
	}
	
	public function showLogin() 
	{
		return View::make("login");
	}
	
	public function doLogin()
	{
		
	}
}