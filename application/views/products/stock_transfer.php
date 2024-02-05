<div class="card shadow border border-1 rounded">
    <div class="card-header">
        <h5><?php echo $this->lang->line('Stock Transfer') ?></h5>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                <li><a data-action="close"><i class="ft-x"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card border border-2 bg-light">
                    <div class="card-body">
                        <form method="post" id="data_form" class="form-horizontal">
                            <input type="hidden" name="act" value="add_product">
                            <div class="form-group">
                                <label class="form-label"
                                       for="product_cat"><?php echo $this->lang->line('Transfer From') ?></label>
                                <select id="wfrom" name="from_warehouse" class="form-select rounded-0">
                                    <option value='0'>Select</option>
                                    <?php
                                    foreach ($warehouse as $row) {
                                        $cid = $row['id'];
                                        $title = $row['title'];
                                        echo "<option value='$cid'>$title</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label"
                                       for="pay_cat"><?php echo $this->lang->line('Products') ?></label>

                                <select id="products_l" name="products_l[]" class="form-select required select-box rounded-0"
                                        multiple="multiple">
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label"
                                       for="pay_cat"><?php echo $this->lang->line('Products') . ' ' . $this->lang->line('Qty') ?></label>
                                <input name="products_qty" class="form-control required rounded-0" type="text">
                                <small>Comma (,) separated</small>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="product_cat"><?php echo $this->lang->line('Transfer To') ?></label>
                                <select name="to_warehouse" class="form-select rounded-0">
                                    <?php
                                    foreach ($warehouse as $row) {
                                        $cid = $row['id'];
                                        $title = $row['title'];
                                        echo "<option value='$cid'>$title</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label"></label>
                                <div class="col-sm-4">
                                    <input type="submit" id="submit-data" class="btn btn-success"
                                           value="<?php echo $this->lang->line('Stock Transfer') ?>"
                                           data-loading-text="Adding...">
                                    <input type="hidden" value="products/stock_transfer" id="action-url">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#products_l").select2();
    $("#wfrom").on('change', function () {
        var tips = $('#wfrom').val();
        $("#products_l").select2({

            tags: [],
            ajax: {
                url: baseurl + 'products/stock_transfer_products?wid=' + tips,
                dataType: 'json',
                type: 'POST',
                quietMillis: 50,
                data: function (product) {

                    return {
                        product: product,
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash

                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.product_name,
                                id: item.pid
                            }
                        })
                    };
                },
            }
        });
    });
</script>

