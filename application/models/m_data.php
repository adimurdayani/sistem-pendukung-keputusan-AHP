<?php

defined('BASEPATH') or exit('No direct script access allowed');

class m_data extends CI_Model
{

    public function get_frekuensi()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('nilai_frekuensi');
        return $query->result_array();
    }

    public function tambah_frekuensi($data)
    {
        $this->db->insert('nilai_frekuensi', $data);
    }

    public function update_frekuensi($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('nilai_frekuensi', $data);
    }

    public function delete_frekuensi($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('nilai_frekuensi');
    }

    public function get_baris()
    {
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('baris_satu');
        return $query->result_array();
    }

    public function delete_baris($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('baris_satu');
    }

    public function sum_baris_satu($id)
    {
        $sql = "SELECT sum(jumlah) as jumlah FROM baris_satu WHERE user_id=$id";
        $return = $this->db->query($sql);
        return $return->row()->jumlah;
    }

    public function sum_baris_satu_alternatif($id)
    {
        $sql = "SELECT sum(jumlah) as jumlah FROM baris_satu_alternatif WHERE user_id=$id";
        $return = $this->db->query($sql);
        return $return->row()->jumlah;
    }

    public function sum_baris_dua_alternatif($id)
    {
        $sql = "SELECT sum(jumlah) as jumlah FROM baris_dua_alternatif WHERE user_id=$id";
        $return = $this->db->query($sql);
        return $return->row()->jumlah;
    }

    public function sum_baris_dua($id)
    {
        $sql = "SELECT sum(jumlah) as jumlah FROM baris_dua WHERE user_id=$id";
        $return = $this->db->query($sql);
        return $return->row()->jumlah;
    }

    public function sum_baris_tiga($id)
    {
        $sql = "SELECT sum(jumlah) as jumlah FROM baris_tiga WHERE user_id=$id";
        $return = $this->db->query($sql);
        return $return->row()->jumlah;
    }

    public function sum_baris_tiga_alternatif($id)
    {
        $sql = "SELECT sum(jumlah) as jumlah FROM baris_tiga_alternatif WHERE user_id=$id";
        $return = $this->db->query($sql);
        return $return->row()->jumlah;
    }

    public function sum_evn()
    {
        $sql = "SELECT sum(total) as total FROM evn_normalisasi";
        $return = $this->db->query($sql);
        return $return->row()->total;
    }

    public function delete_all_perbandingan_karakter($id)
    {
        $this->db->where_in('id_user', $id);
        $this->db->delete('perbandingan');
    }

    public function delete_all_perbandingan_alternatif($id)
    {
        $this->db->where_in('id_user', $id);
        $this->db->delete('perbandingan_dua');
    }
}

/* End of file m_data.php */
