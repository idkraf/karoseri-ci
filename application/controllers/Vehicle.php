<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vehicle extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
            exit;
        }
        $this->load->model('vehicle_model', 'vech');
    }
    
    public function index()
    {
        $head['title'] = "Manage Vehicle";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        //$this->load->view('fixed/header-produksi', $head);
        $this->load->view('vehicle/index');
        $this->load->view('fixed/footer');
    }
    
    public function create()
    {
        if ($this->input->post('name') != null && $this->input->post('name') != "" ) {
            $code = $this->input->post('code', true);
            $name = $this->input->post('name', true);
            $police = $this->input->post('police', true);
            $body = $this->input->post('body', true);
            $machine = $this->input->post('machine', true);
            $colour = $this->input->post('colour', true);
            $year = $this->input->post('year', true);
            $notes = $this->input->post('notes', true);
            $this->vech->add($code, $name, $police, $body, $machine, $colour, $year, $notes);         
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    public function update()
    {
        if ($this->input->post('editid') != null && $this->input->post('editid') != "" ) {
            $id = $this->input->post('editid');
            $code = $this->input->post('code', true);
            $name = $this->input->post('name', true);
            $police = $this->input->post('police', true);
            $body = $this->input->post('body', true);
            $machine = $this->input->post('machine', true);
            $colour = $this->input->post('colour', true);
            $year = $this->input->post('year', true);
            $notes = $this->input->post('notes', true);
            $this->vech->update($id, $code, $name, $police, $body, $machine, $colour, $year, $notes);
                    
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    
    public function ajax_list() {
        $list = $this->vech->get_datatables();
        $data = array();
        foreach ($list as $prd) {
            $row = array();
            $row[] = $prd->code;
            $row[] = $prd->name;
            $row[] = $prd->police;
            $row[] = $prd->body;
            $row[] = $prd->machine;
            $row[] = $prd->colour;
            $row[] = $prd->year;
            $row[] = '<a href="#" 
            data-object-id="' . $prd->id . '" 
            data-object-code="' . $prd->code . '" 
            data-object-name="' . $prd->name . '" 
            data-object-police="' . $prd->police . '" 
            data-object-body="' . $prd->body . '" 
            data-object-machine="' . $prd->machine . '"
            data-object-colour="' . $prd->colour . '" 
            data-object-year="' . $prd->year . '"  
            data-object-notes="' . $prd->notes . '"  
            class="btn btn-success btn-sm edit-object"><span class="icon-pencil"></span></a> 
            <a href="#" data-object-id="' . $prd->id . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
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

    public function ajax_modal_list() {
        $list = $this->vech->get_datatables();
        $data = array();
        foreach ($list as $prd) {
            $row = array();
            $row[] = '<button 
            data-object-vid="' . $prd->id . '" 
            data-object-vcode="' . $prd->code . '"
            data-object-vname="' . $prd->name . '" 
            data-object-vpolice="' . $prd->police . '" 
            data-toggle="modal" data-target="#dataVehicle" data-dismiss="modal"
            class="btn btn-success btn-sm pilih-vehicle"><span class="icon-share-alt"></span></button>';
            $row[] = $prd->code;
            $row[] = $prd->name;
            $row[] = $prd->police;
            $row[] = $prd->body;
            $row[] = $prd->machine;
            $row[] = $prd->colour;
            $row[] = $prd->year;
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
}