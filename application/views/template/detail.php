<div class="card no-border bg-light">    
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        
        <form id="produksi_model_form">
                    
            <input type="hidden"
                name="<?php echo $this->security->get_csrf_token_name(); ?>"
                value="<?php echo $this->security->get_csrf_hash(); ?>">

            <input type="hidden" name="cid" value="<?php echo $job_id ?>">

        </form>
        
        <div class="col-sm-12">                        
            <div class="row">
                <div class="col-sm-4" class="text-bold">
                <h4>Job: <span class="danger"><?php echo $jobname ?> (<?php echo $day ?> Days)</span></h4>
                </div>
                <div class="col-sm-8 small text-bold" style="text-align: right;padding-right: 20px;">
                <h4>SubTotal: <span class="danger"><?php echo number_format($subtotal, 4) ?></span></h4>
                </div>
            </div>
        </div>
        <table data-paging="false" data-searching="false" data-ordering="false" id="produksi-service" class="table table-striped table-bordered zero-configuration table-sm">
            <thead> 
                <tr>                              
                    <th class="no-sort">
                        <a class="btn btn-success btn-sm addStaffroduksi" data-produksi-id="<?php echo $job_id ?>"><span class="icon-plus"></span></a>
                    </th>
                    <th>Service</th>
                    <th>Subtotal</th>
                    <th class="no-sort">#</th>                         
                </tr>       
            </thead>
            <tbody>
            </tbody>
        </table>
        
        
        <table data-paging="false" data-searching="false" data-ordering="false"  id="produksi-item" class="table table-striped table-bordered zero-configuration table-sm">
            <thead>
                <tr>                         
                    <th class="no-sort">
                        <a class="btn btn-success btn-sm addItemProduksi" data-produksi-id="<?php echo $job_id ?>"><span class="icon-plus"></span></a>
                    </th>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th class="no-sort">#</th>
                </tr> 
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>


<div id="add_item_produksi_view_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pekerjaan <span class="kodeProduksi"></span></h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <form id="produksi_item_model_form">
                <div class="modal-body">
                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <input type="hidden" name="item_job_id" id="item-job-id" value="<?php echo $job_id ?>">
                    <input type="hidden" id="action-url" value="template/add_produksi_item">
                    
                    <input type="hidden" id="item-harga" value="0">
                    <input type="hidden" id="item-mharga" value="0">
                    <input type="hidden" id="item-diskon" value="0">
                    <input type="hidden" id="item-all-qty" value="0">

                    <div class="form-group">
                        <label class="form-label" for="job">Product</label>   
                        <div class="col-md-12">                    
                        <select id="item-id" name="item_id" class="search form-control" style="width:100%">
                            <option value=""> -Pilih produk- </option>
                            <?php
                            foreach ($products as $row) {
                                $pid = $row['pid'];
                                $ptitle = $row['product_name'];
                                $pcode = $row['product_code'];
                                $pqty = $row['qty'];
                                $pprice = $row['product_price'];
                                $mprice = $row['fproduct_price'];
                                $pdisc = $row['disrate'];
                                echo "<option value='$pid' data-pqty='$pqty' data-pprice='$pprice' data-mprice='$mprice' data-pdisc='$pdisc'>$ptitle - $pcode</option>";
                            }
                            ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jumlah dari stok</label>
                        <input id="item-qty" type="number" placeholder="0"
                                class="form-control rounded-0 required" name="qty">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                    <button type="button" id="simpanProduksiItem" 
                        class="btn btn-primary"  data-toggle="modal" data-target="#add_item_produksi_view_model" data-dismiss="modal">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
<div id="edit_item_produksi_view_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit <span class="kodeProduksi"></span></h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <form id="edit_item_model_form">
                <div class="modal-body">
                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <input type="hidden" id="eid">
                    <input type="hidden" id="action-eurl" value="template/edit_produksi_item">
                    <div class="form-group">
                        <label class="form-label" for="job">Product</label>   
                        <div class="col-md-12">                    
                        <select id="item-eid" name="item_id" class="item form-control" style="width:100%">
                            <option value=""> -Pilih produk- </option>
                            <?php
                            foreach ($products as $row) {
                                $pid = $row['pid'];
                                $ptitle = $row['product_name'];
                                $pcode = $row['product_code'];
                                $pqty = $row['qty'];
                                $pprice = $row['product_price'];
                                $mprice = $row['fproduct_price'];
                                $pdisc = $row['disrate'];
                                echo "<option value='$pid' data-pqty='$pqty' data-pprice='$pprice' data-mprice='$mprice' data-pdisc='$pdisc'>$ptitle - $pcode</option>";
                            }
                            ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jumlah dari stok</label>
                        <input id="item-eqty" type="number" placeholder="0"
                                class="form-control rounded-0 required" name="qty">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                    <button type="button" id="editProduksiItem" 
                        class="btn btn-primary"  data-toggle="modal" data-target="#edit_item_produksi_view_model" data-dismiss="modal">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
