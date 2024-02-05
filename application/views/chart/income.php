
<div class="card border border-1 bg-light">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0">
            <h5 class="text-dark">Income  Graphical Reports</h5>
        </button>
     
        
    </div>
    <div class="card-content">
        
        <div class="card-body">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
            </div>
            <div class="card border border-1">
                <div class="card-body text-center">
                    <div class="form-group">
                <!-- basic buttons -->
                <button type="button"
                        class="update_chart btn btn-primary rounded-0 btn-lg"
                        data-val="week"><i
                        class="fa fa-clock-o"></i> <?= $this->lang->line('This') . ' ' . $this->lang->line('Week') ?>
                </button>
                <button type="button"
                        class="update_chart btn btn-danger rounded-0  btn-lg"
                        data-val="month"><i
                        class="fa fa-calendar"></i> <?= $this->lang->line('This') . ' ' . $this->lang->line('Month') ?>
                </button>
                <button type="button"
                        class="update_chart btn btn-success rounded-0  btn-lg"
                        data-val="year"><i
                        class="fa fa-book"></i> <?= $this->lang->line('This') . ' ' . $this->lang->line('Year') ?>
                </button>
                <button type="button"
                        class="update_chart btn btn-warning rounded-0  btn-lg"
                        data-val="custom"><i
                        class="fa fa-address-book"></i> <?= $this->lang->line('Custom Range') . ' ' . $this->lang->line('Date') ?>
                </button>

            </div>
                </div>
            </div>
            <div class="card border border-1" id="custom_c" style="display: none ">
                <div class="card-body">
                    <form id="chart_custom">
                <div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                            <fieldset class="form-group">
                                <label for="basicInput"><strong><?php echo $this->lang->line('From Date') ?></strong></label>
                                <input type="text" class="form-control rounded-0 required date30"
                                       placeholder="Start Date" name="sdate"
                                       data-toggle="datepicker" autocomplete="false">
                            </fieldset>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                            <fieldset class="form-group">
                                <label for="helpInputTop"><strong><?php echo $this->lang->line('To Date') ?></strong></label>
                                <input type="text" class="form-control rounded-0 required"
                                       placeholder="End Date" name="edate"
                                       data-toggle="datepicker" autocomplete="false">
                            </fieldset>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12 mb-1"><span class="mt-2"><br></span>
                            <fieldset class="form-group">
                                <input type="hidden" name="p"
                                       value="custom">
                                <button type="button" id="custom_update_chart"
                                        class="btn btn-primary">Submit
                                </button>
                            </fieldset>
                        </div>

                    </div>

                </div>
            </form>
                </div>
                
               
                
            </div>
            
            <div class="card border border-1">
                 <div class="card-body">
                <div class="card-body border border-2">
                    <div id="cat-chart" height="400"></div>
                </div>
            </div>
            </div>
            
            
            
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var cat_data = [
<?php
foreach ($chart as $item) {
    echo '{y: "' . $item['date'] . '", a: ' . $item['credit'] . ' },';
}
?>
        ];
        draw_c(cat_data);
    });

    function draw_c(cat_data) {
        $('#cat-chart').empty();
        Morris.Bar({
            element: 'cat-chart',
            data: cat_data,
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Amount'],
            barColors: [
                '#dc3545',
            ],
            barFillColors: [
                '#dc3545',
            ],
            barOpacity: '',
        });
    }

    $(document).on('click', ".update_chart", function (e) {
        e.preventDefault();
        var a_type = $(this).attr('data-val');
        if (a_type == 'custom') {
            $('#custom_c').show();
        } else {
            $.ajax({
                url: baseurl + 'chart/income_update',
                dataType: 'json',
                method: 'POST',
                data: {
                    'p': $(this).attr('data-val'),
                    '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash(); ?>'
                },
                success: function (data) {
                    draw_c(data);
                }
            });
        }
    });


    $(document).on('click', "#custom_update_chart", function (e) {
        e.preventDefault();
        $.ajax({
            url: baseurl + 'chart/income_update',
            dataType: 'json',
            method: 'POST',
            data: $('#chart_custom').serialize() + '&<?= $this->security->get_csrf_token_name() ?>=<?= $this->security->get_csrf_hash(); ?>',
            success: function (data) {
                draw_c(data);
            }
        });

    });


</script>