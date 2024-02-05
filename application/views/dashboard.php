<script type="text/javascript">
    var dataVisits = [
<?php
$tt_inc = 0;
foreach ($incomechart as $row) {
    $tt_inc += $row['total'];
    echo "{ x: '" . $row['date'] . "', y: " . intval(amountExchange_s($row['total'], 0, $this->aauth->get_user()->loc)) . "},";
}
?>
    ];
    var dataVisits2 = [
<?php
$tt_exp = 0;
foreach ($expensechart as $row) {
    $tt_exp += $row['total'];
    echo "{ x: '" . $row['date'] . "', y: " . intval(amountExchange_s($row['total'], 0, $this->aauth->get_user()->loc)) . "},";
}
?>];

</script>
<div class="row">
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card rounded shadow">
            <div class="card-body p-5">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo base_url('assets/images/invoice2.png'); ?>"> 
                    </div>
                    <div class="col-md-8">
                        <div class="p-1  white ">
                            <h4><?php echo $this->lang->line('today_invoices') ?></h4>
                            <h5 class="text-bold-400 mb-0"><i class="ft-plus"></i> <?= $todayin ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card rounded shadow">
            <div class="card-body p-5">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo base_url('assets/images/invoice1.png'); ?>"> 
                    </div>
                    <div class="col-md-8">
                        <div class="">

                            <div class="p-1 white">
                                <h4><?= $this->lang->line('month_invoice') ?></h4>
                                <h5 class="text-bold-400 mb-0"><i class="ft-arrow-up"></i><?= $monthin ?></h5>
                            </div>
                        </div>   
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card rounded shadow">
            <div class="card-body p-5">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo base_url('assets/images/sales1.png'); ?>"> 
                    </div>
                    <div class="col-md-8">
                        <div class="media align-items-stretch">

                            <div class="p-1 white">
                                <h4><?= $this->lang->line('today_sales') ?></h4>
                                <h5 class="text-bold-400 mb-0"><i class="ft-arrow-up"></i><?= amountExchange($todaysales, 0, $this->aauth->get_user()->loc) ?>
                                </h5>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card  rounded shadow">
            <div class="card-body p-5">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo base_url('assets/images/sales2.png'); ?>"> 
                    </div>
                    <div class="col-md-8">
                        <div class="p-1  white">
                            <h4><?php echo $this->lang->line('this_month_sales') ?></h4>
                            <h5 class="text-bold-400 mb-0"><i class="ft-arrow-up"></i> <?= amountExchange($monthsales, 0, $this->aauth->get_user()->loc) ?>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row match-height">
    <div class="col-xl-8 col-lg-12">
        <div class="card rounded bg-white">
            <div class="card-header">
                <h4 class="card-title"><?php echo $this->lang->line('in_last _30') ?></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a href="#" class="btn btn-danger btn-sm" data-action="reload">Refresh</a></li>
                        <li><a href="#" class="btn btn-success btn-sm text-white" data-action="expand">Expand</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div id="products-sales" class="height-300"></div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body text-left w-100">
                                            <h3 class="primary"><?= amountExchange($todayinexp['credit'], 0, $this->aauth->get_user()->loc) ?></h3>
                                            <span><?php echo $this->lang->line('today_income') ?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"
                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body text-left w-100">
                                            <h3 class="danger"><?= amountExchange($todayinexp['debit'], 0, $this->aauth->get_user()->loc) ?></h3>
                                            <span><?php echo $this->lang->line('today_expenses') ?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 40%"
                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body text-left w-100">
                                            <h3 class="success"><?= amountExchange($todayprofit, 0, $this->aauth->get_user()->loc) ?></h3>
                                            <span><?php echo $this->lang->line('today_profit') ?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 60%"
                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card rounded shadow">

                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body text-left w-100">
                                        <h3 class="warning"><?= amountExchange($tt_inc - $tt_exp, 0, $this->aauth->get_user()->loc) ?></h3>
                                        <span><?php echo $this->lang->line('revenue') ?></span>
                                    </div>

                                </div>
                                <div class="progress progress-sm mt-1 mb-0">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 35%"
                                         aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card rounded">
            <div class="card-header">
                <h4 class="card-title"><?php echo $this->lang->line('Recent Buyers') ?></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a href="#" class="btn btn-danger btn-sm" data-action="reload">Refresh</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div id="recent-buyers" class="media-list height-450  mt-1 position-relative">
                    <?php
                    if (isset($recent_buy[0]['csd'])) {
                        foreach ($recent_buy as $item) {
                            ?>
                            <div class="card mb-3 bg-light rounded shadow-sm">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="text-center p-3">
                                            <img src="<?php echo base_url() . 'userfiles/customers/thumbnail/' . $item['picture']; ?>" class="img-fluid rounded-circle" alt="..." width="50" height="50">   
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body align-items-center">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <h5 class="card-title"><?php echo $item['name']; ?></h5>
                                                    <h6 class="card-text"><?php echo amountExchange($item['total'], 0, $this->aauth->get_user()->loc); ?></h6>
                                                </div>
                                                <div class="col-md-5">
                                                    <h5><span class="badge rounded-pill bg-success"><?php echo $this->lang->line(ucwords($item['status'])); ?></span></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } elseif ($recent_buy == 'sql') {
                        echo ' <div class="media-body w-100">  <h5 class="list-group-item-heading bg-danger white">Critical SQL Strict Mode Error: </h5>Please Disable Strict SQL Mode for in database  settings.</div>';
                    }
                    ?>
                </div>    
            </div>
        </div>
    </div>
</div>
<div class="row match-height">
    <div class="col-xl-8 col-lg-12">
        <div class="card rounded">
            <div class="card-header">
                <h4 class="card-title"><?php echo $this->lang->line('recent_invoices') ?></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <p><span class="float-right"> <a
                                href="<?php echo base_url() ?>invoices/create"
                                class="btn btn-primary btn-sm rounded"><?php echo $this->lang->line('Add Sale') ?></a>
                            <a
                                href="<?php echo base_url() ?>invoices"
                                class="btn btn-success btn-sm rounded"><?php echo $this->lang->line('Manage Invoices') ?></a>
                            <a
                                href="<?php echo base_url() ?>pos_invoices"
                                class="btn btn-danger btn-sm rounded ">&nbsp;&nbsp;<?php echo $this->lang->line('POS') ?>&nbsp;&nbsp;</a></span>
                    </p>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="recent-orders" class="table table-striped table-bordered table-sm table-hover mb-1 border-primary">
                        <thead>
                            <tr>
                                <th><?php echo $this->lang->line('Invoices') ?>#</th>
                                <th><?php echo $this->lang->line('Customer') ?></th>
                                <th><?php echo $this->lang->line('Status') ?></th>
                                <th><?php echo $this->lang->line('Due') ?></th>
                                <th><?php echo $this->lang->line('Amount') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($recent as $item) {
                                $page = 'subscriptions';
                                $t = 'Sub ';
                                if ($item['i_class'] == 0) {
                                    $page = 'invoices';
                                    $t = '';
                                } elseif ($item['i_class'] == 1) {
                                    $page = 'pos_invoices';
                                    $t = 'POS ';
                                }
                                echo '    <tr>
                                <td class="text-truncate"><a href="' . base_url() . $page . '/view?id=' . $item['id'] . '">' . $t . '#' . $item['tid'] . '</a></td>
                             
                                <td class="text-truncate"> ' . $item['name'] . '</td>
                                <td class="text-truncate"><span class="badge  st-' . $item['status'] . ' st-' . $item['status'] . '">' . $this->lang->line(ucwords($item['status'])) . '</span></td>
                                <td class="text-truncate">' . dateformat($item['invoicedate']) . '</td>
                                <td class="text-truncate">' . amountExchange($item['total'], 0, $this->aauth->get_user()->loc) . '</td>
                            </tr>';
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="header-block">
                    <h4 class="title">
                        <?php echo $this->lang->line('income_vs_expenses') ?>
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <div id="salesbreakdown" class="card mt-2"
                     data-exclude="xs,sm,lg">
                    <div class="dashboard-sales-breakdown-chart" id="dashboard-sales-breakdown-chart"></div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<div class="row match-height">
    <div class="col-md-3 col-lg-3 col-sm-3">
        <div class="card rounded shadow">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-8">
                        <h3 class="primary"><?php $ipt = sprintf("%0.0f", ($tt_inc * 100) / $goals['income']); ?><?php echo ' ' . $ipt . '%' ?></h3><?= '<span class=" font-medium-1 display-block">' . date('F') . ' ' . $this->lang->line('income') . '</span>'; ?>
                        <span class="font-medium-1"><?= amountExchange($tt_inc, 0, $this->aauth->get_user()->loc) . '/' . amountExchange($goals['income'], 0, $this->aauth->get_user()->loc) ?></span>   
                    </div>
                    <div class="col-md-4">
                        <div class="item-icon bg-light-green ">
                            <i class="flaticon-classmates text-green"></i>
                        </div>  
                    </div>
                </div>
                <div class="progress mt-4">
                    <div class="progress-bar-striped" role="progressbar" style="width: <?= $ipt ?>%"
                         aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>   
    </div>
    <div class="col-md-3 col-lg-3 col-sm-3">
        <div class="card rounded shadow">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-8">
                        <h3 class="red"><?php $ipt = sprintf("%0.0f", ($tt_exp * 100) / $goals['expense']); ?><?php echo ' ' . $ipt . '%' ?></h3><?= '<span class="font-medium-1 display-block">' . date('F') . ' ' . $this->lang->line('expenses') . '</span>'; ?>
                        <span class="font-medium-1"><?= amountExchange($tt_exp, 0, $this->aauth->get_user()->loc) . '/' . amountExchange($goals['expense'], 0, $this->aauth->get_user()->loc) ?></span> 
                    </div>
                    <div class="col-md-4">
                        <div class="item-icon bg-light-green ">
                            <i class="flaticon-classmates text-green"></i>
                        </div>  
                    </div>
                </div>
                <div class="progress mt-4">
                    <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>    
    </div>
    <div class="col-md-3 col-lg-3 col-sm-3">
        <div class="card shadow rounded">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-8">
                        <h3 class="blue"><?php $ipt = sprintf("%0.0f", ($monthsales * 100) / $goals['sales']); ?><?php echo ' ' . $ipt . '%' ?></h3><?= '<span class="font-medium-1 display-block">' . date('F') . ' ' . $this->lang->line('sales') . '</span>'; ?>
                        <span class="font-medium-1"><?= amountExchange($monthsales, 0, $this->aauth->get_user()->loc) . '/' . amountExchange($goals['sales'], 0, $this->aauth->get_user()->loc) ?></span>
                    </div>
                    <div class="col-md-4">
                        <div class="item-icon bg-light-green ">
                            <i class="flaticon-classmates text-green"></i>
                        </div>  
                    </div>
                </div>
                <div class="progress mt-4">
                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>   
    </div>
    <div class="col-md-3 col-lg-3 col-sm-3">
        <div class="card shadow rounded">
            <div class="card-content">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-8">
                            <h3 class="purple"><?php $ipt = sprintf("%0.0f", (($tt_inc - $tt_exp) * 100) / $goals['sales']); ?><?php echo ' ' . $ipt . '%' ?></h3><?= '<span class="font-medium-1 display-block">' . date('F') . ' ' . $this->lang->line('net_income') . '</span>'; ?>
                            <span class="font-medium-1"><?= amountExchange($tt_inc - $tt_exp, 0, $this->aauth->get_user()->loc) . '/' . amountExchange($goals['netincome'], 0, $this->aauth->get_user()->loc) ?></span>
                        </div>
                        <div class="col-md-4">
                            <div class="item-icon bg-light-green ">
                                <i class="flaticon-classmates text-green"></i>
                            </div>  
                        </div>
                    </div>
                    <div class="progress mt-4">
                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<div class="row match-height">
    <div class="col-xl-7 col-lg-12">
        <div class="card shadow rounded" id="transactions">
            <div class="card-body">
                <h4><?php echo $this->lang->line('cashflow') ?></h4>
                <p><?php echo $this->lang->line('graphical_presentation') ?></p>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1"
                           href="#sales"
                           aria-expanded="true"><?php echo $this->lang->line('income') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2"
                           href="#transactions1"
                           aria-expanded="false"><?php echo $this->lang->line('expenses') ?></a>
                    </li>
                </ul>
                <div class="tab-content pt-1">
                    <div role="tabpanel" class="tab-pane active" id="sales" aria-expanded="true"
                         data-toggle="tab">
                        <div id="dashboard-income-chart"></div>

                    </div>
                    <div class="tab-pane" id="transactions1" data-toggle="tab" aria-expanded="false">
                        <div id="dashboard-expense-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-5 col-lg-12">
        <div class="card rounded shadow">
            <div class="card-header">
                <h4 class="card-title"><?php echo $this->lang->line('task_manager') . ' ' ?> 
                    <a class="btn btn-primary btn-sm" href="<?php echo base_url() ?>manager/todo">Go to</a>
                </h4>
            </div>
            <div class="card-body">
                <div id="daily-activity">
                    <table class="table table-striped table-sm table-hover table-bordered  table-responsive" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo $this->lang->line('Tasks') ?></th>
                                <th><?php echo $this->lang->line('Status') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $t = 0;
                            foreach ($tasks as $row) {
                                $name = '<a class="check text-default" data-id="' . $row['id'] . '" data-stat="Due"> <i class="fa fa-check"></i> </a><a href="#" data-id="' . $row['id'] . '" class="view_task"></a>';
                                if ($row['status'] == 'Done') {
                                    $name = '<a class="check text-success" data-id="' . $row['id'] . '" data-stat="Done"> <i class="fa fa-check"></i> </a><a href="#" data-id="' . $row['id'] . '" class="view_task"></a>';
                                }

                                echo ' <tr>
                                <td class="text-truncate">
                                   ' . $name . '
                                </td>
                                <td class="text-truncate">' . $row['name'] . '</td>
                                <td class="text-truncate"><span id="st' . $t . '" class="badge badge-default task_' . $row['status'] . '">' . $row['status'] . '</span></td>
                            </tr>';

                                $t++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row match-height">
    <div class="col-xl-8 col-lg-12">
        <div class="card rounded shadow">
            <div class="card-header">
                <h4 class="card-title"><?php echo $this->lang->line('recent') ?> 
                </h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a
                                href="<?php echo base_url() ?>transactions"
                                class="btn btn-primary btn-sm rounded"><?php echo $this->lang->line('Transactions') ?></a></li>
                        <li><a data-action="reload" class="btn btn-danger btn-sm">Refresh</a></li>

                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-sm table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo $this->lang->line('Date') ?>#</th>
                                <th><?php echo $this->lang->line('Account') ?></th>
                                <th><?php echo $this->lang->line('Debit') ?></th>
                                <th><?php echo $this->lang->line('Credit') ?></th>
                                <th><?php echo $this->lang->line('Method') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($recent_payments as $item) {

                                echo '<tr>
                                <td class="text-truncate"><a href="' . base_url() . 'transactions/view?id=' . $item['id'] . '">' . dateformat($item['date']) . '</a></td>
                                <td class="text-truncate"> ' . $item['account'] . '</td>
                                <td class="text-truncate">' . amountExchange($item['debit'], 0, $this->aauth->get_user()->loc) . '</td>
                                <td class="text-truncate">' . amountExchange($item['credit'], 0, $this->aauth->get_user()->loc) . '</td>                    
                                <td class="text-truncate">' . $this->lang->line($item['method']) . '</td>
                            </tr>';
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card shadow rounded">
            <div class="card-header ">
                <h4 class="card-title"><?php echo $this->lang->line('Stock Alert') ?></h4>
            </div>
            <div class="card-body">

                <ul class="list-group list-group-flush">
                    <?php
                    foreach ($stock as $item) {
                        echo '<li class="list-group-item"><span class="badge bg-danger fs-5">' . +$item['qty'] . ' ' . $item['unit'] . '</span> <a href="' . base_url() . 'products/edit?id=' . $item['pid'] . '"><span class="badge bg-warning fs-5">' . $item['product_name'] . '</span></a><small class="purple float-end"><span class="badge bg-success fs-5"> <i class="ft-map-pin"></i> ' . $item['title'] . '</span></small>
                                </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(window).on("load", function () {
        $('#recent-buyers').perfectScrollbar({
            wheelPropagation: true
        });
        /********************************************
         *               PRODUCTS SALES              *
         ********************************************/
        var sales_data = [
<?php
foreach ($countmonthlychart as $row) {
    echo "{ y: '" . $row['date'] . "', sales: " . intval(amountExchange_s($row['total'], 0, $this->aauth->get_user()->loc)) . ", invoices: " . intval($row['ttlid']) . "},";
}
?>
        ];
        var months = ["<?= lang('Jan') ?>", "<?= lang('Feb') ?>", "<?= lang('Mar') ?>", "<?= lang('Apr') ?>", "<?= lang('May') ?>", "<?= lang('Jun') ?>", "<?= lang('Jul') ?>", "<?= lang('Aug') ?>", "<?= lang('Sep') ?>", "<?= lang('Oct') ?>", "<?= lang('Nov') ?>", "<?= lang('Dec') ?>"];
        Morris.Area({
            element: 'products-sales',
            data: sales_data,
            xkey: 'y',
            ykeys: ['sales', 'invoices'],
            labels: ['sales', 'invoices'],
            behaveLikeLine: true,
            xLabelFormat: function (x) { // <--- x.getMonth() returns valid index
                var day = x.getDate();
                var month = months[x.getMonth()];
                return day + ' ' + month;
            },
            resize: true,
            pointSize: 0,
            pointStrokeColors: ['#00B5B8', '#FA8E57', '#F25E75'],
            smooth: true,
            gridLineColor: '#E4E7ED',
            numLines: 6,
            gridtextSize: 14,
            lineWidth: 0,
            fillOpacity: 0.9,
            hideHover: 'auto',
            lineColors: ['#00B5B8', '#F25E75']
        });


    });
</script>
<script type="text/javascript">
    function drawIncomeChart(dataVisits) {
        $('#dashboard-income-chart').empty();
        Morris.Area({
            element: 'dashboard-income-chart',
            data: dataVisits,
            xkey: 'x',
            ykeys: ['y'],
            ymin: 'auto 40',
            labels: ['<?php echo $this->lang->line('Amount') ?>'],
            xLabels: "day",
            hideHover: 'auto',
            yLabelFormat: function (y) {
                // Only integers
                if (y === parseInt(y, 10)) {
                    return y;
                } else {
                    return '';
                }
            },
            resize: true,
            lineColors: [
                '#00A5A8',
            ],
            pointFillColors: [
                '#00A5A8',
            ],
            fillOpacity: 0.4,
        });
    }

    function drawExpenseChart(dataVisits2) {

        $('#dashboard-expense-chart').empty();
        Morris.Area({
            element: 'dashboard-expense-chart',
            data: dataVisits2,
            xkey: 'x',
            ykeys: ['y'],
            ymin: 'auto 0',
            labels: ['<?php echo $this->lang->line('Amount') ?>'],
            xLabels: "day",
            hideHover: 'auto',
            yLabelFormat: function (y) {
                // Only integers
                if (y === parseInt(y, 10)) {
                    return y;
                } else {
                    return '';
                }
            },
            resize: true,
            lineColors: [
                '#ff6e40',
            ],
            pointFillColors: [
                '#34cea7',
            ]
        });
    }

    drawIncomeChart(dataVisits);
    drawExpenseChart(dataVisits2);
    $('#dashboard-sales-breakdown-chart').empty();
    Morris.Donut({
        element: 'dashboard-sales-breakdown-chart',
        data: [{
                label: "<?php echo $this->lang->line('Income') ?>",
                value: <?= intval(amountExchange_s($tt_inc, 0, $this->aauth->get_user()->loc)); ?>},
            {
                label: "<?php echo $this->lang->line('Expenses') ?>",
                value: <?= intval(amountExchange_s($tt_exp, 0, $this->aauth->get_user()->loc)); ?>}
        ],
        resize: true,
        colors: ['#34cea7', '#ff6e40'],
        gridTextSize: 6,
        gridTextWeight: 400
    });
    $('a[data-toggle=tab').on('shown.bs.tab', function (e) {
        window.dispatchEvent(new Event('resize'));
    });
</script>