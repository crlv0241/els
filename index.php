<!DOCTYPE html>
<html>
<head>
<title>General Mariano Alvarez Technical High School </title>

<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<meta charset="utf-8">
	
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">	
<style>
        
        body {margin:0;font-family:Arial;padding: 0;}

        .topnav {
        overflow: hidden;
        background-color: #5a2022;
        }

        .topnav a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
        }

        .active {
        background-color: #ffde00;
        color: white;
        }

        .topnav .icon {
        display: none;
        }

        .dropdown {
        float: left;
        overflow: hidden;
        }

        .dropdown .dropbtn {
        font-size: 17px;    
        border: none;
        outline: none;
        color: white;
        padding: 14px 16px;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
        }

        .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        }

        .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
        }

        .topnav a:hover, .dropdown:hover .dropbtn {
        color: white;
        opacity: .8;
        }

        .dropdown-content a:hover {
        background-color: #ddd;
        color: black;
        }

        .dropdown:hover .dropdown-content {
        display: block;
        }

        @media screen and (max-width: 600px) {
        .topnav a:not(:first-child), .dropdown .dropbtn {
            display: none;
        }
        .topnav a.icon {
            float: right;
            display: block;
        }
        }

        @media screen and (max-width: 600px) {
        .topnav.responsive {position: relative;}
        .topnav.responsive .icon {
            position: absolute;
            right: 0;
            top: 0;
        }
        .topnav.responsive a {
            float: none;
            display: block;
            text-align: left;
        }
        .topnav.responsive .dropdown {float: none;}
        .topnav.responsive .dropdown-content {position: relative;}
        .topnav.responsive .dropdown .dropbtn {
            display: block;
            width: 100%;
            text-align: left;
        }
        }

            
            
            
            
            
        * {
        box-sizing: border-box;
        }

        body {
        background-color: #f1f1f1;
        font-family: Arial;
        }

        img {
            width: 210px;
            height: 215px;
            padding: 10px;
        }

        .main {
        max-width: 1000px;
        margin: auto;
        }

        h1 {
        font-size: 50px;
        word-break: break-all;
        }

        .row {
        margin: 8px -16px;
        }

        .row,
        .row > .column {
        padding: 8px;
        }

        .column {
        float: left;
        width: 25%;
        }


        .row:after {
        content: "";
        display: table;
        clear: both;
        }


        .content {
        background-color: white;
        padding: 10px;
        }


        @media screen and (max-width: 900px) {
        .column {
            width: 50%;
        }
        }


        @media screen and (max-width: 600px) {
        .column {
            width: 100%;
        }
        }
            
            
            
            
            
            
        * {box-sizing: border-box;}

        .container {
        position: relative;
        width: 100%;
        max-width: 380px;
        }

        .image {
            padding: 8px;
        display: block;
        width: 100%;
        height: auto;
        }

        .overlay {
        position: absolute; 
        bottom: 0; 
        background: rgb(0, 0, 0);
        background: rgba(0, 0, 225, 0.9);
        color: #012265; 
        width: 100%;
        transition: .5s ease;
        opacity:0;
        color: white;
        font-size: 15px;
        padding: 20px;
        text-align: justify;
        }

        .container:hover .overlay {
        opacity: 1;
        }
            

            
            
            
            
            
        .responsive {
        width: 60%;
        height: auto;
        }

            
        .alink
            {
        
            text-decoration: none;
            color: #FFFFFF;
        }

        .alink2
            {
        
            text-decoration: none;
            color:#0D0D0D;
        }
            
        a.ex1:hover, a.ex1:active {
            color:#01246b;
            text-decoration: inherit;
            }
                
        .fDiv {
        height: 100px;
        background-color: #282828;    
        text-align: center;
        }
            
        .pfooter{
            font-size: 12px;
            color: #FFFFFF;
        }
            

            
            
            
            
        .accordion {
          background-color: #9b3437 ;
          color: white;
          cursor: pointer;
          padding: 18px;
          width: 99%;
          border: none;
          text-align: left;
          outline: none;
          font-size: 17px;
          transition: 0.4s;
        }

        .active, .accordion:hover {
          opacity: .8;
        }

        .panel {
        padding: 0 18px;
        background-color: white;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
        }

        .container {
        position: relative;
        width: 100%;
        }

        .image {
        opacity: 1;
        display: block;
        width: 100%;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
        }

        .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
        }

        .container:hover .image {
        opacity: 0.3;
        }

        .container:hover .middle {
        opacity: 1;
        }

        .text {
        background-color: #ffde00;
        color: white;
        font-size: 16px;
        padding: 16px 32px;
        }	
