<div class="card no-border bg-light">  
    
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>   
        <table id="templates" class="table table-striped table-bordered zero-configuration table-sm ">
                <thead>
                    <tr>
                        <th class="no-sort">
                            <a class="btn btn-success btn-sm add-template"><span class="icon-plus"></span></a>                        
                        
                        </th>
                        <th>Nama</th>
                        <th>Hari</th>
                        <th>Biaya Service</th>
                        <th>Jumlah Sparepart</th>
                        <th>Harga Sparepart</th>
                        <th>Cogs</th>
                        <th>Tax ppn</th>
                        <th>Tax pph</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
        </table>
    </div>
</div>

<div id="add_template_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Template</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="addtemplate_form">

                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">


                    <input type="hidden" id="action-url" value="template/add">

                    <div class="row">
                        <div class="col mb-1">
                            <label for="name"><?php echo $this->lang->line('Name') ?></label>
                            <input type="text" name="name" class="form-control tname">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-1">
                            <label for="price"><?php echo $this->lang->line('Price') ?></label>
                            <input type="number" name="price" class="form-control tprice">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="taxppn">Tax Ppn</label>
                            <input type="number" name="taxppn" placeholder="0.0" class="form-control ttaxppn">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="tax">Tax PPh</label>
                            <input type="number" name="tax" class="form-control ttax"  placeholder="0.0">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                <button type="button" id="simpanTemplate" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>

</div>

