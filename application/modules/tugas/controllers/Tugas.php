<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tugas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tugas_model');
        $this->load->model('kelas/kelas_model');
        $this->load->model('guru/guru_model');
        $this->load->model('pelajaran/pelajaran_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'tugas/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tugas/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tugas/index.html';
            $config['first_url'] = base_url() . 'tugas/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tugas_model->total_rows($q);
        $tugas = $this->Tugas_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tugas_data' => $tugas,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $data['judul'] = 'Data Tugas';

        $this->load->view('templates/header', $data);
        $this->load->view('tugas/tugas_list', $data);
        $this->load->view('templates/footer', $data);
    }

    public function read($id) 
    {
        $row = $this->Tugas_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_tugas' => $row->id_tugas,
              'id_kelas' => $row->id_kelas,
              'id_guru' => $row->id_guru,
              'id_pelajaran' => $row->id_pelajaran,
              'judul' => $row->judul,
              'deskripsi' => $row->deskripsi,
              'lampiran' => $row->lampiran,
              'tahun_angkatan' => $row->tahun_angkatan,
          );

            $data['judul'] = 'Detail Tugas';

            $this->load->view('templates/header', $data);
            $this->load->view('tugas/tugas_read', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('tugas'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tugas/create_action'),
            'id_tugas' => set_value('id_tugas'),
            'id_kelas' => set_value('id_kelas'),
            'id_guru' => set_value('id_guru'),
            'id_pelajaran' => set_value('id_pelajaran'),
            'judul' => set_value('judul'),
            'deskripsi' => set_value('deskripsi'),
            'lampiran' => set_value('lampiran'),
            'tahun_angkatan' => set_value('tahun_angkatan'),
        );

        $data['judul'] = 'Tambah Tugas';
        $data['pelajaran'] = $this->pelajaran_model->get_all();
        $data['guru'] = $this->guru_model->get_all();
        $data['kelas'] = $this->kelas_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('tugas/tugas_form', $data);
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
              'id_guru' => $this->input->post('id_guru',TRUE),
              'id_pelajaran' => $this->input->post('id_pelajaran',TRUE),
              'judul' => $this->input->post('judul',TRUE),
              'deskripsi' => $this->input->post('deskripsi',TRUE),
              'lampiran' => $this->input->post('lampiran',TRUE),
              'tahun_angkatan' => $this->input->post('tahun_angkatan',TRUE),
          );

            $this->Tugas_model->insert($data);
            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('tugas'));
        }
    }

    public function update($id) 
    {
        $row = $this->Tugas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tugas/update_action'),
                'id_tugas' => set_value('id_tugas', $row->id_tugas),
                'id_kelas' => set_value('id_kelas', $row->id_kelas),
                'id_guru' => set_value('id_guru', $row->id_guru),
                'id_pelajaran' => set_value('id_pelajaran', $row->id_pelajaran),
                'judul' => set_value('judul', $row->judul),
                'deskripsi' => set_value('deskripsi', $row->deskripsi),
                'lampiran' => set_value('lampiran', $row->lampiran),
                'tahun_angkatan' => set_value('tahun_angkatan', $row->tahun_angkatan),
            );

            $data['judul'] = 'Ubah Tugas';
            $data['pelajaran'] = $this->pelajaran_model->get_all();
            $data['guru'] = $this->guru_model->get_all();
            $data['kelas'] = $this->kelas_model->get_all();

            $this->load->view('templates/header', $data);
            $this->load->view('tugas/tugas_form', $data);
            $this->load->view('templates/footer', $data);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('tugas'));
        }
    }

    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_tugas', TRUE));
        } else {
            $data = array(
              'id_kelas' => $this->input->post('id_kelas',TRUE),
              'id_guru' => $this->input->post('id_guru',TRUE),
              'id_pelajaran' => $this->input->post('id_pelajaran',TRUE),
              'judul' => $this->input->post('judul',TRUE),
              'deskripsi' => $this->input->post('deskripsi',TRUE),
              'lampiran' => $this->input->post('lampiran',TRUE),
              'tahun_angkatan' => $this->input->post('tahun_angkatan',TRUE),
          );

            $this->Tugas_model->update($this->input->post('id_tugas', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('tugas'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Tugas_model->get_by_id($id);

        if ($row) {
            $this->Tugas_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('tugas'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('tugas'));
        }
    }

    public function _rules() 
    {
     $this->form_validation->set_rules('id_kelas', 'id kelas', 'trim|required|numeric');
     $this->form_validation->set_rules('id_guru', 'id guru', 'trim|required|numeric');
     $this->form_validation->set_rules('id_pelajaran', 'id pelajaran', 'trim|required|numeric');
     $this->form_validation->set_rules('judul', 'judul', 'trim|required');
     $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
     $this->form_validation->set_rules('tahun_angkatan', 'tahun angkatan', 'trim|required|numeric');

     $this->form_validation->set_rules('id_tugas', 'id_tugas', 'trim');
     $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
 }

}

/* End of file Tugas.php */
/* Location: ./application/controllers/Tugas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-01 16:05:43 */
                        /* http://harviacode.com */