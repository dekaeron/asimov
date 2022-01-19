// Start Today Calendar
// Variables de Inicio
star_time = 0;
end_time = 0;

var getOpeningHours = function(){
	var xhr = new XMLHttpRequest();
	xhr.withCredentials = true;

	xhr.addEventListener("readystatechange", function() {
	  if(this.readyState === 4) {
	    var response = JSON.parse(this.responseText);
	    star_time = parseInt(response.data[0]);
	    end_time = parseInt(response.data[1]);
	  }
	});

	xhr.open("GET", "http://18.230.47.70/asimov/public/api/v1/bookings/openinghours/admin");

	xhr.send();
};


var showBox = function (value){	
	for (let element of document.getElementsByClassName("hidden-box")){
   		element.style.display="none";
	}
	document.getElementById(value).style.display = 'block';
};

Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});




var getBookingsByDate = function(){
	// Hide Form
	document.getElementById("form-request").style.display="none";
	// Delete entire list
	removeElementsByClass("list-data");
	
	// Create html 	
	var htmlListData = '<a href="#" class="list-group-item list-group-item-action active list-data"><b>'+this.value+'</b></a>';
	for(var loop = star_time; loop <= end_time; loop++){
		var hourText = loop < 10 ? hourText = "0"+loop : loop;
		htmlListData += '<a onclick="selectDateHourForBooking('+loop+')" data-hour="'+loop+'" id="hour_'+loop+'" class="list-group-item list-group-item-action list-data">'+hourText+':00</a>';
	}
	document.getElementById("list-hours").innerHTML = htmlListData;
	

	// Get Data Booking
	var xhr = new XMLHttpRequest();
	xhr.withCredentials = true;
	xhr.addEventListener("readystatechange", function() {
	  if(this.readyState === 4) {
	    var response = JSON.parse(this.responseText);	    
	    response.data.forEach(isBookedHour);
	    
	  }
	});

	xhr.open("GET", "http://18.230.47.70/asimov/public/api/v1/bookings/date/"+this.value);
	xhr.setRequestHeader("Accept", "application/json");
	xhr.send();

}


var isBookedHour = function(element, index, array) {	
    document.getElementById("hour_"+element.hour).classList.add('disabled', 'no-available', 'text-danger');
};

var selectDateHourForBooking = function(hour){
	document.getElementById("form-request").style.display ="block";
	document.getElementById("date_form").value = document.getElementById("date").value;
	document.getElementById("hour_form").value = hour;
}


var removeElementsByClass = function(className){
    const elements = document.getElementsByClassName(className);
    while(elements.length > 0){
        elements[0].parentNode.removeChild(elements[0]);
    }
};


var sendRequest = function(){
	

	var settings = {
	    "url": "http://18.230.47.70/asimov/public/api/v1/bookings",
	    "method": "POST",
	    "timeout": 0,
	    "headers": {
	        "Content-Type": "application/x-www-form-urlencoded"
	    },
	    "data": {
	        "contact_email": document.getElementById("contact_email").value,
	        "contact_name": document.getElementById("contact_name").value,
	        "date": document.getElementById("date_form").value,
	        "hour": document.getElementById("hour_form").value,

	    }
	    };

	    $.ajax(settings)
	    .done(function (response) {
	        swal.fire({
	            title: 'BOOKING',
	            text: 'Booking OK!!!',
	            icon: 'success',
	            confirmButtonClass: 'btn btn-secondary',
	            timer: 3000                        
	            }).then(function() {                            
	                location.reload();
	            });
	    })
	    .fail(function (errors) {
	    	var html_error = "Check:<br/>";
	        var error_json = JSON.parse(errors.responseText);	
	        if(error_json.hasOwnProperty('errors')){
	        	var error_data = error_json.errors;	
	        	for (const [key, value] of Object.entries(error_data)) {
	            html_error += ""+value+"<br/>";                             
	        }
	        }
	        else{
	        	var error_data = error_json.data;
	        	html_error = error_json.data;
	        }	
	        
	        
	       
	        swal.fire({
	            title: 'Error',
	            html: html_error,                        
	            icon: 'error',
	            confirmButtonClass: 'btn btn-secondary',
	            timer: 5000,
	        });
	        });	

}


// Funcion a ejecutar
showBox('calendar');
document.getElementById('date').value = new Date().toDateInputValue();
document.getElementById("date").addEventListener("change", getBookingsByDate)
getOpeningHours();

