<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif extends CI_Controller
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
            $data['title'] = 'Analisis Alternatif';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $user_id = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $this->db->order_by('id', 'asc');
            $data['get_alternatif'] = $this->db->get_where('alternatif', ['id_user' => $user_id->id])->result();
            $this->db->order_by('id', 'asc');
            $data['get_alternatif_dua'] = $this->db->get_where('alternatif', ['id_user' => $user_id->id])->result();
            $data['get_frekuensi'] = $this->db->get('nilai_frekuensi')->result();
            $data['get_baris_satu_alternatif'] = $this->db->get_where('baris_satu_alternatif', ['user_id' => $user_id->id])->result();
            $data['get_baris_dua_alternatif'] = $this->db->get_where('baris_dua_alternatif', ['user_id' => $user_id->id])->result();
            $data['get_baris_tiga_alternatif'] = $this->db->get_where('baris_tiga_alternatif', ['user_id' => $user_id->id])->result();
            $data['get_evn_normalisasi_alternatif'] = $this->db->get_where('evn_normalisasi_alternatif', ['user_id' => $user_id->id])->result();
            $data['get_rasio_konsistensi_alternatif'] = $this->db->get_where('rasio_konsistensi_alternatif', ['user_id' => $user_id->id])->result();
            $data['get_total_baris_satu_alternatif'] = $this->db->get_where('baris_satu_alternatif', ['user_id' => $user_id->id])->num_rows();
            $data['get_total_baris_dua_alternatif'] = $this->db->get_where('baris_dua_alternatif', ['user_id' => $user_id->id])->num_rows();
            $data['get_total_baris_tiga_alternatif'] = $this->db->get_where('baris_tiga_alternatif', ['user_id' => $user_id->id])->num_rows();
            $data['get_total_evn_normalisasi_alternatif'] = $this->db->get_where('evn_normalisasi_alternatif', ['user_id' => $user_id->id])->num_rows();
            $data['get_total_rasio_konsistensi_alternatif'] = $this->db->get_where('rasio_konsistensi_alternatif', ['user_id' => $user_id->id])->num_rows();
            $data['sum_baris_dua_alternatif'] = $this->m_data->sum_baris_dua_alternatif($user_id->id);
            $data['sum_baris_satu_alternatif'] = $this->m_data->sum_baris_satu_alternatif($user_id->id);
            $data['sum_baris_tiga_alternatif'] = $this->m_data->sum_baris_tiga_alternatif($user_id->id);

            $this->load->view('template/head', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('backend/analisis/alternatif', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function perbandingan()
    {
        $this->form_validation->set_rules('nilai_kriteria', 'nilai kriteria', 'trim');

        if ($this->form_validation->run() == FALSE) {
            redirect('backend/alternatif', 'refresh');
        } else {
            $data = [
                'id_alternatif' => $this->input->post('id_alternatif'),
                'id_alternatif_dua' => $this->input->post('id_alternatif_dua'),
                'nilai_alternatif' => $this->input->post('nilai_alternatif'),
                'id_user' => $this->input->post('id_user')
            ];
            $this->db->insert('perbandingan_dua', $data);
            redirect('backend/alternatif', 'refresh');
        }
    }

    public function tambah_baris_satu_alternatif()
    {
        $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_dua', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_tiga', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_empat', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_lima', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_enam', 'nilai ', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            redirect('backend/alternatif', 'refresh');
        } else {
            $nilai_satu = $this->input->post('nilai') * $this->input->post('nilai_dua');
            $nilai_dua = $this->input->post('nilai_tiga') * $this->input->post('nilai_empat');
            $nilai_tiga = $this->input->post('nilai_lima') * $this->input->post('nilai_enam');
            $jumlah = $nilai_satu + $nilai_dua + $nilai_tiga;

            $data  = [
                'nilai' => $nilai_satu,
                'nilai_dua' => $nilai_dua,
                'nilai_tiga' => $nilai_tiga,
                'jumlah' => $jumlah,
                'user_id' => $this->input->post('user_id')

            ];
            $this->db->insert('baris_satu_alternatif', $data);
            redirect('backend/alternatif', 'refresh');
        }
    }

    public function tambah_baris_dua_alternatif()
    {
        $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_dua', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_tiga', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_empat', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_lima', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_enam', 'nilai ', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            redirect('backend/alternatif', 'refresh');
        } else {
            $nilai_satu = $this->input->post('nilai') * $this->input->post('nilai_dua');
            $nilai_dua = $this->input->post('nilai_tiga') * $this->input->post('nilai_empat');
            $nilai_tiga = $this->input->post('nilai_lima') * $this->input->post('nilai_enam');
            $jumlah = $nilai_satu + $nilai_dua + $nilai_tiga;

            $data  = [
                'nilai' => $nilai_satu,
                'nilai_dua' => $nilai_dua,
                'nilai_tiga' => $nilai_tiga,
                'jumlah' => $jumlah,
                'user_id' => $this->input->post('user_id')

            ];
            $this->db->insert('baris_dua_alternatif', $data);
            redirect('backend/alternatif', 'refresh');
        }
    }

    public function tambah_baris_tiga_alternatif()
    {
        $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_dua', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_tiga', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_empat', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_lima', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_enam', 'nilai ', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            redirect('backend/alternatif', 'refresh');
        } else {
            $nilai_satu = $this->input->post('nilai') * $this->input->post('nilai_dua');
            $nilai_dua = $this->input->post('nilai_tiga') * $this->input->post('nilai_empat');
            $nilai_tiga = $this->input->post('nilai_lima') * $this->input->post('nilai_enam');
            $jumlah = $nilai_satu + $nilai_dua + $nilai_tiga;

            $data  = [
                'nilai' => $nilai_satu,
                'nilai_dua' => $nilai_dua,
                'nilai_tiga' => $nilai_tiga,
                'jumlah' => $jumlah,
                'user_id' => $this->input->post('user_id')

            ];
            $this->db->insert('baris_tiga_alternatif', $data);
            redirect('backend/alternatif', 'refresh');
        }
    }

    public function kirim_nilai_alternatif()
    {
        $this->form_validation->set_rules('nilai_satu', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_dua', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_tiga', 'nilai ', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            redirect('backend/alternatif', 'refresh');
        } else {
            $nilai_satu = $this->input->post('nilai_satu');
            $nilai_dua =  $this->input->post('nilai_dua');
            $nilai_tiga = $this->input->post('nilai_tiga');
            $jumlah = $nilai_satu + $nilai_dua + $nilai_tiga;

            $user_id = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $total_baris =  $this->m_data->sum_baris_satu_alternatif($user_id->id) + $this->m_data->sum_baris_dua_alternatif($user_id->id) + $this->m_data->sum_baris_tiga_alternatif($user_id->id);

            $data  = [
                'nilai' => $nilai_satu,
                'nilai_dua' => $nilai_dua,
                'nilai_tiga' => $nilai_tiga,
                'total' => $jumlah,
                'evn' => $jumlah / $total_baris,
                'user_id' => $this->input->post('user_id')

            ];
            $this->db->insert('evn_normalisasi_alternatif', $data);
            redirect('backend/alternatif', 'refresh');
        }
    }

    public function kirim_nilai_rasio_alternatif()
    {
        $this->form_validation->set_rules('nilai_satu', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_dua', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_tiga', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_empat', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_lima', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_enam', 'nilai ', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            redirect('backend/alternatif', 'refresh');
        } else {
            $nilai_satu = $this->input->post('nilai_satu');
            $nilai_dua =  $this->input->post('nilai_dua');
            $nilai_tiga = $this->input->post('nilai_tiga');
            $nilai_empat = $this->input->post('nilai_empat');
            $nilai_lima = $this->input->post('nilai_lima');
            $nilai_enam = $this->input->post('nilai_enam');
            $jumlah = ($nilai_satu * $nilai_dua) + ($nilai_tiga * $nilai_empat) + ($nilai_lima * $nilai_enam);
            $ci =  ($jumlah - 3) / 2;
            $cr = $ci / 0.58;

            $data  = [
                'emaks' => $jumlah,
                'ci' => $ci,
                'cr' => $cr,
                'user_id' => $this->input->post('user_id')

            ];
            $this->db->insert('rasio_konsistensi_alternatif', $data);
            redirect('backend/alternatif', 'refresh');
        }
    }

    public function delete_baris_satu_alternatif($id)
    {
        $this->db->delete('baris_satu_alternatif', ['id' => $id]);
        redirect('backend/alternatif', 'refresh');
    }

    public function delete_baris_dua_alternatif($id)
    {
        $this->db->delete('baris_dua_alternatif', ['id' => $id]);
        redirect('backend/alternatif', 'refresh');
    }

    public function delete_baris_tiga_alternatif($id)
    {
        $this->db->delete('baris_tiga_alternatif', ['id' => $id]);
        redirect('backend/alternatif', 'refresh');
    }

    public function delete_evn_normalisasi_alternatif($id)
    {
        $this->db->delete('evn_normalisasi_alternatif', ['id' => $id]);
        redirect('backend/alternatif', 'refresh');
    }

    public function delete_rasio_konsistensi_alternatif($id)
    {
        $this->db->delete('rasio_konsistensi_alternatif', ['id' => $id]);
        redirect('backend/alternatif', 'refresh');
    }

    public function hapus_all()
    {
        $id = $_POST['id'];
        $this->m_data->delete_all_perbandingan_alternatif($id);
        redirect('backend/alternatif');
    }
}

/* End of file Alternatif.php */
