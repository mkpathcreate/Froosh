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
		// $this->oauth->authorize($type);  

		
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

					
					//$user['username']=$user['screen_name'];
					$output['user']=$user;
					$output['user']['mode']="twitter";
					if ($this->agent->is_mobile())
					{
					//$this->load->view('mail_register_mobile',$output);
					$output['umedia']="Mobile";
					$na=$user['name'];
					echo "<script>window.close();window.opener.updateValue('uname','$na');window.opener.updateValue('umode','twitter');</script>";
					}
					elseif ($this->agent->is_browser()){
					$output['umedia']="PC";
					$na=$user['name'];
					echo "<script>window.close();window.opener.updateValue('uname','$na');window.opener.updateValue('umode','twitter');</script>";
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
		//extra
		$this->load->library('instagram_api');
               $token = $provider->access($_GET['code']);
		//extra
		$auth_response = $this->instagram_api->authorize($_GET['code']);
		
		
                $user = $provider->get_user_info($token);

                // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
                // If you store it all in a cookie and redirect to a registration page this is crazy-simple.

			if($provider->name=="facebook")
			{
					$output=array();
					$user['username']=str_replace(" ","",$user['name']);
					$output['user']=$user;
					$output['user']['mode']="facebook";
	
					if ($this->agent->is_mobile())
					{
					$output['umedia']="Mobile";
					//$this->load->view('mail_register_mobile',$output);
					$na=$user['name'];
					$em=$user['email'];
							
					echo "<script>window.close();window.opener.updateValue('uname','$na');window.opener.updateValue('umode','facebook');window.opener.updateValue('uemail','$em');</script>";
					}
					elseif ($this->agent->is_browser()){
					//$this->load->view('mail_register',$output);
					$output['umedia']="PC";
					$na=$user['name'];
					$em=$user['email'];
							
					echo "<script>window.close();window.opener.updateValue('uname','$na');window.opener.updateValue('umode','facebook');window.opener.updateValue('uemail','$em');</script>";
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