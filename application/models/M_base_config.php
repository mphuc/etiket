<?php
/**
 * @property  M_base_config $M_base_config
 * @property  base_config $base_config
 * @property  Ion_auth|Ion_auth_model $ion_auth
 * @property  CI_Lang $lang
 * @property  CI_URI $uri
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 * @property  CI_Input $input
 * @property  CI_User_agent $agent
 * @property  Mahana_hierarchy $mahana_hierarchy
 * @property  CI_Email email
 */
class M_base_config  extends CI_Model  {
	
	public function __construct()
    {
    	parent::__construct();
    }
    public function getData($param){
		$data='';
		if(array_key_exists('where', $param)){
			for($i=0;$i<count($param['where']);$i++){
				$this->db->where($param['where'][$i]['wherefield'],$param['where'][$i]['where_value']);
			}
		}
    	$query = $this->db->order_by($param['nm_sort'],$param['sort'])
    			 		  ->limit($param['limit'],$param['offset'])
    			 		  ->get($param['table']);
		if($query){
			$data=$query->result();
		}else{
			$data='';
		}
		return $data;
	}
	public function getSimpleData($param){
		$tmp='';
        $return = $param['return'];
		if(array_key_exists('where', $param)){
			for($i=0;$i<count($param['where']);$i++){
				$this->db->where($param['where'][$i]['wherefield'],$param['where'][$i]['where_value']);
			}
		}
		$query=$this->db->get($param['table']);
		if ($query->num_rows() > 0)
		{
			foreach($query->result() as $val){
					$tmp=$val->$return;
			}
		}
        return $tmp;
	}
	public function countDatamultiple($param){
		if(array_key_exists('where', $param)){
			for($i=0;$i<count($param['where']);$i++){
				$this->db->where($param['where'][$i]['wherefield'],$param['where'][$i]['where_value']);
			}
		}
    	return $this->db->count_all_results($param['table']);
	}
    public function getSingleSetting($jenis,$nama){
		$this->db->where('setting_type',$jenis);
		$this->db->where('setting_name',$nama);
		$query=$this->db->get('tb_setting');
		if($query)
		$row = $query->row();
		if($row){
			$data=$row->setting_value;
		}else{
			$data='';
		}
		return $data;
	}
	public function getMultiSetting($jenis,$nama){
		if(!empty($nama))
		$this->db->where_in('setting_name',$nama);
		
		$this->db->where('setting_typ',$jenis);
		$query=$this->db->get('tb_setting');
		if($query){
			$data=$query->result();
		}else{
			$data='';
		}
		return $data;
	}
	public function cekaAuth(){
		if (!$this->ion_auth->logged_in()){
			redirect('cms/auth', 'refresh');
		}
	}
	public function ifLogin(){ 
		if ($this->ion_auth->logged_in()){
			redirect('cms', 'refresh');
		}
	}
	public function countData($table,$where,$where_value) {
		return $this->db
					->where($where,$where_value)
			 		->get($table)
			 		->num_rows();
	}
	public function search($param){
		$data='';
		if(array_key_exists('where', $param)){
			for($i=0;$i<count($param['where']);$i++){
				$this->db->where($param['where'][$i]['wherefield'],$param['where'][$i]['where_value']);
			}
		}
		if(array_key_exists('match', $param)){
			for($i=0;$i<count($param['match']);$i++){
				$this->db->where('MATCH ('.$param['match'][$i]['matchfield'].') AGAINST ("'.$param['match'][$i]['match_value'].'")', NULL, FALSE);
				
			}
		}
    	$query = $this->db->order_by($param['nm_sort'],$param['sort'])
    			 		  ->limit($param['limit'],$param['offset'])
    			 		  ->get($param['table']);
		if($query->num_rows() > 0){
			$data=$query->result();
		}else{
			if(array_key_exists('where', $param)){
				for($i=0;$i<count($param['where']);$i++){
					$this->db->where($param['where'][$i]['wherefield'],$param['where'][$i]['where_value']);
				}
			}
			if(array_key_exists('match', $param)){
				for($i=0;$i<count($param['match']);$i++){
					$this->db->like($param['match'][$i]['matchfield'],$param['match'][$i]['match_value']);
				}
			}
	    	$query = $this->db->order_by($param['nm_sort'],$param['sort'])
	    			 		  ->limit($param['limit'],$param['offset'])
	    			 		  ->get($param['table']);
	        $data=$query->result();
		}
		return $data;
	}
	public function countSearch($param){
		$data='';
		if(array_key_exists('where', $param)){
			for($i=0;$i<count($param['where']);$i++){
				$this->db->where($param['where'][$i]['wherefield'],$param['where'][$i]['where_value']);
			}
		}
		if(array_key_exists('match', $param)){
			for($i=0;$i<count($param['match']);$i++){
					$this->db->where('MATCH ('.$param['match'][$i]['matchfield'].') AGAINST ("'.$param['match'][$i]['match_value'].'")', NULL, FALSE);
			}
		}
    	$query = $this->db->get($param['table']);
		if($query->num_rows() > 0){
			$data=$query->num_rows();
		}else{
			if(array_key_exists('match', $param)){
				for($i=0;$i<count($param['match']);$i++){
					$this->db->like($param['match'][$i]['matchfield'],$param['match'][$i]['match_value']);
				}
			}
	    	$query = $this->db->get($param['table']);
	        $data=$query->num_rows();
		}
		return $data;
	}
	//Record Notification
	public function insertnotif($data=array()){
		$user_notification = array("notification_type" => $data['type'],"notification_user" =>$data['user'],"notification_parent" => $data['parent'],"notification_desc" => $data['desc'].' <a target="_blank" href="'.$data['link'].'">'.$data['title'].'</a>',"notification_status" => 'active',"notification_icon" => $data['icon'],"notification_date" => date('Y-m-d H:i:s'));
        $this->db->insert('tb_notification',$user_notification);
	}

