<?php

defined('BASEPATH') or exit('No direct script access allowed');

class m_menu extends CI_Model
{

    public function get_menu()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('user_menu');
        return $query->result_array();
    }

    public function tambah_menu($data)
    {
        $this->db->insert('user_menu', $data);
    }

    public function update_menu($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('user_menu', $data);
    }

    public function delete_menu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }

    public function get_submenu()
    {
        $query = " SELECT `user_sub_menu`.*,`user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu` 
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                    ORDER BY `id` DESC";
        return $this->db->query($query)->result();
    }

    public function tambah_submenu($data)
    {
        $this->db->insert('user_sub_menu', $data);
    }

    public function update_submenu($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);
    }

    public function delete_submenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }
}

/* End of file m_menu.php */
