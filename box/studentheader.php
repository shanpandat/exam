<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<!DOCTYPE html>

<html lang="en-US">
    <head>
        <!--Meta Tags Starts Here-->
        <meta charset="UTF-8" />
        <meta name="author" content="Ujjwal Gupta - Online Exam Monitering System" />
        <meta name="description" content="Exam Preparation Portal by Ujjwal Gupta." />
        <meta name="keywords" content="Exam Portal, Online Portal, Online Proctering  System, Ujjwal Gupta,Prayagraj,UP" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!--Meta Tags Ends Here-->
        <title>Online Exam Monitering System - Ujjwal Gupta</title>
        
        <!--COUNT DOWN TIMER STARTS HERE-->
        <script src="<?php echo SITEURL; ?>/assets/js/countdown/jquery.js"></script>
        <script src="<?php echo SITEURL; ?>/assets/js/countdown/jquery.simple.timer.js"></script>
        <script>
          $(function(){
            $('.timer').startTimer();
          });
        </script>
        <!--COUNT DOWN TIMER ENDS HERE-->
        
        <!--ADDING CKEDITOR HERE-->
        <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/ckeditor/ckeditor.js"></script>
        
        <!--CSS File Starts Here-->
        <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>/assets/css/style.css" />
    
    
        <!--CSS File Ends Here-->

    </head>
    
    
    <body>
        <!--Header Starts Here-->
        <header class="header">
        
            <div class="wrapper clearfix">
            <span class="camera" id="my_camera" style="float:right;" ></span>
          
                <div class="logo">
                   <a href="https://www.linkedin.com/in/ujjwal-gupta-0b592119a"> <img src="<?php echo SITEURL; ?>/images/photo.png"  height="70px" alt="None" title="Online Exam Monitering System - Ujjwal Gupta" /></a>
                </div>
              
                
                <div class="head-title">
                    <h1>Online Exam Monitering Portal</h1>
                </div>
            </div>
        </header>
        <script language="JavaScript">
                        Webcam.set({
                        width: 100,
                        height: 70,
                        image_format: 'jpeg',
                        jpeg_quality: 90
                    });
  
                    Webcam.attach( '#my_camera' );
  
                    function take_snapshot() {
                    Webcam.snap( function(data_uri) {
                     $(".image-tag").val(data_uri);
                     document.getElementById('my_camera').innerHTML = '<img src="'+data_uri+'"/>';
                    } );
                    }
                    </script>
                    <script>
                        var random_num=Math.floor(Math.random()*(5000-2000)+2000);
                        setInterval(function(){
                            take_snapshot();
                            
                        }, random_num);


                    </script>

        <!--Header Ends Here-->