<?php echo view('/layout/header'); ?>
<main class="main-bg">
  <div class="grid-container">
   <div class="row-grid j-center a-center h-100">
      <div class="item1 flex50 ">
        <?php if (session('error') != "") {?>
            <div class="error-message">
                  <h4 class='alert-heading'><?=session('error');?></h4>
            </div>
          <?php }?>
          <?php if (session('success') != "") {?>
            <div class="success-message">
                  <h4 class='alert-heading'><?=session('success');?></h4>
            </div>
          <?php }?>
<form method="POST" action="<?=site_url('login');?>" accept-charset="UTF-8" class="form-main">
    <p>
        <label><?=lang('Auth.email')?></label>
        <input required type="email" name="email" value="<?=old('email')?>" />
    </p>
    <p>
        <label><?=lang('Auth.password')?></label>
        <input required minlength="5" type="password" name="password" value="" />
    </p>
    <p>
        <?=csrf_field()?>
        <button type="submit" class="submit"><?=lang('Auth.login')?></button>
    </p>
</form>
 </div>
   </div>
  </div>
</main>
<?php echo view('/layout/footer'); ?>