<?php  
	namespace BehanceAPI;

	/**
	* This function makes the calls to the Behance API.
	*
	* This functions get the information from the .env file and uses cURL
	* to make the calls to the Behance API, then the same function it mapes 
	* the response from Behance and creates and array with the user or projects
	* information.
	*
	* @return void
	*/
	class BehanceAPI
	{
		
		/** 
		* @var object Contains the cURL handler 
		*/
		protected $curl_ch;

		/**
		* @var string Contains the Behance user id
		*/
		protected $user_id;

		/**
		* @var string Contains the max amount of projects that can be pulled from the Behance API
		*/
		protected $per_page;

		/**
		* @var string Contains the Behance Client id 
		*/
		protected $client_id;

		/**
		* @var string Contains base of the Behance API endpoint
		*/
		protected $api_endpoint;

		/** 
		* @var array|empty should have the user data 
		*/
		public $user_data;

		/** 
		* @var array|empty should have the projects data 
		*/
		public $user_projects;


		/**
		* The construct bring the variables from the .env file, initialize cURL and
		* sets some general options for cURL.
		*
		*
		* @return void
		*/
		function __construct()
		{
			$this->user_id = $_ENV['BEHANCE_USER_ID'];
			$this->per_page = $_ENV['BEHANCE_PER_PAGE'];
			$this->client_id = $_ENV['BEHANCE_CLIENT_ID'];
			$this->api_endpoint = $_ENV['BEHANCE_API_ENDPOINT'];

			$this->curl_ch = curl_init();

			curl_setopt($this->curl_ch, CURLOPT_HEADER, false);
			curl_setopt($this->curl_ch, CURLOPT_RETURNTRANSFER, true);
		}

		/**
		* This method bring all the information of the the user from Behance.
		*
		* This method builds the URL based on the information passed from the .env file,
		* then sets the URL to cURL and executes the request. it also checks if there's any error,
		* if it finds one, it call the error handler which is in the same class. If the response
		* is correct, it converts the response into an array and makes it available for the controller
		* trough the $user_data variable.
		*
		* @return void
		*/
		public function user_data()
		{
			
			$url_endpoint = $this->api_endpoint . $this->user_id . '?client_id=' . $this->client_id;

			curl_setopt($this->curl_ch, CURLOPT_URL, $url_endpoint);

			$response = curl_exec($this->curl_ch);

			false === $response ? $this->error_handler() : '';

			$user_data = json_decode($response, true);

			$this->user_data = $user_data;
		}


		/**
		* This method brings the projects from the Behance API.
		*
		* This method does pretty much the same as user_data() but it brings the amount of projects
		* defined in the .env file.
		*
		* @return void
		*/
		public function user_projects()
		{
			$url_endpoint = $this->api_endpoint . $this->user_id . '/projects?client_id=' . $this->client_id . '&per_page=' . $this->per_page;

			curl_setopt($this->curl_ch, CURLOPT_URL, $url_endpoint);

			$response = curl_exec($this->curl_ch);

			false === $response ? $this->error_handler() : '';

			$user_projects = json_decode($response, true);

			$this->user_projects = $user_projects;
		}

		/**
		* It's a handler for any error thrown by cURL.
		*
		* @return void
		*/
		protected function error_handler()
		{
			echo 'cURL error: ' . curl_error($this->curl_ch);
			exit();
		}

		/**
		* Disables the cURL SSL peer verification.
		*
		* @return void
		*/
		public function desc_ssl_verify()
		{
			curl_setopt($this->curl_ch, CURLOPT_SSL_VERIFYPEER, false);
		}

		/**
		* Cleans the cURL channel to make another request.
		*
		* @return void
		*/
		function __destruct()
		{
			curl_close($this->curl_ch);
		}
	}
?>