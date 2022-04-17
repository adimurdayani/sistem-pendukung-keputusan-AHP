<?php

defined('BASEPATH') or exit('No direct script access allowed');

class m_tanah extends CI_Model
{
    public function get_tanah()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('jenis_tanah');
        return $query->result_array();
    }

    public function tambah($data)
    {
        $this->db->insert('jenis_tanah', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('jenis_tanah', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jenis_tanah');
    }
}

/* End of file m_tanah.php */
