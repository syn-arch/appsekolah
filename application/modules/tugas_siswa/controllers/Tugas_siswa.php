<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tugas_siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tugas_siswa_model');
        $this->load->model('siswa/siswa_model');
        $this->load->model('tugas/tugas_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'tugas_siswa/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tugas_siswa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tugas_siswa/index.html';
            $config['first_url'] = base_url() . 'tugas_siswa/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tugas_siswa_model->total_rows($q);
        $tugas_siswa = $this->Tugas_siswa_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tugas_siswa_data' => $tugas_siswa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $data['judul'] = 'Pengumpulan Tugas';

        $this->load->view('templates/header', $data);
        $this->load->view('tugas_siswa/tugas_siswa_list', $data);
        $this->load->view('templates/footer', $data);
    }

    public function read($id) 
    {
        $row = $this->Tugas_siswa_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_tugas_siswa' => $row->id_tugas_siswa,
              'nama_siswa' => $row->nama_siswa,
              'judul' => $row->judul,
              'deskripsi' => $row->deskripsi,
              'lampiran' => $row->lampiran,
          );

            $data['judul'] = 'Detail Tugas_siswa';

            $this->load->view('templates/header', $data);
            $this->load->view('tugas_siswa/tugas_siswa_read', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('tugas_siswa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tugas_siswa/create_action'),
            'id_tugas_siswa' => set_value('id_tugas_siswa'),
            'id_siswa' => set_value('id_siswa'),
            'id_tugas' => set_value('id_tugas'),
            'deskripsi' => set_value('deskripsi'),
            'lampiran' => set_value('lampiran'),
        );

        $data['judul'] = 'Tambah Tugas_siswa';
        $data['siswa'] = $this->siswa_model->get_all();
        $data['tugas'] = $this->tugas_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('tugas_siswa/tugas_siswa_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'id_siswa' => $this->input->post('id_siswa',TRUE),
              'id_tugas' => $this->input->post('id_tugas',TRUE),
              'deskripsi' => $this->input->post('deskripsi',TRUE),
              'lampiran' => $this->input->post('lampiran',TRUE),
          );

            $this->Tugas_siswa_model->insert($data);
            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('tugas_siswa'));
        }
    }

    public function update($id) 
    {
        $row = $this->Tugas_siswa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tugas_siswa/update_action'),
                'id_tugas_siswa' => set_value('id_tugas_siswa', $row->id_tugas_siswa),
                'id_siswa' => set_value('id_siswa', $row->id_siswa),
                'id_tugas' => set_value('id_tugas', $row->id_tugas),
                'deskripsi' => set_value('deskripsi', $row->deskripsi),
                'lampiran' => set_value('lampiran', $row->lampiran),
            );

            $data['judul'] = 'Ubah Tugas_siswa';
            $data['siswa'] = $this->siswa_model->get_all();
            $data['tugas'] = $this->tugas_model->get_all();

            $this->load->view('templates/header', $data);
            $this->load->view('tugas_siswa/tugas_siswa_form', $data);
            $this->load->view('templates/footer', $data);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('tugas_siswa'));
        }
    }

    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_tugas_siswa', TRUE));
        } else {
            $data = array(
              'id_siswa' => $this->input->post('id_siswa',TRUE),
              'id_tugas' => $this->input->post('id_tugas',TRUE),
              'deskripsi' => $this->input->post('deskripsi',TRUE),
              'lampiran' => $this->input->post('lampiran',TRUE),
          );

            $this->Tugas_siswa_model->update($this->input->post('id_tugas_siswa', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('tugas_siswa'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Tugas_siswa_model->get_by_id($id);

        if ($row) {
            $this->Tugas_siswa_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('tugas_siswa'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('tugas_siswa'));
        }
    }

    public function _rules() 
    {
     $this->form_validation->set_rules('id_siswa', 'id siswa', 'trim|required|numeric');
     $this->form_validation->set_rules('id_tugas', 'id tugas', 'trim|required|numeric');
     $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');

     $this->form_validation->set_rules('id_tugas_siswa', 'id_tugas_siswa', 'trim');
     $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
 }

}

/* End of file Tugas_siswa.php */
/* Location: ./application/controllers/Tugas_siswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-01 16:07:00 */
                        /* http://harviacode.com */