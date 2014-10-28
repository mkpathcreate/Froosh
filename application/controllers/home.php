<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	
	 public function __construct()
	 {
	 parent::__construct();
	
// if ( $this->input->post( 'remember_me' ) ) // set sess_expire_on_close to 0 or FALSE when remember me is checked.
  //          $this->config->set_item('sess_expire_on_close', '0'); // do change session config
 
        $this->load->library('session');
	$this->load->library('user_agent');
	$this->load->helper(array('form', 'url','captcha','string'));
	$this->load->library('form_validation');
	$this->load->database();
       

	 }
	 
	public function index()
	{
		if ($this->agent->is_mobile())
		{
    		$this->load->view('home_mobile');

		}
		elseif ($this->agent->is_browser())
		{
		$this->load->view('home');

		}
		//$this->mail();
	
		
	}
	public function mail()
	{

		$vals = array(
	        'img_path' => 'assets/captcha',
	        'img_url' => base_url().'assets/captcha',
		'word'          => random_string('numeric', 6),
		'img_width' => '150',
        	'img_height' => '30',
	        'expiration' => '7200'
        	);
		
		$captcha = create_captcha($vals);
		
      
      		/* Store the captcha value (or 'word') in a session to retrieve later */
		$this->session->set_userdata('captchaWord', $captcha['word']);
	        $data['image']=$captcha['image'];

	if ($this->agent->is_mobile())
	{
	
	$data['umedia']="Mobile";
	$this->load->view('mail_register_mobile',$data);
	}
	elseif ($this->agent->is_browser())
	{
	$data['umedia']="PC";	
	$this->load->view('mail_register',$data);
	}
		
	}
	
	//Mail user Registration
	public function register()
	{
		//$this->form_validation->set_rules('uemail', 'uemail', 'required|callback_check_usermail|trim');
		$this->form_validation->set_rules('captcha', "Captcha", 'required');
		//$userCaptcha = set_value('captcha');
		$userCaptcha =$this->input->post('captcha');
	
		$word = $this->session->userdata('captchaWord');
	  
		/* Check if form (and captcha) passed validation*/
		if ($this->form_validation->run() == TRUE &&
			strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0)
		{
     		 /** Validation was successful; show the Success view **/
	  
			if(file_exists( base_url()."assets/captcha".$this->session->userdata['captchaWord']))
					unlink(base_url()."assets/captcha".$this->session->userdata['captchaWord']);

			/* Clear the session variable */
			$this->session->unset_userdata('captchaWord');
      
      
	
			$data = $this->input->post();
			$this->load->model('mail_module');
			 
			$x=$this->mail_module->umregister($data);
			
			
				if($x=='')
				{

					$vals = array(
						'img_path' => 'assets/captcha',
						'img_url' => base_url().'assets/captcha',
						'word'    => random_string('numeric', 6),
						'img_width' => '150',
						'img_height' => '30',
						'expiration' => '7200'
						);
		
						$captcha = create_captcha($vals);
		
						/* Store the captcha value (or 'word') in a session to retrieve later */
						$this->session->set_userdata('captchaWord', $captcha['word']);
						$data['image']=$captcha['image'];

					if ($this->agent->is_mobile())
					{
	
						$data['umedia']="Mobile";
					$this->load->view('mail_register_mobile',$data);

					}
					elseif ($this->agent->is_browser())
					{
						$data['umedia']="PC";	
						$this->load->view('mail_register',$data);

 					 }
						

				}
				else
				{
					//echo "User Successfully Registered";
					if ($this->agent->is_mobile())
					{
						$this->load->view('reg_success_mobile');
					}
					elseif ($this->agent->is_browser())
					{
						$this->load->view('reg_success');

					}
					//$this->load->view('reg_success');
	
				}
		}
		else 
		{
      
			/** Validation was not successful - Generate a captcha **/
      
			/* Setup vals to pass into the create_captcha function */
			$vals = array(
				'img_path' => 'assets/captcha',
				'img_url' => base_url().'assets/captcha',
				'word'          => random_string('numeric', 6),
				'img_width' => '150',
				'img_height' => '30',
				'expiration' => '7200'
				);
		
			$captcha = create_captcha($vals);
		
      
			/* Store the captcha value (or 'word') in a session to retrieve later */
			$this->session->set_userdata('captchaWord', $captcha['word']);
			$user=array();
			$data['user']['username']=$this->input->post('uname');
			$data['user']['email']=$this->input->post('uemail');
			$data['user']['mode']=$this->input->post('umode');
			$data['umedia'] = $this->input->post('umedia');
			if($this->input->post('umode')!='mail')
			$data['user']['rusername']=1;
			else
			$data['user']['rusername']=0;
			$data['image']=$captcha['image'];
					if ($this->agent->is_mobile())
					{
					$this->load->view('mail_register_mobile',$data);
					}
					elseif ($this->agent->is_browser())
					{
				$this->load->view('mail_register',$data);	
					}
			//$this->load->view('mail_register');
	
	
		}
	}
	
	public function mview()
	{
		if ($this->agent->is_mobile())
		{
			$this->load->view('aregister_mobile');
		}
		elseif ($this->agent->is_browser())
		{
			$this->load->view('aregister');
		}
	}


	function check_usermail(){
	$this->load->model('mail_module');
	$return_value =$this->mail_module->uemail_verify();
	if(!$return_value)
    //echo '<span style="color:#f00">Email already in use. </span>';
	echo "use";
    else
    //echo '<span style="color:#0c0">Email Available</span>';
	echo "available";
	}

	
	function check_username(){
	$this->load->model('mail_module');
	$return_value =$this->mail_module->uname_verify();
	if(!$return_value)
    //echo '<span style="color:#f00">UserName already in use. </span>';
	echo "use";
    else
    //echo '<span style="color:#0c0">UserName Available</span>';
	echo "available";
	}

}

