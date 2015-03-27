<?php


abstract class OAuth2_Provider
{
	/**
	 * @var  string  provider name
	 */
	public $name;

	/**
	 * @var  string  uid key name
	 */
	public $uid_key = 'uid';

	/**
	 * @var  string  additional request parameters to be used for remote requests
	 */
	public $callback;

	/**
	 * @var  array  additional request parameters to be used for remote requests
	 */
	protected $params = array();

	/**
	 * @var  string  the method to use when requesting tokens
	 */
	protected $method = 'GET';

	/**
	 * @var  string  default scope (useful if a scope is required for user info)
	 */
	protected $scope;

	protected $info=array();
	/**
	 * @var  string  scope separator, most use "," but some like Google are spaces
	 */
	protected $scope_seperator = ',';

	/**
	 * Overloads default class properties from the options.
	 *
	 * Any of the provider options can be set here, such as app_id or secret.
	 *
	 * @param   array $options provider options
	 * @throws  Exception if a required option is not provided
	 */
	public function __construct(array $options = array())
	{
		if ( ! $this->name)
		{
			// Attempt to guess the name from the class name
			$this->name = strtolower(substr(get_class($this), strlen('OAuth2_Provider_')));


		}

		if (empty($options['id']))
		{
			throw new Exception('Required option not provided: id');
		}

		$this->client_id = $options['id'];
		
		isset($options['callback']) and $this->callback = $options['callback'];
		isset($options['secret']) and $this->client_secret = $options['secret'];
		isset($options['scope']) and $this->scope = $options['scope'];
		
		$this->redirect_uri = site_url(get_instance()->uri->uri_string());

		
		$this->info=$options;
		if($this->name=='twitter'){
		$this->redirect_uri = $this->values['twitter']['redirect_uri'];
		}
		
	}

	/**
	 * Return the value of any protected class variable.
	 *
	 *     // Get the provider signature
	 *     $signature = $provider->signature;
	 *
	 * @param   string $key variable name
	 * @return  mixed
	 */
	public function __get($key)
	{
		return $this->$key;
	}

	/**
	 * Returns the authorization URL for the provider.
	 *
	 *     $url = $provider->url_authorize();
	 *
	 * @return  string
	 */
	abstract public function url_authorize();

	/**
	 * Returns the access token endpoint for the provider.
	 *
	 *     $url = $provider->url_access_token();
	 *
	 * @return  string
	 */
	abstract public function url_access_token();

	/**
	 * @param OAuth2_Token_Access $token
	 * @return array basic user info
	 */
	abstract public function get_user_info(OAuth2_Token_Access $token);

	/*
	* Get an authorization code from Facebook.  Redirects to Facebook, which this redirects back to the app using the redirect address you've set.
	*/	
	public function authorize($options = array())
	{
		$state = md5(uniqid(rand(), true));
		get_instance()->session->set_userdata('state', $state);

		$params = array(
			'client_id' 		=> $this->client_id,
			'redirect_uri' 		=> isset($options['redirect_uri']) ? $options['redirect_uri'] : $this->redirect_uri,
			'state' 			=> $state,
			'scope'				=> is_array($this->scope) ? implode($this->scope_seperator, $this->scope) : $this->scope,
			'response_type' 	=> 'code',
			'approval_prompt'   => 'force' // - google force-recheck
		);
		
	       //$params['redirect_uri']	="http://rhytha.info/path/auth/session/facebook";
		
		$params = array_merge($params, $this->params);
		redirect($this->url_authorize().'?'.http_build_query($params));
	}

