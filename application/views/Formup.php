<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" href="<?php echo base_url('assets/css/w3.css'); ?>">
   <link rel="stylesheet" href="<?php echo base_url('assets/css/Jcrop.css'); ?>">
   <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
   <script src="<?php echo base_url('assets/js/Jcrop.js') ?>" type="text/javascript"></script>
   <script>
      $(document).ready(function(){
         $('#form1').change(function(){
            var formData = new FormData(this);

            $.ajax({
               url: "<?php echo base_url(); ?>index.php/upload/uploadImage",
               type: 'POST',
               data: formData,
               success: function(res) {
                  var image = JSON.parse(res);
                  $("#name_file").attr('value', image),
                  $("#submitt").css('display', 'inline-block'),
                  $("#painel-miniatura").css('display', 'block'),
                  $("#target").attr('src', "<?php echo base_url('assets/uploads/'); ?>"+image)
               },
               cache: false,
               contentType: false,
               processData: false
            });
         });
      });
   </script>
   <script>
      jQuery(function($){

         // The variable jcrop_api will hold a reference to the
         // Jcrop API once Jcrop is instantiated.
         var jcrop_api;

         // In this example, since Jcrop may be attached or detached
         // at the whim of the user, I've wrapped the call into a function
         $("#target").click(function(){
            initJcrop();
         });
         // The function is pretty simple
         function initJcrop()//{{{
         {

           // Invoke Jcrop in typical fashion
           $('#target').Jcrop({
               onSelect: updateCoords
            },function(){

            jcrop_api = this;
           });

         };

         function updateCoords(c)
         {
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
         };

         function checkCoords()
         {
            if (parseInt($('#w').val())) return true;
               alert('Please select a crop region then press submit.');
               return false;
         };
      });
   </script>
</head>
<body class="w3-dark-grey">
	<div class="w3-content w3-grey w3-center">
		<div class="w3-center">
			<div class="w3-container w3-center w3-margin">
				<form id='form1' enctype="multipart/form-data">
					<div>
						Escolha sua imagem
					</div>
					<input type="file" name="Imagem" id="Imagem">
				</form>
			</div>
	        <div class="w3-container" id="outer">
	            <div class="jcExample">
		            <div class="article">
		               <?php //This is the image we're attaching Jcrop to ?>
		               <img id='target'/>

		            </div>
	        	</div>
	    	</div>
			<div class="w3-container">
				<?php //This is the form that our event handler fills
					echo form_open('upload/cropImage', array('id' => 'form2', 'onsubmit' => 'return checkCoords();'));
					echo form_input('name_file', '', array('id' => 'name_file', 'hidden' => ''));
					echo form_input('x', set_value('x'), array('id' => 'x', 'hidden' => ''));
					echo form_input('y', set_value('y'), array('id' => 'y', 'hidden' => ''));
					echo form_input('w', set_value('w'), array('id' => 'w', 'hidden' => ''));
					echo form_input('h', set_value('h'), array('id' => 'h', 'hidden' => ''));
					echo form_submit(NULL, 'Cropar Imagem', array('id'=>'submitt', 'class'=>'w3-margin-top', 'style'=>'display:none;'));
				?>
			</div>
		</div>
	</div>
</body>
</html>
