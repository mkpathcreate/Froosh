<?php defined('BASEPATH') OR exit('No direct script access allowed');


class mail_module extends CI_Model{

    
    
    /* Check the User details and store the User Information in database
     */
    function umregister($udata)
	{
	$query = $this->db->get_where('users',array('uemail'=>$udata['uemail']));
	
	
	if($query->num_rows()==0){
	$this->load->helper('date');
	
	$n=date("Y/m/d h:i:s");
	$udata_db = array(
	   'uname' => $udata['uname'] ,
	   'uemail' => $udata['uemail'] ,
	   'upassword' => md5($udata['upassword']),
	   'ureg_date'=>$n,
	   'ulogin_mode'=>$udata['umode'],
	   'user_ip'=> $this->input->ip_address(),
	   'umedia'=> $udata['umedia']
		);
	 $this->db->insert('users',$udata_db);
	 $insert_id = $this->db->insert_id();

	$from=trim($udata['uemail']);
	if($this->db->affected_rows()>=1)
		$this->send_mail($from);


	 return $insert_id;
	}
	else
	{
	
	return '';
	}
	}
	
/* Check Email Id Exist or Not */

	function uemail_verify()
	{
	  $uemail = trim($this->input->post('uemail'));
	  $query = $this->db->get_where('users',array('uemail'=>$uemail));
	  if($query->num_rows() > 0)
    return false;
    else
    return true;
	  
	}



/*    send Email to Registered User */

	function send_mail($to)
	{
	$to  = $to;
	$subject = "【日焼け止めLP】よりご注文を承りました。";

	$message = "【日焼け止めLP】よりご注文を承りました。
******************************************************************
ご請求金額と配送情報
******************************************************************
ご注文番号：2014-10-20-120
お支払合計：￥3240
お支払方法：クレジットカード
お届け日：2014/08/27
お届け時間：16:00-18:00
備考欄：テストの購入です。


◎お届け先
お名前　：テストテスト
フリガナ　：テストテスト
郵便番号：439-0031
ご住所　：滋賀県菊川市加茂9
電話番号：08099998888
メール　：matsushita.sei@pathcreate.co.jp
性別: 女性
生年月日: 1975/1/1
メールマガジン項目: 受取らない
個人情報の取り扱い同意: on
******************************************************************
　ご注文商品明細
******************************************************************
商品名　：UVA&B+C
サイズ　：35ml 3,240 円（税込）
数量　：1個
金額　：￥3240
--------------------------------------------------------------- 
小 計:￥ 3240 
送 料 :￥0
--------------------------------------------------------------- 
合計:￥ 3240 
---------------------------------------------------------------";

	$s_header = "";
	$s_header = $s_header . "MIME-Version: 1.0\r\n";
	$s_header = $s_header . "From: ". $this->config->item('emailfrom')."\r\n"; 
	$s_header = $s_header . "Content-type: text/html; charset=ISO-2022-JP\r\n";
	$s_header = $s_header . "Content-Transfer-Encoding:7bit\r\n";
	mb_language("ja");
	$subject = mb_convert_encoding($subject, "ISO-2022-JP","AUTO");
	$subject = mb_encode_mimeheader($subject);
	$message = mb_convert_encoding($message, "ISO-2022-JP", "AUTO");
	mail($to, $subject, $message, $s_header);
	}





}