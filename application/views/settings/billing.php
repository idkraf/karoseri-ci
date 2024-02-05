
<div class="card border border-1 bg-light rounded-0">
    <div class="card-header">
        <h5>Change Language</h5>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        
    </div>
    
    <div class="card-body">
        <div class="card-body border border-2 border-success">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="card-body">
            <form method="post" id="product_action" class="form-horizontal">

                <input type="hidden" name="id" value="<?php echo $company['id'] ?>">


                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="currency">Language</label>

                    <div class="col-sm-6">
                        <select name="language" class="form-control">

                            <?php
                            echo $langs;
                            ?>

                        </select>
                    </div>
                </div>


                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="submit" id="billing_update" class="btn btn-success margin-bottom"
                               value="<?php echo $this->lang->line('Update') ?>" data-loading-text="Updating...">
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
    
</div>

<script type="text/javascript">
    $("#billing_update").click(function (e) {
        e.preventDefault();
        var actionurl = baseurl + 'settings/language';
        actionProduct(actionurl);
    });
</script>

