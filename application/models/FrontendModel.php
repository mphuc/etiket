<?php

/**
 * @property  CI_Lang $lang
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 * @property  ApiModel apiModel
 * @property  ProductModel productModel
 * @property  TicketModel ticketModel
 * @property  UserModel userModel
 * @property  Setting setting
 */
class FrontendModel extends CI_Model
{

	public function get_product()
	{
		$this->db->select('*')
			->from('tb_product')
			->where('product_active', 1)
			->order_by("product_order", "asc");

		$sql = $this->db->get()->result();
		return $sql;
	}

	public function get_syarat()
	{
		$this->db->select('*')
			->from('tb_syaratketentuan');

		$sql = $this->db->get()->result();
		return $sql;
	}

	public function get_kontak()
	{
		$this->db->select('*')
			->from('tb_kontak');

		$sql = $this->db->get()->result();
		return $sql;
	}

	public function get_tentang()
	{
		$this->db->select('*')
			->from('tb_tentangkami');

		$sql = $this->db->get()->result();
		return $sql;
	}

	public function getById($id)
	{

		$this->db->select('*')
			->from('tb_transaction')
			->where('transaction_id', $id);

		return $this->db->get()->row();
	}

	public function getByCode($code)
	{
		$this->db->select('*')
			->from('tb_transaction')
			->where('transaction_code', $code);

		return $this->db->get();
	}

	public function add_transaction($data, $detail)
	{
		// simpan transaksi

		$insert_query = $this->db->insert('tb_transaction', $data);
		$last_insert_id = $this->db->insert_id();

		$unique = md5($last_insert_id);

		$data_update = array(
			'transaction_uniq' => strtoupper($unique)
		);

		$this->db->where('transaction_id', $last_insert_id);
		$this->db->update('tb_transaction', $data_update);

		// simpan detail
		for ($i = 0; $i < count($detail); $i++) {

			$data_detail[] = array(
				'transaction_id' => $last_insert_id,
				'product_id' => $detail[$i]['id_tiket'],
				'transaction_detail_price' => $detail[$i]['harga_tiket'],
				'transaction_detail_qty' => $detail[$i]['jumlah_item'],
				'transaction_detail_subtotal' => $detail[$i]['subT'],
			);
		}

		try {

			for ($i = 0; $i < count($detail); $i++) {
				$this->db->insert('tb_transaction_detail', $data_detail[$i]);
			}
			return $last_insert_id;
		} catch (Exception $e) {
			return 'failed';
		}
	}

	public function update_transactionUniq($id, $data)
	{
		$this->db->where('transaction_id', $id)
			->update('tb_transaction', $data);
	}

	public function getTransaction($id)
	{
		$this->db->where('transaction_user_email', $id)
			->order_by('transaction_id', 'DESC');

		return $this->db->get('tb_transaction')->result();
	}

	public function getHistory($id)
	{
		$this->db->select('*')
			->from('tb_transaction_detail')
			->join('tb_product', 'tb_transaction_detail.product_id = tb_product.product_id')
			->join('tb_transaction', 'tb_transaction_detail.transaction_id = tb_transaction.transaction_id')
			->where('tb_transaction.transaction_user_email', $id)
			->order_by('tb_transaction.transaction_id', 'DESC');

		return $this->db->get()->result();
	}

	public function getDetailTransactions($id)
	{
		$this->db->select('*')
			->from('tb_transaction_detail')
			->join('tb_transaction', 'tb_transaction_detail.transaction_id = tb_transaction.transaction_id')
			->join('tb_product', 'tb_transaction_detail.product_id = tb_product.product_id')
			->where('tb_transaction_detail.transaction_id', $id);

		return $this->db->get()->result();
	}

	public function getInvoice($id)
	{
		$this->db->select('*')
			->from('tb_xendit')
			->where('external_id', $id);

		return $this->db->get();
	}