	/*
	* Get access to the API
	*
	* @param	string	The access code
	* @return	object	Success or failure along with the response details
	*/	
	public function access($code, $options = array())
	{
		$params = array(
			'client_id' 	=> $this->client_id,
			'client_secret' => $this->client_secret,
			'grant_type' 	=> isset($options['grant_type']) ? $options['grant_type'] : 'authorization_code',
		);
		
		$params = array_merge($params, $this->params);

		switch ($params['grant_type'])
		{
			case 'authorization_code':
				$params['code'] = $code;
				$params['redirect_uri'] = isset($options['redirect_uri']) ? $options['redirect_uri'] : $this->redirect_uri;
				//$params['redirect_uri'] = isset($options['redirect_uri']) ? urlencode($options['redirect_uri']) : $this->redirect_uri;
			break;

			case 'refresh_token':
				$params['refresh_token'] = $code;
			break;
		}

		$response = null;
		$url = $this->url_access_token();

		switch ($this->method)
		{
			case 'GET':

				// Need to switch to Request library, but need to test it on one that works
				$url .= '?'.http_build_query($params);
				//$url = preg_replace("/ /", "%20", $url);
				$response = file_get_contents($url);
				//	$response =url_get_contents($url);

				parse_str($response, $return);

			break;

			case 'POST':

				/* 	$ci = get_instance();

				$ci->load->spark('curl/1.2.1');

				$ci->curl
					->create($url)
					->post($params, array('failonerror' => false));

				$response = $ci->curl->execute();
				*/

				$opts = array(
					'http' => array(
						'method'  => 'POST',
						'header'  => 'Content-type: application/x-www-form-urlencoded',
						'content' => http_build_query($params),
					)
				);

				$_default_opts = stream_context_get_params(stream_context_get_default());
				$context = stream_context_create(array_merge_recursive($_default_opts['options'], $opts));
				//$response = file_get_contents($url, false, $context);

				//$return = json_decode($response, true);
				if($this->name=='instagram'){		
$post="client_id=".$this->info['id']."&client_secret=".$this->info['secret']."&grant_type=authorization_code&redirect_uri=".$this->info['redirect_uri']."&code=".$code;
				$ch = curl_init();
				    curl_setopt($ch, CURLOPT_URL, $url);
		 		    curl_setopt($ch, CURLOPT_POST, true);
				   curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
				    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				    $output = curl_exec($ch);
				    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); //get the code of request
				    curl_close($ch);
				
				$output=json_decode($output,true);
				

				$CI =&get_instance();
				$output['user']['mode']="instagram";
				$data=$output;
					$CI->load->model('mail_module');
					$return_value =$CI->mail_module->uname_verify1($data['user']['username']);
					if(!$return_value)
					{
						if ($CI->agent->is_mobile())
						{
						$CI->load->view('reg_success_mobile');
						}
						elseif ($CI->agent->is_browser())
						{
						//$pa=$this->load->view('reg_success');
						echo "<script>window.close();window.opener.updateview();</script>";
						$this->load->view('reg_success');
						}
									
					}
					else
					{
						if($CI->agent->is_mobile())
						{
						//$CI->load->view('mail_register_mobile',$data);	
						$data['umedia']="Mobile";
						$na=$data['user']['username'];
						
						echo "<script>window.close();window.opener.updateValue('uname','$na');window.opener.updateValue('umode','instagram');window.opener.updateValue('uemail','$em');</script>";
						}
						elseif ($CI->agent->is_browser())
						{
						//$CI->load->view('mail_register',$data);	
						$data['umedia']="PC";
						$na=$data['user']['username'];
						
						echo "<script>window.close();window.opener.updateValue('uname','$na');window.opener.updateValue('umode','instagram');window.opener.updateValue('uemail','$em');</script>";
						}
					}			

					
				

					
					$return=$output;
					}	
				else
				{
				$response = file_get_contents($url, false, $context);
				$return = json_decode($response, true);
				}
			
			break;

			default:
				throw new OutOfBoundsException("Method '{$this->method}' must be either GET or POST");
		}

		if ( ! empty($return['error']))
		{
			throw new OAuth2_Exception($return);
		}
		
		switch ($params['grant_type'])
		{
			case 'authorization_code':
				return OAuth2_Token::factory('access', $return);
			break;

			case 'refresh_token':
				return OAuth2_Token::factory('refresh', $return);
			break;
		}
		
	}



}
