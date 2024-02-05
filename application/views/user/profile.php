<div class="card border border-1 shadow rounded-0 bg-light">
    <div class="card-header">
        <h5><?php echo $employee['name'] ?></h5>
    </div>
    <div class="card-body">
        <div class="card-body border border-2 border-success">
            <div class="btn btn-success rounded-0" style="margin-top: -4rem">Profile</div>
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <div class="message"></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card mb-3 border border-1 rounded">
                            <div class="row g-0">
                                <div class="col-md-5">
                                    <img src="<?php echo base_url('userfiles/employee/' . $employee['picture']); ?>" class="rounded mx-auto d-block mt-3" alt="...">
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $employee['name'] ?></h5>
                                        <p class="card-text"><?php echo $employee['city'] ?></p>
                                        <p class="card-text">

                                            <strong><?php echo $this->lang->line('Address') ?>
                                                : </strong><?php echo $employee['address'] ?>
                                        </p>
                                        <p class="card-text">

                                            <strong><?php echo $this->lang->line('City') ?>
                                                : </strong><?php echo $employee['city'] ?>


                                        </p>
                                        <p class="card-text">

                                            <strong><?php echo $this->lang->line('Country') ?>
                                                : </strong><?php echo $employee['country'] ?>


                                        </p>
                                        <p class="card-text">

                                            <strong><?php echo $this->lang->line('PostBox') ?>
                                                : </strong><?php echo $employee['postbox'] ?>


                                        </p>
                                        <p class="card-text">
                                        <div class="col-md-12">
                                            <strong><?php echo $this->lang->line('Phone') ?></strong> <?php echo $employee['phone']; ?>
                                        </div>

                                        </p>
                                        <p class="card-text">
                                        <div class="col-md-12">
                                            <strong>EMail</strong> <?php echo $employee['email']; ?>
                                        </div>

                                        </p>
                                        <p class="card-text">
                                        <div class="col-md-12">
                                            <strong><?php echo $this->lang->line('Salary') ?></strong> <?php echo ' ' . amountExchange($employee['salary'], 0, $this->aauth->get_user()->loc); ?>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card border border-1 rounded">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="<?php echo base_url('employee/invoices?id=' . $eid) ?>"
                                           class="btn btn-primary rounded-0 mt-2"><?php echo $this->lang->line('Invoices') ?> <?php echo $this->lang->line('View') ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <a href="<?php echo base_url('employee/transactions?id=' . $eid) ?>"
                                       class="btn btn-warning rounded-0 mt-2"><?php echo $this->lang->line('Transactions') ?> <?php echo $this->lang->line('View') ?>
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="<?php echo base_url('user/update?id=' . $eid) ?>"
                                       class="btn btn-danger rounded-0 mt-2"> <?php echo $this->lang->line('Edit') ?> <?php echo $this->lang->line('Account') ?>
                                    </a>
                                </div>
                                <div class="col-sm-6">


                                    <a href="<?php echo base_url('user/salary?id=' . $eid) ?>" class="btn btn-info rounded-0 mt-2"> <?php echo $this->lang->line('Salary') ?>
                                    </a>


                                </div>
                                <div class="col-sm-6">

                                    <p class="text-muted mt-2"><?php echo $this->lang->line('Your Signature') ?></p>
                                    <img alt="image" class="card-img-top img-fluid"
                                         src="<?php echo base_url('userfiles/employee_sign/' . $employee['sign']); ?>">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
