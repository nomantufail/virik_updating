<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <section class="col-md-6">
                    <h1 class="page-header">
                        Customers <small></small>
                    </h1>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="panel-body">
                    <div id="myTabContent" class="" style="min-height: 500px;">
                        <section style="" class="col-lg-12 center-block">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-user fa-fw"></i> Add Customer</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group">
                                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <strong>Error! </strong>', '</div>'); ?>
                                        <?php
                                        //opening the form
                                        $attributes = array('class' => 'form-horizontal', 'role' => 'form');
                                        echo form_open(base_url().'customers/add', $attributes);
                                        ?>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Name</label>
                                            <div class="col-md-8">
                                                <?php
                                                $data = array(
                                                    'name' => 'name',
                                                    'class'=>'form-control',
                                                    'value'=>set_value('name'),
                                                    'placeholder'=>'customer name here...',
                                                    'maxlength'=>'100',
                                                );
                                                echo form_input($data);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Phone</label>
                                            <div class="col-md-8">
                                                <?php
                                                $data = array(
                                                    'name' => 'phone',
                                                    'class'=>'form-control',
                                                    'value'=>set_value('email'),
                                                    'placeholder'=>'customer phone here...',
                                                    'maxlength'=>'15',
                                                );
                                                echo form_input($data);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Email</label>
                                            <div class="col-md-8">
                                                <?php
                                                $data = array(
                                                    'name' => 'email',
                                                    'class'=>'form-control',
                                                    'value'=>set_value('email'),
                                                    'placeholder'=>'customer email here...',
                                                    'maxlength'=>'100',
                                                );
                                                echo form_input($data);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">ID Card#</label>
                                            <div class="col-md-8">
                                                <?php
                                                $data = array(
                                                    'name' => 'idCard',
                                                    'class'=>'form-control',
                                                    'value'=>set_value('idCard'),
                                                    'placeholder'=>'customer ID Card# here...',
                                                    'maxlength'=>'17',
                                                );
                                                echo form_input($data);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Address</label>
                                            <div class="col-md-8">
                                                <?php
                                                $data = array(
                                                    'name' => 'address',
                                                    'class'=>'form-control',
                                                    'value'=>set_value('address'),
                                                    'placeholder'=>'customer address here...',
                                                    'maxlength'=>'198',
                                                );
                                                echo form_input($data);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Image</label>
                                            <div class="col-md-8">
                                                <?php
                                                $data = array(
                                                    'name' => 'image',
                                                    'class'=>'form-control',
                                                    'value'=>set_value('image'),
                                                    'placeholder'=>'customer image here...',
                                                    'maxlength'=>'198',
                                                    'type'=>'file',
                                                );
                                                echo form_input($data);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label"></label>
                                            <div class="col-md-8">
                                                <?php
                                                $data = array(
                                                    'name' => 'addCustomer',
                                                    'class'=>'btn btn-success center-block',
                                                    'value'=>'Add Customer',
                                                );
                                                echo form_submit($data);
                                                ?>
                                            </div>
                                        </div>

                                        <?php
                                        //closing form
                                        form_close();
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <br><br>
                        <div class="text-left" style="font-size: 18px;">
                            <a href="#"><i class="fa fa-arrow-circle-left"> Back</i></a>
                        </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>