<div class="card no-border bg-light">    
    <div class="card-header no-border">
        <h4> <?php echo $title ?></h4>
    </div>
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div> 
        <table id="purchase" class="table table-striped table-bordered zero-configuration table-sm ">
                <thead>
                    <tr>
                        <th class="no-sort">#</th>
                        <th>Code</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Vehicle</th>
                        <th>Disc</th>
                        <th>Tax</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Balance</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
        </table>
    </div>
</div>