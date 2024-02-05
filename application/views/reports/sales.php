<div class="card border border-1 bg-light rounded-0 shadow">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0 text-dark">
            <h5><?php echo $this->lang->line('Sales') . ' ' . $this->lang->line('Data & Reports') ?></h5>
        </button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card border border-1">
                    <div class="card-body">
                        <button class="btn btn-primary rounded-0">
                            <?php echo $this->lang->line('Total') . ' ' . $this->lang->line('Sales') ?>
                            <span id="p1" class="font-large-x1 red float-xs-right"><i
                                    class=" icon-refresh spinner"></i></span>
                        </button>
                        <button class="btn btn-danger rounded-0">
                            <?php echo $this->lang->line('Total') . ' ' . $this->lang->line('Month') . ' ' . $this->lang->line('Sales') ?>
                            <span id="p2" class="font-large-x1 blue float-xs-right"><i
                                    class=" icon-refresh spinner"></i></span>
                        </button>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-warning rounded-0 text-dark mt-2">
                                    <span id="param1">xxxxxxxxxxxxxxxxxxx</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card border border-1  rounded-0">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card border border-1 shadow bg-light">
                    <div class="card-header">
                        <button class="btn btn-outline-warning rounded-0 text-dark">
                            <h5><?php echo $this->lang->line('Custom Range') . ' ' . $this->lang->line('Sales') ?></h5>
                        </button>
                    </div>
                    <div class="card-body">
                        <form method="post" id="product_action">
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
                                <input type="text" class="form-control rounded-0 required"
                                       placeholder="Start Date" name="sdate" id="sdate"
                                       data-toggle="datepicker" autocomplete="false">
                            </div>
                            <div class="form-group">
                                <label class="form-label"
                                       for="edate"><strong><?php echo $this->lang->line('To Date') ?></strong></label>
                                <input type="text" class="form-control rounded-0 required"
                                       placeholder="End Date" name="edate"
                                       data-toggle="datepicker" autocomplete="false">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="check" value="ok">
                                <input type="submit" id="calculate_profit" class="btn btn-primary rounded-0"
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
        var actionurl = baseurl + 'reports/customsales';
        actionCaculate(actionurl);
    });
    setTimeout(function () {
        $.ajax({
            url: baseurl + 'reports/fetch_data?p=sales',
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