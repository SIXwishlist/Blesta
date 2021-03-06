<?php
/**
 * Internetbs API response handler
 * @package internetbs
 */
class InternetbsResponse {
	
	/**
	 * @var SimpleXMLElement The XML parsed response from the API
	 */
	private $xml;
	/**
	 * @var string The raw response from the API
	 */	
	private $raw;

	/**
	 * Initializes the Internetbs Response
	 *
	 * @param string $response The raw XML response data from an API request
	 */
	public function __construct($response) {
		$this->raw = $response;
		
		try {
			$this->xml = new SimpleXMLElement($this->raw, LIBXML_NOCDATA);
		}
		catch (Exception $e) {
			// Invalid response
		}
	}
	
	/**
	 * Returns the CommandResponse
	 *
	 * @return stdClass A stdClass object representing the CommandResponses, null if invalid response
	 */
	public function response() {
		if ($this->xml && $this->xml instanceof SimpleXMLElement) {
			return $this->formatResponse($this->xml);
		}
	   	return null;
	}
	
	/**
	 * Returns the status of the API Responses
	 *
	 * @return string The status (OK = success, ERROR = error, null = invalid responses)
	 */
	public function status() {
		if ($this->xml && $this->xml instanceof SimpleXMLElement) {
          $ncode = "";
			if (isset($this->xml->status))
                $ncode = $this->xml->status;

				return $ncode;
		}
		return null;
	}


	/**
	 * Returns all errors contained in the response
	 *
	 * @return stdClass A stdClass object representing the errors in the response, false if invalid response
	 */
	public function errors() {
		if ($this->xml && $this->xml instanceof SimpleXMLElement && $this->xml->code > 0) {
			//$errors = array();
		   //	for ($i=1; $i<=$this->xml->code; $i++) {
			 //	$errors[] = (string)$this->xml->errors->{"Err" . $i};
            $errors = $this->xml->message;
           //}
			return $this->formatResponse($errors);
		}
		return false;
	}
	
	/**
	 * Returns the raw response
	 *
	 * @return string The raw response
	 */
	public function raw() {
		return $this->raw;
	}
	
	/**
	 * Formats the given $data into a stdClass object by first JSON encoding, then JSON decoding it
	 *
	 * @param mixed $data The data to convert to a stdClass object
	 * @return stdClass $data in a stdClass object form
	 */
	private function formatResponse($data) {
		return json_decode(json_encode($data));
	}
}
?>