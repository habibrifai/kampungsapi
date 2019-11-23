<?php
class TiketModel extends CI_Model {
    function getTiket($data=false){
        if ($data) {
            $data = $this->db->get_where('tiket',$data);
        }else{
            $data = $this->db->get('tiket');
        }
        return $data->result();
    }

    function getStok()
    {
        $this->db->select('stok');
        $data = $this->db->get('tiket')->row_array();
        return $data['stok'];
    }

    // cek total tiket yang dipesan pada tanggal $tgl
    function getTotalPesan($tgl)
    {
        $this->db->select_sum('jumlah_tiket', 'total');
        $this->db->where('DATE(tgl_pesanan)', $tgl);
        return $this->db->get('pesanan')->row();
    }

    function addTiket($data){
        $this->db->insert('tiket', $data);
    }
    
    function editTiket($id,$data){
        $this->db->where('id', $id);
        $this->db->update('tiket', $data);
    }

    function dellTiket($id){
        return $this->db->delete('tiket', array('id' => $id));
    }

    function getTiketDetail($data){
        $data = $this->db->get_where('tiket',$data);
        return $data->row(0);
    }

    function insertPesanan($data){
        $this->db->insert('pesanan', $data);
    }

    function updateStok($data){
        $this->db->set('stok', $data);
        $this->db->update('tiket');
    }


    function getTiketone($id){
        $query = $this->db->get_where('tiket',array('id' => $id));
        return $query->row(0);
    }

    function getPemesanan(){
        $this->db->select('pesanan.*,tiket.harga,tiket.nama,user.username, pesanan.tgl_pesanan');
        $this->db->from('pesanan');
        $this->db->join('user', 'pesanan.id_user = user.id');
        $this->db->join('tiket', 'pesanan.id_tiket = tiket.id');
        $this->db->order_by('pesanan.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function getDetailPemesanan($id){
        $this->db->select('pesanan.*,tiket.harga');
        $this->db->from('pesanan');
        $this->db->join('user', 'pesanan.id_user = user.id');
        $this->db->join('tiket', 'pesanan.id_tiket = tiket.id');
        $this->db->where('pesanan.id_user',$id);
        $this->db->order_by('pesanan.id', 'DESC');
        $query = $this->db->get();
        return $query->row(0);
    }

    function laporanBulan($tgl)
    {
        $this->db->select('type_tiket.nama, sum(pesanan.jumlah_tiket) as total, sum(pesanan.jumlah_tiket)*tiket.harga as totalHarga');
        $this->db->from('pesanan');
        $this->db->join('tiket', 'tiket.id = pesanan.id_tiket');
        $this->db->join('type_tiket', 'type_tiket.id = tiket.type');
        $this->db->where('DATE(tgl_pesanan)', $tgl);
        $this->db->group_by('tiket.type');
        return $this->db->get()->result_array();
    }

    function laporanTahun($bln, $tahun)
    {
        $this->db->select('type_tiket.nama, sum(pesanan.jumlah_tiket) as total, sum(pesanan.jumlah_tiket)*tiket.harga as totalHarga, MONTH(pesanan.tgl_pesanan) as bulanPemesanan, tiket.nama as namaPaket, DATE(pesanan.tgl_pesanan) as tanggalPemesanan');
        $this->db->from('pesanan');
        $this->db->join('tiket', 'tiket.id = pesanan.id_tiket');
        $this->db->join('type_tiket', 'type_tiket.id = tiket.type');
        $this->db->where('MONTH(tgl_pesanan)', $bln);
        $this->db->where('YEAR(tgl_pesanan)', $tahun);
        $this->db->group_by('tiket.type');
        return $this->db->get()->result_array();
    }

    function testLaporanTahun($tahun)
    {
        $this->db->select('type_tiket.nama, sum(pesanan.jumlah_tiket) as total, sum(pesanan.jumlah_tiket)*tiket.harga as totalHarga, MONTH(pesanan.tgl_pesanan) as bulanPemesanan, tiket.nama as namaPaket');
        $this->db->from('pesanan');
        $this->db->join('tiket', 'tiket.id = pesanan.id_tiket', 'left');
        $this->db->join('type_tiket', 'type_tiket.id = tiket.type');
        $this->db->where('YEAR(tgl_pesanan)', $tahun);
        $this->db->group_by('tiket.type');
        return $this->db->get()->result_array();
    }

    // function getTanggal(){
       //$this->db->select('tgl_pesanan');
      //  $data ['pesanan'] = $this->db->get('pesanan')->row_array();
          //  return $data['pesanan'];
       // }
}
