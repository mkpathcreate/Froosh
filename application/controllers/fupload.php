<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //http://www.formget.com/tutorial/codeigniter_image_manipulation/index.php/manipulation_controller/
 //http://www.9lessons.info/2014/07/ajax-upload-and-resize-image-with-php.html

class fupload extends CI_Controller {
  
public function __construct() 
  {
   parent::__construct();
   $this->load->helper(array('url','html','form'));
   $this->load->library('session');
   $this->load->library('image_lib');
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
	
	$this->load->model('image_module','',TRUE);
	$session_data = $this->session->userdata('logged_in');
	$x=array();
	$uid=$session_data['uid'];

    $phase=$this->input->post('phase');

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
		
		$flv="ブルーベリー＆ラズベリー";
	}
	elseif($flv==2)
	{
		$flid=2;
		
		$flv="マンゴー＆オレンジ";
	}
	elseif($flv==3)
	{
		$flid=3;
		
		$flv="パイナップル・バナナ＆ココナッツ";
	}
	elseif($flv==4)
	{
		$flid=4;
		$flv="オレンジ・キャロット＆ジンジャー";
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
		//$x=$this->image_module->getphaimgsec($uid);
	
		$x=$this->image_module->getphaimgsec($uid,$phase);
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
					 $file_name = $this->upload->file_name;
					 list($image_width, $image_height) = getimagesize(FCPATH.'uploads/'.$file_name);
					 //$this->image_resize('206', '200', $file_name, $image_width, $image_height); 
					 //$this->image_resize('200', '206', $file_name, $image_width, $image_height); 
					 $source_path=FCPATH.'uploads/';
					 $destination_path=FCPATH.'uploads/';
					 $new_width=200;
					 $new_height=267;
					
					 if($data['file_ext']==".png")
					 $type=2;
					 elseif($data['file_ext']!=".png")
					 $type=1;
					 $this->thumb($file_name, $source_path, $destination_path, $new_width, $new_height,$type);
					 //$this->image_resize('267', '200', $file_name, $image_width, $image_height); 
					
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
			
			if(isset($x))
			{
			$out['phase']=$x['phase'];
			$out['image_sequence']=$x['active'];
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
			//	$this->image_module->user_smail($uid);
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
			
		//$s=base_url()."uploads/thumb2_".$data['file_name'].",".$da.",".$butstatus;
		$flvdet=str_replace(",","-",$flvdet);
		$s=base_url()."uploads/".$data['file_name'].",".$da.",".$butstatus.",".$flvdet.",".$out['image_fla_id'].",".$x['deleted'].",".$x['active'];
		//$s=$x[0]['deleted'].",".$x[0]['active'];
		

		echo $s;
		
		
		
		
		
		
	}
    }
	
