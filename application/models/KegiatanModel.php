<?php
class KegiatanModel extends CI_Model {
    function getKegiatan(){
        $data = $this->db->get('kegiatan');
        return $data->result();
    }

    function addKegiatan($data){
        $this->db->insert('kegiatan', $data);
    }
    
    function editKegiatan($id,$data){
        $this->db->where('id', $id);
        $this->db->update('kegiatan', $data);
    }

    function dellKegiatan($id){
        return $this->db->delete('kegiatan', array('id' => $id));
    }
}
?>