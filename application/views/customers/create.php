<div class="card border border-1 bg-light shadow">
    <div class="card-header">
        <button type="button" class="btn btn-outline-warning rounded-0 text-dark">
            <strong><?php echo $this->lang->line('Add New Customer') ?></strong>
        </button>
    </div>
    <div class="card-body">
        <form method="post" id="data_form" class="form-horizontal">
            <div class="card">
                <div class="card-body border border-2">
                    <div class="card-body">

                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="base-tab1" data-toggle="tab"
                                   aria-controls="tab1" href="#tab1" role="tab"
                                   aria-selected="true"><?php echo $this->lang->line('Billing Address') ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2"
                                   href="#tab2" role="tab"
                                   aria-selected="false"><?php echo $this->lang->line('Shipping Address') ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3"
                                   href="#tab4" role="tab"
                                   aria-selected="false"><?php echo $this->lang->line('CustomFields') ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3"
                                   href="#tab3" role="tab"
                                   aria-selected="false"><?php echo $this->lang->line('Other') . ' ' . $this->lang->line('Settings') ?></a>
                            </li>

                        </ul>
                        <div class="tab-content px-1 pt-1">
                            <div class="tab-pane active show" id="tab1" role="tabpanel" aria-labelledby="base-tab1">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="card border border-1 shadow mt-4 bg-light">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label class="form-label" for="name"><strong><?php echo $this->lang->line('Name') ?></strong></label>
                                                    <input type="text" placeholder="Name"  class="form-control rounded-0  required" name="name"  id="mcustomer_name">
                                                </div>
                                                <div class="form-group">

                                                    <label class="form-label" for="name"><strong><?php echo $this->lang->line('Company') ?></strong></label>
                                                    <input type="text" placeholder="Company" class="form-control rounded-0" name="company">
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="phone"><strong><?php echo $this->lang->line('Phone') ?></strong></label>
                                                    <input type="text" placeholder="phone" class="form-control rounded-0 margin-bottom required b_input" name="phone" id="mcustomer_phone">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="email"><strong>Email</strong></label>
                                                    <input type="text" placeholder="email" class="form-control rounded-0 margin-bottom required b_input" name="email" id="mcustomer_email">

                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="address"><strong><?php echo $this->lang->line('Address'); ?></strong></label>
                                                    <input type="text" placeholder="address" class="form-control rounded-0 margin-bottom b_input" name="address" id="mcustomer_address1">

                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="city"><strong><?php echo $this->lang->line('City') ?></strong></label>
                                                    <input type="text" placeholder="city" class="form-control rounded-0 margin-bottom b_input" name="city" id="mcustomer_city">

                                                </div>
                                                <div class="form-group">

                                                    <label class="form-label"  for="region"><strong><?php echo $this->lang->line('Region') ?></strong></label>

                                                    <input type="text" placeholder="Region"
                                                           class="form-control rounded-0 margin-bottom b_input" name="region"
                                                           id="region">

                                                </div>
                                                <div class="form-group">

                                                    <label class="form-label" for="country"><strong><?php echo $this->lang->line('Country') ?></strong></label>

                                                    <input type="text" placeholder="Country"
                                                           class="form-control rounded-0 margin-bottom b_input" name="country"
                                                           id="mcustomer_country">

                                                </div>
                                                <div class="form-group">

                                                    <label class="form-label"  for="postbox"><strong><?php echo $this->lang->line('PostBox') ?></strong></label>

                                                    <input type="text" placeholder="PostBox"  class="form-control rounded-0 margin-bottom b_input" name="postbox"   id="postbox">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="base-tab2">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="card border border-1 bg-light">
                                            <div class="card-body">
                                                <div class="form-group row">

                                                    <div class="input-group mt-1">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="customer1"
                                                                   id="copy_address">
                                                            <label class="custom-control-label"
                                                                   for="copy_address"><?php echo $this->lang->line('Same As Billing') ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-10 text-info">
                                                        <?php echo $this->lang->line("leave Shipping Address") ?>
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"
                                                           for="name_s"><?php echo $this->lang->line('Name') ?></label>

                                                    <input type="text" placeholder="Name"
                                                           class="form-control rounded-0 b_input" name="name_s"
                                                           id="mcustomer_name_s">

                                                </div>


                                                <div class="form-group">

                                                    <label class="form-label"
                                                           for="phone_s"><?php echo $this->lang->line('Phone') ?></label>


                                                    <input type="text" placeholder="phone"
                                                           class="form-control rounded-0 b_input" name="phone_s"
                                                           id="mcustomer_phone_s">

                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="email_s">Email</label>

                                                    <input type="text" placeholder="email"
                                                           class="form-control rounded-0 b_input" name="email_s"
                                                           id="mcustomer_email_s">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"
                                                           for="address"><?php echo $this->lang->line('Address') ?></label>

                                                    <input type="text" placeholder="address_s"
                                                           class="form-control rounded-0 b_input" name="address_s"
                                                           id="mcustomer_address1_s">
                                                </div>
                                                <div class="form-group">

                                                    <label class="form-label"
                                                           for="city_s"><?php echo $this->lang->line('City') ?></label>
                                                    <input type="text" placeholder="city"
                                                           class="form-control rounded-0 b_input" name="city_s"
                                                           id="mcustomer_city_s">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"
                                                           for="region_s"><?php echo $this->lang->line('Region') ?></label>
                                                    <input type="text" placeholder="Region"
                                                           class="form-control rounded-0 b_input" name="region_s"
                                                           id="region_s">
                                                </div>
                                                <div class="form-group">

                                                    <label class="form-label"
                                                           for="country_s"><?php echo $this->lang->line('Country') ?></label>
                                                    <input type="text" placeholder="Country"
                                                           class="form-control rounded-0 b_input" name="country_s"
                                                           id="mcustomer_country_s">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"
                                                           for="postbox"><?php echo $this->lang->line('PostBox') ?></label>

                                                    <input type="text" placeholder="PostBox"
                                                           class="form-control rounded-0 b_input" name="postbox_s"
                                                           id="postbox_s">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="base-tab3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="card border border-1 bg-light">
                                            <div class="card-body">
                                                <div class="form-group">
                                    
                                    <label class="form-label" for="Discount"><?php echo $this->lang->line('Discount') ?> </label>
                                    
                                        <input type="text" placeholder="Custom Discount"
                                               class="form-control rounded-0 b_input" name="discount">
                                    
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="taxid"><?php echo $this->lang->line('TAX') ?> ID</label>

                                    
                                        <input type="text" placeholder="TAX ID"
                                               class="form-control rounded-0 b_input" name="taxid">
                                    
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="docid"><?php echo $this->lang->line('Document') ?> ID</label>
                                   
                                        <input type="text" placeholder="Document ID"
                                               class="form-control rounded-0 b_input" name="docid">
                                    
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="c_field"><?php echo $this->lang->line('Extra') ?> </label>
                                    
                                        <input type="text" placeholder="Custom Field"
                                               class="form-control margin-bottom b_input" name="c_field">
                                    
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="customergroup"><?php echo $this->lang->line('Customer group') ?></label>
                                    
                                        <select name="customergroup" class="form-select rounded-0 b_input">
                                            <?php
                                            foreach ($customergrouplist as $row) {
                                                $cid = $row['id'];
                                                $title = $row['title'];
                                                echo "<option value='$cid'>$title</option>";
                                            }
                                            ?>
                                        </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="currency">Language</label>
                                    
                                        <select name="language" class="form-select rounded-0 b_input">

                                            <?php
                                            echo $langs;
                                            ?>

                                        </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="currency"><?php echo $this->lang->line('customer_login') ?></label>
                                    
                                        <select name="c_login" class="form-select rounded-0 b_input">
                                            <option value="1"><?php echo $this->lang->line('Yes') ?></option>
                                            <option value="0"><?php echo $this->lang->line('No') ?></option>
                                        </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="password_c"><?php echo $this->lang->line('New Password') ?></label>

                                    
                                        <input type="text" placeholder="Leave blank for auto generation"
                                               class="form-control rounded-0 b_input" name="password_c"
                                               id="password_c">
                                    
                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            
                                
                            </div>
                            <div class="tab-pane show" id="tab4" role="tabpanel" aria-labelledby="base-tab4">
                                <?php
                                foreach ($custom_fields as $row) {
                                    if ($row['f_type'] == 'text') {
                                        ?>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"
                                                   for="docid"><?= $row['name'] ?></label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="<?= $row['placeholder'] ?>"
                                                       class="form-control margin-bottom b_input <?= $row['other'] ?>"
                                                       name="custom[<?= $row['id'] ?>]">
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div id="mybutton">
                                <input type="submit" id="submit-data"
                                       class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                       value="<?php echo $this->lang->line('Add customer') ?>"
                                       data-loading-text="Adding...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="customers/addcustomer" id="action-url">
        </form>
    </div>
</div>


