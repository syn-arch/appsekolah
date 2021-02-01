<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('kelas/kelas_model');
        $this->load->model('jurusan/jurusan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'siswa/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'siswa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'siswa/index.html';
            $config['first_url'] = base_url() . 'siswa/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Siswa_model->total_rows($q);
        $siswa = $this->Siswa_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'siswa_data' => $siswa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $data['judul'] = 'Data Siswa';

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/siswa_list', $data);
        $this->load->view('templates/footer', $data);
    }

    public function read($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_siswa' => $row->id_siswa,
              'nama_kelas' => $row->nama_kelas,
              'nama_jurusan' => $row->nama_jurusan,
              'nama_siswa' => $row->nama_siswa,
              'nis' => $row->nis,
              'alamat' => $row->alamat,
              'no_telepon' => $row->no_telepon,
              'email' => $row->email,
              'tahun_angkatan' => $row->tahun_angkatan,
          );

            $data['judul'] = 'Detail Siswa';

            $this->load->view('templates/header', $data);
            $this->load->view('siswa/siswa_read', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('siswa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('siswa/create_action'),
            'id_siswa' => set_value('id_siswa'),
            'id_kelas' => set_value('id_kelas'),
            'nama_siswa' => set_value('nama_siswa'),
            'nis' => set_value('nis'),
            'alamat' => set_value('alamat'),
            'no_telepon' => set_value('no_telepon'),
            'email' => set_value('email'),
            'tahun_angkatan' => set_value('tahun_angkatan'),
        );

        $data['judul'] = 'Tambah Siswa';
        $data['kelas'] = $this->kelas_model->get_all();
        $data['jurusan'] = $this->jurusan_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/siswa_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'id_kelas' => $this->input->post('id_kelas',TRUE),
              'nama_siswa' => $this->input->post('nama_siswa',TRUE),
              'nis' => $this->input->post('nis',TRUE),
              'alamat' => $this->input->post('alamat',TRUE),
              'no_telepon' => $this->input->post('no_telepon',TRUE),
              'email' => $this->input->post('email',TRUE),
              'tahun_angkatan' => $this->input->post('tahun_angkatan',TRUE),
          );

            $this->Siswa_model->insert($data);
            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('siswa'));
        }
    }

    public function update($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('siswa/update_action'),
                'id_siswa' => set_value('id_siswa', $row->id_siswa),
                'id_kelas' => set_value('id_kelas', $row->id_kelas),
                'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
                'nis' => set_value('nis', $row->nis),
                'alamat' => set_value('alamat', $row->alamat),
                'no_telepon' => set_value('no_telepon', $row->no_telepon),
                'email' => set_value('email', $row->email),
                'tahun_angkatan' => set_value('tahun_angkatan', $row->tahun_angkatan),
            );

            $data['judul'] = 'Ubah Siswa';
            $data['kelas'] = $this->kelas_model->get_all();
            $data['jurusan'] = $this->jurusan_model->get_all();

            $this->load->view('templates/header', $data);
            $this->load->view('siswa/siswa_form', $data);
            $this->load->view('templates/footer', $data);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('siswa'));
        }
    }

    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_siswa', TRUE));
        } else {
            $data = array(
              'id_kelas' => $this->input->post('id_kelas',TRUE),
              'nama_siswa' => $this->input->post('nama_siswa',TRUE),
              'nis' => $this->input->post('nis',TRUE),
              'alamat' => $this->input->post('alamat',TRUE),
              'no_telepon' => $this->input->post('no_telepon',TRUE),
              'email' => $this->input->post('email',TRUE),
              'tahun_angkatan' => $this->input->post('tahun_angkatan',TRUE),
          );

            $this->Siswa_model->update($this->input->post('id_siswa', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('siswa'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);

        if ($row) {
            $this->Siswa_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('siswa'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('siswa'));
        }
    }

    public function _rules() 
    {
     $this->form_validation->set_rules('id_kelas', 'id kelas', 'trim|required|numeric');
     $this->form_validation->set_rules('nama_siswa', 'nama siswa', 'trim|required');
     $this->form_validation->set_rules('nis', 'nis', 'trim|required');
     $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
     $this->form_validation->set_rules('no_telepon', 'no telepon', 'trim|required');
     $this->form_validation->set_rules('email', 'email', 'trim|required');
     $this->form_validation->set_rules('tahun_angkatan', 'tahun angkatan', 'trim|required|numeric');

     $this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim');
     $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
 }

}

/* End of file Siswa.php */
/* Location: ./application/controllers/Siswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-01 16:05:15 */
                        /* http://harviacode.com */