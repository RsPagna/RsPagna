<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="inc/stylelist.css" />
<link rel="shortcut icon" href="favicon.ico" />
<script src="inc/jquery-3.0.0.0.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
	
</head>

<body>
<form action="<?PHP $_SERVER['PHP_SELF'] ?>" method="get">
  <section id="s1" style="display:none;">
    <h1>This is section 1</h1>
    <p>What you say?</p>
    <input type="text" name="tname" id="tname" value="">
  </section>
  <section id="s2" style="display:none;">
    <h1>This is section 2</h1>
    <p>I said, this is section 2!</p>
    <input type="checkbox" name="ch1" id="ch1" value="1">
  </section>
  <div> 
  <input type="button" name="bt1" id="bt1" value="Section1"> <input type="button" name="bt2" id="bt2" value="Section2"></div>
  <script language="javascript" type="text/javascript">
    $(document).ready(function(e){

      $("#bt1").click(function(){
          $("#s1").slideToggle("fast");
      });

      $("#bt2").click(function(){
          $("#s2").slideToggle("fast");
      });

      //Detecting any change in all input fields
      $("input").change(function(){

        //Alert message with Ok, Cancel action
        if (confirm('Some of your information have been change. Do you want to save before leaving this page?')) {
          alert('Form saved!');
        } else {
            alert('You have discard change!');
        }
      });

    });
  </script>
</form>
</body>
</html>