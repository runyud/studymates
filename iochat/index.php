
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
  <style>

  	#location_select {
  		min-height:190px; 
	    overflow-y :auto; 
	    overflow-x:hidden; 
	    position:absolute;
	    width:300px;
	    display: contents;
  	}

    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    h2{
      text-align: center;
    }
    body{
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      background-position: center;
      background-image:url(img/north_campus.jpg);
      width: 100%;
      height: 100%;
      font-family: Arial, Helvetica;
      letter-spacing: 0.02em;
      font-weight: 400;
      -webkit-font-smoothing: antialiased;
    }
     .blurred-box{
      position: relative;
      margin-top: 50px;
      margin-bottom: 100px;
      margin-right: 100px;
      margin-left: 100px;
      padding: 10px 20px;
      border: 10px solid gold;
      background: inherit;
      overflow: hidden;
      border-radius: 1000px;
      z-index: 2;
    }

    .blurred-box:after{
      content: '';
      width: 2000px;
      height:2000px;
      background: inherit; 
      position: absolute;
      left: -25px;
      left position
      right: -25px;
      right position;
      top: -25px;  
      top position 
      bottom: 0;
      box-shadow: inset 0 0 0 200px rgba(255,255,255,0.05);
      filter: blur(10px);
    }

    .container{
      position: relative;
      margin-top: 50px;
      text-align: center;
      z-index: 1;
    }
    .form-group > *{
      display: inline-block;
      width: 200px;
    }

    input.form-control{
      width: 1000px;
      height: 18px;
      opacity: 0.7;
      border-radius: 2px;
      padding: 5px 15px;
      border: 0;
    }

  </style>
 </head>
 <body>
 <br />
      <h2 ><a href="#">StudyMates: We will match for you!</a></h2>
  <br />
  <img src= "https://raw.githubusercontent.com/runyud/studymates/master/iochat/images/logo.png" alt="studymates" style="width:128px;height:128px;">
  <div class="blurred-box">
    <div class="container">
       <form method="POST" id="submit_form"> // changed comment_form to submit_form
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
        <input type="text" name="time" id="time" class="form-control"
        value = "Availabilities" />
        </div>
        <script>
        $(function() {
          $('input[name="time"]').daterangepicker({
            timePicker: true,
            locale: {
              format: 'hh:mm A'
            }
          }).on('show.daterangepicker', function(ev, picker) {
            picker.container.find(".calendar-table").hide();
          });
        });
        </script>
        <!-- <div class="form-group">
        <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
        </div> -->
        <div class="form-group">
        <input type="hidden" name="comment_id" id="comment_id" value="0" />
        <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
        </div>
      </form>
      <span id="comment_message"></span>
      <br />
      <div id="display_comment"></div>
    </div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
 });
 
});
</script>