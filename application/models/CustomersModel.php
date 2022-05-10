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
class CustomersModel extends CI_Model
{

    public function login($data){
        $this->db->select('*')
            ->from('tb_customers')
            ->where('email', $data['email'])
            ->where('password', $data['password']);

        $sql = $this->db->get();
        return $sql;
    }

    public function register($data){
        if($data['full_name'] != ''){
            $this->db->insert('tb_customers',$data);
        }
    }

    public function checkEmail($email){
        $this->db->select('*')
                ->from('tb_customers')
                ->where('email', $email);

        $sql = $this->db->get();

        if($sql->num_rows() > 0){
            return $sql->row();
        }
        else{
            return 'failed';
        }
    }

    public function getById($id){
        $this->db->select('*')
                ->from('tb_customers')
                ->where('id_customer', $id);

        $sql = $this->db->get()->row();

        return $sql;
    }

    public function newPassword($email, $password){
        $this->db->set('password', md5($password))
                ->where('email', $email)
                ->update('tb_customers');

        if($this->db->affected_rows() > 0){
            return 'success';
        }
        else{
            return 'failed';
        }
    }

}