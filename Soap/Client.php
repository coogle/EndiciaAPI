<?php

class Endicia_Soap_Client extends SoapClient 
{
	public function __doRequest($request, $location, $action, $version, $one_way = 0)
	{
		return parent::__doRequest($request, $location, $action, $version, $one_way);
	}
}