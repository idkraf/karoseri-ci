<div class="card border border-1 bg-light rounded-0">
    
        <div class="card-body">

            <h5>About</h5>
            <hr>
            <div class="form-group row">


                <div class="col-sm-12 text-center text-danger">
                    <h3>Smart POS</h3><h5 class="text-primary"><?php $url = file_get_contents(FCPATH . '/version.json');
                        $version = json_decode($url, true);
                        echo 'V ' . $version['version']?>
                    </h5>

                </div>
            </div>


        </div>
    
</div>

<script type="text/javascript">
    $("#time_update").click(function (e) {
        e.preventDefault();
        var actionurl = baseurl + 'settings/dtformat';
        actionProduct(actionurl);
    });
</script>

