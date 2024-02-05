<div class="card border border-1 bg-light rounded-0 shadow">
    <div class="card-header">
        <h5></h5>

    </div>
    <div class="card-body">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message">

            </div>
        </div>
        <div class="card-body border border-2 border-success">
            <button class="btn btn-success rounded-0 top-badge"><?php echo $this->lang->line('Edit Company Details') ?></button>
            <div class="row">
                <div class="col-4">
                    <div class="card border border-1">
                        <div class="card-body">
                            <form method="post" id="product_action" class="form-horizontal">
                                <input type="hidden" name="id" value="<?php echo $company['id'] ?>">
                                <div class="form-group">
                                    <label class="form-label" for="name"><strong><?php echo $this->lang->line('Company Name') ?></strong></label>
                                    <input type="text" placeholder="Name" class="form-control rounded-0 required" name="name" value="<?php echo $company['cname'] ?>">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="address"><strong><?php echo $this->lang->line('Address') ?></strong></label>
                                    <input type="text" placeholder="address"
                                           class="form-control rounded-0  required" name="address"
                                           value="<?php echo $company['address'] ?>">
                                </div>
                                <div class="form-group">

                                    <label class="form-label" for="city"><strong><?php echo $this->lang->line('City') ?></strong></label>
                                    <input type="text" placeholder="city" class="form-control rounded-0  required" name="city" value="<?php echo $company['city'] ?>">

                                </div>
                                <div class="form-group">
                                    <label class="form-label"  for="city"><strong><?php echo $this->lang->line('Region') ?></strong></label>
                                    <input type="text" placeholder="city" class="form-control rounded-0  required" name="region" value="<?php echo $company['region'] ?>">

                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="country"><strong><?php echo $this->lang->line('Country') ?></strong></label>
                                    <input type="text" placeholder="Country" class="form-control rounded-0  required" name="country" value="<?php echo $company['country'] ?>">

                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="data_share"><?php echo $this->lang->line('Foundation Day') ?> </label> 
                                    <input type="text" class="form-control rounded-0 required editdate" placeholder="Foundation Date" name="foundation" autocomplete="false" value="<?php echo dateformat($company['foundation']) ?>">
                                </div>
                                
                        </div>
                    


                        
                    </div>
                </div>
                
                <div class="col-4">
                    <div class="card border border-1">
                        <div class="card-body">
                            <div class="form-group">
                                    <label class="form-label" for="postbox"><strong><?php echo $this->lang->line('PostBox') ?></strong></label>
                                    <input type="text" placeholder="PostBox" class="form-control rounded-0  required" name="postbox" value="<?php echo $company['postbox'] ?>">

                                </div>

                                <div class="form-group">

                                    <label class="form-label" for="phone"><strong><?php echo $this->lang->line('Phone') ?></strong></label>
                                    <input type="text" placeholder="phone" class="form-control rounded-0  required" name="phone" value="<?php echo $company['phone'] ?>">

                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="email"><strong><?php echo $this->lang->line('Email') ?></strong></label>
                                    <input type="text" placeholder="email" class="form-control rounded-0  required" name="email" value="<?php echo $company['email'] ?>">
                                </div>
                                <div class="form-group">

                                    <label class="form-label" for="email"><strong><?php echo $this->lang->line('Tax') ?> ID </strong></label>
                                    <input type="text" placeholder="TAX ID"  class="form-control rounded-0" name="taxid" value="<?php echo $company['taxid'] ?>">

                                </div>
                                <div class="form-group">

                                    <label class=" form-label" for="data_share"><strong>Product Data Sharing with Other Locations</strong></label>
                                    <select name="data_share" class="form-select rounded-0">

                                        <?php
                                        switch (BDATA) {
                                            case '1' :
                                                echo '<option value="1">** Yes **</option>';
                                                break;
                                            case '0' :
                                                echo '<option value="0">** No **</option>';
                                                break;
                                        }
                                        ?>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                             
                                
                
                                <input type="submit" id="company_update" class="btn btn-primary mt-2 float-end rounded-0"
                                       value="<?php echo $this->lang->line('Update Company') ?>"
                                       data-loading-text="Updating...">
                                </form>
                            
                        
                        </div>
                    </div>
                </div>

                <div class="col-3">
                <div class="card border border-1">
                    
                    <div class="card-body">
                        <button class="btn btn-danger rounded-0 top-badge"><?php echo $this->lang->line('Company Logo') ?></button>
                    <div id="notify" class="alert alert-success" style="display:none;">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>

                        <div class="message"></div>
                    </div> 
                        <form method="post" id="product_action" class="form-horizontal">
                         <input type="hidden" name="id" value="<?php echo $company['id'] ?>">
                         <img src="<?php echo base_url('userfiles/company/') . $company['logo'] . '?t=' . rand(5, 99); ?>" class="img-fluid" alt="...">
                            <p>
                                <label for="fileupload"><?php echo $this->lang->line('Change Company Logo') ?></label><input
                                    id="fileupload" type="file"
                                    name="files[]"></p>
                            <pre>Recommended logo size is 500x200px.</pre>
                            <div id="progress" class="progress progress-sm mt-1 mb-0">
                                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 0%"
                                     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
    $("#company_update").click(function (e) {
        e.preventDefault();
        var actionurl = baseurl + 'settings/company';
        actionProduct(actionurl);
    });
</script>
<script src="<?php echo assets_url('assets/myjs/jquery.ui.widget.js') ?>"></script>
<script src="<?php echo assets_url('assets/myjs/jquery.fileupload.js') ?>"></script>
<script>
    $(function () {
        'use strict';
        var url = '<?php echo base_url() ?>settings/companylogo?id=<?php echo $company['id'] ?>';
                $('#fileupload').fileupload({
                    url: url,
                    dataType: 'json',
                    formData: {'<?= $this->security->get_csrf_token_name() ?>': crsf_hash},
                    done: function (e, data) {

                        $("#dpic").attr('src', '<?php echo base_url() ?>userfiles/company/' + data.result + '?' + new Date().getTime());


                    },
                    progressall: function (e, data) {
                        var progress = parseInt(data.loaded / data.total * 100, 10);
                        $('#progress .progress-bar').css(
                                'width',
                                progress + '%'
                                );
                    }
                }).prop('disabled', !$.support.fileInput)
                        .parent().addClass($.support.fileInput ? undefined : 'disabled');
            });
            $('.editdate').datepicker({
                autoHide: true,
                format: '<?php echo $this->config->item('dformat2'); ?>'
            });
</script>