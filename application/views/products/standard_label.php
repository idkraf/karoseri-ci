<div class="card bprder border-1 bg-light">
    <div class="card-header">
        <h5><?php echo $this->lang->line('standard_label'); ?></h5>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>

    </div>
    <div class="card-content">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
        <div class="card-body">
            <?php
            $attributes = array('class' => 'form-horizontal form-simple', 'id' => 'login_form');
            echo form_open('products/standard_label');
            ?>
            <input type="hidden" name="act" value="add_product">
            <div class="row">
                <div class="col-md-4">
                    <div class="card border border-1">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label" for="product_cat"><strong><?php echo $this->lang->line('Warehouse'); ?></strong></label>
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
                                <label class="form-label"  for="pay_cat"><strong><?php echo $this->lang->line('Products') ?></strong></label>
                                <select id="products_l" name="products_l[]" class="form-select required select-box" multiple="multiple">

                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="standard_label"><strong><?php echo $this->lang->line('standard_label') ?></strong></label>
                                <select class="form-select rounded-0" name="standard_label">
                                    <option value="eu30019">EU30019 65</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <input type="submit" class="btn btn-primary float-end"
                           value="<?php echo $this->lang->line('Print') ?>"
                           data-loading-text="Adding...">

                </div>
            </div>
        </div>
        </form>
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

