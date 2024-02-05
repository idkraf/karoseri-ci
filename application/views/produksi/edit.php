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
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="code">Code</label>
                                <input type="text" placeholder="code"
                                       class="form-control rounded-0 required code_input" name="code" value="<?php echo $produksi['code'] ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="price">Price</label>
                                <input type="text" placeholder="0"
                                       class="form-control rounded-0 price_input" name="pice" value="<?php echo $produksi['price'] ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="bbn">BBN</label>
                                <input type="text" placeholder="0.000"
                                       class="form-control rounded-0  required bbn_input" name="bbn" value="<?php echo $produksi['bbn'] ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="disc">Disc</label>
                                <input type="text" placeholder="0"
                                       class="form-control rounded-0 required disc_input" name="disc" value="<?php echo $produksi['disc'] ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="tax">Tax</label>
                                <input type="text" placeholder="0"
                                       class="form-control rounded-0 required tax_input" name="tax" value="<?php echo $produksi['tax'] ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="taxppn">Tax</label>
                                <input type="text" placeholder="0"
                                       class="form-control rounded-0 required ppn_input" name="taxppn" value="<?php echo $produksi['taxppn'] ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="taxppn">Cogs R</label>
                                <input type="text" placeholder="0"
                                       class="form-control rounded-0 required total_input" name="total" value="<?php echo $produksi['total'] ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="taxppn">Cogs E</label>
                                <input type="text" placeholder="0"
                                       class="form-control rounded-0 required totale_input" name="total" value="<?php echo $produksi['totale'] ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" class="form-control d_input required"
                                    placeholder="" name="date"
                                    data-toggle="datepicker" autocomplete="false" value="<?php echo $produksi['date'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Datedue</label>
                                <input type="text" class="form-control due_input required"
                                    placeholder="" name="datedue"
                                    data-toggle="datepicker" autocomplete="false" value="<?php echo $produksi['datedue'] ?>">
                            </div>
                           <br>
                            <div class="form-group">
                                <label class="form-label" for="customer">Customer </label>     
                                <button type="button" class="btn btn-info float-end" data-toggle="modal" data-target="#dataCustomer"><b>Pilih Customer</b></button>
								
                                <input type="hidden" class="form-control rounded-0 txt_customer_id" name="customer_id" value="<?php echo $produksi['customer_id'] ?>" readonly>
                                <input type="text" class="form-control rounded-0 txt_customer_name" name="customer_name" value="<?php echo $produksi['cname'] ?>" readonly>
                                <input type="text" class="form-control rounded-0 txt_customer_code" name="customer_code" value="<?php echo $produksi['ccode'] ?>" readonly>
                           </div>
                           <br>
                            <div class="form-group">
                                <label class="form-label" for="vehicle">Vehicle </label>     
                                <button type="button" class="btn btn-info float-end" data-toggle="modal" data-target="#dataVehicle"><b>Pilih Vehicle</b></button>
                            
                                <input type="hidden" class="form-control rounded-0 txt_vehicle_id" name="vehicle_id" value="<?php echo $produksi['vehicle_id'] ?>" readonly>
                                <input type="text" class="form-control rounded-0 txt_vehicle_code" name="vehicle_code" value="<?php echo $produksi['vcode'] ?>" readonly>
                                <input type="text" class="form-control rounded-0 txt_vehicle_name" name="vehicle_name" value="<?php echo $produksi['vname'] ?>" readonly>
                           </div>
                           <br>
						   <input type="hidden" class="form-control produksi_id" name="produksi_id" value="<?php echo $produksi['id'] ?>" readonly>
                                

                            <div class="form-group">
                                <input type="submit" id="submit-data" class="btn btn-success float-end"
                                       value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('Edit') ?>&nbsp;&nbsp;&nbsp;&nbsp;" data-loading-text="Adding...">
                                <input type="hidden" value="produksi/edit" id="action-url">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
</div>


<div class="modal fade" id="dataCustomer" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Cari Data Customer</h4>
			</div>
			<div class="modal-body">
				<div class="box-body table-responsive">
					<table id="customer" class="table table-hover no-footer">
						<thead>
							<tr>
								<th></th>
								<th>Name</th>
								<th>Address</th>
								<th>City</th>
								<th>Telp</th>
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

