<div class="card border  border-1 bg-light rounded-0">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-outline-warning rounded-0 text-dark">
                    <strong><?php echo $this->lang->line('Employee') ?></strong>
                </button>
                
            </div>
            <div class="col-md-6">
                <a href="<?php echo base_url('employee/add') ?>" class="btn float-end btn-primary rounded-0">
                   <?php echo $this->lang->line('Add new') ?>
                </a>
            </div>
        </div>
        
        
    </div>
    <div class="card-body">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="card-body border border-2">

            <table id="emptable" class="table table-striped table-bordered table-sm table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Salary') ?></th>
                        <th>Role</th>
                        <th><?php echo $this->lang->line('Status') ?></th>

                        <th><?php echo $this->lang->line('Actions') ?></th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    foreach ($employee as $row) {
                        $aid = $row['id'];
                        $username = $row['username'];
                        $name = $row['name'];
                        $role = user_role($row['roleid']);
                        $status = $row['banned'];
                        $salary = amountExchange($row['salary'], 0, $row['loc']);

                        if ($status == 1) {
                            $status = '<span class="badge badge-danger">Deactive</span>';
                        } else {
                            $status = '<span class="badge badge-success">Active</span>';
                        }

                        echo "<tr>
                    <td>$i</td>
                    <td>$name</td>
                         <td>$salary</td>
                    <td>$role</td>                 
                    <td>$status</td>
                 
                    <td><a href='" . base_url("employee/history?id=$aid") . "' class='btn btn-danger btn-sm'><i class='fa fa-list-ul'></i> " . "</a></td></tr>";
                        $i++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Salary') ?></th>
                        <th>Role</th>
                        <th><?php echo $this->lang->line('Status') ?></th>
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