<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Productcategory extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('categories_model', 'products_cat');
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        if (!$this->aauth->premission(2)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $this->li_a = 'stock';
    }

    public function index() {
        $data['cat'] = $this->products_cat->category_stock();
        $head['title'] = "Product Categories";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/category', $data);
        $this->load->view('fixed/footer');
    }

    public function warehouse() {
        $data['cat'] = $this->products_cat->warehouse();
        $head['title'] = "Product Warehouse";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/warehouse', $data);
        $this->load->view('fixed/footer');
    }

    public function view() {
        $data['id'] = $this->input->get('id');
        $data['sub'] = $this->input->get('sub');
        $data['cat'] = $this->products_cat->category_sub_stock($data['id']);
        $head['title'] = "View Product Category";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/category_view', $data);
        $this->load->view('fixed/footer');
    }

    public function viewwarehouse() {
        $data['cat'] = $this->products_cat->warehouse();
        $head['title'] = "View Product Warehouses";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/warehouse_view', $data);
        $this->load->view('fixed/footer');
    }

    public function add() {
        $data['cat'] = $this->products_cat->category_list();
        $this->load->model('locations_model');
        $data['locations'] = $this->locations_model->locations_list2();
        $head['title'] = "Add Product Category";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/category_add', $data);
        $this->load->view('fixed/footer');
    }

    public function add_sub() {
        $data['cat'] = $this->products_cat->category_list();
        $this->load->model('locations_model');
        $data['locations'] = $this->locations_model->locations_list2();
        $head['title'] = "Add Product Category";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/category_add_sub', $data);
        $this->load->view('fixed/footer');
    }

    public function addwarehouse() {
        if ($this->input->post()) {
            $cat_name = $this->input->post('product_catname');
            $cat_desc = $this->input->post('product_catdesc');
            $lid = $this->input->post('lid');
            if ($this->aauth->get_user()->loc) {
                if ($lid == 0 or $this->aauth->get_user()->loc == $lid) {
                    
                } else {
                    exit();
                }
            }

            if ($cat_name) {

                $this->products_cat->addwarehouse($cat_name, $cat_desc, $lid);
            }
        } else {
            $this->load->model('locations_model');
            $data['locations'] = $this->locations_model->locations_list2();
            $data['cat'] = $this->products_cat->category_list();
            $head['title'] = "Add Product Warehouse";
            $head['usernm'] = $this->aauth->get_user()->username;
            $this->load->view('fixed/header', $head);
            $this->load->view('products/warehouse_add', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function addcat() {
        $cat_name = $this->input->post('product_catname', true);
        $cat_desc = $this->input->post('product_catdesc', true);
        $cat_type = $this->input->post('cat_type', true);
        $cat_rel = $this->input->post('cat_rel', true);
        if ($cat_name) {
            $this->products_cat->addnew($cat_name, $cat_desc, $cat_type, $cat_rel);
        }
    }

    public function delete_i() {
        if ($this->aauth->premission(11)) {
            $id = intval($this->input->post('deleteid'));
            if ($id) {

                $query = $this->db->query("DELETE smartpos_movers FROM smartpos_movers LEFT JOIN smartpos_products ON  smartpos_movers.rid1=smartpos_products.pid LEFT JOIN smartpos_product_cat ON  smartpos_products.pcat=smartpos_product_cat.id WHERE smartpos_product_cat.id='$id' AND  smartpos_movers.d_type='1'");

                $this->db->delete('smartpos_products', array('pcat' => $id));
                $this->db->delete('smartpos_product_cat', array('id' => $id));
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Product Category with products')));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }

    public function delete_i_sub() {
        if ($this->aauth->premission(11)) {
            $id = intval($this->input->post('deleteid'));
            if ($id) {

                $query = $this->db->query("DELETE smartpos_movers FROM smartpos_movers LEFT JOIN smartpos_products ON  smartpos_movers.rid1=smartpos_products.pid LEFT JOIN smartpos_product_cat ON  smartpos_products.sub_id=smartpos_product_cat.id WHERE smartpos_product_cat.id='$id' AND  smartpos_movers.d_type='1'");

                $this->db->delete('smartpos_products', array('sub_id' => $id));
                $this->db->delete('smartpos_product_cat', array('id' => $id));
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Product Category with products')));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }

    public function delete_warehouse() {
        if ($this->aauth->premission(11)) {
            $id = $this->input->post('deleteid');
            if ($id) {
                $this->db->delete('smartpos_products', array('warehouse' => $id));
                $this->db->delete('smartpos_warehouse', array('id' => $id));
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Product Warehouse with products')));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }

//view for edit
    public function edit() {
        $catid = $this->input->get('id');
        $this->db->select('*');
        $this->db->from('smartpos_product_cat');
        $this->db->where('id', $catid);
        $query = $this->db->get();
        $data['productcat'] = $query->row_array();
        $data['cat'] = $this->products_cat->category_list();

        $head['title'] = "Edit Product Category";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/product-cat-edit', $data);
        $this->load->view('fixed/footer');
    }

    public function editwarehouse() {
        if ($this->input->post()) {
            $cid = $this->input->post('catid');
            $cat_name = $this->input->post('product_cat_name', true);
            $cat_desc = $this->input->post('product_cat_desc', true);
            $lid = $this->input->post('lid');

            if ($this->aauth->get_user()->loc) {
                if ($lid == 0 or $this->aauth->get_user()->loc == $lid) {
                    
                } else {
                    exit();
                }
            }


            if ($cat_name) {

                $this->products_cat->editwarehouse($cid, $cat_name, $cat_desc, $lid);
            }
        } else {
            $catid = $this->input->get('id');
            $this->db->select('*');
            $this->db->from('smartpos_warehouse');
            $this->db->where('id', $catid);
            $query = $this->db->get();
            $data['warehouse'] = $query->row_array();
            $this->load->model('locations_model');
            $data['locations'] = $this->locations_model->locations_list2();
            $head['title'] = "Edit Product Warehouse";
            $head['usernm'] = $this->aauth->get_user()->username;
            $this->load->view('fixed/header', $head);
            $this->load->view('products/product-warehouse-edit', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function editcat() {
        $cid = $this->input->post('catid');
        $product_cat_name = $this->input->post('product_cat_name');
        $product_cat_desc = $this->input->post('product_cat_desc');
        $cat_type = $this->input->post('cat_type', true);
        $cat_rel = $this->input->post('cat_rel', true);
        $old_cat_type = $this->input->post('old_cat_type', true);
        if ($cid) {
            $this->products_cat->edit($cid, $product_cat_name, $product_cat_desc, $cat_type, $cat_rel, $old_cat_type);
        }
    }

    public function report_product() {
        $pid = intval($this->input->post('id'));

        $r_type = intval($this->input->post('r_type'));
        $s_date = datefordatabase($this->input->post('s_date'));
        $e_date = datefordatabase($this->input->post('e_date'));
        $sub_date = $this->input->post('sub');
        $filter = 'pcat';
        if ($sub_date)
            $filter = 'sub_id';

        if ($pid && $r_type) {
            $qj = '';
            $wr = '';
            if ($this->aauth->get_user()->loc) {
                $qj = "LEFT JOIN smartpos_warehouse ON smartpos_products.warehouse=smartpos_warehouse.id";

                $wr = " AND smartpos_warehouse.loc='" . $this->aauth->get_user()->loc . "'";
            }


            switch ($r_type) {
                case 1 :
                    $query = $this->db->query("SELECT smartpos_invoices.tid,smartpos_invoice_items.qty,smartpos_invoice_items.price,smartpos_invoices.invoicedate FROM smartpos_invoice_items LEFT JOIN smartpos_invoices ON smartpos_invoices.id=smartpos_invoice_items.tid LEFT JOIN smartpos_products ON smartpos_products.pid=smartpos_invoice_items.pid  LEFT JOIN smartpos_product_cat ON smartpos_product_cat.id=smartpos_products.$filter  $qj WHERE smartpos_invoices.status!='canceled' AND (DATE(smartpos_invoices.invoicedate) BETWEEN DATE('$s_date') AND DATE('$e_date')) AND smartpos_products.$filter='$pid' $wr");
                    $result = $query->result_array();
                    break;

                case 2 :
                    $query = $this->db->query("SELECT smartpos_purchase.tid,smartpos_purchase_items.qty,smartpos_purchase_items.price,smartpos_purchase.invoicedate FROM smartpos_purchase_items LEFT JOIN smartpos_purchase ON smartpos_purchase.id=smartpos_purchase_items.tid LEFT JOIN smartpos_products ON smartpos_products.pid=smartpos_purchase_items.pid  LEFT JOIN smartpos_product_cat ON smartpos_product_cat.id=smartpos_products.$filter  WHERE smartpos_purchase.status!='canceled' AND (DATE(smartpos_purchase.invoicedate) BETWEEN DATE('$s_date') AND DATE('$e_date')) AND smartpos_products.$filter='$pid' ");
                    $result = $query->result_array();
                    break;

                case 3 :
                    $query = $this->db->query("SELECT smartpos_movers.rid2 AS qty, DATE(smartpos_movers.d_time) AS  invoicedate,smartpos_movers.note,smartpos_products.product_price AS price,smartpos_products.product_name   FROM smartpos_movers LEFT JOIN smartpos_products ON smartpos_products.pid=smartpos_movers.rid1  WHERE smartpos_movers.d_type='1' AND smartpos_products.$filter='$pid'  AND (DATE(smartpos_movers.d_time) BETWEEN DATE('$s_date') AND DATE('$e_date'))");
                    $result = $query->result_array();
                    break;
            }
            $this->db->select('*');
            $this->db->from('smartpos_product_cat');
            $this->db->where('id', $pid);
            $query = $this->db->get();
            $product = $query->row_array();

            $html = $this->load->view('products/cat_statementpdf-ltr', array('report' => $result, 'product' => $product, 'r_type' => $r_type), true);
            ini_set('memory_limit', '64M');

            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($pid . 'report.pdf', 'I');
        } else {
            $pid = intval($this->input->get('id'));
            $sub = $this->input->get('sub');
            $this->db->select('*');
            $this->db->from('smartpos_product_cat');
            $this->db->where('id', $pid);
            $query = $this->db->get();
            $product = $query->row_array();

            $head['title'] = "Product Sales";
            $head['usernm'] = $this->aauth->get_user()->username;
            $this->load->view('fixed/header', $head);
            $this->load->view('products/cat_statement', array('id' => $pid, 'product' => $product, 'sub' => $sub));
            $this->load->view('fixed/footer');
        }
    }

    public function warehouse_report() {
        $pid = intval($this->input->post('id'));

        $r_type = intval($this->input->post('r_type'));
        $s_date = datefordatabase($this->input->post('s_date'));
        $e_date = datefordatabase($this->input->post('e_date'));

        if ($pid && $r_type) {
            $qj = '';
            $wr = '';
            if ($this->aauth->get_user()->loc) {
                $qj = "LEFT JOIN smartpos_warehouse ON smartpos_products.warehouse=smartpos_warehouse.id";

                $wr = " AND smartpos_warehouse.loc='" . $this->aauth->get_user()->loc . "'";
            }

            switch ($r_type) {
                case 1 :
                    $query = $this->db->query("SELECT smartpos_invoices.tid,smartpos_invoice_items.qty,smartpos_invoice_items.price,smartpos_invoices.invoicedate FROM smartpos_invoice_items LEFT JOIN smartpos_invoices ON smartpos_invoices.id=smartpos_invoice_items.tid LEFT JOIN smartpos_products ON smartpos_products.pid=smartpos_invoice_items.pid $qj WHERE smartpos_invoices.status!='canceled'  AND (DATE(smartpos_invoices.invoicedate) BETWEEN DATE('$s_date') AND DATE('$e_date')) AND smartpos_products.warehouse='$pid' $wr");
                    $result = $query->result_array();
                    break;

                case 2 :
                    $query = $this->db->query("SELECT smartpos_purchase.tid,smartpos_purchase_items.qty,smartpos_purchase_items.price,smartpos_purchase.invoicedate FROM smartpos_purchase_items LEFT JOIN smartpos_purchase ON smartpos_purchase.id=smartpos_purchase_items.tid LEFT JOIN smartpos_products ON smartpos_products.pid=smartpos_purchase_items.pid  LEFT JOIN smartpos_product_cat ON smartpos_product_cat.id=smartpos_products.pcat  WHERE smartpos_purchase.status!='canceled' AND (DATE(smartpos_purchase.invoicedate) BETWEEN DATE('$s_date') AND DATE('$e_date')) AND smartpos_products.pcat='$pid' ");
                    $result = $query->result_array();
                    break;

                case 3 :
                    $query = $this->db->query("SELECT smartpos_movers.rid2 AS qty, DATE(smartpos_movers.d_time) AS  invoicedate,smartpos_movers.note,smartpos_products.product_price AS price,smartpos_products.product_name  FROM smartpos_movers LEFT JOIN smartpos_products ON smartpos_products.pid=smartpos_movers.rid1  WHERE smartpos_movers.d_type='1' AND smartpos_products.warehouse='$pid'  AND (DATE(smartpos_movers.d_time) BETWEEN DATE('$s_date') AND DATE('$e_date'))");
                    $result = $query->result_array();
                    break;
            }


            $this->db->select('*');
            $this->db->from('smartpos_warehouse');
            $this->db->where('id', $pid);
            $query = $this->db->get();
            $product = $query->row_array();

            $html = $this->load->view('products/ware_statementpdf-ltr', array('report' => $result, 'product' => $product, 'r_type' => $r_type), true);
            ini_set('memory_limit', '64M');

            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($pid . 'report.pdf', 'I');
        } else {
            $pid = intval($this->input->get('id'));
            $this->db->select('*');
            $this->db->from('smartpos_warehouse');
            $this->db->where('id', $pid);
            $query = $this->db->get();
            $product = $query->row_array();

            $head['title'] = "Product Sales";
            $head['usernm'] = $this->aauth->get_user()->username;
            $this->load->view('fixed/header', $head);
            $this->load->view('products/ware_statement', array('id' => $pid, 'product' => $product));
            $this->load->view('fixed/footer');
        }
    }

}
