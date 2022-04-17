<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_mangrove extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_mangrove');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $data['title'] = 'Jenis Mangrove';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_mangrove'] = $this->db->get('jenis_mangrove')->result();
            $this->load->view('template/head', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('backend/data/jenis_mangrove', $data, FALSE);
        }
    }

    public function load_data()
    {
        $data =  $this->m_mangrove->get_mangrove();
        echo json_encode($data);
    }

    public function tambah()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'keterangan' => $this->input->post('keterangan')
        ];
        $this->m_mangrove->tambah($data);
    }

    public function update()
    {
        $data = [
            $this->input->post('table_column') => $this->input->post('value')
        ];
        $this->m_mangrove->update($data, $this->input->post('id'));
    }

    public function delete()
    {
        $this->m_mangrove->delete($this->input->post('id'));
    }
}

/* End of file Jenis_mangrove.php */
