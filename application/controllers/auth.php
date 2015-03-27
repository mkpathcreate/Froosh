<?php
/* This Controller only for Social network Login */
class auth extends CI_Controller
{

	public function index(){
	//$this->load->view('login');
	
	}
	public function __construct()
	    {
        	parent::__construct();
	        session_start();
		$this->ci = &get_instance();
		$this->ci->load->config('oauth', TRUE);
		$this->values = $this->ci->config->item('oauth');
		
	    }

    public function session($provider)
    {
        $this->load->helper('url_helper');

	$x=$this->uri->segment(3);
		if($x=="twitter")
		{

		$type="twitter";

		$this->load->helper('url');
	        $this->load->spark('oauth/0.3.1');

		$this->load->library('OAuth');
		

		
		        // Create an consumer from the config
		        $consumer = $this->oauth->consumer(array(
		            'key' =>  $this->values['twitter']['consumer_key'],
		            'secret' => $this->values['twitter']['key_secret'],
                            'callback'=>$this->values['twitter']['redirect_uri']
		        ));

			// Load the provider
		        $provider = $this->oauth->provider($provider);

		        // Create the URL to return the user to
		        $callback = site_url('auth/oauth/'.$provider->name);

			        if ( ! $this->input->get_post('oauth_token'))
			        {
		            // Add the callback URL to the consumer
		            $consumer->callback($callback); 

		            // Get a request token for the consumer
		            $token = $provider->request_token($consumer);

		            // Store the token
		            $this->session->set_userdata('oauth_token', base64_encode(serialize($token)));

		            // Get the URL to the twitter login page
		            $url = $provider->authorize($token, array(
		                'oauth_callback' => $callback,
		            ));

		            // Send the user off to login
		            redirect($url);
		        }
		        else
		        {
			            if ($this->session->userdata('oauth_token'))
			            {
			                // Get the token from storage
        	        		$token = unserialize(base64_decode($this->session->userdata('oauth_token')));
			            }

			            if ( ! empty($token) AND $token->access_token !== $this->input->get_post('oauth_token'))
			            {   
			                // Delete the token, it is not valid
			                $this->session->unset_userdata('oauth_token');

			                // Send the user back to the beginning
			                exit('invalid token after coming back to site');
			            }
	
       				    // Get the verifier
			            $verifier = $this->input->get_post('oauth_verifier');
			            // Store the verifier in the token
			            $token->verifier($verifier);

			            // Exchange the request token for an access token
		        	    $token = $provider->access_token($consumer, $token);

			            // We got the token, let's get some user data
			            $user = $provider->get_user_info($consumer, $token);

			            // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
			            // If you store it all in a cookie and redirect to a registration page this is crazy-simple.
					
					$output=array();
					$user['username']=$user['name'];

					
					
					$output['user']=$user;
					$output['user']['mode']="twitter";
					$this->load->model('mail_module');
					$return_value =$this->mail_module->uname_verify1($user['username']);

					
					
					if($return_value)
					{
						if ($this->agent->is_mobile())
						{
						
						 $this->load->library('session');
						 $this->session->set_userdata('logged_in', $return_value);
							$session_data = $this->session->userdata('logged_in');
							$this->load->model('mail_module');
						   	$img_res=$this->mail_module->userimages($session_data['uid']);
								if($img_res)
								{	
									
								$this->load->view('fupload_view',$img_res);
							   	}
								else
								{
								$data['uid']= $session_data['uid'];
								
								$this->load->view('fupload_view',$data);
								}
						}
						elseif ($this->agent->is_browser())
						{
						
						
						 $this->load->library('session');
						 $this->session->set_userdata('logged_in', $return_value);
						
							echo "<script>window.close();</script>";

						}
									
					}
					else
					{
					
					

			
						if ($this->agent->is_mobile())
						{
						
						$this->load->helper(array('form', 'url','captcha','string'));	
						$output['umedia']="Mobile";
						$na=$user['name'];
						$vals = array(
					        'img_path' => 'assets/captcha',
					        'img_url' => base_url().'assets/captcha',
						'word'          => random_string('numeric', 6),
						'img_width' => '250',
				        	'img_height' => '30',
					        'expiration' => '7200'
				        	);
		
						$captcha = create_captcha($vals);
		
      
      						/* Store the captcha value (or 'word') in a session to retrieve later */
						$this->session->set_userdata('captchaWord', $captcha['word']);
					        $output['image']=$captcha['image'];
						$this->load->view('mail_register_mobile',$output);
						}
						elseif ($this->agent->is_browser()){
						$output['umedia']="PC";
						$na=$user['name'];
						echo "<script>window.close();window.opener.updateValue('uname','$na');window.opener.updateValue('umode','twitter');</script>";
						}	
					
					}			
					
										
					

				 
			        }


		 }
		
		else
		{
		$this->load->spark('oauth2/0.3.1');
		$this->load->library('OAuth2');
		if($x=="instagram")
		{
		
		
		 $provider = $this->oauth2->provider($provider, array(
		          'id' =>$this->values['instagram']['consumer_key'],
		          'secret' => $this->values['instagram']['key_secret'],
		          'redirect_uri'=>$this->values['instagram']['redirect_uri']
		 ));
		}
		elseif($x=="facebook")
		{
			 $provider = $this->oauth2->provider($provider, array(
		        'id' =>$this->values['facebook']['consumer_key'],
		        'secret' => $this->values['facebook']['key_secret']
	     		));
		}
		

        if ( ! $this->input->get('code'))
        {
            // By sending no options it'll come back here
            $provider->authorize();
        }
        else
        {
            
            try
            {
	
		$this->load->library('instagram_api');
               $token = $provider->access($_GET['code']);
		
		$auth_response = $this->instagram_api->authorize($_GET['code']);
		
		
                $user = $provider->get_user_info($token);

               

			if($provider->name=="facebook")
			{
					$output=array();
					
					$user['username']=$user['name'];
					$user['uprefecture']=$user['uprefecture'];
					$user['ugender']=$user['gender'];
					$output['user']=$user;
					$output['user']['mode']="facebook";

					$this->load->model('mail_module');
					$return_value =$this->mail_module->uname_verify1($user['username']);
					
					
					if($return_value!='')
					{
						if ($this->agent->is_mobile())
						{
						
						$this->load->library('session');
						 $this->session->set_userdata('logged_in', $return_value);
							$session_data = $this->session->userdata('logged_in');
							$this->load->model('mail_module');
						   	$img_res=$this->mail_module->userimages($session_data['uid']);
								if($img_res)
								{	
									
								$this->load->view('fupload_view',$img_res);
							   	}
								else
								{
								$data['uid']= $session_data['uid'];
								
								$this->load->view('fupload_view',$data);
								}
                                                  
						}
						elseif ($this->agent->is_browser())
						{
						

						$this->load->library('session');
						 $this->session->set_userdata('logged_in', $return_value);
						 
							echo "<script>function check_data(){var pathArray = window.opener.location.pathname.split( '/' );if
(pathArray[4]!='login')alert('You Are Already registered with this Site. So sigin with your Information'); }check_data();window.close();</script>";
						
                                                     


						}
									
					}
					else
					{
						if ($this->agent->is_mobile())
						{
						
						
						$this->load->helper(array('form', 'url','captcha','string'));	
						$output['umedia']="Mobile";
						$na=$user['name'];
						$vals = array(
					        'img_path' => 'assets/captcha',
					        'img_url' => base_url().'assets/captcha',
						'word'          => random_string('numeric', 6),
						'img_width' => '250',
				        	'img_height' => '30',
					        'expiration' => '7200'
				        	);
		
						$captcha = create_captcha($vals);
		
      
      						/* Store the captcha value (or 'word') in a session to retrieve later */
						$this->session->set_userdata('captchaWord', $captcha['word']);
						if($user['gender']=="male"){
						
						$output['user']['ugender']="マレ";
						}
						if($user['gender']=="female")
						{
						
						$output['user']['ugender']="女性";
						}
					        $output['image']=$captcha['image'];
						if($user['birthdate']!='')
							{
								$output['user']['ubdate'] = date("Y-m-d", strtotime($user['birthdate']));
							}
						else 
							$output['user']['ubdate']="";
					        $output['user']['uprefecture']=$user['uprefecture'];
						$this->load->view('mail_register_mobile',$output);
						}

						elseif ($this->agent->is_browser()){
						
						$output['umedia']="PC";
						$na=$user['name'];
						$em=$user['email'];
						$gen=$user['gender'];
						$pre=$user['uprefecture'];
						if($user['birthdate']!=''){
						
						
						$bdate = date("Y-m-d", strtotime($user['birthdate']));
						}
						else 
						$bdate="";
						echo "<script>window.close();window.opener.updateValue('uname','$na');window.opener.updateValue('umode','facebook');window.opener.updateValue('uemail','$em');window.opener.updateValue('ubdate','$bdate');window.opener.updateValue('uprefecture','$pre');window.opener.updateValue('ugender','$gen');</script>";
						}
					}			


					

		}
		
	


            }

            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }

        }
		
		}
    }
}