</style>
	
	
	
</head>
<body>
	<div class="yDiv"></div>
        <div class="topnav" id="myTopnav">
        <div>
            <a href="./public/user/index.php"><font color="white">Sign In</font></a>
        </div>

	</div>

<div class="content">


		
		
		<div class="w3-row-padding">
		  <div class="w3-third"><center><img src="./images/system/logo.png">
		    <h1><font color="#012775">GMATHS Library</font></h1>
			  <p>gmathslibrary@gmail.com<br>
				 
			  https://www.facebook.com/gmathslibrary101/
			  </p>
			  
			  </center>
			  <br><center><hr>
			  <font size="5">Library Hours</font><br><br>
			  Monday - Friday : 8:00 AM - 8:00 PM<br>
			  Saturday : 7:00 AM to 7:00 PM <br>
			  Sunday and Holidays : CLOSED
			  <br><br>
			  <hr>
			  
			</center>
		
		  </div>
		  
	<br><br>
  <div class="w3-third">
	  <div>
		<button class="accordion">Library Video Orientation</button>
			<div class="panel">
            <iframe src="https://drive.google.com/file/d/10nbfKmaNtXf_Mz803IxC7agXxvqgHeX5/preview" style="width: 100%; height:100%" allow="autoplay"></iframe> 
  			</div>	
			
		</div>
			<hr>
		<div>
			<button class="accordion">New Acquisition</button>
				<div class="panel">
  					<p>
                          New Acquisition will be posted here.
                      </p>
				</div>
			<hr>
		</div>
		<div>
			<button class="accordion">Online Services</button>
				<div class="panel">
                    <p>
                        The following are the online services.
                    </p>
                </div>
		</div>
			<hr>
	  <div>
			<button class="accordion">E-Library</button>
				<div class="panel"><br>
  					<p>
                          Enter information about E-library here
                      </p>
				</div>
			<hr>
		</div>
	<br><br>
	
</div>
  
 <div class="w3-third">
 
		<div>
			<button class="accordion">Mission &amp; Vision</button>
		  <div class="panel">
  					
  				<h2><font color="#012775">Mission</font></h2>
		    <p align="justify">
        GMATHS is committed:
      <ul>
          <li>
            To provide equitable and relevant educational opportunities in the area of Technical
            and Vocational Education and to produce a demand-driven technology individuals,
            quality technicians and skilled workers for today's career and tomorrow's
            opportunity.
          </li>
          <li>
            Shall lead and undertake researches and extension services in the community to have progressive life towards nation-building.
          </li>
          <li>
              Sustain GMATHS family morale and productivity by developing their full potential
              and total well-being and by establishing mutual trust, mutual responsibility and
              harmony through open communication.
          </li>
      </ul>

			  	</p>
			  <h2><font color="#012775">Vision</font></h2>
				 <p align="justify">
         General Mariano Alvarez Technical High School shall be the leading "DepEd" institution in

the area of Technical and Vocational Education in the 21 st century and beyond.		
			  	</p>
		  </div>
	
		</div>	
		<hr>
		<div>
			<button class="accordion">Quality Objectives</button>
		  <div class="panel">
              <p>
                  Enter Quality Objectives content here
              </p>
			</div>
		</div>
			<hr>
		<div>
		<button class="accordion">Organizational Structure</button>
		  <div class="panel">
              <p>
                  Enter information about Organizational Structure here
              </p>
			</div>
		</div>
	
<hr>
		<div>
		<button class="accordion">Announcement</button>
		  <div class="panel">
              <p>
                  Enter Announcement content here
              </p>
		  </div>
	<hr>
		
		<button class="accordion">News</button>
		  <div class="panel">
			  <p>
				 Enter News content here
  			  </p>
		  </div>
		</div>
	</div>
    </div>
			
		
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>
</div>

<hr>

<div class="yDiv"></div>	
	
 <!-- FONT AWESOME -->
<script src="https://kit.fontawesome.com/60d9c0509e.js" crossorigin="anonymous"></script>
<footer class="footer" style="background-color: #5a2022; color:white;padding:2rem">
        <div class="">
            <div class="row">
                <div class="col-md-5">
                    <h4 > Address </h4>
                    <ul>
                        <li> General Mariano Alvarez Technical High School</li>
                        <li> Congressional Road, 4117 General Mariano Alvarez</li>
                        <li> 	Telephone: (046) 972-1148 </li>
                        <li> gmathslibrary@gmail.com </li>
                    </ul>
                </div>
                <!-- <div class="col-md-5">
                    <h4>Follow Us On : </h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div> -->
            </div>
        </div>
  </footer>

</body>
</html>