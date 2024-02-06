<div class="card no-border bg-light">    
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div> 
        <table id="cashbond" class="table table-striped table-bordered zero-configuration table-sm ">
                <thead>
                    <tr>
                        <th class="no-sort">#</th>
                        <th>Date</th>
                        <th>Staff</th>
                        <th>Description</th>
                        <th>Account</th>
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
<script>
    function showPayment(_id){
        window.location = 'finance/cashbondpayment_add/'+_id;
    }
    
</script>