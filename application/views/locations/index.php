<div class="card border border-1 bg-light rounded-0">
    <div class="card-header">
        <h5 class="title"> 
            <a href="<?php echo base_url('locations/create') ?>"
               class="btn btn-primary  rounded-0 float-end"><?php echo $this->lang->line('Add new') ?>
            </a>
        </h5>
    </div>
    <div class="card-body">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
        <div class="card-body border border-2 border-success">
            <button class="btn btn-success rounded-0 top-badge"><?php echo $this->lang->line('Business Locations') ?></button>
            <table id="catgtable" class="table table-striped table-bordered table-sm table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Address') ?></th>
                        <th><?php echo $this->lang->line('Action') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($locations as $row) {
                        $cid = $row['id'];
                        $name = $row['cname'];
                        $addr = $row['address'] . ', ' . $row['city'];

                        echo "<tr>
                    <td>$i</td>
                    <td>$name</td>
                    <td>$addr</td>
                 
                    <td><a href='" . base_url("locations/edit?id=$cid") . "' class='btn btn-warning btn-sm'><i class='icon-pencil'></i> " . "</a>&nbsp;<a href='#' data-object-id='" . $cid . "' class='btn btn-danger btn-sm delete-object' title='Delete'><i class='fa fa-trash'></i></a></td></tr>";
                        $i++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Address') ?></th>
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
        $('#catgtable').DataTable({responsive: true});

    });
</script>
<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('delete this location') ?></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="locations/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal" class="btn btn-danger"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
</div>
</div>    
