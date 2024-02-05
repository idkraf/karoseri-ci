<div class="card border border-1 bg-light rounded-0">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6"> 
                <button class="btn btn-outline-warning rounded-0 text-dark">
                    <h5><?php echo $this->lang->line('Company Statistics') ?></h5>
                </button>
            </div>
            <div class="col-md-6">
                <a class="btn btn-primary float-end rounded-0" href="<?php echo base_url('reports/refresh_data')?>">Refresh</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="card-body border border-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="card border border-1">
                        <div class="card-header no-border">
                            <button class="btn btn-warning rounded-0 text-dark" style="width:100%">
                                <h6><?php echo $this->lang->line('Sales in last 12 months') ?></h6>
                            </button>
                            
                        </div>
                        <div class="card-body">
                            <div id="invoices-sales-chart"></div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="card border border-1">
                        <div class="card-header no-border">
                            <h6 class="card-title"><?php echo $this->lang->line('Products in last 12 months') ?></h6>
                        </div>
                        <div class="card-body">
                            <div id="invoices-products-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 ">
                    <div class="card border border-2 bg-light rounded-0">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo $this->lang->line('All Time Detailed Statistics') ?></h4>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm table-bordered table-dark">
                                    <thead>
                                        <tr>
                                            <th><?php echo $this->lang->line('Month') ?></th>
                                            <th><?php echo $this->lang->line('Income') ?></th>
                                            <th><?php echo $this->lang->line('Expenses') ?></th>
                                            <th><?php echo $this->lang->line('Sales') ?></th>
                                            <th><?php echo $this->lang->line('Invoices') ?></th>
                                            <th><?php echo $this->lang->line('sold') . $this->lang->line('products') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($stat as $item) {
                                            // $month=date("F", $item['month']);


                                            $dateObj = DateTime::createFromFormat('!m', $item['month']);
                                            $month = $dateObj->format('F');
                                            echo '<tr>
                                <td class="text-truncate">' . $month . ', ' . $item['year'] . '</td>
                                <td class="text-truncate"> ' . $item['income'] . '</td>
                            
                                <td class="text-truncate">' . $item['expense'] . '</td>
                                 <td class="text-truncate">' . $item['sales'] . '</td>
                                  <td class="text-truncate">' . $item['invoices'] . '</td>
                                   <td class="text-truncate">' . $item['items'] . '</td>
                               
                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $('#invoices-sales-chart').empty();
    Morris.Bar({
        element: 'invoices-sales-chart',
        data: [
<?php
$i = 0;
foreach (array_reverse($stat) as $row) {
    if ($i > 11)
        exit;
    $num = cal_days_in_month(CAL_GREGORIAN, $row['month'], $row['year']);
    echo "{ x: '" . $row['year'] . '-' . sprintf("%02d", $row['month']) . "-$num', y: " . intval($row['income']) . ", z: " . intval($row['expense']) . "},";
    $i++;
}
?>
        ],
        xkey: 'x',
        ykeys: ['y', 'z'],
        labels: ['Income', 'expense'],
        hideHover: 'auto',
        resize: true,
        barColors: ['#34cea7', '#ff6e40'],
    });

    $('#invoices-products-chart').empty();

    Morris.Line({
        element: 'invoices-products-chart',
        data: [
<?php
$i = 0;
foreach (array_reverse($stat) as $row) {
    if ($i > 11)
        exit;
    $num = cal_days_in_month(CAL_GREGORIAN, $row['month'], $row['year']);
    echo "{ x: '" . $row['year'] . '-' . sprintf("%02d", $row['month']) . "-$num', y: " . intval($row['items']) . ", z: " . intval($row['invoices']) . "},";
    $i++;
}
?>
        ],
        xkey: 'x',
        ykeys: ['y', 'z'],
        labels: ['Products', 'Invoices'],
        hideHover: 'auto',
        resize: true,
        lineColors: ['#34cea7', '#ff6e40'],
    });
</script>