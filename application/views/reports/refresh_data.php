<div class="card border border-1 rounded-0">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6><?php echo $this->lang->line('data are regenerating') ?></h6>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    setTimeout(function () {
        $.ajax({

            url: baseurl + 'reports/refresh_process',
            dataType: 'json',
            success: function () {
                window.location.href = baseurl + 'reports/statistics';

            },
            error: function () {

            }

        });
    }, 2000);

</script>


