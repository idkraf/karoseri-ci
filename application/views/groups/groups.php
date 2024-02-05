<div class="card border border-1 shadow rounded-0">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-outline-warning text-dark rounded-0">
                    &nbsp;&nbsp;&nbsp;<strong><?php echo $this->lang->line('Client Groups') ?></strong> &nbsp;&nbsp;&nbsp;
                </button>
            </div>
            <div class="col-md-6">
                <a href="<?php echo base_url('clientgroup/create') ?>" class="btn btn-primary float-end rounded-0"><?php echo $this->lang->line('Add new') ?></a> 
            </div>
        </div>


    </div>
    <div class="card-body">

        <div class="card-body border border-2">
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <table id="cgrtable" class="table table-striped table-bordered zero-configuration table-hover table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Total Clients') ?></th>
                        <th><?php echo $this->lang->line('Action') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($group as $row) {
                        $cid = $row['id'];
                        $title = $row['title'];
                        $total = $row['pc'];

                        echo "<tr>
                    <td>$i</td>
                    <td>$title</td>
                    <td>$total</td>
                    
                    <td><a href='" . base_url("clientgroup/groupview?id=$cid") . "' class='btn btn-success btn-sm'><i class='fa fa-eye'></i>  " . "</a>&nbsp;<a href='" . base_url("clientgroup/editgroup?id=$cid") . "' class='btn btn-warning btn-sm'><i class='fa fa-pencil'></i> " . "</a>&nbsp;<a href='#' data-object-id='" . $cid . "'  class='btn btn-info btn-sm discount-object' title='Apply Discount'><i class='fa fa-bolt'></i> " . $this->lang->line('Discount') . "</a> <a href='#' data-object-id='" . $cid . "' class='btn btn-danger btn-sm delete-object' title='Delete'><i class='fa fa-trash'></i></a></td></tr>";
                        $i++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Total Clients') ?></th>

                        <th><?php echo $this->lang->line('Action') ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        //datatables
        $('#cgrtable').DataTable({responsive: true});

    });
</script>

<div id="pop_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Discount'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="form_model">
                    <p>
                        <?php echo $this->lang->line('you can pre-define the discount') ?>
                    </p>
                    <input type="hidden" id="dobject-id" name="gid" value="">


                    <div class="row">
                        <div class="col mb-1"><label
                                for="pmethod"><?php echo $this->lang->line('Discount') ?></label>
                            <input name="disc_rate" class="form-control mb-1" type="number"
                                   placeholder="Discount Rate in %">


                        </div>
                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default"
                                data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
                        <input type="hidden" id="action-url" value="clientgroup/discount_update">
                        <button type="button" class="btn btn-primary"
                                id="submit_model"><?php echo $this->lang->line('Change Status'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Delete Customer Group') ?></h4>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&nbsp; X &nbsp;</span></button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('delete this customer group') ?></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="clientgroup/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-danger"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-primary"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).on('click', ".discount-object", function (e) {
        e.preventDefault();
        $('#dobject-id').val($(this).attr('data-object-id'));
        $(this).closest('tr').attr('id', $(this).attr('data-object-id'));
        $('#pop_model').modal({backdrop: 'static', keyboard: false});
    });
</script>