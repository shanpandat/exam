<!--Body Starts Here-->
<?php
include('box/studentheader1.php');
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<style>
    form i {
    margin-left: -30px;
    cursor: pointer;
}
.main{
    background-image: url(images/exam.jpeg);
    height: 600px;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    margin-top:0%;
    margin-bottom: 0%;
    
}

.contents{
    
    border: 1px solid silver;
    width:50%;
    float:right;
    padding: 1%;
    margin-right:50px;
    box-shadow: 0 0 1px 1px silver;
    font-weight: bold;
}

.login{
   
    margin-left: 200px;
    margin-bottom: 50px;
    align-self: center;
    


}
button{
    margin-top: 100px;
}
</style>  
   <style>
        #reg{
            width:274px;
            height: 40px;
            margin-left:0px;
            margin-top:3px;
        }
    
    </style>
        <div class="main">
           
            <div class="contents">
            <p>Proctor exam test is a term used to define an online assessment that employs a tech-enabled monitoring software to supervise a test-taker from start to finish. A proctored exam uses a combination of video and audio to prevent cheating. A proctor exam/test 
                provides utmost strictness to an examination drive and eliminates any unwanted incident.<br><br>
                The pandemic had made it clear that we don’t have a choice in the upcoming years but to embrace the digitization of education. And kudos to the Indian educational institutions – schools, colleges, and universities – who have successfully conducted online teaching & learning classes by implementing innovative e-learning software.
                <br><br>    
               However, when it comes to online examinations & online assessments, there remains a wide scope of improvement in terms of malpractices or cheating-free & monitored examinations. Online proctored exams are thus, buzzing in the education sector.
                <br><br>
            Let us understand what is online proctored exam and then we will jump on to how the online exams with proctoring technology work.
            </p>
        </div>

    <div class="login">
                   

                    <a href="/exam/admin" target="_blank"><button type="button" id="reg" class="btn-go" style="height: 37px;">Faculty/Admin Login</button></a>
                   <br> <a href="<?php echo SITEURL; ?>index.php?page=login" target="_blank"><button type="button" id="reg" class="btn-go" style="height: 37px;">Student Login</button></a>
                    <br><a href="pages\help\index.php"><button type="button" class="btn-exit" style="width:274px;height: 37px;margin-top:5px;margin-left:0px;">Help</button></a>
              
            </div>
            
               
        </div>

        
        <!--Body Ends Here-->