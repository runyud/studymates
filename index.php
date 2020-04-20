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
      z-index: 1;
    }

    .blurred-box:after{
      content: '';
      width: 2000px;
      height:2000px;
      background: inherit; 
      position: absolute;
      left: -100px;
      left position
      right: 50px;
      right position;
      top: -25px;  
      top position 
      bottom: 0;
      box-shadow: inset 0 0 0 200px rgba(255,255,255,0.05);
      filter: blur(60px);
    }

    .container{
      position: relative;
      margin-top: 50px;
      margin-bottom: 30px;
      margin-right:100px;
      margin-left: 120px;
      text-align: relative;
      z-index: 1;
    }

    input.form-control{
      position:right;
      width: 750px;
      height: 18px;
      opacity: 0.7;
      border-radius: 2px;
      padding: 5px 15px;
      border: 0;
    }

      /* The Modal (background) */
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }

  /* Modal Content */
  .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
  }

  /* The Close Button */
  .close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }
  </style>
 </head>
 <body>
  <br />
  <h2 align="center"><a href="#">We will match for you!</a></h2>
  <br />
  <img src= "https://raw.githubusercontent.com/runyud/studymates/master/iochat/images/logo.png" alt="studymates" style="width:128px;height:128px;">
  <div class="blurred-box">
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
        <label for='location'> location: </label>
        <select id ='location' name = 'location' size = 2  multiple>
            <option value="Central"> Central </option>
            <option value="North"> North </option>
        </select>
        </div>
        <b>Enter time window in which you are willing to meet-up today</b>
        <div class="form-group">
            <input type="text" name="open_from" id="open_from" class="form-control" placeholder="Time Available From : "/>
            <script type="text/javascript">
            $(function() {
            $('input[name="open_from"]').timepicker({
                timeFormat: 'HH:mm a',
                dynamic: true,
            })
            });
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
        <div class = "form-group">
        <label for='times'> Monday: </label>
        <select id ="Monday" name = "Monday" multiple>
            <option value="Morning"> Morning </option>
            <option value="Afternoon"> Afternoon </option>
            <option value="Evening"> Evening </option>
            <option value="All day"> All day </option>
            <option value="Not Available"> Not available </option>
        </select>
        <label for='times'> Tuesday: </label>
        <select id ="Tuesday" name = "Tuesday" multiple>
            <option value="Morning"> Morning </option>
            <option value="Afternoon"> Afternoon </option>
            <option value="Evening"> Evening </option>
            <option value="All day"> All day </option>
            <option value="Not Available"> Not available </option>
        </select>
        <div>
        </b>
        <label for='times'> Wednesday: </label>
        <select id ="Wednesday" name = "Wednesday" multiple>
            <option value="Morning"> Morning </option>
            <option value="Afternoon"> Afternoon </option>
            <option value="Evening"> Evening </option>
            <option value="All day"> All day </option>
            <option value="Not Available"> Not available </option>
        </select>
        <label for='times'> Thursday: </label>
        <select id ="Thursday" name = "Thursday" multiple>
            <option value="Morning"> Morning </option>
            <option value="Afternoon"> Afternoon </option>
            <option value="Evening"> Evening </option>
            <option value="All day"> All day </option>
            <option value="Not Available"> Not available </option>
        </select>
        </b>
        <label for='times'> Friday: </label>
        <select id ="Friday" name = "Friday" multiple>
            <option value="Morning"> Morning </option>
            <option value="Afternoon"> Afternoon </option>
            <option value="Evening"> Evening </option>
            <option value="All day"> All day </option>
            <option value="Not Available"> Not available </option>
        </select>
        </b>
        <div class="form-group">
        <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
        </div>
    </form>
    <!-- The Modal -->
    <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>Successfully added your availability! Please wait patiently while we find a match for you! </p>
    </div>

</div>
    <span id="request_message"></span>
    <br />
    <div id="display_comment"></div>
    </div>
    </body>
    </html>
  </div>
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
     load_requests();
     //$('#open_from').reset();
     //$('#open_until').reset();
     //$('#comment_id').val('0');
    }
   }
  })
 });

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("submit");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


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
