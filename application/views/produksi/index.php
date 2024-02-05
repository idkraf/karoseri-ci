<div class="card no-border bg-light">    
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <table id="produksi" class="table table-striped table-bordered zero-configuration table-sm ">
                <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th><?php echo $this->lang->line('Code') ?></th>
                        <th><?php echo $this->lang->line('Customer') ?></th>
                        <th>Cogs</th>
                        <th><?php echo $this->lang->line('Price') ?></th>
                        <th>Disc</th>
                        <th>Tax ppn</th>
                        <th>Tax pph</th>
                        <th><?php echo $this->lang->line('Total') ?></th>
                        <th><?php echo $this->lang->line('Balance') ?></th>
                        <th class="no-sort">#</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
        </table>
    </div>
</div>

<div id="produksi_view_model" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Produksi</h4>
                <!-- button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button-->
            </div>
            <div class="modal-body">
                <form id="produksi_view_model_form">
                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="hidden" name="produksi_id" id="produksi-id" value="">
                    <table 
                        data-paging="false"
                        data-searching="false"
                        data-ordering="false"
                        id="produksi-view-list" class="table  zero-configuration table-lg ">
                        <thead>
                            <th class="no-sort">#</th>
                            <th>Job</th>
                            <th>Time</th>
                            <th>Indent</th>
                            <th>Qty</th>
                            <th><?php echo $this->lang->line('Total') ?></th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
            </div>
        </div>
    </div>

</div>

<div id="produksi_view" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <!-- h4 class="modal-title">Produksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button-->
                
                <div class="col-sm-12">                        
                    <h5 class="row">
                        <div class="col-sm-4" class="span text-bold">
                        Name: <span class="text-view-code"></span> -
                        <span class="text-view-name"></span> -
                        <span class="text-view-vname"></span>
                        </div>
                        <div class="col-sm-8 small text-bol" style="text-align: right;padding-right: 20px;">
                            Tax Ppn: <span class="text-view-ppn"></span> / Tax Pph: <span class="text-view-pph"></span>
                        </div>
                    </h5>
                </div>
            </div>
            <div class="modal-body" style="padding:0">
                <form id="produksi_view_form">
                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="hidden" name="produksi_id" id="produksi-view-id" value="">
                    <table 
                        data-paging="false"
                        data-searching="false"
                        data-ordering="false"
                        id="produksi-list" class="table small table-bordered table-hover text-nowrap m-0">
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
            </div>
        </div>
    </div>

</div>

<div id="produksi_job_model" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pekerjaan Produksi</h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                
            </div>

            <div class="modal-body">
                <div class="col-sm-12">                        
                    <div class="row">
                        <div class="col-sm-4" class="span text-bold">
                        Name: <span class="text-code"></span> -
                        <span class="text-name"></span> -
                        <span class="text-vname"></span>
                        </div>
                        <div class="col-sm-8 small text-bold" style="text-align: right;padding-right: 20px;">
                            Tax Ppn: <span class="text-ppn"></span> / Tax Pph<span class="text-pph"></span>
                        </div>
                    </div>
                </div>
                <form id="produksi_job_model_form">
                    
                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="hidden" name="produksi_id" id="produksi-view-id" value="">

                    <div class="box-body table-responsive">
                        <table 
                            data-paging="false"
                            data-searching="false"
                            data-ordering="false"
                            id="produksi-job-list" class="table table-hover no-footer">
                            <thead>                                
                                <th style="width: 35px">
                                    <a class="btn btn-success btn-sm addJobProduksi" data-toggle="modal" data-target="#produksi_job_model" data-dismiss="modal"><span class="icon-plus"></span></a>
                                </th>
                                <th>Job</th>
                                <th>Day</th>
                                <th>Service</th>
                                <th>Indent</th>
                                <th>Qty</th>
                                <th>Item</th>
                                <th style="width: 35px"></th>                                
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
            </div>
        </div>
    </div>

</div>

