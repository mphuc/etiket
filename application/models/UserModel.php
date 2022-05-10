<?php
/**
 * @property  CI_Lang $lang
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 */
class UserModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array
     */
    public function get_group_excerp_members()
    {
        $tmp = [];
        $this->db->select('tb_user.id');
        $this->db->join('tb_users_groups','tb_users_groups.user_id=tb_user.id');
        $this->db->join('tb_groups','tb_groups.id=tb_users_groups.group_id');
        $this->db->where_not_in('tb_groups.name', 'members' );
        $this->db->group_by('tb_user.id');
        $result = $this->db->get('tb_user')->result_array();
        foreach ( $result as $item) {
            $tmp[] = $item['id'];
        }
        return $tmp;
    }

    /**
     * @param int $userID
     * @return array
     */
    public function getGroupsByUserid($userID)
    {
        $this->db->select('g.name as group,ug.*');
        $this->db->join('tb_groups g','g.id=ug.group_id');
        $this->db->where('user_id', $userID);
        $data = $this->db->get('tb_users_groups ug')->result();
        $groupNames = [];
        foreach ($data as $v) {
            $groupNames[] = strtolower($v->group);
        }
        return $groupNames;
    }

    /**
     * @param string $group_name
     * @return array
     */
    public function getByGroup($group_name='members')
    {
        $tmp = [];
        $this->db->select('tb_user.id');
        $this->db->join('tb_users_groups','tb_users_groups.user_id=tb_user.id');
        $this->db->join('tb_groups','tb_groups.id=tb_users_groups.group_id');
        $this->db->where('tb_groups.name',$group_name );
        $this->db->group_by('tb_user.id');
        $this->db->order_by('username','asc');
        $result = $this->db->get('tb_user')->result_array();
        foreach ( $result as $item) {
            $tmp[] = $item['id'];
        }
        return $tmp;
    }

    /**
     * @param string $group_name
     * @return array
     */
    public function getByGroupExcept($group_name='members')
    {
        $tmp = [];
        $this->db->select('tb_user.id');
        $this->db->join('tb_users_groups','tb_users_groups.user_id=tb_user.id');
        $this->db->join('tb_groups','tb_groups.id=tb_users_groups.group_id');
        $this->db->where_not_in('tb_groups.name',$group_name );
        $this->db->group_by('tb_user.id');
        $this->db->order_by('username','asc');
        $result = $this->db->get('tb_user')->result_array();
        foreach ( $result as $item) {
            $tmp[] = $item['id'];
        }
        return $tmp;
    }

    /**
     * @param string $group_name
     * @return int
     */
    public function getCountByGroup($group_name='members')
    {
        $tmp = [];
        // $this->db->select('tb_user.id');
        // $this->db->join('tb_users_groups','tb_users_groups.user_id=tb_user.id');
        // $this->db->join('tb_groups','tb_groups.id=tb_users_groups.group_id');
        // $this->db->where('tb_groups.name',$group_name );
        // $this->db->group_by('tb_user.id');
        // $count = $this->db->count_all_results('tb_user');        #with table user

        $this->db->select('id_customer');
        $count = $this->db->count_all_results('tb_customers');           #with table customers

        return $count;
    }

    /**
     * @param string $group_name
     * @return mixed
     */
    public function getSingleGroupIDbyName($group_name='members')
    {
        $this->db->where('name', $group_name);
        return $this->db->get('tb_groups',1)->row('id');
    }

    /**
     * @param $email string
     * @return mixed
     */
    public function getByEmail($email)
    {
        $this->db->where('email', $email);
        $userDB = $this->db->get('tb_user', 1)->row();
        return $userDB;
    }

    /**
     * @param $id int
     * @return mixed
     */
    public function getByID($id)
    {
        $this->db->where('id', $id);
        $userDB = $this->db->get('tb_user', 1)->row();
        return $userDB;
    }

    /**
     * @param $ids array
     * @return mixed
     */
    public function getByIDs($ids)
    {
        if( !$ids ) return array();
        $this->db->where_in('id', $ids);
        $this->db->order_by('username','asc');
        $userDB = $this->db->get('tb_user')->result_array();
        return $userDB;
    }

      /**
     * @param $ids array
     * @return mixed
     */
    public function getPayeeId()
    {
        $userDB = $this->db->get('tb_payee')->result_array();
        return $userDB;
    }
      /**
     * @param $ids array
     * @return mixed
     */
    public function getCardType()
    {
        $userDB = $this->db->get('tb_card_type')->result_array();
        return $userDB;
    }
          /**
     * @param $ids array
     * @return mixed
     */
    public function getBank()
    {
        $this->db->join('tb_card_type','tb_bank.id_card_type = tb_card_type.card_type_id');
        $this->db->order_by('bank_name','ASC');
        $userDB = $this->db->get('tb_bank')->result_array();
        return $userDB;
    }

    /**
     * 
     * getbank v2
     * 
     */
    public function getBank2()
    {
        $this->db->join('tb_card_type','tb_bank.id_card_type = tb_card_type.card_type_id');
        $this->db->order_by('bank_name','ASC');
        $userDB = $this->db->get('tb_bank')->result();
        return $userDB;
    }


    /**
     * @param $username string
     * @return mixed|array
     */
    public function getByUsername($username)
    {
        $this->db->where('username', $username);
        $userDB = $this->db->get('tb_user', 1)->row();
        return $userDB;
    }

    /**
     * @param $ipAddress string
     * @return mixed
     */
    public function getLocation($ipAddress)
    {
        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ipAddress"));
        //$country = $geo["geoplugin_countryName"];
        $city = @$geo["geoplugin_city"];
        return $city;
    }

    /**
     * @param int $userId
     * @param array $data
     * @return object|boolean
     */
    public function update($userId, $data=array())
    {
        if( !$data || !is_array($data) ) return false;
        $this->db->where('id', $userId);
        return $this->db->update('tb_user', $data);
    }

    /**
     * @param int $groupId
     * @param array $roles
     * @return void
     */
    public function roleUpdate($groupId, $roles=array())
    {
        $this->db->where('post_id', $groupId);
        $this->db->where('terms_type','role');
        $this->db->delete('tb_terms');
        if( $roles ){
            $terms = [];
            foreach ($roles as $role) {
                $terms[] = array(
                    'terms_type'    => 'role',
                    'category_id'   => $role,    //role id
                    'post_id'       => $groupId  //group id
                );
            }
            if( $terms ) $this->db->insert_batch('tb_terms', $terms);
        }
    }

    /**
     * @param int $groupId
     * @return array
     */
    public function roleByGroupId($groupId)
    {
        $this->db->where('post_id', $groupId);
        $this->db->where('terms_type','role');
        $results = $this->db->get('tb_terms')->result_array();
        return array_column($results, 'category_id');
    }

    /**
     * @param int $userId
     * @param int $groupId
     */
    public function assignGroupToUser($userId, $groupId)
    {
        $this->db->where('user_id', $userId);
        $this->db->where('group_id', $groupId);
        $this->db->delete('tb_users_groups');
        $data = array(
            'user_id'   => $userId,
            'group_id'  => $groupId,
        );
        $this->db->insert('tb_users_groups', $data);
    }
}