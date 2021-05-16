function load_moon_phases(obj,callback){
    const gets=[]
    for (const i in obj){
        gets.push(i + "=" +encodeURIComponent(obj[i]))
    }
    gets.push("LDZ=" + new Date(obj.year,obj.month-1,1) / 1000)
    const xmlhttp = new XMLHttpRequest()
    const url = "https://www.icalendar37.net/lunar/api/?" + gets.join("&")
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            callback(JSON.parse(xmlhttp.responseText))
        }
    }
    xmlhttp.open("GET", url, true)
    xmlhttp.send()
}

function example_3(moon){     
    const lunar_day , i , inc = 0;
    const containsCalendar =  document.getElementById("ex3");
    const first_day_week_sunday = false; // canvia el valor d'aquesta constant a true perquè el primer dia de la setmana sigui Diumenge
    if (first_day_week_sunday) {
        inc = 1;
        moon.nameDay.unshift(moon.nameDay.pop());
    }
    const empty_initial_boxes = Number(moon.phase[1].dayWeek) + inc; 
    const number_days_month = Number(moon.daysMonth);
    const total_boxes = Math.ceil((empty_initial_boxes + number_days_month) /7) * 7;
    const html ='<div>' +
        '<button value="-1" class="buttonCalendar">\u276E</button>'  +
        '<div class="titleCalendar">' + moon.monthName + " "+ moon.year + '</div>' +
        '<button value="1" class="buttonCalendar">\u276F</button>' + 
        '</div>';
    for (i=0; i<7; i++){
        html += '<div class="name_day">' + moon.nameDay[i] + '</div>';
    } 
    containsCalendar.innerHTML = html;
    for (i=0; i < total_boxes; i++){
        const day = i - empty_initial_boxes;
        const box = document.createElement("DIV");
        box.className="day_box";
         if (day>=0 && day < number_days_month){
            lunar_day = day + 1;
            if (moon.year ==  (new Date).getFullYear() && moon.month == (new Date).getMonth()+1 && lunar_day == (new Date).getDate()) box.id="isToDay";
            box.innerHTML = '<div>' +
             '<span>' + lunar_day + '</span>' +
             '<div>' +moon.phase[lunar_day].svg +'</div>' +
             '</div>';
            if (moon.phase[lunar_day].isPhaseLimit){           
                const url="data:image/svg+xml;utf8, " + moon.phase[lunar_day].svgMini;
                box.firstChild.style.backgroundImage ='url("' + url +'")';
                box.title= moon.phase[lunar_day].phaseName;
            }
         }        
        containsCalendar.appendChild(box);
    }
   
    document.querySelectorAll(".buttonCalendar").forEach(function(button){
        button.onclick = function(){
            const date_to_show = new Date(moon.year,moon.month + Number(this.getAttribute("value")-1),1);
            const configMoon = moon.receivedconstiables;
            configMoon.month = date_to_show.getMonth()+1;
            configMoon.year = date_to_show.getFullYear();
            load_moon_phases(configMoon,example_3);
            this.style.visibility= "hidden";
        }
    });
}   
const configMoon = {
    lang  		:'ru', 
    month 		:new Date().getMonth() + 1,
    year  		:new Date().getFullYear(),
    size		:"100%", 
    lightColor	:"white", 
    shadeColor	: "#000", 
    texturize	:true, 
}
load_moon_phases(configMoon,example_3);