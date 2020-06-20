<?php $this->extend($config->viewLayout) ?>

<?= $this->section('main') ?>

<?= view('_notifications') ?>
<link href="<?= base_url()?>/assets/css/datatable/custom_form_template.css" rel="stylesheet"/>
<style type="text/css">
  table td{
    text-align: left;
  }
  #container {
    text-align: center;
    margin: 0;
  }

  #qr-canvas {
    margin: auto;
    width: calc(100% - 20px);
    max-width: 400px;
  }

  #btn-scan-qr {
    cursor: pointer;
  }

  #btn-scan-qr img {
    height: 10em;
    padding: 15px;
    margin: 15px;
    background: white;
  }

  #qr-result {
    font-size: 1.2em;
    margin: 20px auto;
    padding: 20px;
    max-width: 700px;
    background-color: white;
  }
</style>
<main class="main-bg">
  <div class="grid-container">
    <div class="row-grid">
      <div class="item1 item-colum">

        <h1>Employee Roles Details</h1>

		<?= view('employee_Roles_details/form_template'); ?>


        <table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable" data-ajaxurl="<?= site_url('EmployeeRolesDetailsController/ajax_add_edit'); ?>" width="100%">
          <thead>
            <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Role</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</main>


<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
            <div>
                <b>Device has camera: </b>
                <span id="cam-has-camera"></span>
                <br>
                <video muted playsinline id="qr-video"></video>
            </div>

            <b>Detected QR code: </b>
            <span id="cam-qr-result">None</span>

            <b>Last detected at: </b>
            <span id="cam-qr-result-timestamp"></span>
            <hr>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/moment-2.18.1/dt-1.10.20/b-1.6.1/sl-1.3.1/datatables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/datatable/generator-base.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/datatable/editor.dataTables.min.css">

<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/moment-2.18.1/dt-1.10.20/b-1.6.1/sl-1.3.1/datatables.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>/assets/js/datatable/dataTables.editor.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>/assets/js/pages/employee_roles_details.js"></script>
<!-- <script src="<?php echo base_url();?>/assets/js/qr_packed.js"></script> -->
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>/assets/js/qrCodeScanner.js"></script>
<?= $this->endSection() ?>