<div class="card border border-1 bg-light  rounded-0">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0 text-dark">
            <h5><?php echo $this->lang->line('Commission') . ' ' . $this->lang->line('Data') ?></h5>
        </button>
    </div>
    <div class="card-body">
        <div id="notify" class="alert alert-success bg-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
        <button class="btn btn-danger rounded-0 mb-2">
            <span id="param1">xxxxxxxxxxxxxxxxxx</span>
        </button>
        <div class="row">
            <div class="col-md-4">
                <div class="card border border-1">
                    <div class="card-header">
                        <button class="btn btn-outline-warning rounded-0" style="width: 100%">
                            <h6><?php echo $this->lang->line('Custom Range') ?></h6>
                        </button>
                    </div>
                    <div class="card-body">
                        <form method="post" id="product_action">
                            <div class="form-group">
                                <label class="form-label" for="pay_cat"><strong><?php echo $this->lang->line('Employee') ?></strong></label>
                                <select name="pay_acc" class="form-select rounded-0">
                                    <?php
                                    foreach ($employee as $row) {
                                        $cid = $row['id'];
                                        $name = $row['name'];

                                        echo "<option value='$cid'>$name</option>";
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
                                <label class="form-label rounded-0" for="edate"><?php echo $this->lang->line('To Date') ?></label>
                                <input type="text" class="form-control rounded-0 required"
                                       placeholder="End Date" name="edate"
                                       data-toggle="datepicker" autocomplete="false">
                            </div>
                            <div class="form-group">
                               <input type="hidden" name="check" value="ok">
                                <input type="submit" id="calculate_profit" class="btn btn-primary"
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
<script type="text/javascript">
    $("#calculate_profit").click(function (e) {
        e.preventDefault();
        var actionurl = baseurl + 'reports/commission';
        actionCaculate(actionurl);
    });
</script>