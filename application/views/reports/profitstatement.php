<div class="card border border-1 bg-light rounded-0">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0 text-dark">
            <h5><?php echo $this->lang->line('Profit') . ' ' . $this->lang->line('Data') ?></h5>
        </button>
    </div>
    <div class="card-content">
        <div class="card-body">
            <div id="notify" class="alert alert-success bg-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <div class="message"></div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <button class="btn btn-primary rounded-0">
                        <?php echo $this->lang->line('Total') . ' ' . $this->lang->line('Profit') ?> 
                        <span id="p1" class="fs-4">
                            <i class=" fa fa-refresh spinner"></i>
                        </span>
                    </button>

                    <button class="btn btn-danger rounded-0">
                        <?php echo $this->lang->line('Total') . ' ' . $this->lang->line('Month') . ' ' . $this->lang->line('Profit') ?>
                        <span id="p2" class="fs-4">
                            <i class=" fa fa-refresh spinner"></i>
                        </span>
                    </button>
                    <button class="btn btn-warning rounded-0">
                        <span class="fs-4" id="param1">xxxxxxxxxxxxx</span>
                    </button>

                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="card border border-1 rounded-0 bg-light">
            <div class="card-header">
                <div class="card-body">
                <button class="btn btn-outline-warning rounded-0 mb-3">
                    <h6><?php echo $this->lang->line('Custom Range') ?></h6>
                </button>
                <div class="card border border-1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                
                                
                                <form method="post" id="product_action" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="form-label" for="pay_cat"><strong><?php echo $this->lang->line('Business Locations') ?></strong></label>
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
                                        <input type="text" class="form-control rounded-0 required" placeholder="Start Date" name="sdate" id="sdate" data-toggle="datepicker" autocomplete="false">

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="edate"><strong><?php echo $this->lang->line('To Date') ?></strong></label>
                                        <input type="text" class="form-control rounded-0 required" placeholder="End Date" name="edate" data-toggle="datepicker" autocomplete="false">

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"></label>
                                        <input type="hidden" name="check" value="ok">
                                        <input type="submit" id="calculate_profit" class="btn btn-success rounded-0"
                                               value="<?php echo $this->lang->line('Calculate') ?>"
                                               data-loading-text="Calculating...">
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
    $("#calculate_profit").click(function (e) {
        e.preventDefault();
        var actionurl = baseurl + 'reports/customprofit';
        actionCaculate(actionurl);
    });

    setTimeout(function () {
        $.ajax({
            url: baseurl + 'reports/fetch_data?p=profit',
            dataType: 'json',
            success: function (data) {
                $('#p1').html(data.p1);
                $('#p2').html(data.p2);

            },
            error: function (data) {
                $('#response').html('Error')
            }

        });
    }, 2000);
</script>