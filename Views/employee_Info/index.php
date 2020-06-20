<?php $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<?= view('_notifications') ?>

<!-- Include Quill stylesheet -->
<link href="<?= base_url()?>/assets/css/quill.snow.css" rel="stylesheet">
<link href="<?= base_url()?>/assets/css/select2.min.css" rel="stylesheet"/>
<link href="<?= base_url()?>/assets/css/select2_custom.css" rel="stylesheet"/>
<style>
.error{
    color: #D8000C;
}

#editor-container {
  height: 200px;
}
#emp_info_form label{
   float: left;
}
</style>

<main class="main-bg">
  <div class="grid-container">
    <div class="row-grid">
      <div class="item1 item-colum">
            <h1>Employee Info Form</h1>
            <form id="emp_info_form" action="<?= base_url('EmployeeInfoController/saveEmplyeeInfo');?>" method="POST">
                <input type="hidden" name="company_structure_id" value="<?= (isset($company_structure_id) && !empty($company_structure_id)) ? $company_structure_id : ''  ?>" />
               <div class="form-group hidden">
                    <label for="title">Select Title</label>
                    <select class="form-control" id="id" name="id"></select>
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter title">
                </div>
<div class="clearfix"></div>

                <div class="row employee_section" >
                    <div class="form-group col-md-4">
                        <label for="title">Employee</label>
                        <select class="form-control" id="employee_id" name="employee_id"></select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="title">Email</label>
                        <input type="text" readonly="readonly" class="form-control" id="emp_email" placeholder="Employee email">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="title">Telephone</label>
                        <input type="text" readonly="readonly"  class="form-control" id="emp_tel" placeholder="Employee telephone">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="title">Department</label>
                        <input type="text" readonly="readonly"  class="form-control" id="emp_dep" placeholder="Employee department">
                    </div>
                </div>
                <div class="form-group">
                    <label for="editor-container">Description</label>
                    <div class="clearfix"></div>

                    <div id="editor-container"></div>
               </div>

<?php /*?>
               <div class="form-group">
                    <label for="title">Title from toms</label>
                    <select class="form-control" id="toms_id" name="toms_id"></select>
                </div>
                */?>

               <div class="form-group pull-right">
                    <button type="button" class="btn btn-danger mt-5" onclick="resetForm()">Cancel</button>
                    <?php if(!empty($validRequest)){ ?>
                        <button type="button" id="save_btn" class="btn btn-success mt-5">Save</button>
                   <?php }?>
               </div>
            </form>
      </div>
    </div>
  </div>
</main>
<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<!-- Include the Quill library -->
<script src="<?php echo base_url();?>/assets/js/quill.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/select2.min.js"></script>
    <!-- jquery-validation -->
<script src="<?= base_url() ?>/assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="<?= site_url(); ?>/assets/js/pages/employee_info.js"></script>
<?= $this->endSection() ?>