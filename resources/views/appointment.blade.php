<!doctype html>
    <html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="preconnect" href="https://fonts.gstatic.com">      
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,400italic,700italic,700" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        

        <title>Dance with death</title>
    </head>
    <body>
      <div class='info'>
        <h1>Dance with death</h1>
        <span>
          Template modified 
          <i class='fa fa-angellist animated infinite pulse'></i>
          by
          <a href='#'>Pablo Duque</a>
          <div class='spoilers'>
            
          </div>
        </span>
      </div>
      <div class='nav'>
        <ul>
          <li>
            <a class='logo'>
              <img src='https://duke.edu/assets/img/dukelogo_white.svg'>
            </a>
          </li>
          <li>
            <a href='#aboutme' onclick="showBox('aboutme')">About me</a>
          </li>
          <li>
            <a href='#calendar' onclick="showBox('calendar')" >Booking</a>
          </li>
          <li>
            <a href='#video' onclick="showBox('video')" >What to expect</a>
          </li>
          <li>
            <a href='mailto:psduquem@gmail.com?subject=%20Work%20contract%20-%20Asimov&body=%0D%0ADear%20Pablo%2C%20we%20want%20to%20offer%20you%20a%20contract%20a%20one%20million%20dollars%20per%20year.%20Think%20about%20it!%20Bye%20Bye' >         
              <div class='fa fa-envelope'></div>
            </a>
          </li>
        </ul>
      </div>
      <div class="hidden-box shadow" id="aboutme"> 
        <strong>Pablo Duque Morales</strong>
        <p>I 've been working in PHP Web development, using frameworks such as Codeigniter and Laravel, since 2014 and 2018 respectively generally in MVC structured and using Boostrap / Jquery from the front.
      I also specialize in mobile applications with Cordova / Angular (IONIC).
      Some projects (Web and Mobile) that I've developed are applications for AVL, TMS and Last Mile Management systems.<p>

       <p>My greatest achievement (work), is the development of an app mobile and web for the company ADT, implemented in Uruguay and Chile, for the verification officers</p>
      </div>
      <div class="hidden-box shadow" id="calendar"> 
        <strong>Booking</strong><br />
        <small>Select a date to check the agenda and make an appointment</small>
        <p>      
          <div class="container">
            <div class="row">
              <div class="col">
                  <input id="date" type="date" name="date">                  
              </div>

              <div class="col">                
                  <div class="list-group" id="list-hours">
                <a href="#" class="list-group-item list-group-item-action active list-data">
                  DAY
                </a>                                
                  </div>

              </div>
              <div class="col hidden-box" id="form-request" >                
                <div class="list-group" id="list-hours">
                <a href="#" class="list-group-item list-group-item-action active">
                  FORM REQUEST
                </a>        
                 <div class="form-group">
                    <label for="exampleInputEmail1">Contact Email</label>
                    <input type="email" class="form-control" id="contact_email" placeholder="Enter email">                    
                 </div>                        

                 <div class="form-group">
                    <label for="contact_email">Contact Name</label>
                    <input type="text" class="form-control" id="contact_name" placeholder="Enter Name">                    
                 </div>       

                 <div class="form-group">
                    <label for="date_form">Date</label>
                    <input type="text" class="form-control" id="date_form" readonly>                    
                 </div>  

                 <div class="form-group">
                    <label for="hour_form">Hour</label>
                    <input type="text" class="form-control" id="hour_form" readonly>                    
                 </div> 

                   <div class="form-group">
                    <button type="button" class="btn btn-danger" onclick="sendRequest()">Send Request</button>                   
                 </div>                                                                       
                
                </div>

              </div>              
            </div>
          </div>
   
        </p>
      </div>
      <div class="hidden-box shadow" id="video">         
        <p><img height="50%" width="50%" src="{{ asset('images/dance.gif') }}" alt="muevelo muevelo" class="mx-auto"></p>
        <p><iframe width="300" height="200" class="mx-auto" src="https://www.youtube.com/embed/nM23EOwYp3Q?start=75" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p>
      </div>


    

  </body>




</html>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.2/umd/popper.min.js"></script>
<script src="{{ asset('js/functions.js') }}"></script>
