<div class="card border border-1 shadow bg-light">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0 border border-warning bofrder-1 text-dark"><?php echo $this->lang->line('BalanceSheet') ?></button>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-body border border-2 bg-light">
                <div id="notify" class="alert alert-success" style="display:none;">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <div class="message"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border border-1">
                            <div class="card-header text-center">
                                <button class="btn btn-primary rounded-0">
                                    <h5><?php echo $this->lang->line('Basic') ?><?php echo $this->lang->line('Accounts'); ?></h5>
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo $this->lang->line('Name') ?></th>
                                            <th><?php echo $this->lang->line('Account') ?></th>
                                            <th><?php echo $this->lang->line('Balance') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $gross = 0;
                                        foreach ($accounts as $row) {
                                            if ($row['account_type'] == 'Basic') {
                                                $aid = $row['id'];
                                                $acn = $row['acn'];
                                                $holder = $row['holder'];

                                                $balance = $row['lastbal'];
                                                $qty = $row['adate'];
                                                echo "<tr>
                    <td>$i</td>                    
                    <td>$holder</td>
                    <td>$acn</td>
                   
                    <td>" . amountExchange($balance, 0, $this->aauth->get_user()->loc) . "</td>
                    </tr>";
                                                $i++;
                                                $gross += $balance;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>

                                            <th></th>

                                            <th class="bg-primary text-white">
                                                <h3 class="text-xl-left"><?php echo amountExchange($gross, 0, $this->aauth->get_user()->loc); ?></h3>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border border-1">
                            <div class="card-header text-center">
                                <button class="btn btn-success rounded-0">
                                    <h5><?php echo $this->lang->line('Assets') ?><?php echo $this->lang->line('Accounts') ?></h5>
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo $this->lang->line('Name') ?></th>
                                            <th><?php echo $this->lang->line('Account') ?></th>
                                            <th><?php echo $this->lang->line('Balance') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $gross1 = 0;
                                        foreach ($accounts as $row) {
                                            if ($row['account_type'] == 'Assets') {
                                                $aid = $row['id'];
                                                $acn = $row['acn'];
                                                $holder = $row['holder'];

                                                $balance = $row['lastbal'];
                                                $qty = $row['adate'];
                                                echo "<tr>
                    <td>$i</td>                    
                    <td>$holder</td>
                    <td>$acn</td>
                   
                    <td>" . amountExchange($balance, 0, $this->aauth->get_user()->loc) . "</td>
                    </tr>";
                                                $i++;
                                                $gross1 += $balance;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>

                                            <th></th>

                                            <th class="bg-success text-white">
                                                <h3 class=""><?php echo amountExchange($gross1, 0, $this->aauth->get_user()->loc); ?></h3>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card border border-1 bg-light">
                            <div class="card-header text-center">
                                <button class="btn btn-danger rounded-0">
                                    <h5>
                                        <?php echo $this->lang->line('Expenses') ?><?php echo $this->lang->line('Accounts') ?>
                                    </h5>
                                </button>

                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-sm  table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo $this->lang->line('Name') ?></th>
                                            <th><?php echo $this->lang->line('Account') ?></th>
                                            <th><?php echo $this->lang->line('Balance') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $gross2 = 0;
                                        foreach ($accounts as $row) {
                                            if ($row['account_type'] == 'Expenses') {
                                                $aid = $row['id'];
                                                $acn = $row['acn'];
                                                $holder = $row['holder'];

                                                $balance = $row['lastbal'];
                                                $qty = $row['adate'];
                                                echo "<tr>
                    <td>$i</td>                    
                    <td>$holder</td>
                    <td>$acn</td>
                   
                    <td>" . amountExchange($balance, 0, $this->aauth->get_user()->loc) . "</td>
                    </tr>";
                                                $i++;
                                                $gross2 += $balance;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>

                                            <th></th>

                                            <th class="bg-danger text-white">
                                                <h3 class=""><?php echo amountExchange($gross2, 0, $this->aauth->get_user()->loc); ?></h3>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border border-1 bg-light">
                            <div class="card-header text-center">
                                <button class="btn btn-info rounded-0">
                                    <h5 class="text-white">
                                        <?php echo $this->lang->line('Income') ?><?php echo $this->lang->line('Accounts') ?>
                                    </h5>
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo $this->lang->line('Name') ?></th>
                                            <th><?php echo $this->lang->line('Account') ?></th>
                                            <th><?php echo $this->lang->line('Balance') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $gross3 = 0;
                                        foreach ($accounts as $row) {
                                            if ($row['account_type'] == 'Income') {
                                                $aid = $row['id'];
                                                $acn = $row['acn'];
                                                $holder = $row['holder'];

                                                $balance = $row['lastbal'];
                                                $qty = $row['adate'];
                                                echo "<tr>
                    <td>$i</td>                    
                    <td>$holder</td>
                    <td>$acn</td>
                   
                    <td>" . amountExchange($balance, 0, $this->aauth->get_user()->loc) . "</td>
                    </tr>";
                                                $i++;
                                                $gross3 += $balance;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="bg-info text-white">
                                                <h3 class="text-xl-left"><?php echo amountExchange($gross3, 0, $this->aauth->get_user()->loc); ?></h3>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border border-1">
                            <div class="card-header text-center">
                                <button class="btn btn-success rounded-0">
                                    <h5 class="text-white">
                                        <?php echo $this->lang->line('Liabilities') ?><?php echo $this->lang->line('Accounts') ?>
                                    </h5>
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo $this->lang->line('Name') ?></th>
                                            <th><?php echo $this->lang->line('Account') ?></th>
                                            <th><?php echo $this->lang->line('Balance') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $gross4 = 0;
                                        foreach ($accounts as $row) {
                                            if ($row['account_type'] == 'Liabilities') {
                                                $aid = $row['id'];
                                                $acn = $row['acn'];
                                                $holder = $row['holder'];

                                                $balance = $row['lastbal'];
                                                $qty = $row['adate'];
                                                echo "<tr>
                    <td>$i</td>                    
                    <td>$holder</td>
                    <td>$acn</td>
                   
                    <td>" . amountExchange($balance, 0, $this->aauth->get_user()->loc) . "</td>
                    </tr>";
                                                $i++;
                                                $gross4 += $balance;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="bg-success text-white">
                                                <h3 class="text-xl-left"><?php echo amountExchange($gross4, 0, $this->aauth->get_user()->loc); ?></h3>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border border-1">
                            <div class="card-header text-center">
                                <button class="btn btn-warning rounded-0">
                                    <h5 class="text-white">
                                        <?php echo $this->lang->line('Equity') ?><?php echo $this->lang->line('Accounts') ?>
                                    </h5>
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo $this->lang->line('Name') ?></th>
                                            <th><?php echo $this->lang->line('Account') ?></th>
                                            <th><?php echo $this->lang->line('Balance') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $gross5 = 0;
                                        foreach ($accounts as $row) {
                                            if ($row['account_type'] == 'Equity') {
                                                $aid = $row['id'];
                                                $acn = $row['acn'];
                                                $holder = $row['holder'];

                                                $balance = $row['lastbal'];
                                                $qty = $row['adate'];
                                                echo "<tr>
                    <td>$i</td>                    
                    <td>$holder</td>
                    <td>$acn</td>
                   
                    <td>" . amountExchange($balance, 0, $this->aauth->get_user()->loc) . "</td>
                    </tr>";
                                                $i++;
                                                $gross5 += $balance;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="bg-warning text-white">
                                                <h3 class="text-xl-left"><?php echo amountExchange($gross5, 0, $this->aauth->get_user()->loc); ?></h3>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-2">
                    <table class="table table-striped table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th><?php echo $this->lang->line('Type') ?></th>
                                <th><?php echo $this->lang->line('Balance') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $this->lang->line('Basic') ?></td>
                                <td><?php echo amountExchange($gross, 0, $this->aauth->get_user()->loc) ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('Assets') ?></td>
                                <td><?php echo amountExchange($gross1, 0, $this->aauth->get_user()->loc) ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('Expenses') ?></td>
                                <td><?php echo amountExchange($gross2, 0, $this->aauth->get_user()->loc) ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('Income') ?></td>
                                <td><?php echo amountExchange($gross3, 0, $this->aauth->get_user()->loc) ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('Liabilities') ?></td>
                                <td><?php echo amountExchange($gross4, 0, $this->aauth->get_user()->loc) ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('Equity') ?></td>
                                <td><?php echo amountExchange($gross5, 0, $this->aauth->get_user()->loc) ?></td>
                            </tr>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //datatables
        $('.dtable').DataTable({responsive: true});
    });
</script>