    /**
     * @param array $param
     * @return array
     */
    public function get_multi_setting_sigle($param){
        $return = array();
        $tmp    = array();
        if(array_key_exists('where', $param)){
            for($i=0;$i<count($param['where']);$i++){
                $this->db->where($param['where'][$i]['wherefield'],$param['where'][$i]['where_value']);
            }
        }
        $data_setting = $this->db->get('tb_setting')->result();
        foreach ($data_setting as $setting) {
            $tmp[$setting->setting_desc]   = $setting->setting_value;
        }
        return $tmp;
    }
    /**
     * @param string $group_name
     * @return mixed
     */
    public function get_users_by_group($group_name=null)
    {
        $this->db->join('tb_user','tb_user.id=tb_users_groups.user_id');
        $this->db->join('tb_groups','tb_groups.id=tb_users_groups.group_id');
        $this->db->where('tb_groups.name', $group_name);
        $this->db->order_by('username','asc');
        $results = $this->db->get('tb_users_groups')->result_array();
        return $results;
	}
	
	public function NotcekaAuth(){
		// if (!$this->ion_auth->logged_in()){
		// 	redirect('cms/auth', 'refresh');
		// }
	}

	public function send_email($subject='Transaksi Pemesanan Tiket',$id_transaksi,$template='email_booking',$email_title,$data=array(), $toEmail=null)
	{
		$this->load->model('umbrella-taman-theme/front');
		$setting               = $this->base_config->front_setting();
		$data = array_merge($data,$setting);
		$company            = array(
			'where' => array(
				array(
					'wherefield' => 'setting_type',
					'where_value'=>'setting_company'
				)
			)
		);
		$company_result            = $this->front->get_multi_setting_sigle($company);
		$data = array_merge($data,$company_result);

		$this->db->where('id_transaksi', $id_transaksi);
		$transaksi = $this->db->get('tb_transaction')->result_array();
		$data_trx = [];
		$base_url = base_url();
        $phrase = str_replace("http://","", $base_url);
        $newphrase = str_replace("/","", $phrase);
        if (filter_var($newphrase, FILTER_VALIDATE_IP)) $base_url = 'https://tamanpintar.co.id/';
		foreach ($transaksi as $item) {
			$data_trx = [
				'base_url'          => $base_url,
				'email_title'       => $email_title,
				'link_facebook'     => 'http://facebook.com',
				'link_twitter'      => 'http://twitter.com',
				'link_telpon'       => 'tel:089654564500',
				'link_email'        => 'mailto:089654564500',
				'link_playstore'    => 'http://play.google.com',
				'logo_tamanpintar'  => $base_url.'assets/frontend/images/kemendikbud1.jpg',
				'logo_playstore'    => $base_url.'assets/uploads/files/logo_playstore.png',
				'logo_facebook'     => $base_url.'assets/uploads/files/logo_facebook.png',
				'logo_twitter'      => $base_url.'assets/uploads/files/logo_twitter.png',
				'logo_telpon'       => $base_url.'assets/uploads/files/logo_telpon.png',
				'logo_sms'          => $base_url.'assets/uploads/files/logo_sms.png',
				'id_transaksi'      => $item['id_transaksi'],
				'kode_transaksi'    => $item['kode_transaksi'],
				'id_user'           => $item['id_user'],
				'jenis_transaksi'   => $item['jenis_transaksi'],
				'total_transaksi'   => number_format($item['total_transaksi']),
				'biaya_tambahan'    => number_format($item['biaya_tambahan']),
				'total_bayar'       => number_format($item['total_transaksi']+$item['biaya_tambahan']),
				'nama_kelompok'     => $item['nama_kelompok'],
				'tanggal'           => $item['tanggal'],
				'tanggal_digunakan' => $item['tanggal_digunakan'],
				'is_transfer'       => $item['is_transfer'],
				'status_bayar'      => $item['status_bayar'],
				'transaksi_name'    => $item['transaksi_name'],
				'transaksi_email'   => $item['transaksi_email'],
				'transaksi_phone'   => $item['transaksi_phone'],
				'detail_transaksi'  => $this->_get_detail_transaksi($item['id_transaksi'])
			];
		}

		$data = array_merge($data,$data_trx);
		$body = $this->parser->parse( $template, $data, TRUE);

        $config = $this->config_email();
        if( $config['protocol'] != 'smtp' ){
            $from = $config['smtp_user'];
            if($toEmail){
                $to = $toEmail;
            }else{
                $to = $data_trx['transaksi_email'];
            }
            $headers = "From: $from" . "\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            mail($to, $subject, $body, $headers);
        }else{
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from( $config['smtp_user'],'Taman Pintar');
            if( $toEmail ){
                $this->email->to($toEmail);
            }else{
                $this->email->to($data_trx['transaksi_email']);
            }
            $this->email->subject($subject);
            $this->email->message($body);
            $this->email->send();
        }
	}

