<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_tanah extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_tanah');
    }


    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $data['title'] = 'Jenis Tanah';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_tanah'] = $this->db->get('jenis_tanah')->result();

            $this->load->view('template/head', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('backend/data/jenis_tanah', $data, FALSE);
        }
    }

    public function load_data()
    {
        $data =  $this->m_tanah->get_tanah();
        echo json_encode($data);
    }

    public function tambah()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'keterangan' => $this->input->post('keterangan')
        ];
        $this->m_tanah->tambah($data);
    }

    public function update()
    {
        $data = [
            $this->input->post('table_column') => $this->input->post('value')
        ];
        $this->m_tanah->update($data, $this->input->post('id'));
    }

    public function delete()
    {
        $this->m_tanah->delete($this->input->post('id'));
    }
}

/* End of file Jenis_tanah.php */
