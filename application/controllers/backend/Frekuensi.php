<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Frekuensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_data');
        is_logged_in();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $data['title'] = 'Data Nilai Frekuensi';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $this->load->view('template/head', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('backend/frekuensi/index', $data, FALSE);
        }
    }

    public function load_data()
    {
        $data =  $this->m_data->get_frekuensi();
        echo json_encode($data);
    }

    public function tambah()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'nilai' => $this->input->post('nilai')
        ];
        $this->m_data->tambah_frekuensi($data);
    }

    public function update()
    {
        $data = [
            $this->input->post('table_column') => $this->input->post('value')
        ];
        $this->m_data->update_frekuensi($data, $this->input->post('id'));
    }

    public function delete()
    {
        $this->m_data->delete_frekuensi($this->input->post('id'));
    }
}

/* End of file Frekuensi.php */
