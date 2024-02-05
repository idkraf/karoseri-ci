<div class="card shadow border border-1 bg-light">
    <div class="card-header">
        <h5><?php echo $this->lang->line('Add New supplier Details') ?></h5>
    </div>
    <div class="card-body">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="btn btn-danger btn-sm float-end" data-dismiss="alert">&nbsp;X&nbsp;</a>
            <div class="message"></div>
        </div>
        <div class="card-body border border-2">
            <div class="card-body">
                <form method="post" id="data_form" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="name"><?php echo $this->lang->line('Name') ?></label>
                                <input type="text" placeholder="Name"
                                       class="form-control rounded-0 required" name="name">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="name"><?php echo $this->lang->line('Company') ?></label>
                                <input type="text" placeholder="Company"
                                       class="form-control rounded-0" name="company">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="phone"><?php echo $this->lang->line('Phone') ?></label>
                                <input type="text" placeholder="phone"
                                       class="form-control rounded-0  required" name="phone">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email"><?php echo $this->lang->line('Email') ?></label>
                                <input type="text" placeholder="email"
                                       class="form-control rounded-0 required" name="email">
                            </div>
                            <div class="form-group">

                                <label class="form-label"
                                       for="address"><?php echo $this->lang->line('Address') ?></label>
                                <input type="text" placeholder="address"
                                       class="form-control rounded-0" name="address">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="city"><?php echo $this->lang->line('City') ?></label>
                                <input type="text" placeholder="city"
                                       class="form-control rounded-0" name="city">
                            </div>
                            <div class="form-group">

                                <label class="form-label"
                                       for="region"><?php echo $this->lang->line('Region') ?></label>
                                <input type="text" placeholder="Region"
                                       class="form-control rounded-0" name="region">
                            </div>
                            <div class="form-group">
                                <label class="form-label"
                                       for="country"><?php echo $this->lang->line('Country') ?></label>
                                <input type="text" placeholder="Country"
                                       class="form-control rounded-0" name="country">
                            </div>
                            <div class="form-group">
                                <label class="form-label"
                                       for="postbox"><?php echo $this->lang->line('PostBox') ?></label>
                                <input type="text" placeholder="PostBox"
                                       class="form-control rounded-0" name="postbox">
                            </div>
                            <div class="form-group">
                                <label class="form-label"
                                       for="postbox"><?php echo $this->lang->line('TAX') ?> ID</label>
                                <input type="text" placeholder="TAX"
                                       class="form-control rounded-0" name="taxid">
                            </div>
                            <div class="form-group">
                                <input type="submit" id="submit-data" class="btn btn-success float-end"
                                       value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('Add') ?>&nbsp;&nbsp;&nbsp;&nbsp;" data-loading-text="Adding...">
                                <input type="hidden" value="supplier/addsupplier" id="action-url">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
</div>

