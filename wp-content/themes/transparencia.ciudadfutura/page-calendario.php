<?php /* Template Name:Calendario */ 

get_header(); // This fxn gets the header.php file and renders it ?>


			<?php if ( have_posts() ) : 
			// Do we have any posts in the databse that match our query?
			?>

				<?php while ( have_posts() ) : the_post(); 
				// If we have a post to show, start a loop that will display it
				?>
	
				<div class="container">
						<div class="col-md-12 main-texto">
								<h1>
									<?php the_title(); ?>
								</h1>
								<?php the_content(); ?>
						</div>
				</div>
				
				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
		
			<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) ?>
				
				<article class="post error">
					<h1 class="404">No hay nada</h1>
				</article>

			<?php endif; // OK, I think that takes care of both scenarios (having a post or not having a post to show) ?>
<div class="container">

<script>
var $ = jQuery;
var events = 'events';
var title = 'monteverde-calendar';
var counter = 0;

var clientId = '779917326152-5k8fcprd7a9q1189v83t5q3cbgjepmoa.apps.googleusercontent.com'; //choose web app client Id, redirect URI and Javascript origin set to http://localhost
var apiKey = 'AIzaSyCKR0xzuIuJOXpBk8S1ZQFdifuJkX_f6uo'; //choose public apiKey, any IP allowed (leave blank the allowed IP boxes in Google Dev Console)
var userEmail = "juanmonteverde@ciudadfutura.com.ar"; //your calendar Id
var userTimeZone = "Buenos_Aires"; //example "Rome" "Los_Angeles" ecc...
var maxRows = 20; //events to shown
var calName = "Agenda de Juan Monteverde"; //name of calendar (write what you want, doesn't matter)
    
var scopes = 'https://www.googleapis.com/auth/calendar';
    
/*variables para Pitu*/

var clientIdPitu = '150217911572-4dcdev99m40fg8mrdhfk6sa4rgurd703.apps.googleusercontent.com';
var apiKeyPitu = 'AIzaSyCOUjsXslcZBrKHteEgvaidxhZxLNZqXcU';
var PituMail = 'pedrosalinas@ciudadfutura.com.ar';
var calNamePitu = "Agenda de Pedro Salinas"; //name of calendar (write what you want, doesn't matter)


var clientIdCaren = '968582415158-9gh9fa4e225b1jlj2hsvujf96nd5pi4p.apps.googleusercontent.com';
var apiKeyCaren = 'AIzaSyC3LCqVOdq79F0EzYjmocFdijUdZK33MB0';
var CarenMail = 'carentepp@ciudadfutura.com.ar';
var calNameCaren = "Agenda de Caren Tepp"; //name of calendar (write what you want, doesn't matter)



//--------------------- Add a 0 to numbers
function padNum(num) {
    if (num <= 9) {
        return "0" + num;
    }
    return num;
}
//--------------------- end    

//--------------------- num Month to String
function monthString(num) {
         if (num === "01") { return "Enero"; } 
    else if (num === "02") { return "Febrero"; } 
    else if (num === "03") { return "Marzo"; } 
    else if (num === "04") { return "Abril"; } 
    else if (num === "05") { return "Mayo"; } 
    else if (num === "06") { return "Junio"; } 
    else if (num === "07") { return "Julio"; } 
    else if (num === "08") { return "Agosto"; } 
    else if (num === "09") { return "Septiembre"; } 
    else if (num === "10") { return "Octubre"; } 
    else if (num === "11") { return "Noviembre"; } 
    else if (num === "12") { return "Diciembre"; }
}

function monthString2(num) {
         if (num === "01") { return "JAN"; } 
    else if (num === "02") { return "FEB"; } 
    else if (num === "03") { return "MAR"; } 
    else if (num === "04") { return "APR"; } 
    else if (num === "05") { return "MAJ"; } 
    else if (num === "06") { return "JUN"; } 
    else if (num === "07") { return "JUL"; } 
    else if (num === "08") { return "AUG"; } 
    else if (num === "09") { return "SEP"; } 
    else if (num === "10") { return "OCT"; } 
    else if (num === "11") { return "NOV"; } 
    else if (num === "12") { return "DEC"; }
}
//--------------------- end

//--------------------- from num to day of week
function dayString(num){
         if (num == "1") { return "Lunes" }
    else if (num == "2") { return "Martes" }
    else if (num == "3") { return "Miercoles" }
    else if (num == "4") { return "Jueves" }
    else if (num == "5") { return "Viernes" }
    else if (num == "6") { return "Sabado" }
    else if (num == "0") { return "Domingo" }
}
//--------------------- end

//--------------------- client CALL
function handleClientLoad() {
    gapi.client.setApiKey(apiKey);
    checkAuth();
}

