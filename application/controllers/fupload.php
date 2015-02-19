<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class fupload extends CI_Controller {
  
public function __construct() 
  {
   parent::__construct();
   $this->load->helper(array('url','html','form'));
   $this->load->library('session');
 }
 
public function index() 
   {
   if ($this->agent->is_mobile())
			{
	$this->load->view('fupload_view_mobile');
	}
	else
	{
	$this->load->view('fupload_view');
	}
   }

public function imgflvdetails2(){
$this->load->model('image_module');
$session_data = $this->session->userdata('logged_in');
$uid=$session_data['uid'];
$imid=$this->input->post("imid");
$flvdet2=$this->image_module->flv_det2($uid,$imid);
if(isset($flvdet2)){
echo $flvdet2[0]['flv'];
}
}

public function imgflvdetails3(){
$this->load->model('image_module');
$session_data = $this->session->userdata('logged_in');
$uid=$session_data['uid'];
$imid=$this->input->post("imid");
$flvdet2=$this->image_module->flv_det3($uid);
if(isset($flvdet2)){
echo $flvdet2[0]['flv'];
}
}

public function upload() 
   {
	$flid=0;
        $butstatus=0;
	$imginfo['loc']=$_FILES['file']['tmp_name'];
	$this->load->model('image_module');
	$session_data = $this->session->userdata('logged_in');

	$uid=$session_data['uid'];


	if(isset($_POST['imid']) && $_POST['imid']!='undefined')
	{
		$im=$this->input->post('imid');
	}
	else
		$im='';

	if(isset($_POST['flavor']))
		$flv=$this->input->post('flavor');
	if($flv==1)
	{
		$flid=1;
		
		$flv="マンゴー＆オレンジ";
	}
	elseif($flv==2)
	{
		$flid=2;
		
		$flv="パイナップル・バナナ＆ココナッツ";
	}
	elseif($flv==3)
	{
		$flid=3;
		
		$flv="オレンジ・キャロット＆ジンジャー";
	}
	elseif($flv==4)
	{
		$flid=4;
		$flv="Carrot";
	}
	elseif($flv==5)
	{
		$flid=5;
		$flv="Strawberry";
	}
	else
	{
		$flid=0;
		
		$flv="マンゴー＆オレンジ";
	}
	if($im!='')
	{
		$x=$this->image_module->imgstatusup($im);
	}
	else
	{
		$x=$this->image_module->getphaimgsec($uid);
	}
	$res=array("loc"=>$imginfo,"file"=>$_FILES);
	if (!empty($_FILES)) 
	{
		 $config['upload_path'] = FCPATH.'uploads/';
	         $config['allowed_types'] = 'jpg|gif|png|jpeg';
	         $config['max_size'] = '30000';
	  	 $config['file_name'] = time() . rand(1,988);
		
		$config['remove_spaces'] = TRUE;
		$config['overwrite'] = FALSE;
	
		$upload_path_url = base_url().'uploads/';
	        $this->load->library('upload', $config);
		 
		
		foreach($_FILES as $field => $file)
            	{
               
                if($file['error'] == 0)
                {
					if ( $this->upload->do_upload($field)) {
					$data = $this->upload->data();
					
					}
					else
        		                { 
                    
                    			}
                }
            	}
			if($data['file_name']!='')
			$out['image_name']=$data['file_name'];
			else
			$out['image_name']=time().rand(1,988);
			$out['image_orig_name']=$_FILES['file']['name'];
			if(isset($uid))
			$out['u_id']=$uid;
			
			if(isset($x[0]))
			{
			$out['phase']=$x[0]['phase'];
			$out['image_sequence']=$x[0]['image_sequence'];
			}
			else
			{
			$out['phase']=1;
			$out['image_sequence']=1;
			}
			
			$out['image_up_media']='PC';
			$out['image_status']=1;
			$out['image_fla_id']=$flid;
			$out['image_fla_name']=$flv;
			$out['image_up_date']= date('Y-m-d H:i:s');
			$this->load->model('image_module');
			$da=$this->image_module->image_store($out);
			$flvdet=$this->image_module->flv_det($uid,$out['phase']);
			if($flvdet!="false" || $flvdet!='')
			$flvdet=$flvdet[0]['flv'];
			if($out['image_sequence']==1)
			{
			$this->image_module->user_smail($uid);
			$this->session->set_userdata('image_det',1);
						$butstatus=1;
			}
			$tf=$this->config->item('totflv');
			if($out['image_sequence']==$tf)
			{
		
			$this->session->set_userdata('image_det',$tf);
			$butstatus=2;
			}
			if($out['image_sequence']!=$tf && $out['image_sequence']!=1)
			{
			$butstatus=0;
			}
			
		$s=base_url()."uploads/".$data['file_name'].",".$da;

		echo $s;
		
		
		
		
		
		
	}
    }
}
 
