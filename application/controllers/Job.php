<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Job extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
            exit;
        }


        $this->load->model('job_model', 'vech');
    }
    
    public function index()
    {
        $head['title'] = "Manage Job Karoseri";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        //$this->load->view('fixed/header-produksi', $head);
        $this->load->view('job/index');
        $this->load->view('fixed/footer');
    }
    
    public function create()
    {
        if ($this->input->post('name') != null && $this->input->post('name') != "" ) {
            $name = $this->input->post('name', true);
            $this->vech->add($name);          
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    
    public function update()
    {
        if ($this->input->post('name') != null && $this->input->post('name') != "" ) {
            $id = $this->input->post('editid');
            $name = $this->input->post('name', true);
            $this->vech->update($id,$name);          
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    public function ajax_list() {
        $list = $this->vech->get_datatables();
        $data = array();
        foreach ($list as $prd) {
            $row = array();
            $row[] = $prd->name;
            $row[] = '<a href="#" data-object-id="' . $prd->id . '"  data-object-name="' . $prd->name . '" class="btn btn-success btn-sm edit-object"><span class="fa fa-edit"></span></a> 
            <a href="#" data-object-id="' . $prd->id . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-minus"></span></a>';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->vech->count_all(),
            "recordsFiltered" => $this->vech->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    
    public function delete_i() {
        if ($this->aauth->premission(11)) {
            $id = $this->input->post('deleteid');
           
            $this->db->delete('smartpos_job', array('id' => $id));
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));

        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }
}