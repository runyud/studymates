
<?php
//index.php

?>
<!DOCTYPE html>
<html>
 <head>
  <title>StudyMates</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
  <style>
  	#location_select {
  		min-height:190px; 
	    overflow-y :auto; 
	    overflow-x:hidden; 
	    position:absolute;
	    width:300px;
	    display: contents;
  	}
  </style>
 </head>
 <body>
  <br />
  <h2 align="center"><a href="#">We will match for you!</a></h2>
  <br />
  <div class="container">
   <form method="POST" id="request_form">
    <div class="form-group">
     <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Name" />
    </div>
    <div class="form-group">
      <input type="text" name="user_email" id="user_email" class="form-control"
      placeholder="Enter Email" />
    </div>
    <div class="form-group">
      <input list="dropdown" type="text" name="location" id="location" class="form-control"
      placeholder="Choose a Preferred Location" />
      <datalist id ="dropdown">
      	<option value="Central"/>
      	<option value="North"/>
      	<option value="Either"/>
      </datalist>
	</div>
    <div class="form-group">
    	<input type="text" name="open_from" id="open_from" class="form-control" placeholder="Time Available From : "/>
    	<script type="text/javascript">
        $(function() {
          $('input[name="open_from"]').timepicker({
            timeFormat: 'HH:mm a',
            dynamic: true,
          })
        });


      // $('#open_from').timepicker({
      //   timeFormat: 'hh:mm p',
      //   dynamic: true,
      // });
			// $(function() {
			//   $('input[name="time_opening"]').daterangepicker({
			//     timePicker: true,
   //        timePickerIncrement: 30,
   //        autoUpdateInput: false,
			//     locale: {
			//       format: 'hh:mm A'
			//     }
			//   }).on('show.daterangepicker', function(ev, picker) {
			//   	picker.container.find(".calendar-table").hide();
			//   });

   //      $('input[name="time_opening"]').on('apply.daterangepicker', function(ev, picker) {
   //        $(this).val(picker.startDate.format('hh:mm A') + ' - ' + picker.endDate.format('hh:mm A'));
   //      });
   //      $('input[name="time_opening"]').on('cancel.daterangepicker', function(ev, picker) {
   //        $(this).val('');
   //      });
			// });
		</script>
	</div>
  <div class="form-group">
    <input type="text" name="open_until" id="open_until" class="form-control" placeholder="Time Available Until : "/>
    <script type="text/javascript">
        $(function() {
          $('input[name="open_until"]').timepicker({
            timeFormat: 'HH:mm a',
            dynamic: true,
          })
        });
    </script>
  </div>
    <div class="form-group">
     <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
    </div>
   </form>
   <span id="request_message"></span>
   <br />
   <div id="display_comment"></div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 
 $('#request_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_requests.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#request_form')[0].reset();
     $('#request_message').html(data.error);
     //$('#open_from').reset();
     //$('#open_until').reset();
     //$('#comment_id').val('0');
    }
   }
  })
 });

 load_requests();

 function load_requests()
 {
  $.ajax({
   url:"fetch_requests.php",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 // $(document).on('click', '.reply', function(){
 //  var comment_id = $(this).attr("id");
 //  $('#comment_id').val(comment_id);
 //  $('#comment_name').focus();
 // });
 
});
</script>