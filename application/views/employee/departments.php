<div class="card border border-1 rounded-0 bg-light">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-outline-warning rounded-0 text-dark">
                    <strong><?php echo $this->lang->line('Departments') ?></strong>
                </button>
            </div>
            <div class="col-md-6">
                <a href="<?php echo base_url('employee/adddep') ?>" class="btn btn-primary float-end rounded-0">
                    <?php echo $this->lang->line('Add new') ?>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="card-body border border-2">
            <table id="emptable" class="table table-striped table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($department_list as $row) {
                        $aid = $row['id'];
                        $username = $row['val1'];
                        $name = $row['val2'];
                        echo "<tr>
                        <td>" . $i . "</td>
                        <td>" . $row['val1'] . "</td>
                                
                        <td><a href='" . base_url("employee/department?id=$aid") . "' class='btn btn-primary btn-sm'><i class='fa fa-eye'></i> " . "</a> <a href='" . base_url("employee/editdep?id=$aid") . "' class='btn btn-success  btn-sm'><i class='fa fa-pencil'></i> " . "</a> <a href='#' data-object-id='$aid' class='btn btn-danger btn-sm delete-object  btn-sm'><span class='fa fa-trash'></span></a></td></tr>";
                        $i++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>


                        <th><?php echo $this->lang->line('Actions') ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        //datatables
        $('#emptable').DataTable({responsive: true});


    });

    $('.delemp').click(function (e) {
        e.preventDefault();
        $('#empid').val($(this).attr('data-object-id'));

    });
</script>

<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php
                echo $this->lang->line('Delete');
                echo ' ' . $this->lang->line('Department');
                ?>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="employee/delete_dep">
                <button type="button" data-dismiss="modal" class="btn btn-danger"
                        id="delete-confirm"><?php echo $this->lang->line('Yes') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-primary"><?php echo $this->lang->line('No') ?></button>
            </div>
        </div>
    </div>
</div>