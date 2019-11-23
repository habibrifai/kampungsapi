<?php
class PenggunaModel extends CI_Model {
    function getPengguna(){
        $data = $this->db->get('user');
        return $data->result();
    }
    function dellPengguna($id){
        return $this->db->delete('user', array('id' => $id));
    }
}
?>