	public function _get_detail_transaksi($id)
	{
		$this->db->where('transaction_id', $id);
		$this->db->join('tb_product', 'tb_detail_transaction.product_id = tb_product.product_id');
		$result = $this->db->get('tb_detail_transaction')->result_array();
		foreach ($result as $key => $item) {
			$result[$key]['no'] = $key+1;
			$result[$key]['total_format'] = number_format($item['transaction_detail_subtotal']);
			// $result[$key]['harga_anak_format'] = number_format($item['harga_anak']);
			$result[$key]['harga_format'] = number_format($item['transaction_detail_price']);
			// $result[$key]['harga_dewasa_format'] = number_format($item['harga_dewasa']);
		}
		return $result;
	}

	public function convert_date_to_local($date)
	{
		$month = date('F', strtotime($date));
		$day = date('l', strtotime($date));
		switch ($day){
			case 'Sunday':
				$day = 'Minggu';
				break;
			case 'Monday':
				$day = 'Senin';
				break;
			case 'Tuesday':
				$day = 'Selasa';
				break;
			case 'Wednesday':
				$day = 'Rabu';
				break;
			case 'Thursday':
				$day = 'Kamis';
				break;
			case 'Friday':
				$day = 'Jumat';
				break;
			case 'Saturday':
				$day = 'Sabtu';
				break;
		}
		switch ($month){
			case "January":
				$month = 'Januari';
				break;
			case "February":
				$month = 'Februari';
				break;
			case "March":
				$month = 'Maret';
				break;
			case "April":
				$month = 'April';
				break;
			case "May":
				$month = 'Mei';
				break;
			case "June":
				$month = 'Juni';
				break;
			case "July":
				$month = 'Juli';
				break;
			case "August":
				$month = 'Agustus';
				break;
			case "September":
				$month = 'September';
				break;
			case "October":
				$month = 'Oktober';
				break;
			case "November":
				$month = 'November';
				break;
			case "December":
				$month = 'Desember';
				break;
		}
		$month = mb_strimwidth( $month, 0, 3, "");
		$day_number = date('d', strtotime($date));
		$year_number = date('Y', strtotime($date));
		return "$day, $day_number-$month-$year_number";
	}
	
}
