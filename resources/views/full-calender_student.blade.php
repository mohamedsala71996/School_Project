<!DOCTYPE html>
<html>
<head>
    {{-- <title>How to Use Fullcalendar in Laravel 8</title> --}}
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
</head>
<body>
  
<div class="container">
    <br />
    {{-- <h1 class="text-center text-primary"><u>How to Use Fullcalendar in Laravel 8</u></h1> --}}
    <br />

    <div id="calendar"></div>

</div>
   
<script>
$(document).ready(function () {

$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
});

var calendar = $('#calendar').fullCalendar({
    editable:false, // Set editable to false
    header:{
        left:'prev,next today',
        center:'title',
        right:'month,agendaWeek,agendaDay'
    },
    events:'/calender_student',
    selectable:false, // Disable event selection
    selectHelper: false, // Disable event creation helper
    eventClick:function(event)
    {
        // Disable event deletion
        alert("You are not allowed to delete events.");
    }
});

});
  
</script>
  
</body>
</html>