	public function convert_date_to_local($date)
	{
		$month = date('F', strtotime($date));
		$day = date('l', strtotime($date));
		switch ($day) {
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
		switch ($month) {
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
		$month = mb_strimwidth($month, 0, 3, "");
		$day_number = date('d', strtotime($date));
		$year_number = date('Y', strtotime($date));
		return "$day, $day_number-$month-$year_number";
	}

	public function getTicketCode($detail_transaction)
	{
		$this->db->where('transaction_detail_id', $detail_transaction);
		return $this->db->get('tb_ticket', 1)->row('ticket_code');
	}

	public function cekTicket($detail_transaction)
	{
		$this->db->where('transaction_detail_id', $detail_transaction);
		return $this->db->get('tb_ticket', 1);
	}

	public function updateTicket($detail_transaction, $tgl)
	{
		$data = array(
			'ticket_date' => $tgl
		);
		$this->db->where('transaction_detail_id', $detail_transaction);
		$this->db->update('tb_ticket', $data);
	}

	public function create_tiket($id_transaksi) //CREATED PDF
	{
		//$generator = new Picqer\Barcode\BarcodeGeneratorJPG();
		$this->load->library('ciqrcode');

		$this->db->select('*')
			->from('tb_transaction_detail')
			->join('tb_transaction', 'tb_transaction_detail.transaction_id = tb_transaction.transaction_id')
			->join('tb_product', 'tb_transaction_detail.product_id = tb_product.product_id')
			->where('tb_transaction_detail.transaction_id', $id_transaksi);
		$data_detail = $this->db->get()->result_array();

		$tmp = [];
		$i_p = 0;

		$tanggal_digunakan = date('Y-m-d');

		foreach ($data_detail as $kk => $item) {
			$judul_jumlah = 'Jumlah Orang';
			$nama_wahana = $item['product_title'];
			$jumlah_orang = $item['transaction_detail_qty'];
			$jenis_transaksi =  $item['transaction_ticket_type'];
			$tanggal_digunakan = $item['transaction_date_used'];
			$nama_kelompok = $item['transaction_group_name'];
			$judul_kelompok = 'Nama kelompok :';
			if (strtolower($jenis_transaksi) == 'individu') {
				// $jumlah_orang = 1;
				$nama_kelompok = '-';
			}

			$code = $this->getTicketCode($item['transaction_detail_id']);
			$title = date('Y-m-d', strtotime($tanggal_digunakan)) . '-' . $code;
			$data['tiket_id'] = $item['transaction_code'];
			//$barcode = $generator->getBarcode( $code , $generator::TYPE_CODE_128,3,30);
			$params['data'] = @$code;
			$params['level'] = 'H';
			$params['size'] = 8;
			$params['savename'] = FCPATH . "assets/uploads/barcode/" . @$title . '.png';
			$qrcode = $this->ciqrcode->generate($params);

			$file_location = FCPATH . "assets/uploads/barcode/" . $title . ".png";
			// file_put_contents($file_location, $barcode);
			// $imurl = $file_location;
			// $file = imagecreatefromjpeg($imurl);
			// $rotim = imagerotate($file, 90, 0);
			// imagejpeg($rotim, $imurl);
			$dir_name  = FCPATH . 'assets/uploads/barcode/';
			if (!is_dir($dir_name)) {
				mkdir($dir_name, 0777, true);
			}
			$data['barcode'] = "assets/uploads/barcode/$title.png";
			$data['tanggal'] = $this->convert_date_to_local($tanggal_digunakan);
			$data['wahana'] = $nama_wahana;
			$data['nama'] = $nama_kelompok;
			$data['jenis'] = $jenis_transaksi;
			$data['tipe_tiket'] = $jenis_transaksi;
			$data['jumlah'] = $jumlah_orang;
			$data['email'] = $item['transaction_user_email'];
			$data['logo_tamanpintar'] = 'assets/uploads/files/images-removebg-preview.png';
			$data['id_transaksi'] = $item['transaction_id'];
			$data['judul_kelompok'] = $judul_kelompok;
			$data['judul_jumlah'] = $judul_jumlah;
			$tmp[] = $data;
		}

		$pdf = new FPDF('L', 'mm', 'A5');
		$id_transaksi = uniqid();

		foreach ($tmp as $data) {
			$id_transaksi = $data['id_transaksi'];
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Times', '', 12);
			$pdf->Cell(195, 110, '', 1, 0);
			$pdf->Ln(10);
			$pdf->Image($data['logo_tamanpintar'], 13, 9, 70);
			$pdf->Image($data['barcode'], 165, 15, 35, 35);
			$pdf->SetFont('Arial', 'B', 20);
			$pdf->Cell(110);
			$pdf->Cell(40, 10, $data['tiket_id'], 1, 0, 'C');
			$pdf->SetFont('Arial', '', 15);
			$pdf->Text(115, 40, $data['tanggal']);
			$pdf->Text(122, 95, $data['judul_jumlah']);
			$pdf->SetFont('Arial', '', 12);
			$pdf->Text(16, 65, 'Tiket Wahana :');
			$pdf->SetFont('Arial', 'B', 11);
			$pdf->Text(16, 75, $data['wahana'] . ' - ' . $data['tipe_tiket']);
			$pdf->SetFont('Arial', '', 12);
			$pdf->Text(16, 85, $data['judul_kelompok']);
			$pdf->SetFont('Arial', 'B', 25);
			$pdf->Text(16, 95, $data['nama']);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Text(16, 110, 'Tiket yang sudah dibeli tidak dapat ditukar');
			$pdf->Text(16, 115, 'Tiket hanya berlaku untuk tanggal diatas');
			$pdf->Ln(80);
			$pdf->Cell(110);
			$pdf->SetFont('Arial', 'B', 20);
			$pdf->Cell(40, 10, sprintf('%03d', $data['jumlah']), 1, 0, 'C');
			$pdf->Ln(20);
		}
		$tanggal_digunakan = date('Y-m-d', strtotime($tanggal_digunakan));
		$file_name = md5($id_transaksi) . '.pdf';
		$dir_name = FCPATH . 'assets/uploads/tiket/' . $tanggal_digunakan;
		if (!is_dir($dir_name)) {
			mkdir($dir_name, 0777, true);
		}
		$pdf->Output($dir_name . '/' . $file_name, 'F');
		foreach ($tmp as $item) {
			unlink($item['barcode']);
		}
		return $file_name;
	}

	public function create_qris_code($qr_string, $title) 
	{
		$this->load->library('ciqrcode');

			$params['data'] = @$qr_string;
			$params['level'] = 'H';
			$params['size'] = 8;
			$params['savename'] = FCPATH . "assets/uploads/barcode/" . @$title . '.png';
			$qrcode = $this->ciqrcode->generate($params);

			$file_location = FCPATH . "assets/uploads/barcode/" . $title . ".png";
		
			$dir_name  = FCPATH . 'assets/uploads/barcode/';
			if (!is_dir($dir_name)) {
				mkdir($dir_name, 0777, true);
			}
			$data['barcode'] = "assets/uploads/barcode/$title.png";
			$tmp[] = $data;
		
		return 'success';
	}

	public function updateReschedule($id, $tgl)
	{
		$data = array(
			'transaction_date_used' => $tgl
		);

		$this->db->where('transaction_id', $id);
		$this->db->update('tb_transaction', $data);

		if ($this->db->affected_rows() > 0)
			return 'success';

		else
			return 'filed';
	}

	public function smtp()
	{
		$config = array();

		$config['protocol']       = $this->setting->get_single('setting_email', 'protocol');
		$config['smtp_host']      = $this->setting->get_single('setting_email', 'smtp_host');
		$config['smtp_port']      = $this->setting->get_single('setting_email', 'smtp_port');
		$config['smtp_user']      = $this->setting->get_single('setting_email', 'smtp_user');
		$config['smtp_pass']      = $this->setting->get_single('setting_email', 'smtp_pass');
		$config['smtp_name']      = $this->setting->get_single('setting_email', 'smtp_name');
		$config['mailtype']       = $this->setting->get_single('setting_email', 'mailtype');
		$config['charset']        = $this->setting->get_single('setting_email', 'charset');

		return $config;
	}

	public function getUrlInvoice($id)
	{

		$get = $this->getInvoice($id);

		if ($get->num_rows() > 0) {
			$row = $get->row();
			$url = $row->invoice_url;

			// echo $url;
			// echo "<script>window.open('".$url."', '_blank');win.focus();</script>";
			return $url;
		} else {
			redirect(base_url());
		}
	}

	public function sendMail($id)
	{
		$transaction = $this->getById($id);

		$xendit_external_id = $transaction->transaction_uniq;

		if ($transaction->transaction_payment != "ewallet") {
			$invoice = $this->getUrlInvoice($xendit_external_id);
		} else {
			$invoice = '';
		}


		// get data array for template
		$data = array(
			'kode'          => $xendit_external_id,
			'kode_boking'	=> $transaction->transaction_code,
			'invoice'       => $invoice,
			'total'         => $this->rupiah($transaction->transaction_total),
			'ppn'           => $this->rupiah($transaction->transaction_fee),
			'sub_total'     => $this->rupiah($transaction->transaction_total - $transaction->transaction_fee),
			'detail'        => $this->getDetailTransactions($id),
		);

		$mesg = $this->load->view('email/email', $data, true);

		$smtp = $this->smtp();

		$config = array(
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

		$this->email->to($transaction->transaction_user_email);
		$this->email->subject('[INVOICE]Pembelian Tiket Museum Nasional Indonesia');
		$this->email->message($mesg);

		//Send mail 
		if ($this->email->send()) {
			//return 'sukses';
			return $this->email->print_debugger();
		} else {
			return $this->email->print_debugger();
		}
	}

	public function sendMailSuccess($id)
	{
		$transaction = $this->getById($id);
		$file_pdf = $this->create_tiket($id);

		$email = $transaction->transaction_user_email;

		$data = array(
			'base_url' 					=> base_url(),
			'kode'							=> $transaction->transaction_code,
			'tanggal_digunakan' => $transaction->transaction_date_used,
			'total' 						=> $this->rupiah($transaction->transaction_total),
			'ppn'           		=> $this->rupiah($transaction->transaction_fee),
			'sub_total'     		=> $this->rupiah($transaction->transaction_total - $transaction->transaction_fee),
			'detail' 						=> $this->getDetailTransactions($id),
			'file_pdf' 					=> $file_pdf
		);

		$mesg = $this->load->view('email/email_kode_booking', $data, true);

		$smtp = $this->smtp();

		$config = array(
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
		$this->email->subject('[E-TICKET]Pembayaran Tiket Museum Nasional Indonesia');
		$this->email->message($mesg);

		//Send mail 
		if ($this->email->send()) {
			echo 'success';
			print_r($this->email->send());
		} else {
			echo $this->email->print_debugger();
		}
	}

	function rupiah($angka)
	{

		$hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
		return $hasil_rupiah;
	}

	function getAvailableDay($day)
	{
		$this->db->where('available_days', $day);

		return $this->db->get('tb_available_date')->row('available_status');
	}
}
