<div class="card shadow border border-1 bg-light">
    <div class="card-header">
        <h5>Add New Produksi</h5>
    </div>
    <div class="card-body">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="btn btn-danger btn-sm float-end" data-dismiss="alert">&nbsp;X&nbsp;</a>
            <div class="message"></div>
        </div>
        <div class="card-body border border-2">
            <div class="card-body">
                <form method="post" id="data_form" class="form-horizontal">
                    <div class="col-md-12">
                        <input type="hidden" class="form-control rounded-0 txt_produksi_id">
                        <input type="hidden" class="form-control rounded-0 txt_account_id">
                        <div class="form-group">
                            <label class="form-label" for="code">Code</label>
                            <input type="text" placeholder="code"
                                    class="form-control rounded-0 required code_input" name="code" value="PRO<?php echo date('Ymd'); ?><?php echo random_string('numeric', 4) ?>">
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

    $(document).on('click', ".pilih-item", function (e) {	
        $('.txt_produksi_id').val($(this).attr('data-object-product-id'));
        $('.txt_account_id').val($(this).attr('data-object-account-id')); 

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
        $('.txt_produk_id').val($(this).attr('data-object-product-id'));
        $('.txt_produk_code').val($(this).attr('data-object-product-code')); 
        $('.txt_produk_name').val($(this).attr('data-object-product-name')); 
    });

	
	$("#submit-data").on("click", function () {
        
        var pid = 'product_id=' + $('.txt_produksi_id').val();
        var aid = 'account_id=' + $('.txt_account_id').val();

		var code = 'code=' + $('.code_input').val();
		var date = 'tanggal=' + $('.tanggal').val();

		var cid = 'customer_id=' + $('.txt_customer_id').val();
        var vid = 'vehicle_id=' + $('.txt_vehicle_id').val();
        var tid = 'product_id=' + $('.txt_produk_id').val();
		var cid = 'job_id=' + $('.txt_job_id').val();


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
