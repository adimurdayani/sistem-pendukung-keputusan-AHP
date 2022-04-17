<?php

defined('BASEPATH') or exit('No direct script access allowed');

class m_mangrove extends CI_Model
{
    public function get_mangrove()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('jenis_mangrove');
        return $query->result_array();
    }

    public function tambah($data)
    {
        $this->db->insert('jenis_mangrove', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('jenis_mangrove', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jenis_mangrove');
    }
}

/* End of file m_mangrove.php */
