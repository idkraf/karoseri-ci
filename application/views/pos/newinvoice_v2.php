<form method="post" id="data_form">
    <div class="row ">
        <div class="col-md-6">
            <div class="card shadow border border-1">
                <div class="card-body">
                    <div class="input-group">
                        <a href='#'
                           class="btn btn-primary  rounded-0 "
                           data-toggle="modal"
                           data-target="#Pos_addCustomer">
                            <i class="fa fa-plus-circle"></i> <?php echo $this->lang->line('Add') ?>
                        </a>
                        <input type="text" class="form-control rounded-0 mousetrap" name="cst"
                               id="pos-customer-box"
                               placeholder="<?php echo $this->lang->line('Enter Customer Name'); ?> "
                               autocomplete="off"/>
                    </div>

                    <div class="row ml-3">
                        <div id="customer-box-result" class="col-md-12"></div>
                        <div id="customer" class="col-md-12 ml-3">
                            <div class="clientinfo">
                                <input type="hidden" name="customer_id" id="customer_id" value="1">
                                <div id="customer_name"><?php echo $this->lang->line('Default'); ?>: <strong>Walk
                                        In </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="saman-row-pos" class="rqw mt-1">
                        <div class="col p-mobile">
                            <table id="pos_list" class="table-responsive tfr pos_stripe table-striped table-bordered table-sm">
                                <thead>
                                    <tr class="item_header bg-warning">
                                        <th width="10%"
                                            class="text-center"><?php echo $this->lang->line('Quantity') ?></th>
                                        <th width="20%"
                                            class="text-center"><?php echo $this->lang->line('Rate') ?></th>
                                        <th width="10%"
                                            class="text-center"><?php echo $this->lang->line('Tax(%)') ?></th>
                                        <th width="10%"
                                            class="text-center"><?php echo $this->lang->line('Discount') ?></th>
                                        <th width="10%" class="text-center">
                                            <?php echo $this->lang->line('Amount') ?>
                                        </th>
                                        <th width="5%" class="text-center"><?php echo $this->lang->line('Action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="pos_items">
                                </tbody>
                            </table>
                            <br>
                            <!--     <div class="row mt-1">
                                 <div class="col-3"<strong><?php echo $this->lang->line('Products') ?> </strong>
                                 </div>
                             <div class="col-6"><input type="hidden" value="0" id="total_items_count_val"
                                     ><span id="total_items_count"
                                             class="currenty lightMode danger  font-weight-bold">0</span>
         
                             </div>
                            </div>-->
                            <table class="table table-striped table-bordered table-sm">
                                <tr>
                                    <td>
                                        <input type="hidden" value="0" id="subttlform"
                                               name="subtotal"> <input type="hidden" value="0"
                                               id="custom_discount"><strong><?php echo $this->lang->line('Total Tax') ?></strong>
                                    </td>
                                    <td>
                                        <span
                                            class="currenty lightMode"><?php echo $this->config->item('currency'); ?></span>
                                        <span id="taxr" class="lightMode">0</span>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo $this->lang->line('Total Discount') ?></strong></td>
                                    <td><span
                                            class="currenty lightMode"><?php
                                                echo $this->config->item('currency');
                                                if (isset($_GET['project'])) {
                                                    echo '<input type="hidden" value="' . intval($_GET['project']) . '" name="prjid">';
                                                }
                                                ?></span>
                                        <span id="discs" class="lightMode">0</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo $this->lang->line('Shipping') ?></strong></td>
                                    <td><input type="text" class="form-control rounded-0 shipVal"
                                               onkeypress="return isNumber(event)"
                                               placeholder="Value"
                                               name="shipping" autocomplete="off"
                                               onkeyup="billUpyog()">

                                    </td>
                                    <td>( <?php echo $this->lang->line('Tax') ?> <?= $this->config->item('currency'); ?>
                                        <span id="ship_final">0</span> )</td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo $this->lang->line('Grand Total') ?>
                                            (<span
                                                class="currenty lightMode"><?php echo $this->config->item('currency'); ?></span>)</strong>
                                    </td>
                                    <td><input type="text" name="total" class="form-control rounded-0"
                                               id="invoiceyoghtml" readonly=""></td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>
                                        <strong> <?php echo $this->lang->line('Extra') . ' ' . $this->lang->line('Discount') ?></strong>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control rounded-0 discVal"
                                               onkeypress="return isNumber(event)"
                                               placeholder="Value"
                                               name="disc_val" autocomplete="off" value="0"
                                               onkeyup="billUpyog()">
                                        <input type="hidden" value="0"
                                               name="after_disc" id="after_disc">
                                    </td>
                                    <td>
                                        ( <?= $this->config->item('currency'); ?>
                                        <span id="disc_final">0</span> )
                                    </td>
                                </tr>
                            </table>


                        </div>




                        <?php if ($emp['key1']) { ?>
                            <div class="col">
                                <div class="form-group">
                                    <label for="employee"><strong><?php echo $this->lang->line('Employee') ?></strong></label>

                                    <select id="employee" name="employee" class="form-select rounded-0">
                                        <?php
                                        foreach ($employee as $row) {
                                            $cid = $row['id'];
                                            $title = $row['name'];
                                            echo "<option value='$cid'>$title</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="row mt-1">
                            <div class="col-md-12 text-center">
                                <a href="#" class="possubmit btn btn-lg btn-primary rounded-0" data-type="6"
                                   ><i class="fa fa-save"></i> <?php echo $this->lang->line('Draft') ?></a>
                                <a href="#" class="possubmit3 btn btn-lg btn-success rounded-0" data-type="6"
                                   data-toggle="modal"
                                   data-target="#basicPay"><i
                                        class="fa fa-money"></i> <?php echo $this->lang->line('Payment') ?>
                                </a>
                                <?php if ($enable_card['url']) { ?>
                                    <a href="#"
                                       class="possubmit2 btn btn-lg btn-danger rounded-0"
                                       data-type="4" data-toggle="modal"
                                       data-target="#cardPay"><i
                                            class="fa fa-credit-card"></i> <?php echo $this->lang->line('Card') ?>
                                    </a>
                                <?php } ?>

                            </div>
                        </div>

                        <div class="card border border-1 mt-2 text-center bg-light">
                            <div class="card-body">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="btn btn-primary rounded-0 mr-1" id="base-tab1" data-toggle="tab"
                                           aria-controls="tab1" href="#tab1" role="tab" aria-selected="false"><i
                                                class="fa fa-trophy"></i>
                                            <?php echo $this->lang->line('Coupon') ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="btn btn-success rounded-0 mr-1 mb-1" id="base-tab2" data-toggle="tab"
                                           aria-controls="tab2" href="#tab2" role="tab" aria-selected="false"><i
                                                class="icon-handbag"></i>
                                            <?php echo $this->lang->line('POS') . ' ' . $this->lang->line('Settings') ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="btn btn-danger rounded-0 mr-1 mb-1" id="base-tab3" data-toggle="tab"
                                           aria-controls="tab3" href="#tab3" role="tab" aria-selected="false"><i
                                                class="fa fa-save"></i> <?php echo $this->lang->line('Draft') ?>(s)</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="btn btn-warning rounded-0 mb-1" id="base-tab4" data-toggle="tab" aria-controls="tab4"
                                           href="#tab4" role="tab" aria-selected="false"><i class="fa fa-cogs"></i>
                                            <?php echo $this->lang->line('Invoice Properties') ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card border bg-light border-1 shadow">
                            <div class="card-body">
                                <div class="tab-content px-1 pt-1">
                            <div class="tab-pane" id="tab1" role="tabpanel" aria-labelledby="base-tab1">
                                <div class="input-group">
                                    <input type="text" class="form-control rounded-0"
                                           id="coupon" name="coupon"><input type="hidden"
                                           name="coupon_amount"
                                           id="coupon_amount"
                                           value="0">
                                    <span class="input-group-text"> 
                                        <button class="apply_coupon btn  btn-primary rounded-0"><?php echo $this->lang->line('Apply') ?></button>
                                    </span>
                                </div>
                                <input type="hidden" class="text-info" name="i_coupon" id="i_coupon"
                                       value="">
                                <span class="text-primary text-bold-600" id="r_coupon"></span>
                            </div>
                            <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="base-tab2">
                                <div class="row">
                                    <div class="col-4">
                                        <label><?php echo $this->lang->line('Warehouse') ?></label>
                                        <select
                                            id="warehouses"
                                            class="selectpicker form-select rounded-0">
                                                <?php
                                                echo $this->common->default_warehouse();
                                                echo '<option value="0">' . $this->lang->line('All')
                                                ?></option><?php
                                            foreach ($warehouse as $row) {
                                                echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label><?php echo $this->lang->line('Tax') ?></label>
                                        <select class="form-select rounded-0"  onchange="changeTaxFormat(this.value)" id="taxformat">
                                            <?php echo $taxlist; ?>
                                        </select>
                                    </div>
                                    <div class="col-4">  <label><?php echo $this->lang->line('Discount') ?></label>
                                        <select class="form-select rounded-0 teal"
                                                onchange="changeDiscountFormat(this.value)"
                                                id="discountFormat">

                                            <?php echo $this->common->disclist() ?>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="base-tab3">
                                <?php
                                foreach ($draft_list as $rowd) {
                                    echo '<li class="indigo p-1"><a href="' . base_url() . 'pos_invoices/draft?id=' . $rowd['id'] . '"> #' . $rowd['tid'] . ' (' . $rowd['invoicedate'] . ')</a></li>';
                                }
                                ?>
                            </div>
                            <div class="tab-pane" id="tab4" role="tabpanel" aria-labelledby="base-tab4">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="invocieno" class="caption"><?php echo $this->lang->line('Invoice Number') ?></label>
                                       <input type="text" class="form-control rounded-0" placeholder="Invoice #"
                                               name="invocieno" id="invocieno"
                                               value="<?php echo $lastinvoice + 1 ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="invocieno" class="caption"><?php echo $this->lang->line('Reference') ?></label>
                                        <input type="text" class="form-control rounded-0" placeholder="Reference #" name="refer">
                                    </div>


                                    <div class="col-sm-3">
                                        <label for="invociedate" class="caption"><?php echo $this->lang->line('Invoice Date'); ?></label>
                                        <input type="text" class="form-control required" placeholder="Billing Date" name="invoicedate" data-toggle="datepicker" autocomplete="false">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="invocieduedate" class="caption"><?php echo $this->lang->line('Invoice Due Date') ?></label>
                                        <input type="text" class="form-control rounded-0 required" id="tsn_due"
                                               name="invocieduedate"
                                               placeholder="Due Date" data-toggle="datepicker"
                                               autocomplete="false">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label><?php echo $this->lang->line('Payment Terms') ?></label> 
                                        <select
                                            name="pterms"
                                            class="selectpicker form-select rounded-0"><?php
                                                foreach ($terms as $row) {
                                                    echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
                                                }
                                                ?>

                                        </select>
                                        <?php
                                        if ($exchange['active'] == 1) {
                                            echo $this->lang->line('Payment Currency client')
                                            ?>
                                        <?php } ?>
                                        <?php if ($exchange['active'] == 1) {
                                            ?>
                                            <select name="mcurrency"
                                                    class="selectpicker form-select rounded-0">
                                                <option value="0">Default</option>
                                                <?php
                                                foreach ($currency as $row) {
                                                    echo '<option value="' . $row['id'] . '">' . $row['symbol'] . ' (' . $row['code'] . ')</option>';
                                                }
                                                ?>

                                            </select><?php } ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="toAddInfo" class="caption"><?php echo $this->lang->line('Invoice Note') ?></label>
                                        <textarea class="form-control rounded-0" name="notes" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow border border-1 bg-light">
                <div class="card-body p-4">
                    <div class="row">
                       <div class="col-md-9">
                            <input type="text" class="form-control text-center rounded-0 mousetrap"
                                   name="product_barcode"
                                   placeholder="Enter Product name, scan barcode " id="search_bar"
                                   autocomplete="off" autofocus="autofocus">
                        </div>
                        <div class="col-md-3  grey text-xs-center">
                            <select
                                id="categories"
                                class="form-select rounded-0 teal">
                                <option value="0"><?php echo $this->lang->line('All') ?></option><?php
                                foreach ($cat as $row) {
                                    $cid = $row['id'];
                                    $title = $row['title'];
                                    echo "<option value='$cid'>$title</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 pt-0" id="pos_item">
                            <!-- pos items -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="pos_invoices/action" id="action-url">
<input type="hidden" value="search" id="billtype">
<input type="hidden" value="0" name="counter" id="ganak">
<input type="hidden" value="<?php echo $this->config->item('currency'); ?>" name="currency">
<input type="hidden" value="<?= $taxdetails['handle']; ?>" name="taxformat" id="tax_format">
<input type="hidden" value="<?= $taxdetails['format']; ?>" name="tax_handle" id="tax_status">
<input type="hidden" value="yes" name="applyDiscount" id="discount_handle">
<input type="hidden" value="<?= $this->common->disc_status()['disc_format']; ?>" name="discountFormat"
       id="discount_format">
<input type="hidden" value="<?= amountFormat_general($this->common->disc_status()['ship_rate']); ?>" name="shipRate"
       id="ship_rate">
<input type="hidden" value="<?= $this->common->disc_status()['ship_tax']; ?>" name="ship_taxtype"
       id="ship_taxtype">
<input type="hidden" value="0" name="ship_tax" id="ship_tax">
</form>

<div id="shortkeyboard" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">ShortCuts</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>Alt+X</td>
                        <td>Focus to products search</td>
                    </tr>
                    <tr>
                        <td>Alt+C</td>
                        <td>Focus to customer search</td>
                    </tr>

                    <tr>
                        <td>Alt+S (twice)</td>
                        <td>PayNow + Thermal Print</td>
                    </tr>
                    <tr>
                        <td>Alt+Z</td>
                        <td>Make Card Payment</td>
                    </tr>
                    <tr>
                        <td>Alt+Q</td>
                        <td>Select First product</td>
                    </tr>
                    <tr>
                        <td>Alt+N</td>
                        <td>Create New Invoice</td>
                    </tr>


                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="Pos_addCustomer" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content ">
            <form method="post" id="product_action" class="form-horizontal">
                <!-- Modal Header -->
                <div class="modal-header bg-gradient-directional-info white">

                    <h4 class="modal-title" id="myModalLabel"><i
                            class="icon-user-plus"></i> <?php echo $this->lang->line('Add Customer') ?></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only"><?php echo $this->lang->line('Close') ?></span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p id="statusMsg"></p><input type="hidden" name="mcustomer_id" id="mcustomer_id" value="0">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5><?php echo $this->lang->line('Billing Address') ?></h5>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                       for="name"><?php echo $this->lang->line('Name') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Name"
                                           class="form-control margin-bottom" id="mcustomer_name" name="name" required>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                       for="phone"><?php echo $this->lang->line('Phone') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Phone"
                                           class="form-control margin-bottom" name="phone" id="mcustomer_phone">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                       for="email"><?php echo $this->lang->line('Email') ?></label>

                                <div class="col-sm-10">
                                    <input type="email" placeholder="Email"
                                           class="form-control margin-bottom" name="email"
                                           id="mcustomer_email">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                       for="address"><?php echo $this->lang->line('Address') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Address"
                                           class="form-control margin-bottom " name="address" id="mcustomer_address1">
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                       for="customergroup"><?php echo $this->lang->line('Group') ?></label>

                                <div class="col-sm-10">
                                    <select name="customergroup" class="form-control">
                                        <?php
                                        foreach ($customergrouplist as $row) {
                                            $cid = $row['id'];
                                            $title = $row['title'];
                                            echo "<option value='$cid'>$title</option>";
                                        }
                                        ?>
                                    </select>


                                </div>
                            </div>

                            <?php
                            if (is_array($custom_fields_c)) {
                                foreach ($custom_fields_c as $row) {
                                    if ($row['f_type'] == 'text') {
                                        ?>
                                        <div class="form-group row">

                                            <label class="col-sm-2 col-form-label"
                                                   for="docid"><?= $row['name'] ?></label>

                                            <div class="col-sm-8">
                                                <input type="text" placeholder="<?= $row['placeholder'] ?>"
                                                       class="form-control margin-bottom b_input"
                                                       name="custom[<?= $row['id'] ?>]">
                                            </div>
                                        </div>


                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                        <!-- shipping -->
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                    <input type="submit" id="mclient_add" class="btn btn-primary submitBtn" value="ADD"/ >
                </div>
            </form>
        </div>
    </div>
</div>
<!--card-->
<div class="modal fade" id="cardPay" role="dialog">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content ">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line('Make Payment') ?></h4>
                <button type="button" class="btn btn-danger rounded btn-sm" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    <span class="sr-only"><?php echo $this->lang->line('Close') ?></span></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <p id="statusMsg"></p>
                <form role="form" id="card_data">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-title mb-3">
                                <label for="cardNumber"><?php echo $this->lang->line('Payment Gateways') ?></label>
                                <select class="form-select rounded-0" name="gateway"><?php
                                    $surcharge_t = false;
                                    foreach ($gateway as $row) {
                                        $cid = $row['id'];
                                        $title = $row['name'];
                                        if ($row['surcharge'] > 0) {
                                            $surcharge_t = true;
                                            $fee = '(<span class="gate_total"></span>+' . amountFormat_s($row['surcharge']) . ' %)';
                                        } else {
                                            $fee = '';
                                        }
                                        echo "<option value='$cid'>$title $fee</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-success btn-lg btn-block"
                                    type="submit"
                                    id="pos_card_pay"
                                    data-type="2"><?php echo $this->lang->line('Paynow') ?></button>
                        </div>
                    </div>
                    <div class="form-group">

                        <?php if ($surcharge_t) echo '<br>' . $this->lang->line('Note: Payment Processing'); ?>

                    </div>
                    <div class="row" style="display:none;">
                        <div class="col-xs-12">
                            <p class="payment-errors"></p>
                        </div>
                    </div>

                    <input type="hidden" value="pos_invoices/action" id="pos_action-url">
                </form>
            </div>
            <!-- Modal Footer -->
        </div>
    </div>
</div>
<div class="modal fade" id="basicPay" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content ">
            <form method="post" id="basicpay_data" class="form-horizontal">
                <!-- Modal Header -->
                <div class="modal-header">

                    <h4 class="modal-title"><?php echo $this->lang->line('Make Payment') ?></h4>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only"><?php echo $this->lang->line('Close') ?></span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p id="statusMsg"></p>
                    <div class="text-center"><h1 id="b_total"></h1></div>
                    <div class="row">
                        <div class="col-6">
                            <div class="card-title">
                                <label for="cardNumber"><?php echo $this->lang->line('Amount') ?></label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control rounded-0"
                                        name="p_amount"
                                        placeholder="Amount" onkeypress="return isNumber(event)"
                                        id="p_amount" onkeyup="update_pay_pos()" inputmode="numeric"
                                        />
                                    <span class="input-group-addon"><i class="icon icon-cash"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card-title">
                                <label for="cardNumber"><?php echo $this->lang->line('Payment Method') ?></label>
                                <select class="form-select rounded-0" name="p_method" id="p_method">
                                    <option value='Cash'><?php echo $this->lang->line('Cash') ?></option>
                                    <option value='Card Swipe'><?php echo $this->lang->line('Card Swipe') ?></option>
                                    <option value='Bank'><?php echo $this->lang->line('Bank') ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="amount"><?php echo $this->lang->line('Balance Due') ?></label>
                                <input type="text" class="form-control rounded-0 red" name="amount" id="balance1"
                                       onkeypress="return isNumber(event)"
                                       value="0.00"
                                       required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="b_change"><?php echo $this->lang->line('Change') ?></label>
                                <input
                                    type="text"
                                    class="form-control rounded-0 green"
                                    name="b_change" id="change_p" value="0">
                            </div>
                        </div>
                    </div>
                    <?php if (PAC) { ?>
                        <div class="col">
                            <div class="form-group">
                                <label for="account_p"><?php echo $this->lang->line('Account') ?></label>

                                <select name="p_account" id="p_account" class="form-select rounded-0">
                                    <?php
                                    foreach ($acc_list as $row) {
                                        echo '<option value="' . $row['id'] . '">' . $row['holder'] . ' / ' . $row['acn'] . '</option>';
                                    }
                                    ?>
                                </select></div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-success btn-lg"
                                    type="submit"
                                    id="pos_basic_pay" data-type="4"> <?php echo $this->lang->line('Paynow') ?>
                            </button>
                            <button class="btn btn-primary btn-lg"
                                    type="submit"
                                    id="pos_basic_print" data-type="4"> <?php echo $this->lang->line('Paynow') ?>
                                + <?php echo $this->lang->line('Print') ?></button>
                        </div>
                    </div>

                    <div class="row" style="display:none;">
                        <div class="col-xs-12">
                            <p class="payment-errors"></p>
                        </div>
                    </div>
                    <!-- shipping -->
                </div>
                <!-- Modal Footer -->

            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="register" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content ">

            <!-- Modal Header -->
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Your Register') ?></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only"><?php echo $this->lang->line('Close') ?></span>
                </button>

            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="text-center m-1"><?php echo $this->lang->line('Active') ?> - <span id="r_date"></span></div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group  text-bold-600 green">
                            <label for="amount"><?php echo $this->lang->line('Cash') ?>
                                (<?= $this->config->item('currency'); ?>)
                            </label>
                            <input type="number" class="form-control green" id="r_cash"
                                   value="0.00"
                                   readonly>
                        </div>
                    </div>
                    <div class="col-5 col-md-5 pull-right">
                        <div class="form-group text-bold-600 blue">
                            <label for="b_change blue"><?php echo $this->lang->line('Card') ?></label>
                            <input
                                type="number"
                                class="form-control blue"
                                id="r_card" value="0" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group  text-bold-600 indigo">
                            <label for="amount"><?php echo $this->lang->line('Bank') ?>
                            </label>
                            <input type="number" class="form-control indigo" id="r_bank"
                                   value="0.00"
                                   readonly>
                        </div>
                    </div>
                    <div class="col-5 col-md-5 pull-right">
                        <div class="form-group text-bold-600 red">
                            <label for="b_change"><?php echo $this->lang->line('Change') ?>(-)</label>
                            <input
                                type="number"
                                class="form-control red"
                                id="r_change" value="0" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="display:none;">
                    <div class="col-xs-12">
                        <p class="payment-errors"></p>
                    </div>
                </div>
                <!-- shipping -->
            </div>
            <!-- Modal Footer -->
        </div>
    </div>
</div>
<div class="modal fade" id="close_register" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content ">
            <!-- Modal Header -->
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Close') ?><?php echo $this->lang->line('Your Register') ?></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only"><?php echo $this->lang->line('Close') ?></span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <a href="<?= base_url() ?>/register/close" class="btn btn-danger btn-lg btn-block"
                           type="submit"
                           ><i class="icon icon-arrow-circle-o-right"></i> <?php echo $this->lang->line('Yes') ?></a>
                    </div>
                    <div class="col-4"></div>
                </div>

            </div>
            <!-- Modal Footer -->
        </div>
    </div>
</div>
<div class="modal fade" id="stock_alert" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content ">

            <!-- Modal Header -->
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Stock Alert') ?> !</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only"><?php echo $this->lang->line('Close') ?></span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <div class="row p-1">
                    <div class="alert alert-danger mb-2" role="alert">
                        <strong>Oh snap!</strong> <?php echo $this->lang->line('order or edit the stock') ?>
                    </div>
                </div>

            </div>
            <!-- Modal Footer -->


        </div>
    </div>
</div>
<script type="text/javascript">
    $.ajax({
        url: baseurl + 'search_products/pos_search',
        dataType: 'html',
        method: 'POST',
        data: 'cid=' + $('#categories').val() + '&wid=' + $('#warehouses option:selected').val() + '&' + crsf_token + '=' + crsf_hash,
        success: function (data) {
            $('#pos_item').html(data);
        }
    });

    function update_register() {
        $.ajax({
            url: baseurl + 'register/status',
            dataType: 'json',
            success: function (data) {
                $('#r_cash').val(data.cash);
                $('#r_card').val(data.card);
                $('#r_bank').val(data.bank);
                $('#r_change').val(data.change);
                $('#r_date').text(data.date);
            }
        });
    }

    update_register();
    $(".possubmit").on("click", function (e) {
        e.preventDefault();
        var o_data = $("#data_form").serialize() + '&type=' + $(this).attr('data-type');
        var action_url = $('#action-url').val();
        addObject(o_data, action_url);
    });
    $(".possubmit2").on("click", function (e) {
        e.preventDefault();
        $('#card_total').val(Number($('#invoiceyoghtml').val()));
    });
    $(".possubmit3").on("click", function (e) {
        e.preventDefault();
        var roundoff = accounting.unformat($('#invoiceyoghtml').val(), accounting.settings.number.decimal);
<?php
$round_off = $this->custom->api_config(4);
if ($round_off['other'] == 'PHP_ROUND_HALF_UP') {
    echo ' roundoff=Math.ceil(roundoff);';
} elseif ($round_off['other'] == 'PHP_ROUND_HALF_DOWN') {
    echo ' roundoff=Math.floor(roundoff);';
}
?>
        $('#b_total').html(' <?= $this->config->item('currency'); ?> ' + accounting.formatNumber(roundoff));
        $('#p_amount').val(accounting.formatNumber(roundoff));
    });

    function update_pay_pos() {
        var am_pos = accounting.unformat($('#p_amount').val(), accounting.settings.number.decimal);
        var ttl_pos = accounting.unformat($('#invoiceyoghtml').val(), accounting.settings.number.decimal);
<?php
$round_off = $this->custom->api_config(4);
if ($round_off['other'] == 'PHP_ROUND_HALF_UP') {
    echo ' ttl_pos=Math.ceil(ttl_pos);';
} elseif ($round_off['other'] == 'PHP_ROUND_HALF_DOWN') {
    echo ' ttl_pos=Math.floor(ttl_pos);';
}
?>
        var due = parseFloat(ttl_pos - am_pos).toFixed(2);
        if (due >= 0) {
            $('#balance1').val(accounting.formatNumber(due));
            $('#change_p').val(0);
        } else {
            due = due * (-1)
            $('#balance1').val(0);
            $('#change_p').val(accounting.formatNumber(due));
        }
    }

    $('#pos_card_pay').on("click", function (e) {
        e.preventDefault();
        $('#cardPay').modal('toggle');
        $("#notify .message").html("<strong>Processing</strong>: .....");
        $("#notify").removeClass("alert-danger").addClass("alert-primary").fadeIn();
        $("html, body").animate({scrollTop: $('#notify').offset().top - 100}, 1000);
        var o_data = $("#data_form").serialize() + '&' + $("#card_data").serialize() + '&type=' + $(this).attr('data-type');
        var action_url = $('#action-url').val();
        addObject(o_data, action_url);
        update_register();
    });
    $('#pos_basic_pay').on("click", function (e) {
        e.preventDefault();
        $('#basicPay').modal('toggle');
        $("#notify .message").html("<strong>Processing</strong>: .....");
        $("#notify").removeClass("alert-danger").addClass("alert-primary").fadeIn();
        $("html, body").animate({scrollTop: $('#notify').offset().top - 100}, 1000);
        var o_data = $("#data_form").serialize() + '&p_amount=' + accounting.unformat($('#p_amount').val(), accounting.settings.number.decimal) + '&p_method=' + $("#p_method option:selected").val() + '&type=' + $(this).attr('data-type') + '&account=' + $("#p_account option:selected").val() + '&employee=' + $("#employee option:selected").val();
        var action_url = $('#action-url').val();
        addObject(o_data, action_url);
        setTimeout(
                function () {
                    update_register();
                }, 3000);
    });
    $('#pos_basic_print').on("click", function (e) {
        e.preventDefault();
        $('#basicPay').modal('toggle');
        $("#notify .message").html("<strong>Processing</strong>: .....");
        $("#notify").removeClass("alert-danger").addClass("alert-primary").fadeIn();
        $("html, body").animate({scrollTop: $('body').offset().top - 100}, 1000);
        var o_data = $("#data_form").serialize() + '&p_amount=' + accounting.unformat($('#p_amount').val(), accounting.settings.number.decimal) + '&p_method=' + $("#p_method option:selected").val() + '&type=' + $(this).attr('data-type') + '&printnow=1' + '&account=' + $("#p_account option:selected").val() + '&employee=' + $("#employee option:selected").val();
        var action_url = $('#action-url').val();
        addObject(o_data, action_url);
        setTimeout(
                function () {
                    update_register();
                }, 3000);
    });
</script>
<!-- Vendor libraries -->
<script type="text/javascript">
    var $form = $('#payment-form');
    $form.on('submit', payWithCard);
    /* If you're using Stripe for payments */
    function payWithCard(e) {
        e.preventDefault();
        /* Visual feedback */
        $form.find('[type=submit]').html('Processing <i class="fa fa-spinner fa-pulse"></i>')
                .prop('disabled', true);
        jQuery.ajax({
            url: '<?php echo base_url('billing/process_card') ?>',
            type: 'POST',
            data: $('#payment-form').serialize(),
            dataType: 'json',
            success: function (data) {
                $form.find('[type=submit]').html('Payment successful <i class="fa fa-check"></i>').prop('disabled', true);
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                $("html, body").animate({scrollTop: $('#notify').offset().top}, 1000);
            },
            error: function () {
                $form.find('[type=submit]').html('There was a problem').removeClass('success').addClass('error');
                /* Show Stripe errors on the form */
                $form.find('.payment-errors').text('Try refreshing the page and trying again.');
                $form.find('.payment-errors').closest('.row').show();
                $form.find('[type=submit]').html('Error! <i class="fa fa-exclamation-circle"></i>')
                        .prop('disabled', true);
                $("#notify .message").html("<strong>Error</strong>: Please try again!");
            }
        });
    }

    $(document).ready(function () {
        Mousetrap.bind('alt+x', function () {
            $('#search_bar').focus();
        });
        Mousetrap.bind('alt+c', function () {
            $('#pos-customer-box').focus();
        });
        Mousetrap.bind('alt+z', function () {
            $('.possubmit2').click();
        });
        Mousetrap.bind('alt+n', function () {
            window.location.href = "<?= base_url('pos_invoices/create') ?>";
        });
        Mousetrap.bind('alt+q', function () {
            $('#posp0').click();
            $('#search_bar').val('');
        });
        Mousetrap.bind('alt+s', function () {
            if ($('#basicPay').hasClass('in')) {
                $('#pos_basic_print').click();
            } else {
                $('.possubmit3').click();
            }
        });
        $('#search_bar').keypress(function (event) {
            if (event.keyCode == 13) {
                setTimeout(
                        function () {
                            $('#posp0').click();
                            $('#search_bar').val('');
                        }, 700);

            }
        });
    });
</script>