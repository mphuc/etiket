<?php    
/**
 * @property  CI_DB_query_builder $db
 * @property OrderModel orderModel
 * @property TicketModel ticketModel
 * @property FrontendModel frontendModel
 * @property CI_Input input
 * @property CI_Config config
 */

class XenditModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();        
        $this->load->config('xendit');
        require 'vendor/autoload.php';
        $this->load->model('orderModel');
        $this->load->model('ticketModel');
        $this->load->model('frontendModel');
    }

    /**
     * @param array $data
     * @return object|boolean
     */
    public function add($data=array())
    {
        $invoiceId              = $data['id'];
        $transactionUniqId      = $data['external_id'];
        $insert = array(
            'id'                            => $invoiceId,
            'external_id'                   => $transactionUniqId,
            'user_id'                       => $data['user_id'],
            'status'                        => $data['status'],
            'merchant_name'                 => $data['merchant_name'],
            'merchant_profile_picture_url'  => $data['merchant_profile_picture_url'],
            'amount'                        => $data['amount'],
            'payer_email'                   => $data['payer_email'],
            'description'                   => $data['description'],
            'expiry_date'                   => $data['expiry_date'],
            'invoice_url'                   => $data['invoice_url'],
            'should_exclude_credit_card'    => $data['should_exclude_credit_card'],
            'should_send_email'             => $data['should_send_email'],
            'created'                       => $data['created'],
            'updated'                       => $data['updated'],
        );
        $query = $this->db->insert('tb_xendit', $insert);
        if( $query ){
            $insertBanks = array();
            $insertOutlets = array();
            if(isset($data['available_banks']) && is_array($data['available_banks'])){
                foreach ($data['available_banks'] as $v) {
                    $insertBanks[] = array(
                        'invoice_id'            => $invoiceId,
                        'external_id'           => $transactionUniqId,
                        'bank_code'             => @$v['bank_code'],
                        'collection_type'       => @$v['collection_type'],
                        'bank_account_number'   => @$v['bank_account_number'],
                        'transfer_amount'       => @$v['transfer_amount'],
                        'bank_branch'           => @$v['bank_branch'],
                        'account_holder_name'   => @$v['account_holder_name'],
                        'identity_amount'       => @$v['identity_amount'],
                    );
                }
            }
            if( isset($data['available_retail_outlets']) && is_array($data['available_retail_outlets']) ){
                $insertOutlets[] = array(
                    'invoice_id'            => $invoiceId,
                    'external_id'           => $transactionUniqId,
                    'retail_outlet_name'    => @$v['retail_outlet_name'],
                    'payment_code'          => @$v['payment_code'],
                    'transfer_amount'       => @$v['transfer_amount']
                );
            }
            if( $insertBanks ) $this->db->insert_batch('tb_xendit_available_banks', $insertBanks);
            if( $insertOutlets ) $this->db->insert_batch('tb_xendit_available_retail_outlets', $insertOutlets);
        }
        return $query;
    }

    /**
     * @param string $invoiceId
     * @param string $transactionUniqId
     * @param string $status
     * @return object|boolean
     */
    public function setPaid($transactionUniqId, $status)
    {
        $update = array(
            'updated' => date('Y-m-d H:i:s'),
            'status'  => $status
        );
        $this->db->where('external_id', $transactionUniqId);
        return $this->db->update('tb_xendit', $update);
    }

    /**
     * @param string $external_id
     * @param int $amount
     * @param string $email
     * @param string $description
     * @return array
     */
    public function createInvoice($external_id, $amount, $email, $description)
    {
        $options['secret_api_key'] = $this->config->item('xendit_secret_api_key');
        $xenditPHPClient = new XenditClient\XenditPHPClient($options);
        $response = $xenditPHPClient->createInvoice($external_id,$amount,$email,$description);
        $this->add($response);
        return $response;
    }

    /**
     * @param string $invoice_id
     * @return array
     */
    protected function getInvoice($invoice_id)
    {
        $options['secret_api_key'] = $this->config->item('xendit_secret_api_key');
        $xenditPHPClient = new XenditClient\XenditPHPClient($options);
        $response = $xenditPHPClient->getInvoice($invoice_id);
        return $response;
    }
		
    public function checkInvoice(){
        $options['secret_api_key'] = $this->config->item('xendit_secret_api_key');
        $xenditPHPClient = new XenditClient\XenditPHPClient($options);
        
        $external_id = 'demo_1475801962607';
        $amount = 230000;
        $payer_email = 'marufaziz99@gmail.com';
        $description = 'Trip to Bali';

        $response = $xenditPHPClient->createInvoice($external_id, $amount, $payer_email, $description);
        print_r($response);
    }

    /**
     * @param array $data
     * @return object|boolean
     */
    protected function callbackInvoice($data=array())
    {
        $insert = array(
            'id'                        => @$data['id'],
            'external_id'               => @$data['external_id'],
            'user_id'                   => @$data['user_id'],
            'is_high'                   => @$data['is_high'],
            'payment_method'            => @$data['payment_method'],
            'status'                    => @$data['status'],
            'merchant_name'             => @$data['merchant_name'],
            'amount'                    => @$data['amount'],
            'paid_amount'               => @$data['paid_amount'],
            'bank_code'                 => @$data['bank_code'],
            'payer_email'               => @$data['payer_email'],
            'description'               => @$data['description'],
            'adjusted_received_amount'  => @$data['adjusted_received_amount'],
            'fees_paid_amount'          => @$data['fees_paid_amount'],
            'created'                   => @$data['created'],
            'updated'                   => @$data['updated'],
        );
        return $this->db->insert('tb_xendit_callback_invoice', $insert);
    }

    /**
     * @param array $data
     * @return object|boolean
     */
    // protected function callbackOutlet($data=array())
    // {
    //     $insert = array(
    //         'id'                 => @$data['id'],
    //         'owner_id'           => @$data['owner_id'],
    //         'external_id'        => @$data['external_id'],
    //         'prefix'             => @$data['prefix'],
    //         'payment_code'       => @$data['payment_code'],
    //         'retail_outlet_name' => @$data['retail_outlet_name'],
    //         'name'               => @$data['name'],
    //         'type'               => @$data['type'],
    //         'expiration_date'    => @$data['expiration_date'],
    //         'is_single_use'      => @$data['is_single_use'],
    //         'status'             => @$data['status'],
    //         'created'            => @$data['created'],
    //         'updated'            => @$data['updated'],
    //     );
    //     return $this->db->insert('tb_xendit_callback_outlet', $insert);
    // }

    /**
     * @return void
     */
    public function verify_invoice()
    {
        if( $this->input->get_request_header('x-callback-token') === $this->config->item('xendit_validation_token') && $_SERVER["REQUEST_METHOD"] === "POST" ) {
            $data = json_decode(file_get_contents('php://input'), true);
            $this->callbackInvoice($data);
            $transactionIdUniq = $data['external_id'];
            $transaction = $this->orderModel->getByIdUniq($transactionIdUniq); # script ambil data transaksi
            if( !$transaction ){
                json_response("STOP, ORDER NOT FOUND",400);
            }else{
                $transactionId  = $transaction['transaction_id'];
                $status         = $data['status']; //PAID
                $paid_amount    = $data['paid_amount'];
                // $total = ($transaction['transaction_total']-$transaction['transaction_discount'])+$transaction['transaction_fee'];
                $total = $transaction['transaction_total'];
                if( $total != $paid_amount ) {
                    json_response("STOP, TOTAL PAYMENT NOT MATCH", 400);
                }
                if( $status != 'PAID' ) {
                    json_response("STOP, INVALID STATUS", 400);
                }
                $invoiceId = $data['id'];
                $invoice = $this->getInvoice($invoiceId);
                $query = $this->orderModel->setPaid($transactionId);
                if( $query ) $this->ticketModel->create(array($transactionId)); # ??
                $this->setPaid($invoiceId, $transactionIdUniq, $invoice['status']);
                $this->frontendModel->sendMailSuccess($transactionId);  #send mail

                json_response('SUCCESS');
            }
            
        } else {
            json_response('NOT ALLOWED', 403);
        }
    }

    /**
     * @return void
     */

    // public function verify_outlet()
    // {
    //     if( $this->input->get_request_header('X-CALLBACK-TOKEN') === $this->config->item('xendit_validation_token') && $_SERVER["REQUEST_METHOD"] === "POST" ) {
    //         $data = json_decode(file_get_contents('php://input'), true);
    //         $this->callbackOutlet($data);
    //         $transactionIdUniq = @$data['external_id'];
    //         $transaction = $this->orderModel->getByIdUniq($transactionIdUniq);
    //         if( !$transaction ){
    //             json_response("STOP, ORDER NOT FOUND",400);
    //         }else{
    //             $transactionId  = $transaction['transaction_id'];
    //             $status         = @$data['status']; //ACTIVE
    //             if( $status != 'ACTIVE' ) {
    //                 json_response("STOP, INVALID STATUS", 400);
    //             }
    //             $invoiceId = @$data['id'];
    //             $invoice = $this->getInvoice($invoiceId);
    //             $query = $this->orderModel->setPaid($transactionId);
    //             if( $query ) $this->ticketModel->create(array($transactionId));
    //             $this->setPaid($transactionIdUniq, $invoice['status']);
    //             $this->apiModel->sendBulkNotificationToMobile([$transaction['user_id']], 'Kidsfun','Pembayaran telah berhasil dilakukan');
    //             json_response('SUCCESS');
    //         }
    //     }else{
    //         json_response('NOT ALLOWED',403);
    //     }
    // }


    /**
     * @param array $transactionIdUniq
     * @return mixed|array
     */
    public function getOrder($transactionIdUniq)
    {
        $this->db->where_in('external_id',$transactionIdUniq);
        $invoices = $this->db->get('tb_xendit')->result_array();
        $this->db->select('external_id,bank_code,collection_type,bank_account_number,transfer_amount,bank_branch,account_holder_name,identity_amount');
        $this->db->where_in('external_id', $transactionIdUniq);
        $available_banks = $this->db->get('tb_xendit_available_banks')->result_array();
        $this->db->select('external_id,retail_outlet_name,payment_code,transfer_amount');
        $this->db->where_in('external_id', $transactionIdUniq);
        $available_retail_outlets = $this->db->get('tb_xendit_available_retail_outlets')->result_array();
        foreach ($invoices as $key => $invoice) {
            $resultBanks = array_filter($available_banks, function ($el)use($invoice){
                return $el['external_id'] == $invoice['external_id'];
            });
            $resultOutlets = array_filter($available_retail_outlets, function ($el)use($invoice){
                return $el['external_id'] == $invoice['external_id'];
            });
            $invoices[$key]['available_banks'] = $resultBanks;
            $invoices[$key]['available_retail_outlets'] = $resultOutlets;
        }
        return $invoices;
    }

    public function create_qris($external_id, $amount){
        $xendit     = new Xendit\Xendit;
        $xendit->setApiKey($this->config->item('xendit_secret_api_key')); #data production
        $qris    = new Xendit\QRCode;
        $redirectUrl = 'https://e-tiket.museumnasional.or.id/verifyQris/';
        $qrisParams = [
            'external_id' => $external_id,
            'type' =>"DYNAMIC",
            'callback_url' => $redirectUrl,
            'amount' => $amount
        ];

        $response = $qris->create($qrisParams);

        return $response;
    }

    
    public function verify_qris($transactionIdUniq){
        $transaction = $this->orderModel->getByIdUniq($transactionIdUniq); # script ambil data transaksi
        if( !$transaction ){
            json_response("STOP, ORDER NOT FOUND",400);
        }else{
            $transactionId  = $transaction['transaction_id'];
            $total = $transaction['transaction_total'];

            $xendit     = new Xendit\Xendit;
            // $xendit->setApiKey('xnd_development_n26xcwLfs8Hj1gDNlhyR0UpNvcpw41i9SpndWeSHbxElchoVcw9dWgp8OiHhJ'); #data test
            $xendit->setApiKey($this->config->item('xendit_secret_api_key')); #data production

            $qris    = new Xendit\QRCode;
            
            $getqris = $qris->get($transactionIdUniq);

            if($getqris['status'] == 'COMPLETED'){
                $query = $this->orderModel->setPaid($transactionId);
                if( $query ) $this->ticketModel->create(array($transactionId)); # ??
                $this->frontendModel->sendMailSuccess($transactionId);  #send mail

                // json_response('SUCCESS');

                return "SUCCESS";
            }
            else
                return "FAILED";
            
        }
            
    }

    public function verify_qris_callback(){
        if( $this->input->get_request_header('x-callback-token') === $this->config->item('xendit_validation_token') && $_SERVER["REQUEST_METHOD"] === "POST" ) {
            $data = json_decode(file_get_contents('php://input'), true);
            $transactionIdUniq = $data['id'];
            $transaction = $this->orderModel->getByIdUniq($transactionIdUniq); # script ambil data transaksi
            if( !$transaction ){
                json_response("STOP, ORDER NOT FOUND",400);
            }else{
                $transactionId  = $transaction['transaction_id'];
                $total = $transaction['transaction_total'];

                $xendit     = new Xendit\Xendit;
                // $xendit->setApiKey('xnd_development_n26xcwLfs8Hj1gDNlhyR0UpNvcpw41i9SpndWeSHbxElchoVcw9dWgp8OiHhJ'); #data test
                $xendit->setApiKey($this->config->item('xendit_secret_api_key')); #data production

                $qris    = new Xendit\QRCode;
                
                $getQris = $qris->get($transactionIdUniq);

                if($getQris['status'] == 'COMPLETED'){
                    $query = $this->orderModel->setPaid($transactionId);
                    if( $query ) $this->ticketModel->create(array($transactionId)); # ??
                    $this->frontendModel->sendMailSuccess($transactionId);  #send mail
                    json_response('SUCCESS');
                }
                else
                    json_response("STOP, INVALID STATUS", 400);
            }
            
        } else {
            json_response('NOT ALLOWED', 403);
        }

        $transaction = $this->orderModel->getByIdUniq($transactionIdUniq); # script ambil data transaksi
        if( !$transaction ){
            json_response("STOP, ORDER NOT FOUND",400);
        }else{
            $transactionId  = $transaction['transaction_id'];
            $total = $transaction['transaction_total'];

            $xendit     = new Xendit\Xendit;
            // $xendit->setApiKey('xnd_development_n26xcwLfs8Hj1gDNlhyR0UpNvcpw41i9SpndWeSHbxElchoVcw9dWgp8OiHhJ'); #data test
            $xendit->setApiKey($this->config->item('xendit_secret_api_key')); #data production

            $qris    = new Xendit\QRCode;
            
            $getQris = $qris->get($transactionIdUniq);

            if($getQris['status'] == 'COMPLETED'){
                $query = $this->orderModel->setPaid($transactionId);
                if( $query ) $this->ticketModel->create(array($transactionId)); # ??
                $this->frontendModel->sendMailSuccess($transactionId);  #send mail

                // json_response('SUCCESS');

                return "SUCCESS";
            }
            else
                return "FAILED";
            
        }
            
    }

    public function create_ewallet($external_id, $amount, $phone){
        $xendit     = new Xendit\Xendit;
        //$xendit->setApiKey('xnd_development_n26xcwLfs8Hj1gDNlhyR0UpNvcpw41i9SpndWeSHbxElchoVcw9dWgp8OiHhJ'); #data test
        $xendit->setApiKey($this->config->item('xendit_secret_api_key')); #data production
        //$xendit->setApiKey('xnd_production_zbuquIauQ9zkfZEQm3FADL2gMvtrZmJE9itIZQ3oJET5Mn30p5RILpAe4AHjw');

        $ewallet    = new Xendit\EWallets;
        $redirectUrl = 'https://e-tiket.museumnasional.or.id/';
        $ovoParams = [
            'external_id' => $external_id,
            'amount' => $amount,
            'phone' => $phone,
            'ewallet_type' => 'OVO',
            'failure_redirect_url' => $redirectUrl, 
            'success_redirect_url' => $redirectUrl
        ];

       

        $response = $ewallet->create($ovoParams);

        return $response;

        // try {
        //     $createOvo = ;
        //     var_dump($createOvo);
        // } catch (\Xendit\Exceptions\ApiException $exception) {
        //     var_dump($exception);
        // }
    }

    public function verify_ewallet_callback(){
        if( $this->input->get_request_header('x-callback-token') === $this->config->item('xendit_validation_token') && $_SERVER["REQUEST_METHOD"] === "POST" ) {
            $data = json_decode(file_get_contents('php://input'), true);
            $transactionIdUniq = $data['id'];
            $transaction = $this->orderModel->getByIdUniq($transactionIdUniq); # script ambil data transaksi
            if( !$transaction ){
                json_response("STOP, ORDER NOT FOUND",400);
            }else{
                $transactionId  = $transaction['transaction_id'];
                $total = $transaction['transaction_total'];

                $xendit     = new Xendit\Xendit;
                // $xendit->setApiKey('xnd_development_n26xcwLfs8Hj1gDNlhyR0UpNvcpw41i9SpndWeSHbxElchoVcw9dWgp8OiHhJ'); #data test
                $xendit->setApiKey($this->config->item('xendit_secret_api_key')); #data production

                $ewallet    = new Xendit\EWallets;
                
                $getOvo = $ewallet->getPaymentStatus($transactionIdUniq, 'OVO');

                if($getOvo['status'] == 'COMPLETED'){
                    $query = $this->orderModel->setPaid($transactionId);
                    if( $query ) $this->ticketModel->create(array($transactionId)); # ??
                    $this->frontendModel->sendMailSuccess($transactionId);  #send mail
                    json_response('SUCCESS');
                }
                else
                    json_response("STOP, INVALID STATUS", 400);
            }
            
        } else {
            json_response('NOT ALLOWED', 403);
        }

        $transaction = $this->orderModel->getByIdUniq($transactionIdUniq); # script ambil data transaksi
        if( !$transaction ){
            json_response("STOP, ORDER NOT FOUND",400);
        }else{
            $transactionId  = $transaction['transaction_id'];
            $total = $transaction['transaction_total'];

            $xendit     = new Xendit\Xendit;
            // $xendit->setApiKey('xnd_development_n26xcwLfs8Hj1gDNlhyR0UpNvcpw41i9SpndWeSHbxElchoVcw9dWgp8OiHhJ'); #data test
            $xendit->setApiKey($this->config->item('xendit_secret_api_key')); #data production

            $ewallet    = new Xendit\EWallets;
            
            $getOvo = $ewallet->getPaymentStatus($transactionIdUniq, 'OVO');

            if($getOvo['status'] == 'COMPLETED'){
                $query = $this->orderModel->setPaid($transactionId);
                if( $query ) $this->ticketModel->create(array($transactionId)); # ??
                $this->frontendModel->sendMailSuccess($transactionId);  #send mail

                // json_response('SUCCESS');

                return "SUCCESS";
            }
            else
                return "FAILED";
            
        }
            
    }

    public function verify_ewallet($transactionIdUniq){
        $transaction = $this->orderModel->getByIdUniq($transactionIdUniq); # script ambil data transaksi
        if( !$transaction ){
            json_response("STOP, ORDER NOT FOUND",400);
        }else{
            $transactionId  = $transaction['transaction_id'];
            $total = $transaction['transaction_total'];

            $xendit     = new Xendit\Xendit;
            // $xendit->setApiKey('xnd_development_n26xcwLfs8Hj1gDNlhyR0UpNvcpw41i9SpndWeSHbxElchoVcw9dWgp8OiHhJ'); #data test
            $xendit->setApiKey($this->config->item('xendit_secret_api_key')); #data production

            $ewallet    = new Xendit\EWallets;
            
            $getOvo = $ewallet->getPaymentStatus($transactionIdUniq, 'OVO');

            if($getOvo['status'] == 'COMPLETED'){
                $query = $this->orderModel->setPaid($transactionId);
                if( $query ) $this->ticketModel->create(array($transactionId)); # ??
                $this->frontendModel->sendMailSuccess($transactionId);  #send mail

                // json_response('SUCCESS');

                return "SUCCESS";
            }
            else
                return "FAILED";
            
        }
            
    }

}