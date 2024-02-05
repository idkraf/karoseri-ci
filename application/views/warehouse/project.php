<div class="card no-border bg-light">    
    <div class="card-body no-border">
        <div class="card shadow shadow-lg mb-0">
            <div class="card-header no-border pb-0 pt-1">
                <h4> <?php echo $title ?></h4>
            </div>
        </div>
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div> 
        <table id="project" class="table table-striped table-bordered zero-configuration table-sm ">
                <thead>
                    <tr>
                        <th class="no-sort">#</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Vehicle</th>
                        <th>Job</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Stock Out</th>
                        <th>Indent</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="dataAddDelivery" role="dialog">
	<div class="modal-dialog  modal-fullscreen">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Delivery to Stockout</h4>
			</div>
			<div class="modal-body">
				<div class="box-body table-responsive">                    
                    <form method="post" id="data_form" class="form-horizontal">
                        <div class="col-md-12">
                            <input type="hidden" class="form-control rounded-0 txt_produksi_id">
                            <input type="hidden" class="form-control rounded-0 txt_account_id">
                            <div class="form-group">
                                <label class="form-label" for="code">Code</label>
                                <input  readonly type="text" placeholder="code"
                                        class="form-control rounded-0 required code_input" name="code" value="PDLV<?php echo date('Ymd'); ?><?php echo random_string('numeric', 4) ?>">
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" class="form-control d_input required"
                                    placeholder="" name="tanggal"
                                    data-toggle="datepicker" autocomplete="false">
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="form-label" for="customer">Customer </label>     
                                <input type="text" class="form-control rounded-0 txt_customer_id" name="customer_id" readonly>
                                <input type="text" class="form-control rounded-0 txt_customer_name" readonly>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="form-label" for="vehicle">Vehicle </label>     
                                <input type="hidden" class="form-control rounded-0 txt_vehicle_id" name="vehicle_id" readonly>
                                <input type="text" class="form-control rounded-0 txt_vehicle_name" readonly>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="form-label" for="job">Job </label>     
                                <input type="hidden" class="form-control rounded-0 txt_job_id" name="job_id" readonly>
                                <input type="text" class="form-control rounded-0 txt_job_name" readonly>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="form-label">Request </label>     
                                <input type="text" class="form-control rounded-0 txt_request" readonly>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="form-label">Indent </label>     
                                <input type="text" class="form-control rounded-0 txt_indent" readonly>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="form-label" for="item">Item </label>     
                                <button type="button" class="btn btn-info float-end" data-toggle="modal" data-target="#dataProduk"><b>----</b></button>
                                
                                <input type="text" class="form-control rounded-0 txt_produk_id" name="product_id" readonly>
                                <input type="text" class="form-control rounded-0 txt_produk_name" readonly>
                                <input type="text" class="form-control rounded-0 txt_produk_code" readonly>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="form-label">Qty </label>     
                                <input type="number" class="form-control rounded-0 txt_qty">
                            </div>
                            <div class="form-group">
                                <input type="submit" id="submit-data" class="btn btn-success float-end"
                                        value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('Add') ?>&nbsp;&nbsp;&nbsp;&nbsp;" data-loading-text="Adding...">
                                <input type="hidden" value="warehoust/update_project_stockout" id="action-url">
                            </div>
                        </div>
                    </form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="dataProduk" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Cari Data Produk</h4>
			</div>
			<div class="modal-body">
				<div class="box-body table-responsive">
					<table id="produk" class="table table-hover no-footer">
						<thead>
							<tr>
								<th>#</th>
								<th>Category</th>
								<th>Name</th>
								<th>Stock</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        draw_data();
        function draw_data() {            
            $('#project').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('warehouse/ajax_list_project') ?>",
                    'type': 'GET',
                    'data': {
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    }
                },
                'columnDefs': [
                    {
                        'targets': [0,1,2,3,4,5,6,7,8,9],
                        'orderable': false,
                    },
                ],
                dom: 'Blfrtip',
                lengthMenu: [20, 40, 80, 200, 500],    
            });
        };
    });

    $(document).on('click', ".edit-object", function (e) {	
        $('.txt_produksi_id').val($(this).attr('data-object-product-id'));
        //$('.txt_account_id').val($(this).attr('data-object-account-id')); 

        $('.txt_customer_id').val($(this).attr('data-object-customer-id'));
        $('.txt_customer_name').val($(this).attr('data-object-customer-name'));

        $('.txt_vehicle_id').val($(this).attr('data-object-vehicle-id'));
        $('.txt_vehicle_name').val($(this).attr('data-object-vehicle-name'));
        
        $('.txt_job_id').val($(this).attr('data-object-job-id'));
        $('.txt_job_name').val($(this).attr('data-object-job-name'));

        $('.txt_indent').val($(this).attr('data-object-indent'));
        $('.txt_request').val($(this).attr('data-object-request'));

        $('.txt_produk_id').val($(this).attr('data-object-product-id'));
        $('.txt_produk_code').val($(this).attr('data-object-product-code')); 
        $('.txt_produk_name').val($(this).attr('data-object-product-name')); 

    });
    
    $(document).on('click', ".pilih-produk", function (e) {	
        $('.txt_produk_id').val($(this).attr('data-object-id'));
        $('.txt_produk_code').val($(this).attr('data-object-code')); 
        $('.txt_produk_name').val($(this).attr('data-object-name')); 
    });
    
	
	$("#submit-data").on("click", function () {
        
        //var aid = 'account_id=' + $('.txt_account_id').val();
		var code = 'code=' + $('.code_input').val();
        var pid = 'produksi_id=' + $('.txt_produksi_id').val();
        var tid = 'product_id=' + $('.txt_produk_id').val();
		var cid = 'job_id=' + $('.txt_job_id').val();
        var vid = 'vehicle_id=' + $('.txt_vehicle_id').val();
		var cid = 'customer_id=' + $('.txt_customer_id').val();
		var date = 'qty=' + $('.txt_qty').val();
		var date = 'indent=' + $('.txt_indent').val();
		var date = 'tanggal=' + $('.tanggal').val();



        var action_url = $('#data_form #action-url').val();

		console.log(code);
		console.log(date);
		console.log(cid);
		console.log(vid);
		console.log(tid);
		console.log(pid);
		console.log(action_url);

		//addProduksi(code,date,datedue,cid,vid,tid,price,bbn,disc,taxpph,taxppn,total,totale,action_url);
	});

	function addProduksi(code,date,datedue,cid,vid,tid,price,bbn,disc,taxpph,taxppn,total,totale,action_url) {
        if ($("#notify").length == 0) {
            $("#c_body").html('<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>');
        }
        jQuery.ajax({
            url: baseurl + action_url,
            type: 'POST',
            data: code+'&'+date+'&'+datedue+'&'+cid+'&'+vid+'&'+tid+'&'+price+'&'+bbn+'&'+disc+'&'+taxpph+'&'+taxppn+'&'+total+'&'+totale+'&'+crsf_token+'='+crsf_hash,
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

    function resetProduk(){ 
        $('.txt_produk_id').val('');
        $('.txt_produk_code').val(''); 
        $('.txt_produk_name').val(''); 
    } 

	$('#dataProduk').on('shown.bs.modal', function (e) {
		resetProduk();
		$('#produk').DataTable({
			'processing': true,
			'serverSide': true,
			'stateSave': true,
			retrieve: true,
			'order': [],
			'ajax': {
				'url': "<?php echo site_url('warehouse/ajax_modal_product') ?>",
				'type': 'POST',
				'data': {
				}
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
</script>