<!Doctype html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name=viewport content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/style.css">
      <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/upload.css">
	  <link href="<?= base_url()?>/assets/css/bootstrap.min.css" rel="stylesheet" />
      <link rel="stylesheet" href="<?= base_url()?>/assets/css/custom.css" />

      <title>
        <?php
          if (isset($title)) {
            echo $title . " - Smart DSMS";
          }
          else {
            echo "Smart DSMS";
          }
        ?>
      </title>

      <script type="text/javascript">
            var site_url = '<?= site_url() ?>';
      </script>
  </head>
<body>
<?php
if (session('isLoggedIn')) {
	echo view('_navbar');
}
?>

<main role="main" class="wrapper">
	<?= $this->renderSection('main') ?>
</main>

<footer>
<p class="footer-copyright">© <?= date('Y'); ?> Smart DSMS</p>
</footer>

<div class="footer-grid-container">
  <!-- <div class="footer-item1">

  </div> -->

  <?php
  //Only show "Sign-out" Button when User is logged in, otherwise displays nothing
    if (!isset($_SESSION['UserID'])) {
    }
    else {
      echo '<div class="footer-item2">
        <form action="includes/logout.inc.php" method="post">
          <button class="abmelden" type="submit" name="Logout-Bestätigen">Sign-out</button>
        </form>
      </div>';
    }
   ?>
</div>
<script src="<?php echo base_url();?>/assets/js/jquery-2.0.3.min.js"></script>
<script src="https://kit.fontawesome.com/8174167528.js" crossorigin="anonymous"></script>
<script src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/sweetalert.min.js"></script>

<script src="<?php echo base_url();?>/assets/js/script.js"></script>
<script type="text/javascript" src="<?= base_url()?>/assets/js/block_ui.js"></script>


<?= $this->renderSection('extra-js') ?>

<script src="<?= base_url()?>/assets/js/custom.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){

      $(".btn-save").click(function(){
        $("#aa").val('')
        $("#aa").val($(this).val());
      })
	// load_data();
	function load_data(query)
	{
		$.ajax({
			url: "./searchuser",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result').html(data);
          $('.add_user').click(function(){
            $("#user_email").val('');
            $("#fname").val('');
            $("#lname").val('');
            var email = $(this).closest("td").find("input[class='email']").val();
            var fname = $(this).closest("td").find("input[class='fname']").val();
            var lname = $(this).closest("td").find("input[class='lname']").val();
            $("#user_email").val(email);
            $("#fname").val(fname);
            $("#lname").val(lname);
          });
			}
		});
	}

	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();
		}
	});

  $("#create_acc").click(function(){
    if($("#user_email").val()!=''){
        $.ajax({
          url: "./sendmail",
          method:"post",
          data:{email:$("#user_email").val(),lname:$("#lname").val(),fname:$("#fname").val(),role_id:$("#user_role").val()},
          success:function(data)
          {

               var html = "<div id='error' class='success-message'>\n\<div class='alert alert-error'>\n\
                                <h4 class='alert-heading'>Mail sent to user create accout for user !</h4>\n\
                           </div>";
              $("#notice").append(html);
              setInterval(cleanup,7000);
              function cleanup(){
                $("#error").remove();
              }

          },
          error: function (error) {

              var html = "<div id='error' class='error-message'>\n\
                                <h4 class='alert-heading'>Can not create accout for user !</h4>\n\
                            </div>";
              $("#notice").append(html);
              setInterval(cleanup,7000);
              function cleanup(){
                $("#error").remove();
              }
              // alert('Error : ' + + eval(error));
          }
        });
      // console.log("email : "+ $("#user_email").val());
    }
  });
});
</script>

<script type="text/javascript">
    $(document).ready(function(){
      //load_user();
      function load_user(query)
      {
        $.ajax({
          url:"./search_user_report",
          method:"post",
          data:{query:query},
          success:function(data)
          {
            $('#result').html(data);
            $(".add_que").click(function(){
              var email = $(this).closest("td").find("input[class='email']").val();
              var fname = $(this).closest("td").find("input[class='fname']").val();
              var lname = $(this).closest("td").find("input[class='lname']").val();
              let row = "<tr><td>"+fname+"</td><td>"+lname+"</td><td>"+email+"</td><td><button class='btn btn-sm btn-danger remove_row'><i class='fas fa-trash'></i> Remove</button><input type='hidden' name='data[email][]' value='"+email+"'></td></tr>";

              $("#report >tbody").append(row);
              $("button.remove_row").click(function(){
                $(this).parents('tr').remove();
              });

            });

          }
        });
      }
      $('#search_user').keyup(function(){
        var search = $(this).val();
        if(search != '')
        {
          load_user(search);
        }
        else
        {
          load_user();
        }
      });

});
</script>


<script>
  $('.burger').click(function(){
    $('.menu-ul').toggleClass('active');
    $(this).toggleClass('active');
});
  $('.menu-li a').click(function(){
     //alert();
     if($(this).next('.menu-ul2').hasClass('open')){
        $('.menu-ul2').removeClass('open');
     }else{
      $('.menu-ul2').removeClass('open');
        $(this).next('.menu-ul2').toggleClass('open');
     }
 });

// $('.menu-li a').click(function(){
//     alert();
//     $(this).next('.menu-ul2').toggleClass('open');
// });
</script>

</body>
</html>