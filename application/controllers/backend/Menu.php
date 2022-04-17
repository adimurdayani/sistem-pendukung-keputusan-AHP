<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_menu');
        is_logged_in();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            // show_error('You must be an administrator to view this page.');
            redirect('auth/block');
        } else {
            $data['title'] = 'Menu';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $this->load->view('template/head', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('backend/menu/index', $data, FALSE);
        }
    }

    public function load_data()
    {
        $data =  $this->m_menu->get_menu();
        echo json_encode($data);
    }

    public function tambah()
    {
        $data = [
            'menu' => $this->input->post('menu')
        ];
        $this->m_menu->tambah_menu($data);
    }

    public function update()
    {
        $data = [
            $this->input->post('table_column') => $this->input->post('value')
        ];
        $this->m_menu->update_menu($data, $this->input->post('id'));
    }

    public function delete()
    {
        $this->m_menu->delete_menu($this->input->post('id'));
    }
}

/* End of file Dashboard.php */
