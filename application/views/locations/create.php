<div class="card border border-1 bg-light rounded-0">
    <div class="card-header"></div>
    <div class="card-body">
        <div class="card-body border border-2 border-success">
            <button class="btn btn-success rounded-0 top-badge"><h6><?php echo $this->lang->line('Add Business Location') ?></h6></button>
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <div class="message"></div>
            </div>
            <form method="post" id="data_form" class="form-horizontal">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border border-1">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label" for="name"><?php echo $this->lang->line('Name') ?></label>

                                    <input type="text" placeholder="Name"
                                           class="form-control rounded-0  required" name="name">

                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="address"><?php echo $this->lang->line('Address') ?></label>

                                    <input type="text" placeholder="Address"
                                           class="form-control rounded-0  required" name="address">

                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="city"><?php echo $this->lang->line('City') ?></label>

                                    <input type="text" placeholder="City"
                                           class="form-control rounded-0  required" name="city">

                                </div>

                                <div class="form-group">

                                    <label class="form-label"
                                           for=region"><?php echo $this->lang->line('Region') ?></label>


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
                                           for="postbox"><?php echo $this->lang->line('Postbox') ?></label>


                                    <input type="text" placeholder="postbox"
                                           class="form-control rounded-0" name="postbox">

                                </div>

                                <div class="form-group">

                                    <label class="form-label"
                                           for="phone"><?php echo $this->lang->line('Phone') ?></label>


                                    <input type="text" placeholder="Phone"
                                           class="form-control rounded-0" name="phone">

                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="email"><?php echo $this->lang->line('Email') ?></label>
                                    <input type="text" placeholder="Email" class="form-control rounded-0" name="email">
                                </div>

                                <div class="form-group">
                                    <label class="form-label"
                                           for="taxid"><?php echo $this->lang->line('TAX ID') ?></label>
                                    <input type="text" placeholder="taxid"
                                           class="form-control rounded-0" name="taxid">
                                </div>
                                <div class="form-group">
                                    <label class="form-label"  for="taxid"><?php echo $this->lang->line('Default') ?><?php echo $this->lang->line('Warehouse') ?></label>
                                    <select name="wid" class="selectpicker form-select rounded-0">
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
                                <div class="form-group">
                                    <label class="form-label" for="taxid"><?php echo $this->lang->line('Payment Currency client') ?></label>
                                    <select name="cur_id" class="selectpicker form-select rounded-0">
                                        <option value="0">Default</option>
                                        <?php
                                        foreach ($currency as $row) {
                                            echo '<option value="' . $row['id'] . '">' . $row['symbol'] . ' (' . $row['code'] . ')</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="account"><?php echo $this->lang->line('credit-online-payment') ?></label>
                                    <select name="account" class="form-select rounded-0">
                                        <?php
                                        foreach ($accounts as $row) {
                                            echo '<option value="' . $row['id'] . '">' . $row['holder'] . ' / ' . $row['acn'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><?php echo $this->lang->line('Company Logo') ?></label>
                                    <div class="card border border-1 bg-light">
                                        <div class="card-body">
                                            <!-- The container for the uploaded files -->
                                            <div id="files" class="files text-center"></div>
                                        </div>
                                    </div>
                                    <span class="btn btn-danger fileinput-button">
                                       <span>Select files...</span>
                                        <!-- The file input field used as target for the file upload widget -->
                                        <input id="fileupload" type="file" name="files[]">
                                    </span>
                                    <br>
                                    <pre>Allowed: gif, jpeg, png</pre>
                                    <br>
                                    <!-- The global progress bar -->
                                    <div id="progress" class="progress">
                                        <div class="progress-bar progress-bar-striped bg-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="submit-data" class="btn btn-success rounded-0"
                                           value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">
                                    <input type="hidden" value="locations/create" id="action-url">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="image" id="image" value="logo.png">
            </form>
        </div>
    </div>
</div>
</div>

<script src="<?php echo assets_url('assets/myjs/jquery.ui.widget.js'); ?>"></script>
<script src="<?php echo assets_url('assets/myjs/jquery.fileupload.js') ?>"></script>
<script>
    /*jslint unparam: true */
    /*global window, $ */
    $(function () {
        'use strict';
        // Change this to the location of your server-side upload handler:
        var url = '<?php echo base_url() ?>locations/file_handling';
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            formData: {'<?= $this->security->get_csrf_token_name() ?>': crsf_hash},
            done: function (e, data) {
                var img = 'default.png';
                $.each(data.result.files, function (index, file) {
                    $('#files').html('<img style="max-height:100px;" src="<?php echo base_url() ?>userfiles/company/' + file.name + '">');
                    img = file.name;
                });

                $('#image').val(img);
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

    $(document).on('click', ".aj_delete", function (e) {
        e.preventDefault();

        var aurl = $(this).attr('data-url');
        var obj = $(this);

        jQuery.ajax({

            url: aurl,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                obj.closest('tr').remove();
                obj.remove();
            }
        });

    });
</script>