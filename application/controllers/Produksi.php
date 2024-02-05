<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produksi extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
            exit;
        }

        $this->load->model('produksi_model', 'prrd');
        $this->load->model('produksi_job_model', 'prrdJob');
        $this->load->model('produksi_item_model', 'prrdItem');
        $this->load->model('produksi_staff_model', 'prrdStaff');
        $this->load->model('data_model', 'dmodel');
    }
    
    public function index()
    {
        $data = array();
        $head['title'] = "Manage Produksi Karoseri";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['jobs'] = $this->dmodel->get('smartpos_job');
        $data['products'] = $this->dmodel->get('smartpos_products');
        $data['staff'] = $this->dmodel->get('smartpos_users');
        $this->load->view('fixed/header', $head);
        //$this->load->view('fixed/header-produksi', $head);
        $this->load->view('produksi/index', $data);
        $this->load->view('fixed/footer');
    }
    
    public function detail()
    {
        if (!$this->input->get()) {
            exit();
        }

        $data = array();
        $data['job_id'] = intval($this->input->get('id'));
        $data['produksi_id'] = intval($this->input->get('pid'));

        $head['title'] = "Service & Produk dalam pekerjaan";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['jobs'] = $this->dmodel->get('smartpos_job');
        $data['products'] = $this->dmodel->get('smartpos_products');
        $data['staff'] = $this->dmodel->get('smartpos_users');
        $this->load->view('fixed/header', $head);
        //$this->load->view('fixed/header-produksi', $head);
        $this->load->view('produksi/detail', $data);
        $this->load->view('fixed/footer');
    }
    
    public function create()
    {       
        $head['title'] = "Buat Produksi baru";
        $head['usernm'] = $this->aauth->get_user()->username;
        //$data['tahun'] = '%Y';
        $this->load->view('fixed/header', $head);
        //$this->load->view('fixed/header-produksi', $head);
        $this->load->view('produksi/create');
        $this->load->view('fixed/footer');
    }

    public function edit()
    {
        $this->load->helper('date');
        $catid = $this->input->get('id');
        $this->db->select('smartpos_produksi.*');        
        $this->db->select('x1.name as cname, x1.phone as ccode');
        $this->db->select('x2.name as vname, x2.code as vcode');
        $this->db->join('smartpos_customers x1', 'x1.id = smartpos_produksi.customer_id');
        $this->db->join('smartpos_vehicle x2', 'x2.id = smartpos_produksi.vehicle_id');

        $this->db->from('smartpos_produksi');
        //$this->db->join('smartpos_vehicle x3', 'x2.id = smartpos_produksi.vehicle_id');
        $this->db->where('smartpos_produksi.id', $catid);
        $query = $this->db->get();
        $data['produksi'] = $query->row_array();       


        $head['title'] = "Buat Produksi baru";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        //$this->load->view('fixed/header-produksi', $head);
        $this->load->view('produksi/edit', $data);
        $this->load->view('fixed/footer');
    }
    public function update()
    {
        if ($this->input->post('produksi_id') != null && $this->input->post('produksi_id') != "" ) {
            $id = $this->input->post('produksi_id');
            $date = $this->input->post('date', true);
            $datedue = $this->input->post('datedue', true);
            $customer_id = $this->input->post('customer_id', true);
            $vehicle_id = $this->input->post('vehicle_id', true);
            $price = $this->input->post('price', true);
            $bbn = $this->input->post('bbn', true);
            $tax = $this->input->post('tax');
            $taxppn = $this->input->post('taxppn');
            $total = $this->input->post('total');
            $this->prrd->update($id, $date, $datedue, $customer_id, $vehicle_id, $price, $bbn, $tax, $taxppn, $total);
                    
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    
    public function delete_job()
    {
        $id = $this->input->post('deleteid');
        if ($this->dmodel->delete('smartpos_produksi_job', 'id', $id)) {
            //set_pesan('data berhasil dihapus.');
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {
            //set_pesan('data gagal dihapus.', false);
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
        //redirect('produksi');
    }
    public function delete_staff()
    {
        $id = $this->input->post('deleteid');
        if ($this->dmodel->delete('smartpos_produksi_staff', 'id', $id)) {
            //set_pesan('data berhasil dihapus.');
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {
            //set_pesan('data gagal dihapus.', false);
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
        //redirect('produksi/detail/'.$getId);
    }

    public function delete_item()
    {
        $id = $this->input->post('deleteid');
        
        $item = $this->dmodel->get('smartpos_produksi_item', ['id' => $id]);
        if($item['qty'] > 0){
            $qty1 = $item['qty'] - $item['indent'];

            $produk = $this->dmodel->get('smartpos_products', ['pid' => $item['product_id']]);
            $qty2 = $produk['qty'];
    
            $qty = $qty1 + $qty2;
            $data = array('qty' => $qty);
            $this->db->set($data);
            $this->db->where('pid', $item['product_id']);
            if($this->db->update('smartpos_products')){
                
                if ($this->dmodel->delete('smartpos_produksi_item', 'id', $id)) {
                    echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
                } else {
                    echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
                }

            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        }else{

            if ($this->dmodel->delete('smartpos_produksi_item', 'id', $id)) {
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        }
        //redirect('produksi/detail/'.$getId);
    }


    public function ajax_list() {
        $list = $this->prrd->get_datatables();
        $data = array();
        foreach ($list as $prd) {
            //calculate
            $service = $this->dmodel->total_count('price', ['produksi_id' => $prd->id], 'smartpos_produksi_staff');
            $price = $this->dmodel->total_count('harga', ['produksi_id' => $prd->id], 'smartpos_produksi_item');
            $bprice = $price + $service;
            $subtotal = $this->dmodel->total_count('subtotal', ['produksi_id' => $prd->id], 'smartpos_produksi_item');
            $pprice = $subtotal + $service * $prd->taxppn;
            $kode = '<a 
            data-object-id="' . $prd->id . '"  
            data-object-name="'.$prd->name.'"   
            data-object-vname="'.$prd->vname.'"
            data-object-code="'.$prd->code.'" 
            data-object-pph="' . $prd->tax. '"
            data-object-ppn="' . $prd->taxppn. '"            
            class="produksiJob">'. $prd->code .'</a>';
            
            $row = array();
            $row[] = '<a href="#" 
            data-view-id="' . $prd->id . '"
            data-view-name="'.$prd->name.'"   
            data-view-vname="'.$prd->vname.'"
            data-view-code="'.$prd->code.'" 
            data-view-pph="' . $prd->tax. '"
            data-view-ppn="' . $prd->taxppn. '"            
            class="btn btn-success btn-sm viewProduksi"><span class="icon-folder"></span></a>';
            $row[] = $kode . '<br>' . date('d-M-Y', strtotime($prd->date));
            $row[] = $prd->name.'<br>'.$prd->vname;
            $row[] = 'R: '.number_format($prd->total, 4, ".", ".").'<br>'.'E: '.number_format($prd->totale, 4, ".", ".");
            $row[] = number_format($price, 4, ".", ".").'<br>'.'B: '.number_format($bprice, 4, ".", ".");
            $row[] = $prd->disc;
            $row[] = $prd->taxppn;
            $row[] = $prd->tax;
            $row[] = number_format($subtotal, 4, ".", ".").'<br>'.'P: '.number_format($pprice, 4, ".", ".");
            $row[] = '0.0000';
            //$row[] = '<button class="btn btn-sm btn-success" disabled=""><i class="fa fa-check fa-sm"></i></button>';
            $row[] = '<a href="produksi/edit?id='.$prd->id.'" class="btn btn-sm btn-warning"><i class="fa fa-edit fa-sm"></i></a>
            <a href="#" data-object-id="'.$prd->id.'" class="btn btn-danger btn-sm delete-object"><i class="fa fa-minus fa-sm"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->prrd->count_all(),
            "recordsFiltered" => $this->prrd->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    
    public function ajax_modal_produksi_job_list(){
        
        $id = $this->input->post('produksi_id');
        $list = $this->prrdJob->get_datatables($id);
        $data = array();
        $no = 0;
        foreach ($list as $prd) {
            //calculate
            //$job = '<a data-job-id="' . $prd->job_id . '" class="itemJob">'. $prd->name .'</a>';
            //$service = '0.000';
            $service = $this->dmodel->total_count('price', ['produksi_job_id' => $prd->id], 'smartpos_produksi_staff');

            //$indent = '0.000';
            $indent = $this->dmodel->total_count('indent', ['produksi_job_id' => $prd->id], 'smartpos_produksi_item');

            //$qty = '0.000';
            $qty = $this->dmodel->total_count('qty', ['produksi_job_id' => $prd->id], 'smartpos_produksi_item');

            //$item = '0.000';
            $item = $this->dmodel->total_count('harga', ['produksi_job_id' => $prd->id], 'smartpos_produksi_item');

            $job = '<a
            href="produksi/detail?pid='.$prd->produksi_id.'&id='.$prd->id.'"
            data-job-id="'.$prd->job_id .'" 
            data-view-id="'.$prd->id .'"
            data-view-name="'.$prd->name.'"   
            data-view-vname="'.$prd->vname.'"
            data-view-code="'.$prd->code.'" 
            data-view-pph="'.$prd->tax.'"
            data-view-ppn="'.$prd->taxppn.'"
            >'. $prd->name .'</a>';

            $job_ = '<a 
            href="produksi/detail?id='.$prd->job_id.'" 
            data-job-id="'.$prd->job_id .'" 
            data-view-id="'.$prd->id .'"
            data-view-name="'.$prd->name.'"   
            data-view-vname="'.$prd->vname.'"
            data-view-code="'.$prd->code.'" 
            data-view-pph="'.$prd->tax.'"
            data-view-ppn="'.$prd->taxppn.'"    
            data-toggle="modal" data-target="#produksi_job_model" data-dismiss="modal"
            class="produksiItem"
            >'. $prd->name .'</a>';

            $no++;
            $row = array();
            $row[] = $prd->que;
            $row[] = $job;
            $row[] = $prd->day;
            $row[] = $service != "" ? $service : '0';
            $row[] = $indent != "" ? $indent : '0';
            $row[] = $qty != "" ? $qty : '0' ;
            $row[] = $item != "" ? $item : '0';
            $row[] = '<button 
            data-jid="'.$prd->id.'"
            data-jproduksi-id="'.$prd->produksi_id.'" 
            data-jjob-id="'.$prd->job_id.'" 
            data-jque="'.$prd->que.'" 
            data-jday="'.$prd->day.'"
            class="btn btn-sm btn-warning editJobProduksi" data-toggle="modal" data-target="#produksi_job_model" data-dismiss="modal"><i class="fa fa-edit fa-sm"></i></button>
            <a href="#" data-object-id="'.$prd->id.'" class="btn btn-danger btn-sm delete-object2"><i class="fa fa-minus fa-sm"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->prrdJob->count_all(),
            "recordsFiltered" => $this->prrdJob->count_filtered($id),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }
    
    public function add()
    {
        if ($this->input->post('customer_id') != null 
            && $this->input->post('customer_id') != "" 
            && $this->input->post('vehicle_id') != null 
            && $this->input->post('vehicle_id') != "" ) {
            $code = $this->input->post('code', true);
            $date = datefordatabase($this->input->post('date'));
            $datedue = datefordatabase($this->input->post('datedue'));
            $customer_id = $this->input->post('customer_id', true);
            $vehicle_id = $this->input->post('vehicle_id', true);
            $template_id = $this->input->post('template_id', true);
            $price = $this->input->post('price', true);
            $disc = $this->input->post('disc', true);
            $bbn = $this->input->post('bbn', true);
            $tax = $this->input->post('tax');
            $taxppn = $this->input->post('taxppn');
            $total = $this->input->post('total');
            $totale = $this->input->post('totale');
            //$cek = $this->dmodel->getIfExist('smartpos_produksi', ['produksi_id' => $produksi_id,'produksi_job_id' => $produksi_job_id, 'product_id' => $product_id]);
            //if($cek){
            //    echo json_encode(array('status' => 'Error', 'message' => 'Produk sudah dimasukkan tidak bisa duplikat, silahkan edit'));
            //}else{
                //$this->prrdItem->add($produksi_id, $produksi_job_id, $product_id, numberClean($mharga), numberClean($harga), numberClean($qty), $indent);
                $this->prrd->add($code, $date, $datedue, $customer_id, $vehicle_id, $template_id, $price, $disc, $bbn, $tax, $taxppn, $total, $totale);        
            //}    
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    
    public function add_produksi_job()
    {
        if ($this->input->post('produksi_id') != null && $this->input->post('produksi_id') != "" ) {
            $produksi_id = $this->input->post('produksi_id');
            $que = $this->input->post('que');
            $day = $this->input->post('day');
            $job_id = $this->input->post('job_id');
            $this->prrdJob->add($produksi_id, $job_id, $que, $day);         
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    public function edit_produksi_job(){
        if ($this->input->post('id') != null 
        && $this->input->post('id') != ""
        && $this->input->post('produksi_id') != null
        && $this->input->post('produksi_id') != ""
        && $this->input->post('job_id') != null
        && $this->input->post('job_id') != "" ) {
            $id = $this->input->post('id');
            $produksi_id = $this->input->post('produksi_id');
            $que = $this->input->post('que');
            $day = $this->input->post('day');
            $job_id = $this->input->post('job_id');
            $this->prrdJob->update($id, $produksi_id, $job_id, $que, $day);         
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    
    public function add_produksi_item()
    {
        if ($this->input->post('produksi_job_id') != null && $this->input->post('produksi_job_id') != "" ) {
            $produksi_id = $this->input->post('produksi_id');
            $produksi_job_id = $this->input->post('produksi_job_id');
            $product_id = $this->input->post('product_id');
            $harga = $this->input->post('harga');
            $mharga = $this->input->post('mharga');
            $dharga = $this->input->post('dharga');
            $qty = $this->input->post('qty');
            $allqty = $this->input->post('allqty');
            $indent = 0;
            if($qty > $allqty) $indent = numberClean($qty) - numberClean($allqty);
            $cek = $this->dmodel->getIfExist('smartpos_produksi_item', ['produksi_id' => $produksi_id,'produksi_job_id' => $produksi_job_id, 'product_id' => $product_id]);
            if($cek){
                echo json_encode(array('status' => 'Error', 'message' => 'Produk sudah dimasukkan tidak bisa duplikat, silahkan edit'));
            }else{
                $this->prrdItem->add($produksi_id, $produksi_job_id, $product_id, numberClean($mharga), numberClean($dharga), numberClean($harga), numberClean($qty), $indent);
            }         
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    public function update_produksi_item()
    {
        if ($this->input->post('id') != null 
        && $this->input->post('id') != "" 
        && $this->input->post('produksi_job_id') != "" 
        && $this->input->post('produksi_job_id') != "" ) {
            $id = $this->input->post('id');
            $produksi_id = $this->input->post('produksi_id');
            $produksi_job_id = $this->input->post('produksi_job_id');
            $product_id = $this->input->post('product_id');
            $harga = $this->input->post('harga');
            $mharga = $this->input->post('mharga');
            $dharga = $this->input->post('dharga');
            $qty = $this->input->post('qty');
            $allqty = $this->input->post('allqty');
            $indent = 0;
            if($qty > $allqty) $indent = numberClean($qty) - numberClean($allqty);

            $this->prrdItem->update($id,$produksi_id, $produksi_job_id, $product_id, numberClean($mharga), numberClean($dharga), numberClean($harga), numberClean($qty), $indent);
                   
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }

    public function add_produksi_staff()
    {
        if ($this->input->post('produksi_job_id') != null 
        && $this->input->post('produksi_job_id') != ""
        && $this->input->post('staff_id') != ""
        ) {
            $produksi_id = $this->input->post('produksi_id');
            $produksi_job_id = $this->input->post('produksi_job_id');
            $staff_id = $this->input->post('staff_id');
            $price = $this->input->post('price');
            //cek if alreadygetIfExist
            //$cek = $this->dmodel->getWhere('smartpos_produksi_staff', ['produksi_job_id' => $produksi_job_id, 'staff_id' => $staff_id]);
            $cek = $this->dmodel->getIfExist('smartpos_produksi_staff', ['produksi_job_id' => $produksi_job_id, 'staff_id' => $staff_id]);
            if($cek){            
                echo json_encode(array('status' => 'Error', 'message' => 'Staff sudah dimasukkan tidak bisa duplikat, silahkan edit'));
            }else{
                $this->prrdStaff->add($produksi_id, $produksi_job_id, $staff_id, $price);    
            }     
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }   

    public function edit_produksi_staff()
    {
        if ($this->input->post('id') != null 
        && $this->input->post('id') != ""
        && $this->input->post('produksi_job_id') != null
        && $this->input->post('produksi_job_id') != ""
        && $this->input->post('staff_id') != null
        && $this->input->post('staff_id') != ""
        ) {
            $id = $this->input->post('id');
            $produksi_id = $this->input->post('produksi_id');
            $produksi_job_id = $this->input->post('produksi_job_id');
            $staff_id = $this->input->post('staff_id');
            $price = $this->input->post('price');

            
            $this->prrdStaff->add($id, $produksi_id, $produksi_job_id, $staff_id, $price);    
               
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }   

    public function ajax_modal_produksi_list(){
        $id = $this->input->post('produksi_id');
        $list = $this->prrdJob->get_datatables($id);
        $data = array();
        $no = 0;
        foreach ($list as $prd) {
            $no++;
            //calculate
            $qty = $this->dmodel->total_count('qty', ['produksi_job_id' => $prd->job_id], 'smartpos_produksi_item');
            $indent = 0;
            $row = array();
            $row[] = $no;
            $row[] = $prd->name;
            $row[] = $prd->day;
            $row[] = $indent;
            $row[] = $qty;
            $row[] = $prd->total;
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->prrdJob->count_all(),
            "recordsFiltered" => $this->prrdJob->count_filtered($id),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_modal_staff_list(){
        
        $data = array();
        $no = 0;
        //get data item
        $id = $this->input->post('cid');
        $service = $this->dmodel->getWhere('smartpos_produksi_staff', ['produksi_job_id' => $id]);
        if(isset($service)){                        
            foreach ($service as $srv) {
                $staff = $this->dmodel->get('smartpos_users', ['id' => $srv['staff_id']]);
                if(isset($staff)){ 
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $staff['username'];
                    $row[] = $srv['price'];
                    $row[] = '';
                    $row[] = '';
                    $row[] = '<button                     
                    data-sid="' . $srv['id'] . '"
                    data-sstaff-id="'.$srv['staff_id'].'"   
                    data-sjob-id="'.$srv['produksi_job_id'].'"
                    data-sproduksi_id="' . $srv['produksi_id']. '" 
                    data-sprice="' . $srv['price']. '" 
                    id="editStaffjob" class="btn btn-sm btn-warning" ><i class="fa fa-edit fa-sm"></i></button>
                    <a data-staff-id="'.$srv['id'].'" id="hapusStaffJob" class="btn btn-sm btn-danger"><i class="fa fa-minus fa-sm"></i></a>';
                    $data[] = $row;
                }
            }
            
        }
        $output = array(
            "recordsTotal" => $this->prrdStaff->count_all(),
            "recordsFiltered" => $this->prrdStaff->count_filtered_1($id),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);


    }

    public function ajax_modal_item_list(){
        $data = array();
        $no = 0;
        $id = $this->input->post('cid');

        $item = $this->prrdItem->get_datatables($id);
        foreach ($item as $it) { 
            $no++;
            $row = array();
            $cogs = $it->qty * $it->harga;
            //$qty = $this->dmodel->get_column();
            $qty = $this->dmodel->get_column('smartpos_products', 'qty', ['pid' => $it->product_id]);
            $row[] = $no;
            $row[] = $it->product_name.' - '.$it->product_code;
            $row[] = $it->indent;
            $row[] = $it->qty;
            $row[] = $cogs;
            $row[] = '<button 
                data-eid="' . $it->id . '"
                data-eproduksi-id="'.$it->produksi_id.'"   
                data-eproduksi-job-id="'.$it->produksi_job_id.'"
                data-eproduct-id="' . $it->product_id. '"
                data-eharga="' . $it->harga. '"       
                data-emharga="' . $it->mharga. '"       
                data-edharga="' . $it->dharga. '"       
                data-eqty="' . $it->qty. '"           
                data-eallqty="' . $qty. '"       
                class="btn btn-sm btn-warning editItemProduksi"><i class="fa fa-edit fa-sm"></i></button>
                <a data-item-id="'.$it->id.'" id="hapusItemJob" class="btn btn-sm btn-danger"><i class="fa fa-minus fa-sm"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->prrdItem->count_all(),
            "recordsFiltered" => $this->prrdItem->count_filtered($id),
            "data" => $data,
            "id" => $id
        );
        //output to json format
        echo json_encode($output);
    }    

    public function ajax_modal_produksi(){
        $id = $this->input->post('produksi_id');
        $list = $this->prrdJob->get_datatables($id);
        $data = array();
        foreach ($list as $prd) {
            $row = array();
            $row['_position'] = array();
            $row['_item'] = array();
            
            $service = $this->prrdStaff->get_datatables($prd->id);       
            foreach ($service as $srv) {
                $row1 = array();
                $row1['staff_name'] = $srv->username;
                $row1['qty'] = $srv->price;
                array_push($row['_position'], $row1);
            }
              

            $item = $this->prrdItem->get_datatables($prd->id);
            foreach ($item as $it) { 
                $row2 = array();
    
                $row2['item_code'] = $it->product_code;
                $row2['item_name'] = $it->product_name;
                $row2['indent'] = $it->indent;
                $row2['qty'] = $it->qty;
                array_push($row['_item'], $row2);
            }
            //calculate
            //$qty = $this->dmodel->total_count('qty', ['produksi_job_id' => $prd->job_id], 'smartpos_produksi_item');
            //$indent = $this->dmodel->total_count('indent', ['produksi_job_id' => $prd->job_id], 'smartpos_produksi_item');
            
            $indent = $this->dmodel->total_count('indent', ['produksi_job_id' => $prd->id], 'smartpos_produksi_item');
            $qty = $this->dmodel->total_count('qty', ['produksi_job_id' => $prd->id], 'smartpos_produksi_item');

            $row['job_name'] = $prd->name;
            $row['service_qty'] = $prd->day;
            $row['item_indent'] = $indent;
            $row['item_qty'] = $qty;
            $row['total'] = $prd->total;
            


            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->prrdJob->count_all(),
            "recordsFiltered" => $this->prrdJob->count_filtered($id),
            "data" => $data,
            'status' => true,
        );
        //output to json format
        echo json_encode($output);
    }

    
    public function delete_t()
    {
        //hapus template
        $id = $this->input->post('deleteid');
        if ($id) {     
            
            $this->db->delete('smartpos_produksi_item', array('produksi_id' => $id));
            $this->db->delete('smartpos_produksi_staff', array('produksi_id' => $id));
                    
            $this->db->delete('smartpos_produksi_job', array('produksi_id' => $id));
            $this->db->delete('smartpos_produksi', array('id' => $id));

            echo json_encode(array('status' => 'Success', 'message' => 'Template and all related template deleted Successfully!'));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        }
    }
    
    public function delete_j()
    {
        //hapus job
        $id = $this->input->post('deleteid');
        if ($id) {     
                
            $this->db->delete('smartpos_produksi_item', array('produksi_job_id' => $id));
            $this->db->delete('smartpos_produksi_staff', array('produksi_job_id' => $id));   

            $this->db->delete('smartpos_produksi_job', array('id' => $id));
            echo json_encode(array('status' => 'Success', 'message' => 'Job and all related job deleted Successfully!'));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        }
    }

}