<div id="edit_template_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Template</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="edittemplate_form">

                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">


                    <input type="hidden" id="edit-id">

                    <input type="hidden" id="action-url" value="template/edit">

                    <div class="row">
                        <div class="col mb-1">
                            <label for="name"><?php echo $this->lang->line('Name') ?></label>
                            <input type="text" name="name" class="ename form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-1">
                            <label for="price"><?php echo $this->lang->line('Price') ?></label>
                            <input type="number" name="price" class="eprice form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="tax">Tax Pph</label>
                            <input type="number" name="tax" class="etax form-control"  placeholder="0.0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="taxppn">Tax Ppn</label>
                            <input type="number" name="taxppn" placeholder="0.0" class="etaxppn form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                <button type="button" id="editTemplate" class="btn btn-primary">Simpan</button>
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
                        Name: <span class="text-name"></span>
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
                    <input type="hidden" name="template_view_id" id="produksi-view-id" value="">

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
                                <th>Qty</th>
                                <th>Item</th>
                                <th>SubTotal</th>
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
                <div class="modal-body">
                    <form id="addjob_form">
                        <input type="hidden"
                            name="<?php echo $this->security->get_csrf_token_name(); ?>"
                            value="<?php echo $this->security->get_csrf_hash(); ?>">

                        <input type="hidden" name="template_id" id="produksi-id" value="">
                        <input type="hidden" id="action-url" value="template/add_job">
                        
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                    <button type="button" id="simpanProduksiJob" 
                        class="btn btn-primary"  data-toggle="modal" data-target="#add_job_produksi_view_model" data-dismiss="modal">Simpan</button>
                </div>
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
                <div class="modal-body">
                    <form id="addjob_form">
                        <input type="hidden"
                            name="<?php echo $this->security->get_csrf_token_name(); ?>"
                            value="<?php echo $this->security->get_csrf_hash(); ?>">

                        <input type="hidden" id="jid" value="">
                        <input type="hidden" name="template_id" id="etemplate-id" value="">
                        <input type="hidden" id="action-url" value="template/edit_job">
                        
                        <div class="form-group">
                            <label class="form-label" for="que">Que</label>
                            <input id="eque" type="number" placeholder="0"
                                    class="form-control rounded-0 required" name="que">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="day">Days</label>
                            <input id="eday" type="number" placeholder="0"
                                    class="form-control rounded-0 required" name="day">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="job">Job</label>                        
                            <select id="ejob-id" name="job_id" class="form-control">
                                <?php
                                foreach ($jobs as $row) {
                                    $cid = $row['id'];
                                    $title = $row['name'];
                                    echo "<option value='$cid'>$title</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                    <button type="button" id="editProduksiJob" 
                        class="btn btn-primary"  data-toggle="modal" data-target="#edit_job_produksi_view_model" data-dismiss="modal">Simpan</button>
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
                        Name: <span class="text-view-name"></span> 
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
                    <input type="hidden" name="produksi_id" id="template-view-id" value="">
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

<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Hapus Template</h4>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"> &nbsp;X&nbsp; </span></button>
            </div>
            <div class="modal-body">
                <p> Semua data job, item dan service akan terhapus</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="template/delete_t">
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
                <input type="hidden" id="action-url2" value="template/delete_j">
                <button type="button" data-dismiss="modal" class="btn btn-danger"
                        id="delete-confirm2"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-primary"><?php echo $this->lang->line('Cancel') ?></button>
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
    
    $(document).on('click', "#edit-template", function (e) {
        

        $('#edit-id').val($(this).attr('data-edit-id'));
        $('.ename').val($(this).attr('data-edit-name'));
        $('.eprice').val($(this).attr('data-edit-price'));
        $('.etaxppn').val($(this).attr('data-edit-ppn'));
        $('.etax').val($(this).attr('data-edit-pph'));

        $('#edit_template_modal').modal({backdrop: 'static', keyboard: false});       
    });

    
    $("#editTemplate").on("click", function () {
        var id = 'id=' + $('#edit-id').val();
        var name = 'name=' + $('.ename').val();
        var price = 'price=' + $('.eprice').val();
        var tax = 'tax=' + $('.etax').val();
        var taxppn = 'taxppn=' + $('.etaxppn').val();
        var action_url = $('#edittemplate_form #action-url').val();

        console.log(id);
        console.log(name);
        console.log(price);
        console.log(tax);
        console.log(taxppn);
        console.log(action_url);
        editTemplate(id, name, price, tax, taxppn, action_url);
    });

    function editTemplate(id,name, price, tax, taxppn, action_url) {
        if ($("#notify").length == 0) {
            $("#c_body").html('<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>');
        }
        jQuery.ajax({
            url: baseurl + action_url,
            type: 'POST',
            data: id+'&'+name+'&'+price+'&'+tax+'&'+taxppn+'&'+ crsf_token + '=' + crsf_hash,
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
                }
            },
            error: function (data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
                $("html, body").scrollTop($("body").offset().top);
            }
        });
    }
    
    $(document).on('click', ".add-template", function (e) {
        $('#add_template_modal').modal({backdrop: 'static', keyboard: false});       
    });
    $("#simpanTemplate").on("click", function () {
        var name = 'name=' + $('.tname').val();
        var price = 'price=' + $('.tprice').val();
        var tax = 'tax=' + $('.ttax').val();
        var taxppn = 'taxppn=' + $('.ttaxppn').val();
        var action_url = $('#addtemplate_form #action-url').val();

        console.log(name);
        console.log(price);
        console.log(tax);
        console.log(taxppn);
        console.log(action_url);
        addTemplate(name, price, tax, taxppn, action_url);
    });

    function addTemplate(name, price, tax, taxppn, action_url) {
        if ($("#notify").length == 0) {
            $("#c_body").html('<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>');
        }
        jQuery.ajax({
            url: baseurl + action_url,
            type: 'POST',
            data: name+'&'+price+'&'+tax+'&'+taxppn+'&'+ crsf_token + '=' + crsf_hash,
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
                }
            },
            error: function (data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
                $("html, body").scrollTop($("body").offset().top);
            }
        });
    }

    
    $('#add_job_produksi_view_model_').on('click', '#simpanProduksiJob_', function (e) {
        //e.prefentDefault();
        jQuery.ajax({
            url: "<?php echo site_url('template/add_job') ?>",
                    type: 'POST',
                    data: $("#addjob_form").serialize(),
                    dataType: 'json',
                    success: function (data) {
                       // $("#add_job_produksi_view_model").modal('hide');

                        $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                        $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                        $("html, body").animate({scrollTop: $('#notify').offset().top}, 1000);
                        location.reload(true);
                        //$('#' + $('#object-id').val()).add();
                    }
            });
    });

    $(document).on('click', "#editTemplateJob", function (e) {
        $('#jid').val($(this).attr('data-jid'));
        $('#etemplate-id').val($(this).attr('data-etid'));
        $('#ejob-id').val($(this).attr('data-ej-id'));
        $('#eque').val($(this).attr('data-eque'));
        $('#eday').val($(this).attr('data-eday'));        
        $('#edit_job_produksi_view_model').modal({backdrop: 'static', keyboard: false});       
    });

    $("#editProduksiJob").on("click", function () {
        var jid = 'id=' + $('#jid').val();
        var produksiid = 'template_id=' + $('#etempate-id').val();
        var jobid = 'job_id=' + $('#ejob-id').val();
        var que = 'que=' + $('#eque').val();
        var day = 'day=' + $('#eday').val();
        var action_url = $('#addjob_form #action-url').val();
        console.log(produksiid);
        console.log(jobid);
        console.log(que);
        console.log(day);
        console.log(action_url);
        editProduksiJob(id, produksiid, jobid, que, day, action_url);
    });

    function editProduksiJob(id, produksiid, jobid, que, day, action_url) {
        if ($("#notify").length == 0) {
            $("#c_body").html('<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>');
        }
        jQuery.ajax({
            url: baseurl + action_url,
            type: 'POST',
            data: id+'&'+produksiid+'&'+jobid+'&'+que+'&'+day+'&' + crsf_token + '=' + crsf_hash,
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
        var produksiid = 'template_id=' + $('#produksi-id').val();
        var jobid = 'job_id=' + $('#job-id').val();
        var que = 'que=' + $('#que').val();
        var day = 'day=' + $('#day').val();
        var action_url = $('#addjob_form #action-url').val();
        console.log(produksiid);
        console.log(jobid);
        console.log(que);
        console.log(day);
        console.log(action_url);
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
        //$('#produksi-id').val($(this).attr('data-produksi-id'));        
        //$('.kodeProduksi').append($(this).attr('data-produksi-code'));
        $('#add_job_produksi_view_model').modal({backdrop: 'static', keyboard: false});       
    });

    $(document).on('click', ".produksiJob", function (e) {  
        e.preventDefault();
        $('#produksi-view-id').val($(this).attr('data-object-id'));
        $('#produksi-id').val($(this).attr('data-object-id'));  
        $('.text-code').empty("");
        $('.text-name').empty("");
        $('.text-vname').empty("");
        $('.text-ppn').empty("");
        $('.text-pph').empty("");

        $('.text-code').append($(this).attr('data-object-code'));
        $('.text-name').append($(this).attr('data-object-name'));
        //$('.text-vname').append($(this).attr('data-object-vname'));
        $('.text-ppn').append($(this).attr('data-object-ppn'));
        $('.text-pph').append($(this).attr('data-object-pph'));

        $('#produksi_job_model').modal({backdrop: 'static', keyboard: false});

    });

    $('#produksi_job_model').on('shown.bs.modal', function (e) {
            console.log($("#produksi_job_model_form").serialize());
            var tid = $('#produksi-view-id').val();
            //$('#produksi-job-list').html('');
            $('#produksi-job-list').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                paging: false,
                destroy: true,
                searching: false,
                responsive: false,
                'ajax': {
                    'url': "<?php echo site_url('template/ajax_modal_produksi_job_list') ?>",
                    'type': 'POST',
                    'data': {
                        'tid': tid,
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    },
                    //'data': $("#produksi_job_model_form").serialize(),
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
                        'targets': [5,6],
                        'render': $.fn.dataTable.render.number(',', '.', 4, '')
                    },
                ],
                dom: 'Blfrtip',
                lengthMenu: [10, 20, 50, 100, 200, 500],
                buttons: [
                ],
            });

        });
            

    $(document).ready(function () {
        draw_data();

        function draw_data() {
            $('#templates').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('template/ajax_list') ?>",
                    'type': 'POST',
                    'data': {
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    }
                },
                'columnDefs': [
                    {
                        'targets': [0],
                        'width' :"10%",
                        'orderable': false,
                    },
                    {
                        'targets': [8],
                        'width' :"10%",
                        'orderable': false,
                    },
                    {
                        'targets': [3,5,6],
                        'render': $.fn.dataTable.render.number(',', '.', 4, '')
                    },
                    {
                        'targets': [4],
                        'render': $.fn.dataTable.render.number(',', '.', 3, '')
                    },
                ],
                dom: 'Blfrtip',
                lengthMenu: [10, 20, 50, 100, 200, 500],
                buttons: [
                    {
                        extend: 'excelHtml5',
                        footer: false,
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
                        }
                    }
                ],
            });
        };

        $(document).on('click', ".viewProduksi", function (e) {  
            e.preventDefault();
            
            $('.text-view-code').empty();
            $('.text-view-name').empty();
            $('.text-view-ppn').empty();
            $('.text-view-pph').empty();

            $('#template-view-id').val($(this).attr('data-view-id'));
            $('.text-view-name').append($(this).attr('data-view-name'));
            $('.text-view-ppn').append($(this).attr('data-view-ppn'));
            $('.text-view-pph').append($(this).attr('data-view-pph'));

            $('#produksi_view').modal({backdrop: 'static', keyboard: false});

        });

        $('#produksi_view').on('shown.bs.modal', function (e) {
            $.ajax({
                url: "<?php echo site_url('template/ajax_modal_produksi') ?>",
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
                            _html+= '<th class="th-qty" style="width: 70px">Day</th>';
                            _html+= '<th class="th-qty" style="width: 70px">Service</th>';
                            _html+= '<th class="th-qty" style="width: 70px">Qty</th>';
                            _html+= '<th class="th-qty" style="width: 70px">Item</th>';
                            _html+= '<th class="th-total2" style="width: 130px">SubTotal</th>';
                            _html+= '</tr>';
                            $('#produksi-list').append(_html);
                            
                            console.log(_arr.job_name);
                            _html = '<tr class="bg-info">';
                            _html+= '<td class="text-bold text-right">' + ++_j + '.</td>';
                            _html+= '<td class="text-bold">' + _arr.job_name + '</td>';
                            _html+= '<td class="text-right bg-gray">' + _numberFormat(_arr.day, 3) + '</td>';
                            _html+= '<td class="text-right bg-warning">' + _numberFormat(_arr.service, 3) + '</td>';
                            _html+= '<td class="text-right">' + _numberFormat(_arr.qty, 3) + '</td>';
                            _html+= '<td class="text-right bg-warning">' + _numberFormat(_arr.item, 3) + '</td>';
                            _html+= '<td class="text-bold text-right bg-red" style="font-weight:700;color:#fff; background-color: #dc3545 !important">' + _numberFormat(_arr.subtotal, 3) + '</td>';
                            _html+= '</tr>';
                            $('#produksi-list').append(_html);
                            
                            _html = '<tr>';
                            _html+= '<td>&nbsp;</td>';
                            _html+= '<td colspan="5" style="padding:0">';
                            _html+= '<table class="table table-bordered table-hover text-nowrap mt-2">';
                            _html+= '<tr class="bg-gray-light">';
                            _html+= '<th class="th-action1" style="width: 35px">#</th>';
                            _html+= '<th>Service</th>';
                            _html+= '<th class="th-qty" style="width: 70px">Subtotal</th>';
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
                            _html+= '<th class="th-qty" style="width: 70px">Qty</th>';
                            _html+= '<th class="th-qty" style="width: 70px">Price</th>';
                            _html+= '<th class="th-qty" style="width: 70px">Subtotal</th>';
                            _html+= '</tr>';
                            _k = 0;
                            $.each(_arr._item, function (_i2, _arr2) {
                                _html+= '<tr>';
                                _html+= '<td class="text-right">' + ++_k + '</td>';
                                _html+= '<td>' + _arr2.item_code + ' - ' + _arr2.item_name + '</td>';
                                _html+= '<td class="text-right">' + _numberFormat(_arr2.qty, 3) + '</td>';
                                _html+= '<td class="text-right">' + _numberFormat(_arr2.price, 3) + '</td>';
                                _html+= '<td class="bg-warning text-right text-bold">' + _numberFormat(_arr2.subtotal, 3) + '</td>';
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