<div id="add_job_produksi_view_model" class="modal fade" style="z-index:1056">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pekerjaan <span class="kodeProduksi"></span></h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <form id="produksi_job_model_form">
                <div class="modal-body">
                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <input type="hidden" name="produksi_id" id="produksi-id" value="">
                    <input type="hidden" id="action-url" value="produksi/add_produksi_job">
                    
                    <div class="form-group">
                        <label class="form-label" for="que">Que</label>
                        <input id="que" type="number" placeholder="0"
                                class="form-control rounded-0 required" name="que">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="day">Days</label>
                        <input id="day" type="number" placeholder="0"
                                class="form-control rounded-0 required" name="day">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="job">Job</label>                        
                        <select id="job-id" name="job_id" class="form-control">
                            <?php
                            foreach ($jobs as $row) {
                                $cid = $row['id'];
                                $title = $row['name'];
                                echo "<option value='$cid'>$title</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                    <button type="button" id="simpanProduksiJob" 
                        class="btn btn-primary"  data-toggle="modal" data-target="#add_job_produksi_view_model" data-dismiss="modal">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="edit_job_produksi_view_model" class="modal fade" style="z-index:1056">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit <span class="kodeProduksi"></span></h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <form id="edit_job_model_form">
                <div class="modal-body">
                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <input type="hidden" name="id" id="jid" value="">
                    <input type="hidden" name="produksi_id" id="jproduksi-id" value="">
                    <input type="hidden" id="action-url" value="produksi/edit_produksi_job">
                    
                    <div class="form-group">
                        <label class="form-label" for="que">Que</label>
                        <input id="jque" type="number" placeholder="0"
                                class="form-control rounded-0 required" name="que">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="day">Days</label>
                        <input id="jday" type="number" placeholder="0"
                                class="form-control rounded-0 required" name="day">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="job">Job</label>                        
                        <select id="jjob-id" name="job_id" class="form-control">
                            <?php
                            foreach ($jobs as $row) {
                                $cid = $row['id'];
                                $title = $row['name'];
                                echo "<option value='$cid'>$title</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                    <button type="button" id="editProduksiJob" 
                        class="btn btn-primary"  data-toggle="modal" data-target="#edit_job_produksi_view_model" data-dismiss="modal">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="produksi_item_model" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Service & Produk dalam pekerjaan</h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                
            </div>

            <div class="modal-body">
                <div class="col-sm-12">                        
                    <div class="row">
                        <div class="col-sm-4" class="span text-bold">
                        Name: <span class="text-code"></span> -
                        <span class="text-name"></span> -
                        <span class="text-vname"></span>
                        </div>
                        <div class="col-sm-8 small text-bold" style="text-align: right;padding-right: 20px;">
                            Tax Ppn: <span class="text-ppn"></span> / Tax Pph<span class="text-pph"></span>
                        </div>
                    </div>
                </div>
                <form id="produksi_model_form">
                    
                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="hidden" name="cid" id="cid" value="">

                    <div class="box-body table-responsive">
                        <table 
                            data-paging="false"
                            data-searching="false"
                            data-ordering="false"
                            id="produksi-service" class="table table-hover no-footer responsive">
                            <thead>                                
                                <th>
                                    <a class="btn btn-success btn-sm addStaffroduksi" data-toggle="modal" data-target="#produksi_item_model" data-dismiss="modal"><span class="icon-plus"></span></a>
                                </th>
                                <th>Service</th>
                                <th>Subtotal</th>
                                <th>Payment</th>
                                <th>Balance</th>
                                <th></th>                                
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        
                        <table
                            data-paging="false"
                            data-searching="false"
                            data-ordering="false"
                            id="produksi-item" class="table table-hover no-footer responsive">
                            <thead>                                
                                <th style="width: 35px">
                                    <a class="btn btn-success btn-sm addItemProduksi" data-toggle="modal" data-target="#produksi_item_model" data-dismiss="modal"><span class="icon-plus"></span></a>
                                </th>
                                <th>Item</th>
                                <th>Indent</th>
                                <th>Qty</th>
                                <th>Cogs</th>
                                <th></th>                                
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
            </div>
        </div>
    </div>

</div>

<div id="add_item_produksi_view_model" class="modal fade" style="z-index:1056">
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

                    <input type="hidden" name="item_job_id" id="item-job-id" value="">
                    <input type="hidden" id="action-url" value="produksi/add_produksi_item">
                    
                    <input type="hidden" id="item-harga" value="0">
                    <input type="hidden" id="item-mharga" value="0">
                    <input type="hidden" id="item-diskon" value="0">
                    <input type="hidden" id="item-all-qty" value="0">

                    <div class="form-group">
                        <label class="form-label" for="job">Product</label>                        
                        <select id="item-id" name="item_id" class="form-control">
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
                    <div class="form-group">
                        <label class="form-label">Jumlah dari stok</label>
                        <input id="item-qty" type="number" placeholder="0"
                                class="form-control rounded-0 required" name="qty">
                    </div>
                    <!--div class="form-group">
                        <label class="form-label">Jumlah Indent</label>
                        <input id="indentItem" type="number" placeholder="0"
                                class="form-control rounded-0 required" name="indent">
                    </div-->
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

<div id="add_staff_produksi_view_model" class="modal fade" style="z-index:1056">
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


                    <input type="hidden" name="staff_job_id" id="staff-job-id" value="">
                    <input type="hidden" id="action-url" value="produksi/add_produksi_staff">
                    
                    <div class="form-group">
                        <label class="form-label" for="job">Staff</label>                        
                        <select id="staf-id" name="staf_id" class="form-control">
                            <?php
                            foreach ($staff as $row) {
                                $uid = $row['id'];
                                $utitle = $row['name'];
                                echo "<option value='$uid'>$utitle</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sub Total</label>
                        <input id="harga_staf" type="number" placeholder="0"
                                class="form-control rounded-0 required" name="staf_price">
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

<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Hapus Produksi</h4>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"> &nbsp;X&nbsp; </span></button>
            </div>
            <div class="modal-body">
                <p> Semua data job, item dan service ikut terhapus</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="produksi/delete_t">
                <button type="button" data-dismiss="modal" class="btn btn-danger"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-primary"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>

<div id="delete_model2" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Hapus Job</h4>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"> &nbsp;X&nbsp; </span></button>
            </div>
            <div class="modal-body">
                <p>Semua data item dan service ikut terhapus</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id2" value="">
                <input type="hidden" id="action-url2" value="produksi/delete_j">
                <button type="button" data-dismiss="modal" class="btn btn-danger"
                        id="delete-confirm2"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-primary"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $("#simpanProduksiItem").on("click", function () {
        var jobid = 'produksi_job_id=' + $('#item-job-id').val();
        var produkid = 'product_id=' + $('#item-id').val();
        var harga = 'harga=' + $('#item-harga').val();
        var mharga = 'mharga=' + $('#item-mharga').val();
        var allqty = 'allqty=' + $('#item-all-qty').val();
        var qty = 'qty=' + $('#item-qty').val();
        var action_url = $('#add_item_produksi_view_model #action-url').val();
        //console.log(jobid);
        //console.log(produkid);
        //console.log(harga);
        //console.log(mharga);
        //console.log(allqty);
        //console.log(qty);
        //console.log(action_url);
        addProduksiItem(jobid, produkid, harga, mharga, qty, allqty, action_url);
    });

    function addProduksiItem(jobid, produkid, harga, mharga, qty, allqty, action_url) {
        if ($("#notify").length == 0) {
            $("#c_body").html('<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>');
        }
        jQuery.ajax({
            url: baseurl + action_url,
            type: 'POST',
            data: jobid+'&'+produkid+'&'+harga+'&'+mharga+'&'+qty+'&'+allqty+'&' + crsf_token + '=' + crsf_hash,
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

    $("#simpanProduksiStaff").on("click", function () {
        var jobid = 'produksi_job_id=' + $('#staff-job-id').val();
        var stafid = 'staff_id=' + $('#staf-id').val();
        var price = 'price=' + $('#harga_staf').val();
        var action_url = $('#add_staff_produksi_view_model #action-url').val();
        addProduksiStaff(jobid, stafid, price, action_url);
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

    $(document).on('click', ".editJobProduksi", function (e) {
        $('#jid').val($(this).attr('data-jid')); 
        $('#jproduksi-id').val($(this).attr('data-jproduksi-id'));    
        $('#jque').val($(this).attr('data-jque'));    
        $('#jday').val($(this).attr('data-jday'));    
        $('#jjob-id').val($(this).attr('data-jjob-id'));        
        //$('.kodeProduksi').append($(this).attr('data-produksi-code'));
        $('#edit_job_produksi_view_model').modal({backdrop: 'static', keyboard: false});       
    });
    
    $(document).on('click', "#editProduksiJob", function (e) { 
        
        var jid = 'id=' + $('#jid').val();
        var produksiid = 'produksi_id=' + $('#jproduksi-id').val();
        var jobid = 'job_id=' + $('#jjob-id').val();
        var que = 'que=' + $('#jque').val();
        var day = 'day=' + $('#jday').val();
        var action_url = $('#edit_job_model_form #action-url').val(); 
        editJob(jid, produksiid, jobid, que, day, action_url);
    });
    function editJob(jid,produksiid, jobid, que, day, action_url) {
        if ($("#notify").length == 0) {
            $("#c_body").html('<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>');
        }
        jQuery.ajax({
            url: baseurl + action_url,
            type: 'POST',
            data: jid+'&'+produksiid+'&'+jobid+'&'+que+'&'+day+'&' + crsf_token + '=' + crsf_hash,
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


    $("#simpanProduksiJob").on("click", function () {
        var produksiid = 'produksi_id=' + $('#produksi-id').val();
        var jobid = 'job_id=' + $('#job-id').val();
        var que = 'que=' + $('#que').val();
        var day = 'day=' + $('#day').val();
        var action_url = $('#add_job_produksi_view_model #action-url').val();
        //$('#' + $('#object-id').val()).remove();
        addProduksiJob(produksiid, jobid, que, day, action_url);
    });

    function addProduksiJob(produksiid, jobid, que, day, action_url) {
        if ($("#notify").length == 0) {
            $("#c_body").html('<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>');
        }
        jQuery.ajax({
            url: baseurl + action_url,
            type: 'POST',
            data: produksiid+'&'+jobid+'&'+que+'&'+day+'&' + crsf_token + '=' + crsf_hash,
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


    $(document).on('click', ".addJobProduksi", function (e) {
        $('#produksi-id').val($(this).attr('data-produksi-id'));        
        //$('.kodeProduksi').append($(this).attr('data-produksi-code'));
        $('#add_job_produksi_view_model').modal({backdrop: 'static', keyboard: false});       
    });


    $(document).on('click', ".produksiJob", function (e) {  
        e.preventDefault();
        $('#produksi-id').val($(this).attr('data-job-id'));
        //$('#produksi-id').val($(this).attr('data-object-id'));
        $('.addJobProduksi').attr('data-produksi-id', $(this).attr('data-object-id'));
        $('.addJobProduksi').attr('data-produksi-code', $(this).attr('data-object-code'));
        $('.addJobProduksi').attr('data-produksi-name', $(this).attr('data-object-name'));
        
        $('.text-code').empty("");
        $('.text-name').empty("");
        $('.text-vname').empty("");
        $('.text-ppn').empty("");
        $('.text-pph').empty("");

        $('.text-code').append($(this).attr('data-object-code'));
        $('.text-name').append($(this).attr('data-object-name'));
        $('.text-vname').append($(this).attr('data-object-vname'));
        $('.text-ppn').append($(this).attr('data-object-ppn'));
        $('.text-pph').append($(this).attr('data-object-pph'));

        $('#produksi_job_model').modal({backdrop: 'static', keyboard: false});

    });

    $(document).on('click', ".addItemProduksi", function (e) {
        $('#item-job-id').val($(this).attr('data-produksi-id'));     
        $('#add_item_produksi_view_model').modal({backdrop: 'static', keyboard: false});       
    });

    $(document).on('click', ".addStaffroduksi", function (e) {
        $('#staff-job-id').val($(this).attr('data-produksi-id'));    
        $('#add_staff_produksi_view_model').modal({backdrop: 'static', keyboard: false});       
    });


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

    $(document).on('click', ".produksiItem", function (e) {  
        
        $('.addItemProduksi').attr('data-produksi-id', $(this).attr('data-job-id'));
        $('.addStaffroduksi').attr('data-produksi-id', $(this).attr('data-job-id'));
        $('#cid').val($(this).attr('data-job-id'));
        $('.text-item-code').empty("");
        $('.text-item-name').empty("");
        $('.text-item-vname').empty("");
        $('.text-item-ppn').empty("");
        $('.text-item-pph').empty("");

        //$('.text-item-code').append($(this).attr('data-view-code'));
        //$('.text-item-name').append($(this).attr('data-view-name'));
        //$('.text-item-vname').append($(this).attr('data-view-vname'));
        //$('.text-item-ppn').append($(this).attr('data-view-ppn'));
        //$('.text-item-pph').append($(this).attr('data-view-pph'));

        $('#produksi_item_model').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('click', ".viewProduksi", function (e) {  
        e.preventDefault();
        
        $('.text-view-code').empty();
        $('.text-view-name').empty();
        $('.text-view-vname').empty();
        $('.text-view-ppn').empty();
        $('.text-view-pph').empty()

        $('#produksi-view-id').val($(this).attr('data-view-id'));
        $('.text-view-code').append($(this).attr('data-view-code'));
        $('.text-view-name').append($(this).attr('data-view-name'));
        $('.text-view-vname').append($(this).attr('data-view-vname'));
        $('.text-view-ppn').append($(this).attr('data-view-ppn'));
        $('.text-view-pph').append($(this).attr('data-view-pph'));

        $('#produksi_view').modal({backdrop: 'static', keyboard: false});

    });

    $(document).ready(function () {            

        draw_data();

        function draw_data() {
            $('#produksi').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                //responsive: true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('produksi/ajax_list') ?>",
                    'type': 'POST',
                    'data': {
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    }
                },
                'columnDefs': [
                    {
                        'targets': [0],
                        'width':"1%",
                        'orderable': false,
                    },
                    {
                        'targets': [10],
                        'width':"1%",
                        'orderable': false,
                    },
                ],
                dom: 'Blfrtip',
                lengthMenu: [10, 20, 50, 100, 200, 500],
                buttons: [                    
                    {
                        text: 'Add Produksi',
                        action: function ( e, dt, node, config ) {
                           window.location = '<?php echo site_url('produksi/create') ?>'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        footer: false,
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }
                    }
                ],
            });
        };


        $('#produksi_view_model').on('shown.bs.modal', function (e) {
            $('#produksi-view-list').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                retrieve: true,
                'ajax': {
                    'url': "<?php echo site_url('produksi/ajax_modal_produksi_list') ?>",
                    'type': 'POST',
                    'data': $("#produksi_view_model_form").serialize(),
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
        });
            
        $('#produksi_job_model').on('shown.bs.modal', function (e) {
            $('#produksi-job-list').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                retrieve: true,
                'ajax': {
                    'url': "<?php echo site_url('produksi/ajax_modal_produksi_job_list') ?>",
                    'type': 'POST',
                    'data': $("#produksi_job_model_form").serialize(),
                },
                'columnDefs': [
                    {
                        'targets': [0],
                        'width': "5%",
                        'orderable': false,
                    },
                    {
                        'targets': [7],
                        'width': "10%",
                        'orderable': false,
                    },
                    {
                        'targets': [3,6],
                        'render': $.fn.dataTable.render.number(',', '.', 4, '')
                    },
                ],
                dom: 'Blfrtip',
                lengthMenu: [10, 20, 50, 100, 200, 500],
                buttons: [
                ],
            });

        });
      

        $('#produksi_item_model').on('shown.bs.modal', function (e){
            $('#produksi-service').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                paging: false,
                destroy: true,
                searching: false,
                responsive: false,
                //retrieve: true,
                'ajax': {
                    'url': "<?php echo site_url('produksi/ajax_modal_staff_list') ?>",
                    'type': 'POST',
                    'data': $("#produksi_model_form").serialize(),
                },
                'columnDefs': [
                    {
                        'targets': [0],
                        'width': "5%",
                        'orderable': false,
                    },
                    {
                        'targets': [5],
                        'width': "15%",
                        'orderable': false,
                    }
                ],
                dom: 'Blfrtip',
                lengthMenu: [10, 20, 50, 100, 200, 500],
                buttons: [
                ],
            });

            $('#produksi-item').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                paging: false,
                destroy: true,
                searching: false,
                responsive: false,
                retrieve: false,
                'ajax': {
                    'url': "<?php echo site_url('produksi/ajax_modal_item_list') ?>",
                    'type': 'POST',
                    'data': $("#produksi_model_form").serialize(),
                },
                'columnDefs': [
                    {
                        'targets': [0],
                        'width': "5%",
                        'orderable': false,
                    },
                    {
                        'targets': [5],
                        'width': "15%",
                        'orderable': false,
                    }
                ],
                dom: 'Blfrtip',
                lengthMenu: [10, 20, 50, 100, 200, 500],
                buttons: [
                ],
            });
        });

        $('#produksi_item_model__').on('shown.bs.modal', function (e){
            $.ajax({
                url: "<?php echo site_url('produksi/ajax_modal_staff_list') ?>",
                type: 'post', 
                dataType: 'json', 
                data: $("#produksi_model_form").serialize(),
                success: function (_json) {
                    console.log(_json);
                }
            });

            $.ajax({
                url: "<?php echo site_url('produksi/ajax_modal_item_list') ?>",
                type: 'post', 
                dataType: 'json', 
                data: $("#produksi_model_form").serialize(),
                success: function (_json) {
                    console.log(_json);
                }
            });
        });
          
        $('#produksi_view').on('shown.bs.modal', function (e) {
            $.ajax({
                url: "<?php echo site_url('produksi/ajax_modal_produksi') ?>",
                type: 'post', 
                dataType: 'json', 
                data: $("#produksi_view_form").serialize(),
                success: function (_json) {
                    if (_json.status) {
                        console.log(_json);
                        _j = 0;
                        $('#produksi-list').html('');
                        $.each(_json.data, function (_i, _arr) {

                            _html = '<tr class="bg-gray" style="background-color: #6c757d;color:#fff">';
                            _html+= '<th class="th-action1" style="width: 35px">#</th>';
                            _html+= '<th>Job</th>';
                            _html+= '<th class="th-qty" style="width: 70px">Time</th>';
                            _html+= '<th class="th-qty" style="width: 70px">Indent</th>';
                            _html+= '<th class="th-qty" style="width: 70px">Qty</th>';
                            _html+= '<th class="th-total2" style="width: 130px">Total</th>';
                            _html+= '</tr>';
                            $('#produksi-list').append(_html);
                            
                            console.log(_arr.job_name);
                            _html = '<tr class="bg-info">';
                            _html+= '<td class="text-bold text-right">' + ++_j + '.</td>';
                            _html+= '<td class="text-bold">' + _arr.job_name + '</td>';
                            _html+= '<td class="text-right">' + _numberFormat(_arr.service_qty, 3) + '</td>';
                            _html+= '<td class="text-right">' + _numberFormat(_arr.item_indent, 3) + '</td>';
                            _html+= '<td class="text-right">' + _numberFormat(_arr.item_qty, 3) + '</td>';
                            _html+= '<td class="text-bold text-right bg-gray-light text-red">' + _numberFormat(_arr.total, 4) + '</td>';
                            _html+= '</tr>';
                            $('#produksi-list').append(_html);
                            
                            _html = '<tr>';
                            _html+= '<td>&nbsp;</td>';
                            _html+= '<td colspan="5" style="padding:0">';
                            _html+= '<table class="table table-bordered table-hover text-nowrap mt-2">';
                            _html+= '<tr class="bg-gray-light">';
                            _html+= '<th class="th-action1" style="width: 35px">#</th>';
                            _html+= '<th>Service</th>';
                            _html+= '<th class="th-qty" style="width: 70px">Time</th>';
                            _html+= '</tr>';
                            _k = 0;
                            $.each(_arr._position, function (_i1, _arr1) {
                                _html+= '<tr>';
                                _html+= '<td class="text-right">' + ++_k + '</td>';
                                _html+= '<td>' + _arr1.staff_name + '</td>';
                                _html+= '<td class="text-right">' + _numberFormat(_arr1.qty, 3) + '</td>';
                                _html+= '</tr>';
                            });
                            _html+= '</table>';
                            _html+= '<table class="table table-bordered table-hover text-nowrap mt-2">';
                            _html+= '<tr class="bg-gray-light">';
                            _html+= '<th class="th-action1" style="width: 35px">#</th>';
                            _html+= '<th>Item</th>';
                            _html+= '<th class="th-qty" style="width: 70px">Indent</th>';
                            _html+= '<th class="th-qty" style="width: 70px">Qty</th>';
                            _html+= '</tr>';
                            _k = 0;
                            $.each(_arr._item, function (_i2, _arr2) {
                                _html+= '<tr>';
                                _html+= '<td class="text-right">' + ++_k + '</td>';
                                _html+= '<td>' + _arr2.item_code + ' - ' + _arr2.item_name + '</td>';
                                _html+= '<td class="text-right">' + _numberFormat(_arr2.indent, 3) + '</td>';
                                _html+= '<td class="bg-warning text-right text-bold">' + _numberFormat(_arr2.qty, 3) + '</td>';
                                _html+= '</tr>';
                            });
                            _html+= '</table>';
                            _html+= '</td>';
                            //_html+= '<td style="width: 35px">&nbsp;</td>';
                            _html+= '</tr>';
                            $('#produksi-list').append(_html);
                        });
                    }
                }
            });

        });
    });
</script>