function handleClientLoadPitu() {
    clientId = clientIdPitu;
    apiKey = apiKeyPitu; //choose public apiKey, any IP allowed (leave blank the allowed IP boxes in Google Dev Console)
    userEmail = PituMail; //your calendar Id
    calName = calNamePitu; 
    events = 'salinas-events';
    title = 'salinas-calendar';
	console.log(calName)
    gapi.client.setApiKey(apiKey);
    checkAuth();
}


function handleClientLoadCaren(){
    clientId = clientIdCaren;
    apiKey = apiKeyCaren; //choose public apiKey, any IP allowed (leave blank the allowed IP boxes in Google Dev Console)
    userEmail = CarenMail; //your calendar Id
    calName = calNameCaren; 
    events = 'caren-events';
    title = 'caren-calendar';
    console.log(calName)
    gapi.client.setApiKey(apiKey);
    checkAuth();
}
//--------------------- end

//--------------------- check Auth
function checkAuth() {
    gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);
}



//--------------------- end

//--------------------- handle result and make CALL
function handleAuthResult(authResult) {
	if (authResult) {
        makeApiCall();
    }
}
//--------------------- end

//--------------------- API CALL itself
function makeApiCall() {
    var today = new Date(); //today date
    gapi.client.load('calendar', 'v3', function () {
        var request = gapi.client.calendar.events.list({
            'calendarId' : userEmail,
            'timeZone' : userTimeZone, 
            'singleEvents': true, 
            'timeMin': today.toISOString(), //gathers only events not happened yet
            'maxResults': maxRows, 
            'orderBy': 'startTime'});
    request.execute(function (resp) {
            for (var i = 0; i < resp.items.length; i++) {
                var li = document.createElement('li');
                var item = resp.items[i];
                var classes = [];
                var allDay = item.start.date? true : false;
                var startDT = allDay ? item.start.date : item.start.dateTime;
                var dateTime = startDT.split("T"); //split date from time
                var date = dateTime[0].split("-"); //split yyyy mm dd
                var startYear = date[0];
                var startMonth = monthString(date[1]);
                var startMonth2 = monthString2(date[1]);
                var startDay = date[2];
                var startDateISO = new Date(startMonth2 + " " + startDay + ", " + startYear + " 00:00:00");
                var startDayWeek = dayString(startDateISO.getDay());
              
                
                if( allDay == true){ //change this to match your needs
                

                /*    var str = [
                    '<font size="4" face="courier">',
                    startDayWeek, ' ',
                    startMonth, ' ',
                    startDay, ' ',
                    startYear, '</font><font size="5" face="courier"> @ ', item.summary , '</font><br><br>'
                    ];
				*/
                var str = '<h3>'+startDayWeek+" "+startDay+" de "+startMonth+" de "+startYear+"</h3>";
                str += '<h2>'+item.summary+'</h2>';
                str += '<p>'+item.description+'</p>'
                }
                else{
              		console.log(dateTime[1])
              	
//                	console.log(item.start.dateTime)
//              		console.log(item.end.dateTime)
              
                    var time = dateTime[1].split(":"); //split hh ss etc...
                    var startHour = time[0];
                    var startMin = time[1];
                    
                    /*var str = [ //change this to match your needs
                        '<font size="4" face="courier">',
                        startDayWeek, ' ',
                        startDay, ' ',
                        startMonth, ' ',
                        startYear, ' - ',
                        startHour, ':', startMin, '</font><font size="5" face="courier"> @ ', item.summary , '</font><br><br>'
                        ];
                */
                var str = '<h3>'+startDayWeek+" "+startDay+" de "+startMonth+" de "+startYear+" - "+startHour+":"+startMin+"</h3>";
                str += '<h2>'+item.summary+'</h2>';
                	if(item.description != undefined){
                		str += '<p>'+item.description+'</p>'
					}
                }
                li.innerHTML = str;
                li.setAttribute('class', classes.join(' '));
                document.getElementById(events).appendChild(li);
            }
        //document.getElementById('updated').innerHTML = "updated " + today;
        $('#'+title).text(calName);
        counter++;
        if(counter==1){
                handleClientLoadPitu();
            }else if(counter==2){
                handleClientLoadCaren();
            }
        });
    });
}
//--------------------- end
</script>
<script src='https://apis.google.com/js/client.js?onload=handleClientLoad'></script>
    <div id='agenda' class="container">
    
    <dl>
    	<dt><span class="glyphicon glyphicon-triangle-right"></span><h2 id='monteverde-calendar'>Cargando...</h1></dt>
    	<dd>
    		    <ul id='events'></ul>
    	</dd>
        <dt><span class="glyphicon glyphicon-triangle-right"></span><h2 id="salinas-calendar">Cargando...</h2></dt>
        <dd>
            <ul id="salinas-events">
                
            </ul>
        </dd>
        <dt><span class="glyphicon glyphicon-triangle-right"></span><h2 id="caren-calendar">Cargando... </h2></dt>
        <dd>
            <ul id="caren-events">
                
            </ul>
        </dd>
    </dl>
    </div>

</div>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>