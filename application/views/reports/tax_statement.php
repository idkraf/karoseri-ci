<div class="card border border-1  bg-light">
    <div class="card-header">
        <div class="btn btn-outline-warning rounded-0">
            <h5 class="text-dark"><?php echo $this->lang->line('TAX') . ' Statement' ?></h5>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card-body">
                    <div id="notify" class="alert alert-success" style="display:none;">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <div class="message"></div>
                    </div>
                    <div class="card border border-1">
                        <div class="card-body">
                            <form action="<?php echo base_url() ?>reports/taxviewstatement" method="post" role="form"><input
                                    type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                    value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <div class="form-group">
                                    <label class="form-label"
                                           for="ty"><strong><?php echo $this->lang->line('Type') ?></strong></label>
                                    <select name="ty" class="form-select rounded-0">
                                        <option value='Sales'>Sales TAX Report</option>
                                        <option value='Purchase'>Purchase TAX Report</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="sdate"><strong><?php echo $this->lang->line('From Date') ?></strong></label>
                                    <input type="text" class="form-control rounded-0 required"
                                           placeholder="Start Date" name="sdate" id="sdate"
                                           data-toggle="datepicker" autocomplete="false">
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="edate"><?php echo $this->lang->line('To Date') ?></label>
                                    <input type="text" class="form-control rounded-0 required"
                                           placeholder="End Date" name="edate"
                                           data-toggle="datepicker" autocomplete="false">
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="lid"><strong><?php echo $this->lang->line('Business Locations') ?></strong></label>
                                    <select name="lid" class="form-select rounded-0">
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
                                    <input type="submit" class="btn btn-primary" value="View">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#customer_statement").select2({
        minimumInputLength: 4,
        tags: [],
        ajax: {
            url: baseurl + 'search/customer_select',
            dataType: 'json',
            type: 'POST',
            quietMillis: 50,
            data: function (customer) {
                return {
                    customer: customer,
                    '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
        }
    });
</script>
