<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Materi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Materi_model');
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
            $config['base_url'] = base_url() . 'materi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'materi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'materi/index.html';
            $config['first_url'] = base_url() . 'materi/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Materi_model->total_rows($q);
        $materi = $this->Materi_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'materi_data' => $materi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $data['judul'] = 'Data Materi';

        $this->load->view('templates/header', $data);
        $this->load->view('materi/materi_list', $data);
        $this->load->view('templates/footer', $data);
    }

    public function read($id) 
    {
        $row = $this->Materi_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_materi' => $row->id_materi,
              'nama_kelas' => $row->nama_kelas,
              'nama_guru' => $row->nama_guru,
              'nama_pelajaran' => $row->nama_pelajaran,
              'judul' => $row->judul,
              'deskripsi' => $row->deskripsi,
              'lampiran' => $row->lampiran,
              'tahun_angkatan' => $row->tahun_angkatan,
          );

            $data['judul'] = 'Detail Materi';

            $this->load->view('templates/header', $data);
            $this->load->view('materi/materi_read', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('materi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('materi/create_action'),
            'id_materi' => set_value('id_materi'),
            'id_kelas' => set_value('id_kelas'),
            'id_guru' => set_value('id_guru'),
            'id_pelajaran' => set_value('id_pelajaran'),
            'judul' => set_value('judul'),
            'deskripsi' => set_value('deskripsi'),
            'lampiran' => set_value('lampiran'),
            'tahun_angkatan' => set_value('tahun_angkatan'),
        );

        $data['judul'] = 'Tambah Materi';
        $data['pelajaran'] = $this->pelajaran_model->get_all();
        $data['guru'] = $this->guru_model->get_all();
        $data['kelas'] = $this->kelas_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('materi/materi_form', $data);
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

            $this->Materi_model->insert($data);
            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('materi'));
        }
    }

    public function update($id) 
    {
        $row = $this->Materi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('materi/update_action'),
                'id_materi' => set_value('id_materi', $row->id_materi),
                'id_kelas' => set_value('id_kelas', $row->id_kelas),
                'id_guru' => set_value('id_guru', $row->id_guru),
                'id_pelajaran' => set_value('id_pelajaran', $row->id_pelajaran),
                'judul' => set_value('judul', $row->judul),
                'deskripsi' => set_value('deskripsi', $row->deskripsi),
                'lampiran' => set_value('lampiran', $row->lampiran),
                'tahun_angkatan' => set_value('tahun_angkatan', $row->tahun_angkatan),
            );

            $data['judul'] = 'Ubah Materi';
            $data['pelajaran'] = $this->pelajaran_model->get_all();
            $data['guru'] = $this->guru_model->get_all();
            $data['kelas'] = $this->kelas_model->get_all();

            $this->load->view('templates/header', $data);
            $this->load->view('materi/materi_form', $data);
            $this->load->view('templates/footer', $data);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('materi'));
        }
    }

    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_materi', TRUE));
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

            $this->Materi_model->update($this->input->post('id_materi', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('materi'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Materi_model->get_by_id($id);

        if ($row) {
            $this->Materi_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('materi'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('materi'));
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

       $this->form_validation->set_rules('id_materi', 'id_materi', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

}

/* End of file Materi.php */
/* Location: ./application/controllers/Materi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-01 16:05:37 */
                        /* http://harviacode.com */