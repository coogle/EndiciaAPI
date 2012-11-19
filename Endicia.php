<?php

class Endicida
{
	const TEST_WSDL = "https://www.envmgr.com/LabelService/EwsLabelService.asmx?WSDL";

	protected $_requesterId;
	protected $_accountId;
	protected $_passPhrase;
	protected $_requestId;
	
	protected $_client;
	
	function __construct() 
	{
		$this->_client = new SoapClient(self::TEST_WSDL);
	}
	
	public function setClient(SoapClient $client) 
	{
		$this->_client = $client;
		return $this;
	}
	
	public function getClient() 
	{
		return $this->_client;
	}
	
	public function setRequesterId($id) {
		$this->_requesterId = $id;
		return $this;
	}
	
	public function getRequesterId() {
		return $this->_requesterId;
	}
	
	public function getLastRequestId() {
		return $this->_requestId;
	}
	
	protected function generateRequestId() {
		$this->_requestId = uniqid("EAPI_", true);
		return $this->_requestId;
	}
	
	public function getAccountId() {
		return $this->_accountId;
	}
	
	public function setAccountId($accountId) {
		$this->_accountId = $accountId;
		return $this;
	}
	
	public function setPassPhrase($phrase) {
		$this->_passPhrase = $phrase;
		return $this;
	}
	
	public function getPassPhrase($phrase) {
		return $this->_passPhrase;
	}
	
	public function changePassPhrase($newPhrase) 
	{
		$request = array(
			'RequesterID' => $this->getRequesterId(),
			'RequestId' => $this->generateRequestId(),
			'CertifiedIntermediary' => array(
				'AccountID' => $this->getAccountId(),
				'PassPhrase' => $this->getPassPhrase()
			),
			'NewPassPhrase' => $newPhrase
		);
		
		return $this->_doRequest("ChangePassPhrase", $request);
	}
	
	protected function _doRequest($method, $request) {
		$result = $this->client->$method($request);
		return $result;
	}
}
