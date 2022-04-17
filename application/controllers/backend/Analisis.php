<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Analisis extends CI_Controller
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
            $data['title'] = 'Analisis Kriteria';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $user_id = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $this->db->order_by('id', 'asc');
            $data['get_kriteria'] = $this->db->get_where('kriteria', ['id_user' => $user_id->id])->result();
            $this->db->order_by('id', 'desc');
            $data['get_kriteria_dua'] = $this->db->get_where('kriteria', ['id_user' => $user_id->id])->result();
            $data['get_frekuensi'] = $this->db->get('nilai_frekuensi')->result();
            $data['get_baris_satu'] = $this->db->get_where('baris_satu', ['user_id' => $user_id->id])->result();
            $data['get_baris_dua'] = $this->db->get_where('baris_dua', ['user_id' => $user_id->id])->result();
            $data['get_baris_tiga'] = $this->db->get_where('baris_tiga', ['user_id' => $user_id->id])->result();
            $data['get_evn_normalisasi'] = $this->db->get_where('evn_normalisasi', ['user_id' => $user_id->id])->result();
            $data['get_rasio_konsistensi'] = $this->db->get_where('rasio_konsistensi', ['user_id' => $user_id->id])->result();
            $data['get_total_baris_satu'] = $this->db->get_where('baris_satu', ['user_id' => $user_id->id])->num_rows();
            $data['get_total_baris_dua'] = $this->db->get_where('baris_dua', ['user_id' => $user_id->id])->num_rows();
            $data['get_total_baris_tiga'] = $this->db->get_where('baris_tiga', ['user_id' => $user_id->id])->num_rows();
            $data['get_total_evn_normalisasi'] = $this->db->get_where('evn_normalisasi', ['user_id' => $user_id->id])->num_rows();
            $data['get_total_rasio_konsistensi'] = $this->db->get_where('rasio_konsistensi', ['user_id' => $user_id->id])->num_rows();
            $data['sum_baris_dua'] = $this->m_data->sum_baris_dua($user_id->id);
            $data['sum_baris_satu'] = $this->m_data->sum_baris_satu($user_id->id);
            $data['sum_baris_tiga'] = $this->m_data->sum_baris_tiga($user_id->id);

            $this->load->view('template/head', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('backend/analisis/kriteria', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function perbandingan()
    {
        $this->form_validation->set_rules('nilai_kriteria', 'nilai kriteria', 'trim');

        if ($this->form_validation->run() == FALSE) {
            redirect('backend/analisis', 'refresh');
        } else {
            $data = [
                'id_kriteria' => $this->input->post('id_kriteria'),
                'id_kriteria_dua' => $this->input->post('id_kriteria_dua'),
                'nilai_kriteria' => $this->input->post('nilai_kriteria'),
                'id_user' => $this->input->post('id_user')
            ];
            $this->db->insert('perbandingan', $data);
            redirect('backend/analisis', 'refresh');
        }
    }

    public function tambah_baris_satu()
    {
        $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_dua', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_tiga', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_empat', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_lima', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_enam', 'nilai ', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            redirect('backend/analisis', 'refresh');
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
            $this->db->insert('baris_satu', $data);
            redirect('backend/analisis', 'refresh');
        }
    }

    public function tambah_baris_dua()
    {
        $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_dua', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_tiga', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_empat', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_lima', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_enam', 'nilai ', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            redirect('backend/analisis', 'refresh');
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
            $this->db->insert('baris_dua', $data);
            redirect('backend/analisis', 'refresh');
        }
    }

    public function tambah_baris_tiga()
    {
        $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_dua', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_tiga', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_empat', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_lima', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_enam', 'nilai ', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            redirect('backend/analisis', 'refresh');
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
            $this->db->insert('baris_tiga', $data);
            redirect('backend/analisis', 'refresh');
        }
    }

    public function kirim_nilai()
    {
        $this->form_validation->set_rules('nilai_satu', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_dua', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_tiga', 'nilai ', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            redirect('backend/analisis', 'refresh');
        } else {
            $nilai_satu = $this->input->post('nilai_satu');
            $nilai_dua =  $this->input->post('nilai_dua');
            $nilai_tiga = $this->input->post('nilai_tiga');
            $jumlah = $nilai_satu + $nilai_dua + $nilai_tiga;
            $user_id = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $total_baris =  $this->m_data->sum_baris_satu($user_id->id) + $this->m_data->sum_baris_dua($user_id->id) + $this->m_data->sum_baris_tiga($user_id->id);

            $data  = [
                'nilai' => $nilai_satu,
                'nilai_dua' => $nilai_dua,
                'nilai_tiga' => $nilai_tiga,
                'total' => $jumlah,
                'evn' => $jumlah / $total_baris,
                'user_id' => $this->input->post('user_id')
            ];
            $this->db->insert('evn_normalisasi', $data);
            redirect('backend/analisis', 'refresh');
        }
    }

    public function kirim_nilai_rasio()
    {
        $this->form_validation->set_rules('nilai_satu', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_dua', 'nilai', 'trim|required');
        $this->form_validation->set_rules('nilai_tiga', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_empat', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_lima', 'nilai ', 'trim|required');
        $this->form_validation->set_rules('nilai_enam', 'nilai ', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            redirect('backend/analisis', 'refresh');
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
            $this->db->insert('rasio_konsistensi', $data);
            redirect('backend/analisis', 'refresh');
        }
    }

    public function delete_baris_satu($id)
    {
        $this->db->delete('baris_satu', ['id' => $id]);
        redirect('backend/analisis', 'refresh');
    }

    public function delete_baris_dua($id)
    {
        $this->db->delete('baris_dua', ['id' => $id]);
        redirect('backend/analisis', 'refresh');
    }

    public function delete_baris_tiga($id)
    {
        $this->db->delete('baris_tiga', ['id' => $id]);
        redirect('backend/analisis', 'refresh');
    }

    public function delete_evn_normalisasi($id)
    {
        $this->db->delete('evn_normalisasi', ['id' => $id]);
        redirect('backend/analisis', 'refresh');
    }

    public function delete_rasio_konsistensi($id)
    {
        $this->db->delete('rasio_konsistensi', ['id' => $id]);
        redirect('backend/analisis', 'refresh');
    }

    public function hapus_all()
    {
        $id = $_POST['id'];
        $this->m_data->delete_all_perbandingan_karakter($id);
        redirect('backend/analisis');
    }
}

/* End of file Analisis.php */
