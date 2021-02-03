<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Absen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Absen_model');
        $this->load->model('siswa/siswa_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'absen/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'absen/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'absen/index.html';
            $config['first_url'] = base_url() . 'absen/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Absen_model->total_rows($q);
        $absen = $this->Absen_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'absen_data' => $absen,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $data['judul'] = 'Data Absen';

        $this->load->view('templates/header', $data);
        $this->load->view('absen/absen_list', $data);
        $this->load->view('templates/footer', $data);
    }

    public function read($id) 
    {
        $row = $this->Absen_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_absen' => $row->id_absen,
              'nama_siswa' => $row->nama_siswa,
              'tgl' => $row->tgl,
              'status' => $row->status,
              'lampiran' => $row->lampiran,
          );

            $data['judul'] = 'Detail Absen';

            $this->load->view('templates/header', $data);
            $this->load->view('absen/absen_read', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('absen'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('absen/create_action'),
            'id_absen' => set_value('id_absen'),
            'id_siswa' => set_value('id_siswa'),
            'tgl' => date('Y-m-d\TH:i:s'),
            'status' => set_value('status'),
            'lampiran' => set_value('lampiran'),
        );

        $data['judul'] = 'Tambah Absen';
        $data['siswa'] = $this->siswa_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('absen/absen_form', $data);
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
              'tgl' => $this->input->post('tgl',TRUE),
              'status' => $this->input->post('status',TRUE),
              'lampiran' => $this->input->post('lampiran',TRUE),
              'lampiran' => uploadFile('lampiran', 'absen/create')
          );

            $this->Absen_model->insert($data);
            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('absen'));
        }
    }

    public function update($id) 
    {
        $row = $this->Absen_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('absen/update_action'),
                'id_absen' => set_value('id_absen', $row->id_absen),
                'id_siswa' => set_value('id_siswa', $row->id_siswa),
                'tgl' => set_value('tgl', date('Y-m-d\TH:i:s', strtotime($row->tgl))),
                'status' => set_value('status', $row->status),
                'lampiran' => set_value('lampiran', $row->lampiran),
            );

            $data['judul'] = 'Ubah Absen';
            $data['siswa'] = $this->siswa_model->get_all();

            $this->load->view('templates/header', $data);
            $this->load->view('absen/absen_form', $data);
            $this->load->view('templates/footer', $data);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('absen'));
        }
    }

    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_absen', TRUE));
        } else {
            $data = array(
              'id_siswa' => $this->input->post('id_siswa',TRUE),
              'tgl' => $this->input->post('tgl',TRUE),
              'status' => $this->input->post('status',TRUE),
              'lampiran' => uploadFile('lampiran', 'absen/create')
          );

            $this->Absen_model->update($this->input->post('id_absen', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('absen'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Absen_model->get_by_id($id);

        if ($row) {
            $this->Absen_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('absen'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('absen'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('id_siswa', 'id siswa', 'trim|required|numeric');
       $this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
       $this->form_validation->set_rules('status', 'status', 'trim|required');

       $this->form_validation->set_rules('id_absen', 'id_absen', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

}

/* End of file Absen.php */
/* Location: ./application/controllers/Absen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-03 16:30:38 */
                        /* http://harviacode.com */