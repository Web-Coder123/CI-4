<?php $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<?= view('_notifications') ?>

<!-- Include Quill stylesheet -->
<link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet">
<style>
#editor-container {
  height: 375px;
}
</style>

<main class="main-bg">
  <div class="grid-container">
    <div class="row-grid">
      <div class="item1 item-colum " >
            <h1>zzz</h1>

    <form action="<?= base_url('EditorQuillController/saveEditorContent');?>" method="POST">
           <div id="editor-container"></div>

            <input type="hidden" name="article[title]" placeholder="Enter Title">
            <?php
            /*
             * <button type="button" class="btn btn-primary mt-5" onclick="return quillContents()">Save</button>
             */
            ?>

    </form>
      </div>
    </div>
  </div>
</main>
<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
<script src="<?= site_url(); ?>/assets/js/pages/quill_editor.js">
<?= $this->endSection() ?>