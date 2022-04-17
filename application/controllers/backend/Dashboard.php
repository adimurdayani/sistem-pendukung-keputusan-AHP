<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            redirect('auth/login');
        } else {
            $data['title'] = 'Dashboard';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $date = date("Y-m-d");

            // jumlah pengujung sekarang
            $this->db->group_by('ip');
            $pengunjung_hariini = $this->db->get_where('tb_visitor', ['date' => $date])->num_rows();
            $db_pengunjung = $this->db->query("SELECT COUNT(hits) as hits FROM tb_visitor")->row();

            // total pengunjung
            $total_pengunjung = isset($db_pengunjung->hits) ? ($db_pengunjung->hits) : 0;
            $batas_waktu = time() - 300;

            // jumlah pengujung online
            $pengunjung_online = $this->db->query("SELECT * FROM tb_visitor WHERE online > '" . $batas_waktu . "'")->num_rows();

            $data['pengunjung_hariini'] = $pengunjung_hariini;
            $data['total_pengunjung'] = $total_pengunjung;
            $data['pengunjung_online'] = $pengunjung_online;
            $data['total_menu'] = $this->db->get('user_menu')->num_rows();

            $this->load->view('template/head', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('backend/dashboard', $data, FALSE);
        }
    }
}

/* End of file Dashboard.php */
