<div class="card border border-1 shadow bg-light">
    <div class="card-header">
        <a href='#' class="btn btn-primary btn-sm rounded" data-toggle="modal"  data-target="#addCustomer"><?php echo $this->lang->line('Add Client'); ?></a>
    </div>
    <div class="card-body">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
        <div class="card-body">
            <form method="post" id="data_form">
                <div class="row">
                    <div class="col-sm-6 cmp-pnl">
                        <div id="customerpanel" class="card border border-1 shadow ">
                            <div class="card-header">
                                <div class="row">
                                    <div class="fcol-sm-12">
                                        <h3 class="title"><?php echo $this->lang->line('Bill To') ?> </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="frmSearch col-sm-12">
                                        <label for="cst" class="caption"><?php echo $this->lang->line('Search Client'); ?></label>
                                        <input type="text" class="form-control rounded-0" name="cst" id="customer-box"
                                               placeholder="Enter Customer Name or Mobile Number to search"
                                               autocomplete="off"/>
                                        <div id="customer-box-result"></div>
                                    </div>
                                </div>
                                <div id="customer">
                                    <div class="clientinfo">
                                        <?php echo $this->lang->line('Client Details'); ?>

                                        <input type="hidden" name="customer_id" id="customer_id" value="0">
                                        <div id="customer_name"></div>
                                    </div>
                                    <div class="clientinfo">
                                        <div id="customer_address1"></div>
                                    </div>
                                    <div class="clientinfo">
                                        <div id="customer_phone"></div>
                                    </div>

                                    <div id="customer_pass"></div>
                                    <strong><?php echo $this->lang->line('Warehouse') ?></strong> 
                                    <select id="s_warehouses"   class="selectpicker form-select rounded-0">
                                        <?php
                                        echo $this->common->default_warehouse();
                                        echo '<option value="0">' . $this->lang->line('All')
                                        ?></option>
                                        <?php
                                        foreach ($warehouse as $row) {
                                            echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 cmp-pnl">
                        <div class="card border border-1 shadow">
                            <div class="card-header">
                                <h3 class="title"><?php echo $this->lang->line('New Subscription') ?></h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="invocieno" class="caption"><?php echo $this->lang->line('Invoice Number') ?></label>
                                        
                                            <input type="text" class="form-control rounded-0" placeholder="Invoice #"
                                                   name="invocieno"
                                                   value="<?php echo $lastinvoice + 1 ?>">
                                       
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="invocieno" class="caption"><?php echo $this->lang->line('Reference') ?></label>
                                        <input type="text" class="form-control rounded-0" placeholder="Reference #" name="refer">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="invociedate" class="caption"><?php echo $this->lang->line('Invoice Date'); ?></label>
                                        <input type="text" class="form-control rounded-0 required" placeholder="Billing Date" name="invoicedate" data-toggle="datepicker" autocomplete="false">
                                       
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="invocieduedate" class="caption"><?php echo $this->lang->line('Next Payment After') ?></label>
                                        <select  name="reccur" class="selectpicker form-select rounded-0">
                                            <option value="7 day">7 <?php echo $this->lang->line('Days') ?></option>
                                            <option value="14 day">14 <?php echo $this->lang->line('Days') ?></option>
                                            <option value="28 day">28 <?php echo $this->lang->line('Days') ?></option>
                                            <option value="30 day">30 <?php echo $this->lang->line('Days') ?></option>
                                            <option value="45 day">45 <?php echo $this->lang->line('Days') ?></option>
                                            <option value="2 month">2 <?php echo $this->lang->line('Months') ?></option>

                                            <option value="3 month">3 <?php echo $this->lang->line('Months') ?></option>
                                            <option value="6 month">6 <?php echo $this->lang->line('Months') ?></option>
                                            <option value="9 month">9 <?php echo $this->lang->line('Months') ?></option>
                                            <option value="1 year">1 <?php echo $this->lang->line('Year') ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="taxformat" class="caption"><?php echo $this->lang->line('Tax') ?></label>
                                        <select class="form-select rounded-0"  onchange="changeTaxFormat(this.value)"  id="taxformat">
                                          <?php echo $taxlist; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="discountFormat"  class="caption"><?php echo $this->lang->line('Discount') ?></label>
                                            <select class="form-select rounded-0" onchange="changeDiscountFormat(this.value)"  id="discountFormat">
                                                <?php echo $this->common->disclist() ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="toAddInfo" class="caption"><?php echo $this->lang->line('Invoice Note') ?></label>
                                        <textarea class="form-control rounded-0" name="notes" rows="2"></textarea></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div id="saman-row">
                    <table class="table-responsive tfr my_stripe table-striped table-hover table-sm table-bordered">
                        <thead>
                            <tr class="item_header bg-warning white">
                                <th width="30%" class="text-center"><?php echo $this->lang->line('Item Name') ?></th>
                                <th width="8%" class="text-center"><?php echo $this->lang->line('Quantity') ?></th>
                                <th width="10%" class="text-center"><?php echo $this->lang->line('Rate') ?></th>
                                <th width="10%" class="text-center"><?php echo $this->lang->line('Tax(%)') ?></th>
                                <th width="10%" class="text-center"><?php echo $this->lang->line('Tax') ?></th>
                                <th width="7%" class="text-center"><?php echo $this->lang->line('Discount') ?></th>
                                <th width="10%" class="text-center">
                                    <?php echo $this->lang->line('Amount') ?>
                                    (<?php echo $this->config->item('currency'); ?>)
                                </th>
                                <th width="5%" class="text-center"><?php echo $this->lang->line('Action') ?></th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="product_name[]"
                                           placeholder="<?php echo $this->lang->line('Enter Product name') ?>"
                                           id='productname-0'>
                                </td>
                                <td>
                                    <input type="text" class="form-control req amnt" name="product_qty[]" id="amount-0"
                                           onkeypress="return isNumber(event)" onkeyup="rowTotal('0'), billUpyog()"
                                           autocomplete="off" value="1"></td>
                                <td><input type="text" class="form-control req prc" name="product_price[]" id="price-0"
                                           onkeypress="return isNumber(event)" onkeyup="rowTotal('0'), billUpyog()"
                                           autocomplete="off"></td>
                                <td><input type="text" class="form-control vat " name="product_tax[]" id="vat-0"
                                           onkeypress="return isNumber(event)" onkeyup="rowTotal('0'), billUpyog()"
                                           autocomplete="off"></td>
                                <td class="text-center" id="texttaxa-0">0</td>
                                <td><input type="text" class="form-control discount" name="product_discount[]"
                                           onkeypress="return isNumber(event)" id="discount-0"
                                           onkeyup="rowTotal('0'), billUpyog()" autocomplete="off"></td>
                                <td><span class="currenty"><?php echo $this->config->item('currency'); ?></span>
                                    <strong><span class='ttlText' id="result-0">0</span></strong></td>
                                <td class="text-center">

                                </td>
                        <input type="hidden" name="taxa[]" id="taxa-0" value="0">
                        <input type="hidden" name="disca[]" id="disca-0" value="0">
                        <input type="hidden" class="ttInput" name="product_subtotal[]" id="total-0" value="0">
                        <input type="hidden" class="pdIn" name="pid[]" id="pid-0" value="0">
                        <input type="hidden" name="unit[]" id="unit-0" value="">
                        <input type="hidden" name="hsn[]" id="hsn-0" value="">
                        </tr>
                        <tr>
                            <td colspan="8">
                                <textarea id="dpid-0" class="form-control" name="product_description[]"
                                                      placeholder="<?php echo $this->lang->line('Enter Product description'); ?>"
                                                      autocomplete="off"></textarea><br></td>
                        </tr>

                        <tr class="last-item-row sub_c">
                            <td class="add-row">
                                <button type="button" class="btn btn-success" id="addproduct">
                                    <i class="fa fa-plus-square"></i> <?php echo $this->lang->line('Add Row') ?>
                                </button>
                            </td>
                            <td colspan="7"></td>
                        </tr>

                        <tr class="sub_c" style="display: table-row;">
                            <td colspan="6" align="right">
                                <input type="hidden" value="0" id="subttlform"
                                                                 name="subtotal"><strong><?php echo $this->lang->line('Total Tax') ?></strong>
                            </td>
                            <td align="left" colspan="2" class="bg-primary text-white">
                                <span class="currenty lightMode"><?php echo $this->config->item('currency'); ?></span>
                                <span id="taxr" class="lightMode">0</span></td>
                        </tr>
                        <tr class="sub_c" style="display: table-row;">
                            <td colspan="6" align="right">
                                <strong><?php echo $this->lang->line('Total Discount') ?></strong></td>
                            <td align="left" colspan="2" class="bg-info text-white"><span
                                    class="currenty lightMode"><?php
                                        echo $this->config->item('currency');
                                        if (isset($_GET['project'])) {
                                            echo '<input type="hidden" value="' . intval($_GET['project']) . '" name="prjid">';
                                        }
                                        ?></span>
                                <span id="discs" class="lightMode">0</span></td>
                        </tr>

                        <tr class="sub_c" style="display: table-row;">
                            <td colspan="6" align="right">
                                <strong><?php echo $this->lang->line('Shipping') ?></strong></td>
                            <td align="left" colspan="2" class="bg-warning text-white">
                                <input type="text" class="form-control rounded-0 border border-1 border-primary shipVal"
                                                                onkeypress="return isNumber(event)"
                                                                placeholder="Value"
                                                                name="shipping" autocomplete="off"
                                                                onkeyup="billUpyog()">
                                ( <?php echo $this->lang->line('Tax') ?> <?= $this->config->item('currency'); ?>
                                <span id="ship_final">0</span> )
                            </td>
                        </tr>

                        <tr class="sub_c" style="display: table-row;">
                            <td colspan="2"><?php
                                if ($exchange['active'] == 1) {
                                    echo $this->lang->line('Payment Currency client') . ' <small>' . $this->lang->line('based on live market')
                                    ?></small>
                                    <select name="mcurrency"
                                            class="selectpicker form-select rounded-0">
                                        <option value="0">Default</option>
                                        <?php
                                        foreach ($currency as $row) {
                                            echo '<option value="' . $row['id'] . '">' . $row['symbol'] . ' (' . $row['code'] . ')</option>';
                                        }
                                        ?>

                                    </select><?php } ?></td>
                            <td colspan="4" align="right"><strong><?php echo $this->lang->line('Grand Total') ?>
                                    (<span class="currenty lightMode"><?php echo $this->config->item('currency'); ?></span>)</strong>
                            </td>
                            <td align="left" colspan="2" class="bg-danger text-white">
                                <input type="text" name="total" class="form-control rounded-0 border border-1 border-warning"
                                                                id="invoiceyoghtml" readonly="">

                            </td>
                        </tr>
                        <tr class="sub_c" style="display: table-row;">
                            <td colspan="2"><?php echo $this->lang->line('Payment Terms') ?> 
                                <select name="pterms" class="selectpicker form-select rounded-0">
                            <?php

                            foreach ($terms as $row) {
                                echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
                            }
                            ?>

                                </select>
                            </td>
                            <td align="right" colspan="6">
                                <input type="submit" class="btn btn-success sub-btn"
                                                                 value="<?php echo $this->lang->line('Generate Invoice') ?> "
                                                                 id="submit-data" data-loading-text="Creating...">

                            </td>
                        </tr>


                        </tbody>
                    </table>
                </div>

                <input type="hidden" value="subscriptions/action" id="action-url">
                <input type="hidden" value="search" id="billtype">
                <input type="hidden" value="0" name="counter" id="ganak">
                <input type="hidden" value="<?php echo $this->config->item('currency'); ?>" name="currency">
                <input type="hidden" value="<?= $taxdetails['handle']; ?>" name="taxformat" id="tax_format">

                <input type="hidden" value="<?= $taxdetails['format']; ?>" name="tax_handle" id="tax_status">
                <input type="hidden" value="yes" name="applyDiscount" id="discount_handle">

                <input type="hidden" value="<?= $this->common->disc_status()['disc_format']; ?>"
                       name="discountFormat" id="discount_format">
                <input type="hidden" value="<?= amountFormat_general($this->common->disc_status()['ship_rate']); ?>"
                       name="shipRate"
                       id="ship_rate">
                <input type="hidden" value="<?= $this->common->disc_status()['ship_tax']; ?>" name="ship_taxtype"
                       id="ship_taxtype">
                <input type="hidden" value="0" name="ship_tax" id="ship_tax">


            </form>
        </div>

    </div>
</div>


<div class="modal fade" id="addCustomer" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <form method="post" id="product_action" class="form-horizontal">
                <!-- Modal Header -->
                <div class="modal-header bg-warning white">

                    <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('Add Customer') ?></h4>

                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p id="statusMsg"></p><input type="hidden" name="mcustomer_id" id="mcustomer_id" value="0">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card border border-1 shadow rounded-0 bg-light">
                                <div class="card-header">
                                    <h5><?php echo $this->lang->line('Billing Address') ?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">

                                        <label class="form-label" for="name"><?php echo $this->lang->line('Name') ?></label>

                                        <input type="text" placeholder="Name" class="form-control rounded-0" id="mcustomer_name" name="name" required>

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="phone"><?php echo $this->lang->line('Phone') ?></label>

                                        <input type="text" placeholder="Phone" class="form-control rounded-0" name="phone" id="mcustomer_phone">

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="email"><?php echo $this->lang->line('Email') ?></label>
                                        <input type="email" placeholder="Email"
                                               class="form-control margin-bottom rounded-0 crequired" name="email"
                                               id="mcustomer_email">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="address"><?php echo $this->lang->line('Address') ?></label>
                                        <input type="text" placeholder="Address"
                                               class="form-control rounded-0 margin-bottom " name="address" id="mcustomer_address1">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="text" placeholder="City" class="form-control rounded-0 margin-bottom" name="city" id="mcustomer_city">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" placeholder="Region" id="region" class="form-control margin-bottom rounded-0" name="region">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="text" placeholder="Country"
                                                   class="form-control margin-bottom rounded-0" name="country" id="mcustomer_country">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" placeholder="PostBox" id="postbox"
                                                   class="form-control margin-bottom rounded-0" name="postbox">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="text" placeholder="Company"
                                                   class="form-control margin-bottom rounded-0" name="company">
                                        </div>

                                        <div class="col-sm-6">
                                            <input type="text" placeholder="TAX ID"
                                                   class="form-control rounded-0 margin-bottom" name="taxid" id="mcustomer_city">
                                        </div>


                                    </div>

                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label  col-form-label-sm"
                                               for="customergroup"><?php echo $this->lang->line('Group') ?></label>

                                        <div class="col-sm-10">
                                            <select name="customergroup" class="form-select rounded-0">
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

                                </div>
                            </div>

                       </div>

                        <!-- shipping -->
                        <div class="col-sm-6">
                            <div class="card border border-1 shadow bg-light">
                                <div class="card-header"><h5><?php echo $this->lang->line('Shipping Address') ?></h5></div>
                                <div class="card-body">
                                    <div class="form-group row">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="customer1s"
                                           id="copy_address">
                                    <label class="custom-control-label"
                                           for="copy_address"><?php echo $this->lang->line('Same As Billing') ?></label>
                                </div>


                                <div class="col-sm-10">
                                    <?php echo $this->lang->line("leave Shipping Address") ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label"
                                       for="name_s"><?php echo $this->lang->line('Name') ?></label>
                              
                                    <input type="text" placeholder="Name"
                                           class="form-control rounded-0 margin-bottom" id="mcustomer_name_s" name="name_s"
                                           required>
                               
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="phone_s"><?php echo $this->lang->line('Phone') ?></label>
                                <input type="text" placeholder="Phone" class="form-control rounded-0 margin-bottom" name="phone_s" id="mcustomer_phone_s">
                                
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email_s"><?php echo $this->lang->line('Email') ?></label>
                                <input type="email" placeholder="Email" class="form-control rounded-0 margin-bottom" name="email_s"  id="mcustomer_email_s">
                                
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="address_s"><?php echo $this->lang->line('Address') ?></label>
                                <input type="text" placeholder="Address" class="form-control rounded-0 margin-bottom " name="address_s" id="mcustomer_address1_s">
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <input type="text" placeholder="City" class="form-control rounded-0 margin-bottom" name="city_s" id="mcustomer_city_s">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="Region" id="region_s"
                                           class="form-control rounded-0 margin-bottom" name="region_s">
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <input type="text" placeholder="Country"
                                           class="form-control rounded-0 margin-bottom" name="country_s" id="mcustomer_country_s">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="PostBox" id="postbox_s"
                                           class="form-control rounded-0 margin-bottom" name="postbox_s">
                                </div>
                            </div>
                                </div>
                            </div>
                            
                            
                            
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
                                               class="form-control rounded-0 margin-bottom b_input"
                                               name="custom[<?= $row['id'] ?>]">
                                    </div>
                                </div>


                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                            data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                    <input type="submit" id="mclient_add" class="btn btn-primary submitBtn" value="ADD"/>
                </div>
            </form>
        </div>
    </div>
</div>