<div class="modal fade" id="dataVehicle" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Cari Data Vehicle</h4>
			</div>
			<div class="modal-body">
				<div id="div_student">
					<div class="box-body table-responsive">
						<table id="vehicle" class="table table-hover no-footer">
							<thead>
								<tr>
									<th></th>
									<th>#</th>
									<th>Name</th>
									<th>Police</th>
									<th>Body</th>
									<th>Machine</th>
									<th>Colour</th>
									<th>Year</th>
								</tr>	
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="dataTemplate" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Cari Template</h4>
			</div>
			<div class="modal-body">
				<div class="box-body table-responsive">
					<table id="template" class="table table-hover no-footer">
						<thead>
							<tr>
								<th></th>
								<th>Name</th>
								<th>Price</th>
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

    $(document).on('click', ".pilih-customer", function (e) {	
        $('.txt_customer_id').val($(this).attr('data-object-cid'));
        $('.txt_customer_code').val($(this).attr('data-object-ccode')); 
        $('.txt_customer_name').val($(this).attr('data-object-cname')); 
    });

    $(document).on('click', ".pilih-template", function (e) {		
        $('.txt_template_id').val($(this).attr('data-object-tid'));
        $('.txt_template_name').val($(this).attr('data-object-tname')); 
    });

    $(document).on('click', ".pilih-vehicle", function (e) {    
	    $('.txt_vehicle_id').val($(this).attr('data-object-vid'));
        $('.txt_vehicle_code').val($(this).attr('data-object-vcode'));
        $('.txt_vehicle_name').val($(this).attr('data-object-vname') + ' | ' + $(this).attr('data-object-vpolice'));
    });
	
	$("#submit-data").on("click", function () {
        
		var id = 'produksi_id=' + $('.produksi_id').val();
		var code = 'code=' + $('.code_input').val();
		var date = 'date=' + $('.d_input').val();
		var datedue = 'datedue=' + $('.due_input').val();

		var cid = 'customer_id=' + $('.txt_customer_id').val();
        var vid = 'vehicle_id=' + $('.txt_vehicle_id').val();

		var price = 'price=' + $('.price_input').val();
		var bbn = 'bbn=' + $('.bbn_input').val();
		var disc = 'disc=' + $('.disc_input').val();

		var taxpph = 'tax=' + $('.tax_input').val();
		var taxppn = 'taxppn=' + $('.ppn_input').val();
		var total = 'total=' + $('.total_input').val();
		var totale = 'totale=' + $('.totale_input').val();

        var action_url = $('#data_form #action-url').val();

		console.log(code);
		console.log(date);
		console.log(datedue);
		console.log(cid);
		console.log(vid);
		console.log(price);
		console.log(bbn);
		console.log(disc);
		console.log(taxpph);
		console.log(taxppn);
		console.log(total);
		console.log(totale);
		console.log(action_url);

		addProduksi(id,code,date,datedue,cid,vid,price,bbn,disc,taxpph,taxppn,total,totale,action_url);
	});

	function addProduksi(id,code,date,datedue,cid,vid,price,bbn,disc,taxpph,taxppn,total,totale,action_url) {
        if ($("#notify").length == 0) {
            $("#c_body").html('<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>');
        }
        jQuery.ajax({
            url: baseurl + action_url,
            type: 'POST',
            data: id+'&'+code+'&'+date+'&'+datedue+'&'+cid+'&'+vid+'&'+price+'&'+bbn+'&'+disc+'&'+taxpph+'&'+taxppn+'&'+total+'&'+totale+'&'+crsf_token+'='+crsf_hash,
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

    function resetCustomer(){ 
        $('.txt_customer_id').val('');
        $('.txt_customer_code').val(''); 
        $('.txt_customer_name').val(''); 
    }
    function resetVehicle(){ 
        $('.txt_vehicle_id').val('');
        $('.txt_vehicle_code').val(''); 
        $('.txt_vehicle_name').val(''); 
    }
    function resetTemplate(){ 
        $('.txt_template_id').val('');
        //$('.txt_template_code').val(''); 
        $('.txt_template_name').val(''); 
    }    

	$('#dataCustomer').on('shown.bs.modal', function (e) {
		resetCustomer();
		$('#customer').DataTable({
			'processing': true,
			'serverSide': true,
			'stateSave': true,
			retrieve: true,
			'order': [],
			'ajax': {
				'url': "<?php echo site_url('customers/ajax_modal_list') ?>",
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
	
	$('#dataVehicle').on('shown.bs.modal', function (e) {
        resetVehicle(); 
		$('#vehicle').DataTable({
			'processing': true,
			'serverSide': true,
			'stateSave': true,
			retrieve: true,
			'order': [],
			'ajax': {
				'url': "<?php echo site_url('vehicle/ajax_modal_list') ?>",
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

	$('#dataTemplate').on('shown.bs.modal', function (e) {
		resetTemplate();
		$('#template').DataTable({
			'processing': true,
			'serverSide': true,
			'stateSave': true,
			retrieve: true,
			'order': [],
			'ajax': {
				'url': "<?php echo site_url('template/ajax_modal_list') ?>",
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
