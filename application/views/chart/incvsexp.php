<div class="card border border-1 bg-light">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0 text-dark">
            <h5><?= $this->lang->line('Income') . ' vs ' . $this->lang->line('Income') . ' ' . $this->lang->line('Graphical Reports') ?></h5>
        </button>
    </div>
    <div class="card-body">
        <div class="card-body">
            <div class="card border border-1">
                <div class="card-body">
                    <div class="form-group float-end">
                        <div id="notify" class="alert alert-success" style="display:none;">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <div class="message"></div>
                        </div>


                        <!-- basic buttons -->
                        <button type="button"
                                class="update_chart btn btn-primary rounded-0 btn-lg"
                                data-val="week"><i
                                class="fa fa-clock-o"></i> <?= $this->lang->line('This') . ' ' . $this->lang->line('Week') ?>
                        </button>
                        <button type="button"
                                class="update_chart btn btn-danger rounded-0 btn-lg "
                                data-val="month"><i
                                class="fa fa-calendar"></i> <?= $this->lang->line('This') . ' ' . $this->lang->line('Month') ?>
                        </button>
                        <button type="button"
                                class="update_chart btn btn-warning rounded-0 btn-lg"
                                data-val="year"><i
                                class="fa fa-book"></i> <?= $this->lang->line('This') . ' ' . $this->lang->line('Year') ?>
                        </button>
                        <button type="button"
                                class="update_chart btn btn-success rounded-0  btn-lg"
                                data-val="custom"><i
                                class="fa fa-address-book"></i> <?= $this->lang->line('Custom Range') . ' ' . $this->lang->line('Date') ?>
                        </button>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card border border-1">
                        <div class="card-body">
                            <form id="chart_custom">
                                <div id="custom_c" style="display: none ">
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
                                                        class="btn btn-primary rounded-0">Submit
                                                </button>
                                            </fieldset>
                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border border-1">
                        <div class="card-body">
                            <div id="cat-chart" height="400"></div>
                        </div>
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
    if ($item['type'] == 'Income') {
        echo '{label: "' . $item['type'] . '", value: ' . $item['credit'] . ' },';
    } elseif ($item['type'] == 'Expense') {
        echo '{label: "' . $item['type'] . '", value: ' . $item['debit'] . ' },';
    }
}
?>
        ];
        draw_c(cat_data);
    });

    function draw_c(cat_data) {
        var cat_color = ['#ff0000', '#33cc33',
        ];
        $('#cat-chart').empty();

        Morris.Donut({
            element: 'cat-chart',
            data: cat_data,
            resize: true,
            colors: cat_color,
            gridTextSize: 6,
            gridTextWeight: 400
        });
    }


    $(document).on('click', ".update_chart", function (e) {
        e.preventDefault();
        var a_type = $(this).attr('data-val');
        if (a_type == 'custom') {
            $('#custom_c').show();
        } else {
            $.ajax({
                url: baseurl + 'chart/incvsexp_update',
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
            url: baseurl + 'chart/incvsexp_update',
            dataType: 'json',
            method: 'POST',
            data: $('#chart_custom').serialize() + '&<?= $this->security->get_csrf_token_name() ?>=<?= $this->security->get_csrf_hash(); ?>',
            success: function (data) {
                draw_c(data);
            }
        });

    });


</script>
<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Customer</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this customer?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="customers/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete-confirm">Delete</button>
                <button type="button" data-dismiss="modal" class="btn">Cancel</button>
            </div>
        </div>
    </div>
</div>