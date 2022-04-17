<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_data');
    }

    public function index()
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $group_id = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else if (!$group_id->group_id) {
            redirect('auth/logout');
        } else {
            $data['title'] = 'Data Kriteria';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $user_id = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_kriteria'] = $this->db->get_where('kriteria', ['id_user' => $user_id->id])->result();
            $data['total_kriteria'] = $this->db->get_where('kriteria', ['id_user' => $user_id->id])->num_rows();

            $ip = $this->input->ip_address();
            $date = date("Y-m-d");
            $waktu = time();
            $timeinsert = date("Y-m-d H:i:s");

            // cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
            $cek_ip = $this->db->query("SELECT * FROM tb_visitor WHERE ip='" . $ip . "' AND date='" . $date . "'")->num_rows();
            $cek_user_ip = isset($cek_ip) ? ($cek_ip) : 0;

            // kalau belum ada, simpan data user tersebut ke database
            if ($cek_user_ip == 0) {
                $this->db->query("INSERT INTO tb_visitor(ip, date, hits, online, time) VALUES('" . $ip . "','" . $date . "','1','" . $waktu . "','" . $timeinsert . "')");
            } else { //jika sudah ada, update
                $this->db->query("UPDATE tb_visitor SET hits=hits+1, online='" . $waktu . "' WHERE ip='" . $ip . "' AND date='" . $date . "'");
            }

            $this->load->view('template/head', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('backend/data/kriteria', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function tambah_kriteria()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('kriteria_id', 'ID kriteria', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata(
                'error',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>Gagal menginput data!</div>'
            );
            redirect('backend/data', 'refresh');
        } else {
            $data = [
                'kriteria_id' => $this->input->post('kriteria_id'),
                'nama' => $this->input->post('nama'),
                'id_user' => $this->input->post('id_user')
            ];
            $this->db->insert('kriteria', $data);
            $this->session->set_flashdata(
                'success',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>Data kriteria berhasil dibuat</div>'
            );
            redirect('backend/data', 'refresh');
        }
    }

    public function edit_kriteria()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata(
                'error',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>Gagal menginput data!</div>'
            );
            redirect('backend/data', 'refresh');
        } else {
            $id = $this->input->post('id');

            $data = [
                'nama' => $this->input->post('nama'),
                'id_user' => $this->input->post('id_user')
            ];

            $this->db->where('id', $id);
            $this->db->update('kriteria', $data);
            $this->session->set_flashdata(
                'success',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>Data kriteria berhasil dibuat</div>'
            );
            redirect('backend/data', 'refresh');
        }
    }

    public function hapus_kriteria($id)
    {
        $this->db->delete('kriteria', ['id' => $id]);
        $this->session->set_flashdata(
            'success',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>Data kriteria berhasil dihapus</div>'
        );
        redirect('backend/data', 'refresh');
    }

    public function alternatif()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $data['title'] = 'Data Alternatif';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $user_id = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_alternatif'] = $this->db->get_where('alternatif', ['id_user' => $user_id->id])->result();
            $data['total_alternatif'] = $this->db->get_where('alternatif', ['id_user' => $user_id->id])->num_rows();
            $this->load->view('template/head', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('backend/data/alternatif', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function tambah_alternatif()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('alternatif_id', 'ID alternatif', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata(
                'error',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>Gagal menginput data!</div>'
            );
            redirect('backend/data/alternatif', 'refresh');
        } else {
            $data = [
                'alternatif_id' => $this->input->post('alternatif_id'),
                'nama' => $this->input->post('nama'),
                'id_user' => $this->input->post('id_user')
            ];
            $this->db->insert('alternatif', $data);
            $this->session->set_flashdata(
                'success',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>Data alternatif berhasil dibuat</div>'
            );
            redirect('backend/data/alternatif', 'refresh');
        }
    }

    public function edit_alternatif()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata(
                'error',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>Gagal menginput data!</div>'
            );
            redirect('backend/data/alternatif', 'refresh');
        } else {
            $id = $this->input->post('id');

            $data = [
                'nama' => $this->input->post('nama'),
                'id_user' => $this->input->post('id_user')
            ];

            $this->db->where('id', $id);
            $this->db->update('alternatif', $data);
            $this->session->set_flashdata(
                'success',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>Data alternatif berhasil dibuat</div>'
            );
            redirect('backend/data/alternatif', 'refresh');
        }
    }

    public function hapus_alternatif($id)
    {
        $this->db->delete('alternatif', ['id' => $id]);
        $this->session->set_flashdata(
            'success',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>Data alternatif berhasil dihapus</div>'
        );
        redirect('backend/data/alternatif', 'refresh');
    }
}

/* End of file Jenis_bibit.php */
