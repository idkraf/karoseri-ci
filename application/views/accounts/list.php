    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="card overflow-hidden">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="bg-primary p-2 media-middle">
                            <i class="fa fa-briefcase font-large-2 white"></i>
                        </div>
                        <div class="media-body p-2">
                            <h4><?php echo $this->lang->line('Balance') ?></h4>
                            <span><?php echo $this->lang->line('Total') ?></span>
                        </div>
                        <div class="media-right p-2 media-middle">
                            <h1 class="success"><span
                                        id="dash_0"></span></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="bg-warning p-2 media-middle">
                            <i class="fa fa-list-alt font-large-2  white"></i>
                        </div>
                        <div class="media-body p-2">
                            <h4><?php echo $this->lang->line('Accounts') ?></h4>
                            <span><?php echo $this->lang->line('Total') ?></span>
                        </div>
                        <div class="media-right p-2 media-middle">
                            <h1 class="cyan" id="dash_1">0</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card border border-1 shadow">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <button  class="btn btn-outline-warning rounded-0 text-dark"><strong><?php echo $this->lang->line('Accounts'); ?></strong></button>
                </div>
                <div class="col-md-6">
                    <a
                        href="<?php echo base_url('accounts/add') ?>"
                        class="btn btn-primary float-end rounded-0">
                    <?php echo $this->lang->line('Add new') ?></a>
                </div>
            </div>
           
        </div>
        <div class="card-body">
            
            <div class="card-body">
                <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <div class="message"></div>
            </div>
                <div class="table-responsive">
                    <table id="acctable" class="table table-striped table-bordered table-hover table-sm" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Account No') ?></th>
                            <th><?php echo $this->lang->line('Name') ?></th>
                            <th><?php echo $this->lang->line('Balance') ?></th>
                            <th><?php echo $this->lang->line('Type') ?></th>
                            <th><?php echo $this->lang->line('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;
                        foreach ($accounts as $row) {
                            $aid = $row['id'];
                            $acn = $row['acn'];
                            $holder = $row['holder'];
                            $balance = amountExchange($row['lastbal'], 0, $this->aauth->get_user()->loc);
                            $type = $row['account_type'];
                            $qty = $row['adate'];
                            echo "<tr>
                    <td>$i</td>
                    <td>$acn</td>
                    <td>$holder</td>
                 
                    <td>$balance</td>
                     <td>$type</td>
                    <td><a href='" . base_url("accounts/view?id=$aid") . "' class='btn btn-success btn-sm'><i class='fa fa-eye'></i>  " . "</a>&nbsp;<a href='" . base_url("accounts/edit?id=$aid") . "' class='btn btn-warning btn-sm'><i class='fa fa-pencil'></i>  " . "</a>&nbsp;<a href='#' data-object-id='" . $aid . "' class='btn btn-danger btn-sm delete-object' title='Delete'><i class='fa fa-trash'></i></a></td></tr>";
                            $i++;
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Account No') ?></th>
                            <th><?php echo $this->lang->line('Name') ?></th>
                            <th><?php echo $this->lang->line('Balance') ?></th>
                            <th><?php echo $this->lang->line('Type') ?></th>
                            <th><?php echo $this->lang->line('Actions') ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" id="dashurl" value="accounts/account_stats">
    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            //datatables
            $('#acctable').DataTable({
                responsive: true, <?php datatable_lang();?> dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        footer: true,
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }
                ],
            });
            miniDash();

        });
    </script>
    <div id="delete_model" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title"><?php echo $this->lang->line('Delete Account') ?></h4>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"> &nbsp;X&nbsp; </span></button>
                </div>
                <div class="modal-body">
                    <p><?php echo $this->lang->line('Delete account message') ?></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="object-id" value="">
                    <input type="hidden" id="action-url" value="accounts/delete_i">
                    <button type="button" data-dismiss="modal" class="btn btn-danger"
                            id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                    <button type="button" data-dismiss="modal"
                            class="btn btn-primary"><?php echo $this->lang->line('Cancel') ?></button>
                </div>
            </div>
        </div>
    </div>