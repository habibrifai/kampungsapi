<?php
class AuthModel extends CI_Model {
    function register($data){
        $this->db->where('username', $data['username']);
        $this->db->or_where('email', $data['email']);
        $stat = $this->db->get('user');
        if ($stat->num_rows()>0) {
            return array('stat' => false);
        }
        $this->db->insert('user', $data);
		return array('stat' => true);
    }
    
    function login($data){
        $data['status']=1;
        $stat = $this->db->get_where('user', $data);
        if ($stat->num_rows()>0) {
            return array(
                'stat' => true,
                'data' => $stat->row(0),
                'role' => 0
            );
        }else{
            $stat2 = $this->db->get_where('admin', $data);
            if ($stat2->num_rows()>0) {
                return array(
                    'stat' => true,
                    'data' => $stat2->row(0),
                    'role' => 1
                );
            }
        }
		return array('stat' => false);
    }
        
    function ver($data){
        $data = array(
            'username' => $data[0], 
            'email' => $data[1],
            'kode' => $data[2]
        );
        $query = $this->db->get_where('user', $data);
        if ($query->num_rows()>0) {
            $this->db->set('status', 1);
            $this->db->where('username', $data['username']);
            $this->db->update('user');
            $result= array('stat' => '1');
        }
        else{
            $result= array('stat' => '0');
        }
        return $result;
    }
}
?>