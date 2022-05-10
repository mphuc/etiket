<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @property    M_base_config M_base_config
 * @property    base_config base_config
 * @property    Ion_auth|Ion_auth_model ion_auth
 * @property    CI_Lang lang
 * @property    CI_URI uri
 * @property    CI_DB_query_builder $db
 * @property    CI_Config config
 * @property    CI_Input input
 * @property    CI_User_agent $agent
 * @property    Slug slug
 * @property    CI_Security security
 * @property    Setting setting
 * @property    CI_Parser parser
 * @property    CI_Upload upload
 * @property    CI_Loader load
 * @property    FrontendModel FrontendModel
 * @property    CustomersModel CustomersModel
 * @property    XenditModel XenditModel
 * @property    Setting Setting
 */
class Home extends MX_Controller
{
    protected $table = '';
    protected $subject = '';
    protected $module;

    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
        $this->load->model('FrontendModel');
        $this->load->model('ProductModel');
        $this->load->model('CustomersModel');
        $this->load->model('XenditModel');
        $this->load->model('TicketModel');
        $this->load->model('Setting');
        $this->load->library('form_validation');
        $this->load->config('smtpMail');
        
        
    }

    public function tiket($id){
        $this->TicketModel->create(array($id));
    }

    protected function role($type=null)
    {
    }

    protected function smtp(){
        $config = array();

        $config['protocol']       = $this->Setting->get_single('setting_email', 'protocol');
        $config['smtp_host']      = $this->Setting->get_single('setting_email', 'smtp_host');
        $config['smtp_port']      = $this->Setting->get_single('setting_email', 'smtp_port');
        $config['smtp_user']      = $this->Setting->get_single('setting_email', 'smtp_user');
        $config['smtp_pass']      = $this->Setting->get_single('setting_email', 'smtp_pass');
        $config['smtp_name']      = $this->Setting->get_single('setting_email', 'smtp_name');
        $config['mailtype']       = $this->Setting->get_single('setting_email', 'mailtype');
        $config['charset']        = $this->Setting->get_single('setting_email', 'charset');

        return $config;
    }

    public function ceksetting(){
        $x = $this->Setting->get_single('setting_transaction', 'transaction_note');

        echo $x;
    }

    public function index()
    {
        $this->role();
        $this->output
                    ->set_header('Content-Type: application/pdf')
                    ->set_header('Access-Control-Allow-Origin: *')
                    ->set_header('Access-Control-Allow-Credentials: true')
                    ->set_header('Access-Control-Max-Age: 1000')
                    ->set_header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding')
                    ->set_header('Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE');

        $data = $this->setting->get_all();
        $data['product']    = $this->FrontendModel->get_product();
        $data['syarat']     = $this->FrontendModel->get_syarat();
        $data['kontak']     = $this->FrontendModel->get_kontak();
        $data['tentang']    = $this->FrontendModel->get_tentang();
        $data['notes']      = $this->Setting->get_single('setting_transaction', 'transaction_note');
        $data['sun']        = $this->FrontendModel->getAvailableDay('sunday');
        $data['mon']        = $this->FrontendModel->getAvailableDay('monday');
        $data['tue']        = $this->FrontendModel->getAvailableDay('tuesday');
        $data['wed']        = $this->FrontendModel->getAvailableDay('wednesday');
        $data['thu']        = $this->FrontendModel->getAvailableDay('thursday');
        $data['fri']        = $this->FrontendModel->getAvailableDay('friday');
        $data['sat']        = $this->FrontendModel->getAvailableDay('saturday');

        $get_holilday = $this->db->get('tb_holiday')->result();

        $holiday = [];

        foreach($get_holilday as $x){
            $holiday[] = date('Y-n-j', strtotime($x->holiday_date));
        }

        $data['holiday'] = $holiday;

        if (isset($_SESSION['id_customer'])) {
            #code with session
            $data['id_customer'] = $this->session->userdata('id_customer');
            $data['full_name'] = $this->session->userdata('full_name');
            $data['email'] = $this->session->userdata('email');
            $data['phone'] = $this->session->userdata('phone');
            $data['addres'] = $this->session->userdata('addres');

            $user_email = $this->session->userdata('email');

            $data['transaction'] = $this->FrontendModel->getTransaction($user_email);
            $data['history'] = $this->FrontendModel->getHistory($user_email);
        }
        else{
            #code whitout session
            $data['id_customer'] = '';
            $data['full_name'] = '';
            $data['email'] = '';
            $data['phone'] = '';
            $data['addres'] = '';
        }
        view_back( "cms_$this->module/views/index", $data);
    }

    public function login(){
        $post = $this->input->post(null, TRUE);
        if (isset($post['login'])) {
            $data_login = array(
                'password' => md5($this->input->post('password', true)),
                'email' => $this->input->post('email', true),
            );

            $check_login = $this->CustomersModel->login($data_login);

            if($check_login->num_rows() > 0){
                $row = $check_login->row();
                $params = array(
                    'id_customer' => $row->id_customer,
                    'full_name' => $row->full_name,
                    'email' => $row->email,
                    'phone' => $row->phone,
                    'addres' => $row->addres
                );

                $this->session->set_userdata($params);

                // echo "<script>alert('Selamat Anda Berhasil Login !!');</script>";

                $this->session->set_flashdata('success', 'Selamat Anda Berhasil Login !!');

                redirect(base_url());
            }
            else{

                $this->session->set_flashdata('error', 'Login Gagal, Periksa Kembali Email dan Password !!!');
                redirect(base_url());
            }
        }
    }

    public function register(){

        $this->form_validation->set_rules('email','Email', 'required|is_unique[tb_customers.email]');

        if($this->form_validation->run() == FALSE )
        {

            $this->session->set_flashdata('error', 'Maaf, Email Sudah Terdaftar, Silahkan Gunakan Email lain !!!');
            redirect(base_url());
        }

        else{
            $data_register = array(
                'full_name' => $this->input->post('full_name', true),
                'password' => md5($this->input->post('password', true)),
                'email' => $this->input->post('email', true),
                'phone' => $this->input->post('phone', true),
                'addres' => $this->input->post('addres', true),
                'date_join' => date('Y-m-d')
            );
    
            $this->CustomersModel->register($data_register);        
    
            if($this->db->affected_rows() > 0 && $data_register['full_name'] != '')
                $this->session->set_flashdata('success', 'Selamat Registrasi Anda Berhasil, Silahkan Login Dengan Akun Anda !!');      
    
            else
                $this->session->set_flashdata('error', 'Maaf, Registrasi Gagal !!!');

      
            redirect(base_url());
        }
        

    }

    public function cekkuotaharian(){
       
        $dateUsed   = $this->input->post('date', true);
        $datacheck   = $this->input->post('datacheck', true);
        $jenisnya = [];
        
        if ( ! empty($datacheck))
		{
			foreach ($datacheck as $key => &$value)
			{
				if (is_array($value))
				{
                    $jumlahharian = $this->TicketModel->getTotalByProductIdDateUsed($datacheck[$key]['id_tiket'],$dateUsed);
                    $produk = $this->ProductModel->getById($datacheck[$key]['id_tiket']);
                    $stockx = $produk['product_stock'];
                    $jmlpermintaan = $jumlahharian + $datacheck[$key]['jumlah_item'];
                    
                    if($stockx>=$jmlpermintaan){
                        $jenisnya[$datacheck[$key]['nama_tiket']] = "ada";
                    }else {
                        $jenisnya[$datacheck[$key]['nama_tiket']] = "kosong";
                    } 
				}
                
                if (array_search('kosong', $jenisnya) !== false) {
                    $adaygkosong = "kosong";
                } else {
                    $adaygkosong = "ada";
                }
				
			}
 		}

        $this->output->set_content_type('application/json');
        echo json_encode(array('status' => $jenisnya, 'adakosong' => $adaygkosong ));
    }

    public function saveTransaction(){

        $data = array(
            'transaction_user_name'         => $this->input->post('nama', true),
            'transaction_type'              => 'online',
            'transaction_approval_code'     => '',
            'transaction_payee'             => 9, #9 = digital payment
            'transaction_card_type'         => 7, #7 = digital payment
            'transaction_bank'              => 11, #11 = digital payment
            'transaction_card_number'       => '',
            'transaction_member_card'       => '',
            'transaction_user_email'        => $this->input->post('email', true),
            'transaction_user_phone'        => $this->input->post('telepon', true),
            'transaction_vendor'            => 'online',
            'transaction_date_used'         => $this->input->post('date', true),
            'transaction_total'             => $this->input->post('total', true),
            'transaction_fee'               => $this->input->post('ppn', true),
            'transaction_created'           => date('Y-m-d h:i:s'),
            'transaction_code'              => random_string('alnum', 5),
            'transaction_discount_type'     => '',
            'transaction_ticket_type'       => $this->input->post('jenis', true),
            'transaction_group_name'        => $this->input->post('group', true) ? $this->input->post('group', true) : '' ,
            'transaction_qty_group'         => $this->input->post('qty', true) ? $this->input->post('qty', true) : 0 ,
            'transaction_is_group'          => 0,
            'transaction_payment'           => $this->input->post('paye', true),
            'transaction_ovo'               => $this->input->post('ovo', true),
        );

        $detail = $this->input->post('data', true);

        $add = $this->FrontendModel->add_transaction($data,$detail);       

        $this->output->set_content_type('application/json');
        echo json_encode(array('status' => 'success', 'id' => $add));
    }

    public function sendMail(){
        $id = 33054;
        $invoice = 'jushdusjihduisdhgusis';
        $email = 'azizmuzani@gmail.com';
        $transaction = $this->FrontendModel->getById($id);

        $data = array(
            'kode' => $transaction->transaction_uniq,
            'invoice' => $invoice,
            'total' => $this->rupiah($transaction->transaction_total),
            'ppn'           => $this->rupiah($transaction->transaction_fee),
            'sub_total'     => $this->rupiah($transaction->transaction_total - $transaction->transaction_fee),
            'detail' => $this->FrontendModel->getDetailTransactions($id),
        );

        $mesg = $this->load->view('email/email',$data,true);
        $smtp = $this->smtp();

        $config = Array(
            'protocol' => $smtp['protocol'],
            'smtp_host' => $smtp['smtp_host'],
            'smtp_port' => $smtp['smtp_port'],
            'smtp_user' => $smtp['smtp_user'],
            'smtp_pass' => $smtp['smtp_pass'],
            'mailtype'  => $smtp['mailtype'], 
            'wordwrap'  => TRUE,
            'charset'   => $smtp['charset']
        );

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from($smtp['smtp_user'], $smtp['smtp_name']); 
        $this->email->to($email);
        $this->email->subject('[INVOICE]Pembelian Tiket Museum Nasional Indonesia'); 
        $this->email->message($mesg); 

        //Send mail 
        if($this->email->send()){
            echo 'success';
        }else {
            echo $this->email->print_debugger();
        } 
    }

    public function settinganemail(){
        // set config smtp
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://mail.alhidayahmejing.com',
            'smtp_port' => 465,
            'smtp_user' => $this->config->item('mail_smtp'),
            'smtp_pass' => $this->config->item('pass'),
            'mailtype'  => 'html', 
            'wordwrap'  => TRUE,
            'charset'   => 'iso-8859-1'
        );

        // $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        // send mail
        $this->email->from('informasi.museumnasional@gmail.com', 'Museum Nasional Indonesia'); 
    }

    // public function saveAndSendMail($id){     
        
    //     // get data transactions
    //     $transaction        = $this->FrontendModel->getById($id);

    //     $xendit_external_id = $transaction->transaction_uniq;
    //     $xendit_amount      = $transaction->transaction_total;
    //     $xendit_email       = $transaction->transaction_user_email;
    //     $xendit_desc        = "Tiket Museum Nasional Indonesia";
    //     $ovo_phone          = $transaction->transaction_ovo;
    //     $type               = $transaction->transaction_payment;

    //     if($type == 'ewallet'){
    //         $this->XenditModel->create_ewallet($xendit_external_id, $xendit_amount, $ovo_phone);
    //     }

    //     else{
    //         // save xendit invoice
    //         $this->XenditModel->createInvoice($xendit_external_id, $xendit_amount, $xendit_email, $xendit_desc);

    //     }

    //     $this->FrontendModel->sendMail($id);
 
    // }

    public function saveAndSendMail($id){     
        
        // get data transactions
        $transaction        = $this->FrontendModel->getById($id);

        $xendit_external_id = $transaction->transaction_uniq;
        $xendit_amount      = $transaction->transaction_total;
        $xendit_email       = $transaction->transaction_user_email;
        $xendit_desc        = "Tiket Museum Nasional Indonesia";
        $ovo_phone          = $transaction->transaction_ovo;
        $type               = $transaction->transaction_payment;

        if($type == 'ewallet'){
            $this->XenditModel->create_ewallet($xendit_external_id, $xendit_amount, $ovo_phone);
        } else if($type == 'qris'){
            $data = $this->XenditModel->create_qris($xendit_external_id, $xendit_amount);
            $qr_string=$data['qr_string'];
            $title=$data['external_id'];
            $this->FrontendModel->create_qris_code($qr_string, $title);
            $this->output->set_content_type('application/json');
            echo json_encode($data);             
        } else{
            // save xendit invoice
            $this->XenditModel->createInvoice($xendit_external_id, $xendit_amount, $xendit_email, $xendit_desc);

        }

        if($type == 'qris'){
        //    view_back( "cms_$this->module/views/v_qris", $data);
        } else {
            $this->FrontendModel->sendMail($id);
        }
 
    }

    public function resendPayment($id){
        // $id = $this->input->post('kode', true);
        // $id = 'AgZls';

        $data = array(
            'transaction_uniq'  => strtoupper(md5(random_string('alnum', 5)))
        );

        $this->FrontendModel->update_transactionUniq($id, $data);

        if($this->db->affected_rows() > 0){
            $transaction        = $this->FrontendModel->getById($id);

            $xendit_external_id = $transaction->transaction_uniq;
            $xendit_amount      = $transaction->transaction_total;
            $ovo_phone          = $transaction->transaction_ovo;

            // echo $xendit_external_id."<br>";
            // echo $xendit_amount."<br>";
            // echo $ovo_phone;

            $this->XenditModel->create_ewallet($xendit_external_id, $xendit_amount, $ovo_phone);

            $this->session->set_flashdata('success', 'Pengiriman Ulang Pembayaran Sukses, Silahkan Cek Notifikasi E-Wallet Anda !!');

            redirect(base_url());
        }

    }

    public function getHistory(){
        $user_email = $this->session->userdata('email');

        $data = $this->FrontendModel->getHistory($user_email);

        if($user_email != ''){

            foreach ($data as $key => $value){

                echo "<tr>
                        <td>".date('d-m-Y', strtotime($value->transaction_created))."</td>
                        <td>".$value->product_title."</td>
                        <td>".$value->transaction_detail_qty."</td>
                        <td>".$this->rupiah($value->transaction_detail_subtotal)."</td>
                        <td><button style='border : 1;' class='btn btn-sucess'>Invoice</button></td>
                    </tr>";

            }

        }
    }

    public function reschedule(){
        $id = $this->input->post('id', true);
        // $id_dt = $this->input->post('id_dt', true);
        $tgl = $this->input->post('tgl', true);

        $cek = $this->FrontendModel->getDetailTransactions($id);

        $status_ticket = null;
        
        $proses = $this->FrontendModel->updateReschedule($id, $tgl);

        foreach($cek as $item){
            $cek_tiket  = $this->FrontendModel->cekTicket($item->transaction_detail_id); 
            if ($cek_tiket->num_rows() > 0) {
                $this->FrontendModel->updateTicket($item->transaction_detail_id, $tgl);
                $status_ticket = 'created';
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode(array('status' => $proses, 'ticket' => $status_ticket));             

    }

    public function resendTicket($id){
        $this->FrontendModel->sendMailSuccess($id);
    }

    public function invoice(){

        $this->XenditModel->checkInvoice();

        // require 'vendor/autoload.php';

        // $options['secret_api_key'] = 'xnd_production_lplurKf1PLxW311wVE8tevOZkt6qaNjXODsPwTrZB6W4XKbWRJuUhnu0KzA3VGC';

        // $xenditPHPClient = new XenditClient\XenditPHPClient($options);

        // $external_id = 'demo_1475801962607';
        // $amount = 230000;
        // $payer_email = 'sample_email@xendit.co';
        // $description = 'Trip to Bali';

        // $response = $xenditPHPClient->createInvoice($external_id, $amount, $payer_email, $description);
        // print_r($response);
    }

    public function resetPassword(){
        $email = $this->input->post('email', true);

        $check = $this->CustomersModel->checkEmail($email);

        $this->output->set_content_type('application/json');
        echo json_encode(array('status' => $check, 'id' => $check->id_customer));
    }

    public function sendMailResetPassword($id){
        // $email = $this->input->post('email', true);

        $cek = $this->CustomersModel->getById($id);

        $email = $cek->email;

        // get data array for template
        $data = array(
            'data_user' => $this->CustomersModel->checkEmail($email),
            'base_url' => base_url()
        );

        // desain template
        $mesg = $this->load->view('resetpassword/reset',$data,true);

        $smtp = $this->smtp();

        $config = Array(
            'protocol' => $smtp['protocol'],
            'smtp_host' => $smtp['smtp_host'],
            'smtp_port' => $smtp['smtp_port'],
            'smtp_user' => $smtp['smtp_user'],
            'smtp_pass' => $smtp['smtp_pass'],
            'mailtype'  => $smtp['mailtype'], 
            'wordwrap'  => TRUE,
            'charset'   => $smtp['charset']
        );

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from($smtp['smtp_user'], $smtp['smtp_name']); 
        $this->email->to($email);
        $this->email->subject('Permintaan Reset Password'); 
        $this->email->message($mesg); 

        //Send mail 
        if($this->email->send()){
            return 'sukses' ;
        }else {
            return $this->email->print_debugger();
        } 

    }

    public function GoToResetPassword($id = ''){
        
        $id = $this->input->post('id', true);

        if($id != ''){
            $account = $this->CustomersModel->getById($id);

            $data = array(
                'email'       => $account->email
            );


            view_back( "cms_$this->module/views/reset", $data);
        }
        else{
            echo "<script>alert('Maaf , Anda gagal terhubung !!');</script>";
        }
        
    }

    public function reset(){
        $new_pass = $this->input->post('password', true);
        $email = $this->input->post('email', true);

        $data = $this->CustomersModel->newPassword($email, $new_pass);

        if($data == 'success'){
            
            // echo "<script>alert('Selamat Password Anda Berhasil Di rubah !!');</script>";
            $this->session->set_flashdata('success', 'Selamat Password Anda Berhasil Di rubah !!');
            // $this->logout();
            $params = array('id_customer');
            $this->session->unset_userdata($params);

            redirect(base_url());
        }
        else{
            // echo "<script>alert('Maaf Password Anda Gagal Di rubah !!');</script>";
            $this->session->set_flashdata('error', 'Maaf Password Anda Gagal Di rubah !!');

            redirect(base_url());
        }
    }

    public function logout(){
        $params = array('id_customer');
        $this->session->unset_userdata($params);
        
        // echo "<script>window.location='".base_url()."'</script>";

        redirect(base_url());
    }

    function rupiah($angka){
	
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
     
    }

    function testBarcode(){
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();

        $kode = random_string('alnum', 5);

        echo '<br><br><br><img src="data:image/png;base64,' . base64_encode($generator->getBarcode($kode, $generator::TYPE_CODE_128)) . '" style="webkit-transform: rotate(90deg);moz-transform: rotate(90deg);-ms-transform: rotate(90deg);o-transform: rotate(90deg);
        transform: rotate(90deg);">';

        // $title = $kode;
        // $barcode = $generator->getBarcode($kode, $generator::TYPE_CODE_128,3,30);
        // $file_location = FCPATH."assets/uploads/barcode/".$title.".jpg";
        // file_put_contents($file_location, $barcode);
        // $imurl = $file_location;
        // $file = imagecreatefromjpeg($imurl);
        // $rotim = imagerotate($file, 90, 0);
        // imagejpeg($rotim, $imurl);
        // $dir_name  = FCPATH.'assets/uploads/barcode/';
        // if(!is_dir( $dir_name )) {
        //     mkdir($dir_name, 0777, true);
        // }
    }

    function testTicket(){
        // $data = array(
        //     'label' => 'test'
        // );

        // $html = $this->load->view('email/email_konfirm', $data, true);
        // $this->pdf->pdfGenerator($html, 'barcode', 'A5','landscape');
        //$generator = new Picqer\Barcode\BarcodeGeneratorJPG();

        $this->load->library('ciqrcode');

        $kode = random_string('alnum', 5);
        $params['data'] = @$kode;
        $params['level'] = 'H';
        $params['size'] = 8;
        $params['savename'] = FCPATH . "assets/uploads/barcode/" . @$kode . '.jpg';
        $qrcode = $this->ciqrcode->generate($params);

        $title = $kode;
        //$barcode = $generator->getBarcode($kode, $generator::TYPE_CODE_128,3,30);
        $file_location = FCPATH."assets/uploads/barcode/".$title.".jpg";
        // file_put_contents($file_location, $qrcode);
        // $imurl = $file_location;
        // $file = imagecreatefromjpeg($imurl);
        // $rotim = imagerotate($file, 90, 0);
        // imagejpeg($rotim, $imurl);
        $dir_name  = FCPATH.'assets/uploads/barcode/';
        if(!is_dir( $dir_name )) {
            mkdir($dir_name, 0777, true);
        }
        
       $data = array(
           'label' => 'test',
           'barcode' => "assets/uploads/barcode/$title.jpg"
       );

       $this->load->view('email/email_konfirm', $data);
    }

    function sendMailSucces($id){
        // $id = 36;
        // $email = 'azizmuzani@gmail.com';
        $transaction = $this->FrontendModel->getById($id);
        $file_pdf = $this->FrontendModel->create_tiket($id);

        $email = $transaction->transaction_user_email;

        $data = array(
            'base_url'              => base_url(),
            'kode'                  => $transaction->transaction_code,
            'tanggal_digunakan'     => $transaction->transaction_date_used,
            'total'                 => $this->rupiah($transaction->transaction_total),
            'ppn'           		=> $this->rupiah($transaction->transaction_fee),
			'sub_total'     		=> $this->rupiah($transaction->transaction_total - $transaction->transaction_fee),
            'detail'                => $this->FrontendModel->getDetailTransactions($id),
            'file_pdf'              => $file_pdf
        );

        $mesg = $this->load->view('email/email_kode_booking',$data,true);

        $smtp = $this->smtp();

        $config = Array(
            'protocol' => $smtp['protocol'],
            'smtp_host' => $smtp['smtp_host'],
            'smtp_port' => $smtp['smtp_port'],
            'smtp_user' => $smtp['smtp_user'],
            'smtp_pass' => $smtp['smtp_pass'],
            'mailtype'  => $smtp['mailtype'], 
            'wordwrap'  => TRUE,
            'charset'   => $smtp['charset']
        );

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from($smtp['smtp_user'], $smtp['smtp_name']); 
        // $this->email->replay();
        $this->email->to($email);
        $this->email->subject('[E-TICKET]Pembayaran Tiket Museum Nasional Indonesia'); 
        $this->email->message($mesg); 

        //Send mail 
        if($this->email->send()){
            // return 'sukses' ;
            echo 'success';
        }else {
            // return 'failed';
            // echo 'failed';
            // return $this->email->print_debugger();
            echo $this->email->print_debugger();
        }
    }

    public function test(){
        $id = 33054;

        $this->FrontendModel->sendMailSuccess($id);
    }

    public function verifyInvoice(){
        $this->XenditModel->verify_invoice();
    }

    public function verifyEwalletCallback(){
        $this->XenditModel->verify_ewallet_callback();
    }

    public function verifyEwallet(){
        $kode       = $this->input->post('kd_booking', true);
        $nama       = $this->input->post('nama_pemesan', true);
        $nominal    = $this->input->post('nominal', true); 

        #konvert nominal string to int
        $nominal_str    = preg_replace("/[^0-9]/", "", $nominal);
        $nominal_int    = (int) $nominal_str;

        #validasi kode
        $validation = $this->FrontendModel->getByCode($kode);

        if($validation->num_rows() > 0){
            $row = $validation->row();
            if($row->transaction_total == $nominal_int){
                if($row->transaction_paid != 1){
                    if($row->transaction_payment == "ewallet"){
                        $verify = $this->XenditModel->verify_ewallet($row->transaction_uniq);

                        if($verify == 'SUCCESS')
                            $this->session->set_flashdata('success', 'Konfirmasi Terkirim, Silahkan Cek Email Anda');
                        else
                            $this->session->set_flashdata('error', 'Konfirmasi Gagal, Harap Melakukan Pembayaran Terlebih Dahulu !!!');

                        redirect(base_url());
                    }
                    else{
                        $this->session->set_flashdata('error', 'Konfirmasi Pembayaran Manual Hanya Untuk Jenis Pembayaran Melalui E-Wallet !!!');
                        redirect(base_url());
                    }
                    
                }
                else{
                    $this->session->set_flashdata('error', 'Anda Sudah Melakukan Konfirmasi Sebelumnya, Silahkan Cek Email Anda !!!');
                    redirect(base_url());
                }
                
            }
            else{
                #code alrt nominal salah
                $this->session->set_flashdata('error', 'Konfirmasi Gagal, Nominal Yang Anda Masukkan Tidak Sesuai !!!');
                redirect(base_url());
            }
        }
        else{
            #code alert kode salah
            $this->session->set_flashdata('error', 'Konfirmasi Gagal, Kode Booking Yang Anda Masukkan Salah !!!');
            redirect(base_url());
        }

        
    }

}