	private function image_resize($height, $width, $file_name, $image_width, $image_height) 
	{
	//$w=($image_width/100)*50;
	//$h=($image_height/100)*50;
	
	$w_ratio = $image_width / $width;
	$h_ratio = $image_height/ $height;

	$ratio = $w_ratio > $h_ratio ? $w_ratio : $h_ratio;

	$dst_w = $image_width / $ratio;
	$dst_h = $image_height/ $ratio;
	$dst_x = ($width - $dst_w) / 2;
	$dst_y = ($height - $dst_h) / 2;

    // Resize image settings
    $config['image_library'] = 'GD2';
    $config['source_image'] = FCPATH.'uploads/'.$file_name;
    $config['new_image'] = FCPATH.'uploads/thumb_'.$file_name;
    $config['maintain_ratio'] = TRUE;
	$config['quality'] ="100%";
	$config['create_thumb']=FALSE;
    $config['thumb_marker']='';
    $config['width'] = $width;
    $config['height'] = $height;
	//$config['width'] = $w;
    //$config['height'] = $h;
	$dim = (intval($image_width) / intval($image_height)) - ($config['width'] / $config['height']);
    //$config['master_dim'] = 'width';
	$config['master_dim'] = ($dim > 0)? "height" : "width";

    $this->image_lib->initialize($config);

    if($image_width >= $config['width'] AND $image_height >= $config['height'])
    {
        if (!$this->image_lib->resize())
        {
            //return $this->image_lib->display_errors();
			log_message('error',json_encode($this->image_lib->display_errors()));
			return false;
        }
		else{
		   // return true;
		   
			$image_config['image_library'] = 'gd2';
			$image_config['source_image'] = FCPATH.'uploads/'.$file_name;
			$image_config['new_image'] = FCPATH.'uploads/thumb2_'.$file_name;
			$image_config['quality'] = "100%";
			$image_config['maintain_ratio'] = FALSE;
			$image_config['width'] = $width;
			$image_config['height'] = $height;
			$image_config['x_axis'] = 0 ;
			$image_config['y_axis'] = 0;
 
			$this->image_lib->clear();
			$this->image_lib->initialize($image_config);
 
			if (!$this->image_lib->crop()){
					//redirect("errorhandler"); //If error, redirect to an error page
					log_message('error',"cropping error");
			}else{
				//redirect("successpage");
				return true;
			}			
		   
		   
		   }
    }
	}
	
	
	private function image_resize3($height, $width, $file_name, $image_width, $image_height) 
	{
	//$w=($image_width/100)*50;
	//$h=($image_height/100)*50;
	
    // Resize image settings
    $config['image_library'] = 'GD2';
    $config['source_image'] = FCPATH.'uploads/'.$file_name;
    $config['new_image'] = FCPATH.'uploads/thumb_'.$file_name;
    $config['maintain_ratio'] = TRUE;
	$config['quality'] ="100%";
	$config['create_thumb']=FALSE;
    $config['thumb_marker']='';
    $config['width'] = $width;
    $config['height'] = $height;
	//$config['width'] = $w;
    //$config['height'] = $h;
	$dim = (intval($image_width) / intval($image_height)) - ($config['width'] / $config['height']);
    //$config['master_dim'] = 'width';
	$config['master_dim'] = ($dim > 0)? "height" : "width";

    $this->image_lib->initialize($config);

    if($image_width >= $config['width'] AND $image_height >= $config['height'])
    {
        if (!$this->image_lib->resize())
        {
            //return $this->image_lib->display_errors();
			log_message('error',json_encode($this->image_lib->display_errors()));
			return false;
        }
		else{
		   // return true;
		   
			$image_config['image_library'] = 'gd2';
			$image_config['source_image'] = FCPATH.'uploads/thumb_'.$file_name;
			$image_config['new_image'] = FCPATH.'uploads/thumb2_'.$file_name;
			$image_config['quality'] = "100%";
			$image_config['maintain_ratio'] = FALSE;
			$image_config['width'] = $width;
			$image_config['height'] = $height;
			$image_config['x_axis'] = '5';
			$image_config['y_axis'] = '0';
 
			$this->image_lib->clear();
			$this->image_lib->initialize($image_config);
 
			if (!$this->image_lib->crop()){
					//redirect("errorhandler"); //If error, redirect to an error page
					log_message('error',"cropping error");
			}else{
				//redirect("successpage");
				return true;
			}			
		   
		   
		   }
    }
	}
	
	
	private function image_resize2($height, $width, $file_name, $image_width, $image_height) 
	{
    // Resize image settings
    $config['image_library'] = 'GD2';
    $config['source_image'] = FCPATH.'uploads/'.$file_name;
    $config['new_image'] = FCPATH.'uploads/sp_'.$file_name;
    $config['maintain_ratio'] = TRUE;
    $config['width'] = $width;
    $config['height'] = $height;
    $config['master_dim'] = 'width';

    $this->image_lib->initialize($config);

    if($image_width >= $config['width'] AND $image_height >= $config['height'])
    {
        if (!$this->image_lib->resize())
        {
            //return $this->image_lib->display_errors();
			log_message('error',json_encode($this->image_lib->display_errors()));
			return false;
        }
		else
		    return true;
    }
	}
	
	private function thumb($nomeimage, $source_path, $destination_path, $new_width, $new_height,$type){
     
     
        if($width > $new_width){
          $new_width = $width;
          $new_height = $height;
        }
        $compression = 100;
        $destimg = imagecreatetruecolor($new_width,$new_height) or die("Problems creating the image");
       	if($type == 2){
		$srcimg = imagecreatefrompng($source_path.$nomeimage) or die("problem opening the image");
		}
		else
		{
		$srcimg = ImageCreateFromJPEG($source_path.$nomeimage) or die("problem opening the image");
		}
        $w = ImageSX($srcimg);
        $h = ImageSY($srcimg);
        $ro = $new_width/$new_height;
        $ri = $w/$h;
        if($ro<$ri){
          $par = "h";
        }else{
          $par = "w";
        }
        if($par == "h"){
          $ih = $h;
          $conv = $new_width/$new_height;
          $iw = $conv*$ih;
          $cw = ($w/2)-($iw/2);
          $ch = ($h/2)-($ih/2);
        }else if($par == "w"){
          $iw = $w;
          $conv = $new_height/$new_width;
          $ih = $conv*$iw;
          $cw = ($w/2)-($iw/2);
          $ch = ($h/2)-($ih/2);
        }
        ImageCopyResampled($destimg,$srcimg,0,0,$cw,$ch,$new_width,$new_height,$iw,$ih) or die("problems with resize");
	    ImageJPEG($destimg,$destination_path.$nomeimage,$compression) or die("problems with storing new image");
      
    }
	
	
	
}
 
