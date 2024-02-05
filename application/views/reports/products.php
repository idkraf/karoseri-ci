<div class="card border border-1 shadow rounded-0 bg-light">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0 text-dark">
            <h5><?php echo $this->lang->line('Products') . ' ' . $this->lang->line('Sales') . ' ' . $this->lang->line('Report') ?></h5>
        </button>
    </div>
    <div class="card-body">
        <div id="notify" class="alert alert-success bg-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
        <div class="row">
            <div class="col-md-4 ">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary rounded-0" style="width:100%">
                            <?php echo $this->lang->line('Total') . ' ' . $this->lang->line('Sales') ?>
                            <span id="p3" class="font-large-x1 red float-xs-right"><i
                                    class=" icon-refresh spinner"></i></span>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-danger rounded-0 mt-2" style="width:100%">
                            <?php echo $this->lang->line('Total') . ' ' . $this->lang->line('Products') . ' ' . $this->lang->line('Qty') ?>
                            <span id="p1" class="font-large-x1 blue float-xs-right"><i
                                    class=" icon-refresh spinner"></i></span>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success rounded-0 mt-2" style="width:100%">
                            <?php echo $this->lang->line('Month') ?> 
                            <span id="p4"  class="font-large-x1 orange float-xs-right">
                                <i class=" icon-refresh spinner"></i></span>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-warning rounded-0 mt-2" style="width:100%">
                            <?php echo $this->lang->line('Month') . ' ' . $this->lang->line('Products') . ' ' . $this->lang->line('Qty') ?>
                            <span id="p2" class="font-large-x1 green float-xs-right"><i
                                    class=" icon-refresh spinner"></i></span>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-info rounded-0 mt-2 mb-2" style="width:100%">
                            <span id="param1">xxxxxxxxxxxxxxxxx</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border border-2 bg-light shadow rounded-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border border-1">
                            <div class="card-header">
                                <button class="btn btn-outline-warning rounded-0 text-dark" style="width:100%">
                                    <h5><?php echo $this->lang->line('Products') . ' ' . $this->lang->line('Sales') . ' ' . $this->lang->line('Custom Range') ?></h5>
                                </button>
                            </div>
                            <div class="card-body">
                                <form method="post" id="product_action" class="form-horizontal">
                                    <div>
                                        <div class="form-group">
                                            <label class="form-label"
                                                   for="pay_cat"><strong><?php echo $this->lang->line('Business Locations') ?></strong></label>
                                            <select name="pay_acc" class="form-select rounded-0">
                                                <option value='0'><?php echo $this->lang->line('All') ?></option>
                                                <?php
                                                foreach ($locations as $row) {
                                                    $cid = $row['id'];
                                                    $acn = $row['cname'];
                                                    $holder = $row['address'];
                                                    echo "<option value='$cid'>$acn - $holder</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="sdate"><strong><?php echo $this->lang->line('From Date') ?></strong></label>
                                            <input type="text" class="form-control rounded-0 required"
                                                   placeholder="Start Date" name="sdate" id="sdate"
                                                   data-toggle="datepicker" autocomplete="false">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label"  for="edate"><strong><?php echo $this->lang->line('To Date') ?></strong></label>
                                            <input type="text" class="form-control rounded-0 required"
                                                   placeholder="End Date" name="edate"
                                                   data-toggle="datepicker" autocomplete="false">
                                        </div>
                                        <div class="form-group text-center">
                                            <input type="hidden" name="check" value="ok">
                                            <input type="submit" id="calculate_p" class="btn btn-primary rounded-0"
                                                   value="<?php echo $this->lang->line('Calculate') ?>"
                                                   data-loading-text="Calculating...">
                                        </div>
                                    </div>
                                </form>
                            </div>    
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border border-1 rounded-0 ">
                            <div class="card-header">
                                <button class="btn btn-outline-warning rounded-0 text-dark" style="width:100%">
                                    <h5><?php echo $this->lang->line('Products') . ' ' . $this->lang->line('Sales') . ' ' . $this->lang->line('Custom Range') ?></h5>
                                </button>
                            </div>
                            <div class="card-body">
                                <form method="post" id="product_action2" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="form-label" for="pay_cat"><strong><?php echo $this->lang->line('Product Category') ?></strong></label>
                                        
                                            <select name="pay_acc" class="form-select rounded-0">
                                                <option value='0'><?php echo $this->lang->line('All') ?></option>
                                                <?php
                                                foreach ($cat as $row) {
                                                    $cid = $row['id'];
                                                    $title = $row['title'];
                                                    echo "<option value='$cid'>$title</option>";
                                                }
                                                ?>
                                            </select>
                                      
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="sdate"><strong><?php echo $this->lang->line('From Date') ?></strong></label>
                                        
                                            <input type="text" class="form-control rounded-0 date30 required"
                                                   placeholder="Start Date" name="sdate"
                                                   data-toggle="datepicker" autocomplete="false">
                                       
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"
                                               for="edate"><strong><?php echo $this->lang->line('To Date') ?></strong></label>
                                        
                                            <input type="text" class="form-control rounded-0 required"
                                                   placeholder="End Date" name="edate"
                                                   data-toggle="datepicker" autocomplete="false">
                                        
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label"></label>
                                        <div class="col-sm-4">
                                            <input type="hidden" name="check" value="ok">
                                            <input type="submit" id="calculate_p_pc" class="btn btn-primary rounded-0"
                                                   value="<?php echo $this->lang->line('Calculate') ?>"
                                                   data-loading-text="Calculating...">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
</div>
<script type="text/javascript">
    $("#calculate_p").click(function (e) {
        e.preventDefault();
        var actionurl = baseurl + 'reports/customproducts';
        actionCaculate(actionurl);
    });

    $("#calculate_p_pc").click(function (e) {
        e.preventDefault();
        var actionurl = baseurl + 'reports/customproducts_cat';
        actionCaculate(actionurl, '#product_action2');
    });

    setTimeout(function () {
        $.ajax({
            url: baseurl + 'reports/fetch_data?p=products',
            dataType: 'json',
            success: function (data) {
                $('#p1').html(data.p1);
                $('#p2').html(data.p2);
                $('#p3').html(data.p3);
                $('#p4').html(data.p4);
            },
            error: function (data) {
                $('#response').html('Error')
            }

        });
    }, 2000);
</script>