<div id="delete_item_model" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('delete this product') ?></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="item-delete-id" value="">
                <input type="hidden" id="item-action-url" value="template/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm-item"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-danger"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>

<div id="add_staff_produksi_view_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pekerjaan <span class="kodeProduksi"></span></h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <form id="produksi_staf_model_form">
                <div class="modal-body">
                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <input type="hidden" name="staff_job_id" id="staff-job-id" value="<?php echo $job_id ?>">
                    <input type="hidden" id="action-url" value="template/add_produksi_staff">
                    
                    <div class="form-group">
                        <label class="form-label" for="job">Staff</label>                        
                        <select id="staf-id" class="form-control" name="staff_id" required="required"  style="width:100%">
                            <option value="0">-Pilih Pekerja-</option>
                            <?php
                            foreach ($staff as $row) {
                                $uid = $row['id'];
                                $utitle = $row['username'];
                                echo "<option value='$uid'>$utitle</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sub Total</label>
                        <input id="harga_staf" name="price" type="number" placeholder="0"
                                class="form-control rounded-0 required">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                    <button type="button" id="simpanProduksiStaff" 
                        class="btn btn-primary"  data-toggle="modal" data-target="#add_staff_produksi_view_model" data-dismiss="modal">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
<div id="edit_staff_produksi_view_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit <span class="kodeProduksi"></span></h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <form id="edit_staf_model_form">
                <div class="modal-body">
                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <input type="hidden" name="staff_job_id" id="staff-job-sid" value="<?php echo $job_id ?>">
                    <input type="hidden" id="action-surl" value="template/edit_produksi_staff">
                    <input type="hidden" id="sid">
                    
                    <div class="form-group">
                        <label class="form-label" for="job">Staff</label>                        
                        <select id="staf-sid" class="form-control" name="staff_id" required="required"  style="width:100%">
                            <option value="0">-Pilih Pekerja-</option>
                            <?php
                            foreach ($staff as $row) {
                                $uid = $row['id'];
                                $utitle = $row['username'];
                                echo "<option value='$uid'>$utitle</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sub Total</label>
                        <input id="harga_sstaf" name="price" type="number" placeholder="0"
                                class="form-control rounded-0 required">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                    <button type="button" id="editProduksiStaff" 
                        class="btn btn-primary"  data-toggle="modal" data-target="#edit_staff_produksi_view_model" data-dismiss="modal">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
<div id="delete_staff_model" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
            </div>
            <div class="modal-body">
                <p>Delete this Staff in Produksi</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="staff-delete-id" value="">
                <input type="hidden" id="staff-action-url" value="template/delete_s">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm-staff"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-danger"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function _numberFormat(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
    $(document).on('click', "#hapusStaffJob", function (e) {
        e.preventDefault();
        $('#staff-delete-id').val($(this).attr('data-staff-id'));

        $(this).closest('tr').attr('id', $(this).attr('data-staff-id'));
        $('#delete_staff_model').modal({backdrop: 'static', keyboard: false});

    });

    $("#delete-confirm-staff").on("click", function () {
        var o_data = 'deleteid=' + $('#staff-delete-id').val();
        var action_url = $('#delete_staff_model #staff-action-url').val();
        $('#' + $('#staff-delete-id').val()).remove();
        removeObject(o_data, action_url);
    });

    //universal list item delete from table
    $(document).on('click', "#hapusItemJob", function (e) {
        e.preventDefault();
        $('#item-delete-id').val($(this).attr('data-item-id'));

        $(this).closest('tr').attr('id', $(this).attr('data-item-id'));
        $('#delete_item_model').modal({backdrop: 'static', keyboard: false});

    });

    $("#delete-confirm-item").on("click", function () {
        var o_data = 'deleteid=' + $('#item-delete-id').val();
        var action_url = $('#delete_item_model #item-action-url').val();
        $('#' + $('#item-delete-id').val()).remove();
        removeObject(o_data, action_url);
    });
    
    function removeObject(action, action_url) {

        jQuery.ajax({
            url: baseurl + action_url,
            type: 'POST',
            data: action + '&' + crsf_token + '=' + crsf_hash,
            dataType: 'json',
            success: function (data) {
                if (data.status == "Success") {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                } else {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-success").addClass("alert-danger").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                }
            },
            error: function (data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
                $("html, body").scrollTop($("body").offset().top);
            }
        });

    }

    $("#simpanProduksiItem").on("click", function () {
        var jobid = 'produksi_job_id=' + $('#item-job-id').val();
        var produkid = 'product_id=' + $('#item-id').val();
        var qty = 'qty=' + $('#item-qty').val();
        var action_url = $('#add_item_produksi_view_model #action-url').val();
        //console.log(jobid);
        //console.log(produkid);
        //console.log(harga);
        //console.log(mharga);
        //console.log(allqty);
        //console.log(qty);
        //console.log(action_url);
        addProduksiItem(jobid, produkid, qty, action_url);
    });

    function addProduksiItem(jobid, produkid, qty, action_url) {
        if ($("#notify").length == 0) {
            $("#c_body").html('<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>');
        }
        jQuery.ajax({
            url: baseurl + action_url,
            type: 'POST',
            data: jobid+'&'+produkid+'&'+qty+'&' + crsf_token + '=' + crsf_hash,
            dataType: 'json',
            success: function (data) {
                if (data.status == "Success") {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                    location.reload(true);
                } else {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-success").addClass("alert-danger").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                    //sleep(15);location.reload(true);
                }
            },
            error: function (data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
                $("html, body").scrollTop($("body").offset().top);
                    //sleep(15);location.reload(true);
            }
        });
    }

    $("#simpanProduksiStaff").on("click", function () {
        var jobid = 'produksi_job_id=' + $('#staff-job-id').val();
        var stafid = 'staff_id=' + $('#staf-id').val();
        var price = 'price=' + $('#harga_staf').val();
        var action_url = $('#add_staff_produksi_view_model #action-url').val();
        if($('#staf-id').val() == 0){
            console.log(jobid);
            console.log(price);
            console.log(action_url);
            console.log(stafid);
            $("#notify .message").html("<strong>Pemberitahuan</strong>: Silahkan pilih Staff");
            $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
            $("html, body").scrollTop($("body").offset().top);

        }else{
            addProduksiStaff(jobid, stafid, price, action_url);
        }
        
    });

    function addProduksiStaff(jobid, stafid, price, action_url) {
        if ($("#notify").length == 0) {
            $("#c_body").html('<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>');
        }
        jQuery.ajax({
            url: baseurl + action_url,
            type: 'POST',
            data: jobid+'&'+stafid+'&'+price+'&' + crsf_token + '=' + crsf_hash,
            dataType: 'json',
            success: function (data) {
                if (data.status == "Success") {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                    sleep(15);
                    location.reload(true);
                } else {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-success").addClass("alert-danger").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                    //sleep(15);
                    //location.reload(true);
                }
            },
            error: function (data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
                $("html, body").scrollTop($("body").offset().top);
                //sleep(15);
                //location.reload(true);
            }
        });
    }
    
    $(document).on('click', ".addItemProduksi", function (e) {
        //$('#item-produksi-id').val($(this).attr('data-produksi-id'));
        //$('#item-job-id').val($(this).attr('data-produksi-id'));     
        $('#add_item_produksi_view_model').modal({backdrop: 'static', keyboard: false});       
    });
    $(document).on('click', ".addStaffroduksi", function (e) {
        //$('#staff-produksi-id').val($(this).attr('data-produksi-id'));
        //$('#staff-job-id').val($(this).attr('data-produksi-id'));    
        $('#add_staff_produksi_view_model').modal({backdrop: 'static', keyboard: false});       
    });

    //$('#item-id').select2();

    $(document).on('change', '#item-id', function (e) {
        var val = $(e.target).val();
        var allqty = $(e.target).find("option:selected").attr('data-pqty');
        var price = $(e.target).find("option:selected").attr('data-pprice');
        var mprice = $(e.target).find("option:selected").attr('data-mprice');
        var pdisc = $(e.target).find("option:selected").attr('data-pdisc');
        $('#item-diskon').val(pdisc); 
        $('#item-harga').val(price);
        $('#item-mharga').val(mprice);  
        $('#item-all-qty').val(allqty); 
    });

    //edit

    $(document).ready(function () {            

        draw_data();
        function draw_data() {
            
            $('#produksi-service').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('template/ajax_modal_staff_list') ?>",
                    'type': 'POST',
                    //'data': $("#produksi_model_form").serialize(),
                    'data': {
                        'cid': <?= $this->input->get('id') ?>,
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    },
                },
                'columnDefs': [
                    {
                        'targets': [0],
                        'width': "5%",
                        'orderable': false,
                    },
                ],
                dom: 'Blfrtip',
                lengthMenu: [10, 20, 50, 100, 200, 500],
                buttons: [
                ],
            });
            
            var table = $('#produksi-item').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                'paging': false,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('template/ajax_modal_item_list') ?>",
                    'type': 'POST',
                    'data': {
                        'cid': <?= $this->input->get('id') ?>,
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    },
                },
                'columnDefs': [
                    {
                        'targets': [0],
                        'width': "5%",
                        'orderable': false,
                    },
                    {
                        'targets': [3,4],
                        'render': $.fn.dataTable.render.number(',', '.', 4, '')
                    },
                ],
                dom: 'Blfrtip',
                lengthMenu: [10, 20, 50, 100, 200, 500],
                buttons: [
                ],
                createdRow: function(row, data, type, name ) {
                    console.log("tes");
                }
            });
            //table.search('').draw();
        }
        
        $("#item-id").select2({ 
            dropdownParent: $("#add_item_produksi_view_model") 
        });

        
        $("#staf-id").select2({ 
            dropdownParent: $("#add_staff_produksi_view_model") 
        });
        
    });

    $(document).on('click', "#editStaffJob", function (e) {
        $('#sid').val($(this).attr('data-sid'));
        $('#staf-sid').val($(this).attr('data-sstaff-id'));
        $('#harga_sstaf').val($(this).attr('data-sprice'));
        $('#edit_staff_produksi_view_model').modal({backdrop: 'static', keyboard: false});       
    });
    $("#editProduksiStaff").on("click", function () {
        var id = 'id=' + $('#sid').val();
        var stafid = 'staff_id=' + $('#staf-sid').val();
        var price = 'price=' + $('#harga_sstaf').val();
        var jobid = 'staff_job_id=' + $('#staff-job-sid').val();
        
        var action_url = $('#edit_staff_produksi_view_model #action-surl').val();
        //console.log(jobid);
        //console.log(produkid);
        //console.log(harga);
        //console.log(mharga);
        //console.log(allqty);
        //console.log(qty);
        //console.log(action_url);
        editSItem(id, jobid, stafid, price, action_url);
    });

    function editSItem(id, jobid, stafid, price, action_url) {
        if ($("#notify").length == 0) {
            $("#c_body").html('<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>');
        }
        jQuery.ajax({
            url: baseurl + action_url,
            type: 'POST',
            data: id+'&'+jobid+'&'+stafid+'&'+price+'&' + crsf_token + '=' + crsf_hash,
            dataType: 'json',
            success: function (data) {
                if (data.status == "Success") {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                    sleep(15);
                    location.reload(true);
                } else {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-success").addClass("alert-danger").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                    //sleep(15);
                    //location.reload(true);
                }
            },
            error: function (data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
                $("html, body").scrollTop($("body").offset().top);
                //sleep(15);
                //location.reload(true);
            }
        });
    }
    ////////////////
    $(document).on('click', "#editItemJob", function (e) {
        $('#eid').val($(this).attr('data-eid'));
        $('#item-eid').val($(this).attr('data-eproduct-id'));
        $('#item-eqty').val($(this).attr('data-eqty'));
        $('#edit_item_produksi_view_model').modal({backdrop: 'static', keyboard: false});       
    });

    $("#editProduksiItem").on("click", function () {
        var id = 'id=' + $('#eid').val();
        var produkid = 'product_id=' + $('#item-eid').val();
        var qty = 'qty=' + $('#item-eqty').val();
        var action_url = $('#edit_item_produksi_view_model #action-eurl').val();
        //console.log(jobid);
        //console.log(produkid);
        //console.log(harga);
        //console.log(mharga);
        //console.log(allqty);
        //console.log(qty);
        //console.log(action_url);
        editTItem(id, produkid, qty, action_url);
    });

    function editTItem(id, produkid, qty, action_url) {
        if ($("#notify").length == 0) {
            $("#c_body").html('<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>');
        }
        jQuery.ajax({
            url: baseurl + action_url,
            type: 'POST',
            data: id+'&'+produkid+'&'+qty+'&' + crsf_token + '=' + crsf_hash,
            dataType: 'json',
            success: function (data) {
                if (data.status == "Success") {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                    sleep(15);
                    location.reload(true);
                } else {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-success").addClass("alert-danger").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                    //sleep(15);
                    //location.reload(true);
                }
            },
            error: function (data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
                $("html, body").scrollTop($("body").offset().top);
                //sleep(15);
                //location.reload(true);
            }
        });
    }
</script>