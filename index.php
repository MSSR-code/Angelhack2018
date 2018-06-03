<!DOCTYPE html>
<html>
  <head>
    <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
       #mychart
       {
        height: 400px;
        width: 100%;
       }
       .chart
       {
          width: 48%;
          display: inline-block;
          padding: 10px;
       }
    </style>
  </head>
  <body>
    <h3>Air control analysis</h3>
    <!--The div element for the map -->
    <div id="map"></div><br>
    <div id="legend"> 
        <div class="chart" style="width: 33%;padding:5px 0px;color:white;background-color: red">Requires Immediate Action</div>
        <div class="chart" style="width: 33%;padding:5px 0px;color:white;background-color: orange">To be Controlled</div>
        <div class="chart" style="width: 33%;padding:5px 0px;color:white;background-color: green">Pollution in Control</div>
      </div>
    <div class="chart" id="anch">
      <canvas id="myChart1"></canvas>  
    </div>
    <div class="chart">
      <canvas id="myChart2"></canvas>  
    </div>
    <div class="chart">
      <canvas id="myChart3"></canvas>  
    </div>
    <div class="chart">
      <canvas id="myChart4"></canvas>  
    </div>
    
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGOMH23C5bSY7mN1f401BgDgIdpW-HGZ8&callback=initMap">
    </script>
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>


  <script>

  
    var sensor = new Array();

    var temp = new Object();

     var co2 = [];
    var no2 = [];
    var o3 = [];
    var so2 = [];
    var flag = "";

    $(document).ready(function(){


      $.getJSON("json/sensor1_out.json", function(json) {
         sens = new Object();
      sens.flag = json['flag'];
      sens.co2 = json['co2'].split(",");
      sens.no2 = json['no2'].split(",");
      sens.so2 = json['so2'].split(",");
      sens.o3 = json['o3'].split(",");
      sensor.push(sens);

          
    });

      setTimeout(function() {
         $.getJSON("json/sensor2_out.json", function(json) {
         sens = new Object();
      sens.flag = json['flag'];
      sens.co2 = json['co2'].split(",");
      sens.no2 = json['no2'].split(",");
      sens.so2 = json['so2'].split(",");
      sens.o3 = json['o3'].split(",");
      sensor.push(sens);
      }, 50);
   
    });

      setTimeout(function() {
        $.getJSON("json/sensor3_out.json", function(json) {
         sens = new Object();
      sens.flag = json['flag'];
      sens.co2 = json['co2'].split(",");
      sens.no2 = json['no2'].split(",");
      sens.so2 = json['so2'].split(",");
      sens.o3 = json['o3'].split(",");

      sensor.push(sens);
      }, 100);
        
      
          
    });
      setTimeout(function() {
        $.getJSON("json/sensor4_out.json", function(json) {
         sens = new Object();
      sens.flag = json['flag'];
      sens.co2 = json['co2'].split(",");
      sens.no2 = json['no2'].split(",");
      sens.so2 = json['so2'].split(",");
      sens.o3 = json['o3'].split(",");

      sensor.push(sens);
      }, 150);
         
    });

      setTimeout(function() {
        $.getJSON("json/sensor5_out.json", function(json) {
         sens = new Object();
      sens.flag = json['flag'];
      sens.co2 = json['co2'].split(",");
      sens.no2 = json['no2'].split(",");
      sens.so2 = json['so2'].split(",");
      sens.o3 = json['o3'].split(",");

      sensor.push(sens);
      
          
    });
      }, 200);
        

      setTimeout(function() {
               $.getJSON("json/sensor6_out.json", function(json) {
             sens = new Object();
          sens.flag = json['flag'];
          sens.co2 = json['co2'].split(",");
          sens.no2 = json['no2'].split(",");
          sens.so2 = json['so2'].split(",");
          sens.o3 = json['o3'].split(",");

          sensor.push(sens);
          
              
        });
      }, 250);

      setTimeout(function() {

         $.getJSON("json/sensor7_out.json", function(json) {
         sens = new Object();
      sens.flag = json['flag'];
      sens.co2 = json['co2'].split(",");
      sens.no2 = json['no2'].split(",");
      sens.so2 = json['so2'].split(",");
      sens.o3 = json['o3'].split(",");

      sensor.push(sens);
      
          
    });
      }, 300);

       setTimeout(function() {
        $.getJSON("json/sensor8_out.json", function(json) {
         sens = new Object();
      sens.flag = json['flag'];
      sens.co2 = json['co2'].split(",");
      sens.no2 = json['no2'].split(",");
      sens.so2 = json['so2'].split(",");
      sens.o3 = json['o3'].split(",");

      sensor.push(sens);
      
          
    });
       }, 350);    

          setTimeout(function() {
            $.getJSON("json/sensor9_out.json", function(json) {
         sens = new Object();
      sens.flag = json['flag'];
      sens.co2 = json['co2'].split(",");
      sens.no2 = json['no2'].split(",");
      sens.so2 = json['so2'].split(",");
      sens.o3 = json['o3'].split(",");

      sensor.push(sens);
          }, 600);
   
          
    });

setTimeout(function() {
  $.getJSON("json/sensor10_out.json", function(json) {
         sens = new Object();
      sens.flag = json['flag'];
      sens.co2 = json['co2'].split(",");
      sens.no2 = json['no2'].split(",");
      sens.so2 = json['so2'].split(",");
      sens.o3 = json['o3'].split(",");

      sensor.push(sens);
          
    });
}, 450);

            
          // console.log(sensor)
});
      

     var year = [1 , 2 , 3 , 4 , 5 , 6 , 7 , 8 , 9 , 10 , 11 , 12 , 13 , 14 , 15 , 16 , 17 , 18 , 19 , 20 , 21 , 22 , 23 , 24 , 25 , 26 , 27 , 28 , 29 , 30 , 31 , 32 , 33 , 34 , 35 , 36 , 37 , 38 , 39 , 40 , 41 , 42 , 43 , 44 , 45 , 46 , 47 , 48 , 49 , 50 , 51 , 52 , 53 , 54 , 55 , 56 , 57 , 58 , 59 , 60 , 61 , 62 , 63 , 64 , 65 , 66 , 67 , 68 , 69 , 70 , 71 , 72 , 73 , 74 , 75 , 76 , 77 , 78 , 79 , 80 , 81 , 82 , 83 , 84 , 85 , 86 , 87 , 88 , 89 , 90 , 91 , 92 , 93 , 94 , 95 , 96 , 97 , 98 , 99 , 100 , 101 , 102 , 103 , 104 , 105 , 106 , 107 , 108 , 109 , 110 , 111 , 112 , 113 , 114 , 115 , 116 , 117 , 118 , 119 , 120 , 121 , 122 , 123 , 124 , 125 , 126 , 127 , 128 , 129 , 130 , 131 , 132 , 133 , 134 , 135 , 136 , 137 , 138 , 139 , 140 , 141 , 142 , 143 , 144 , 145 , 146 , 147 , 148 , 149 , 150 , 151 , 152 , 153 , 154 , 155 , 156 , 157 , 158 , 159 , 160 , 161 , 162 , 163 , 164 , 165 , 166 , 167 , 168 , 169 , 170 , 171 , 172 , 173 , 174 , 175 , 176 , 177 , 178 , 179 , 180 , 181 , 182 , 183 , 184 , 185 , 186 , 187 , 188 , 189 , 190 , 191 , 192 , 193 , 194 , 195 , 196 , 197 , 198 , 199 , 200 , 201 , 202 , 203 , 204 , 205 , 206 , 207 , 208 , 209 , 210 , 211 , 212 , 213 , 214 , 215 , 216 , 217 , 218 , 219 , 220 , 221 , 222 , 223 , 224 , 225 , 226 , 227 , 228 , 229 , 230 , 231 , 232 , 233 , 234 , 235 , 236 , 237 , 238 , 239 , 240 , 241 , 242 , 243 , 244 , 245 , 246 , 247 , 248 , 249 , 250 , 251 , 252 , 253 , 254 , 255 , 256 , 257 , 258 , 259 , 260 , 261 , 262 , 263 , 264 , 265 , 266 , 267 , 268 , 269 , 270 , 271 , 272 , 273 , 274 , 275 , 276 , 277 , 278 , 279 , 280 , 281 , 282 , 283 , 284 , 285 , 286 , 287 , 288 , 289 , 290 , 291 , 292 , 293 , 294 , 295 , 296 , 297 , 298 , 299 , 300 , 301 , 302 , 303 , 304 , 305 , 306 , 307 , 308 , 309 , 310 , 311 , 312 , 313 , 314 , 315 , 316 , 317 , 318 , 319 , 320 , 321 , 322 , 323 , 324 , 325 , 326 , 327 , 328 , 329 , 330 , 331 , 332 , 333 , 334 , 335 , 336 , 337 , 338 , 339 , 340 , 341 , 342 , 343 , 344 , 345 , 346 , 347 , 348 , 349 , 350 , 351 , 352 , 353 , 354 , 355 , 356 , 357 , 358 , 359 , 360 , 361 , 362 , 363 , 364 , 365 ];

      var days = [1, , , , , ,2, , , , , ,3, , , , , ,4, , , , , ,5, , , , , ,6, , , , , ,7, , , , , ,8, , , , , ,9, , , , , ,10, , , , , ,11, , , , , ,12, , , , , ,13, , , , , ,14, , , , , ,15, , , , , ,16, , , , , ,17, , , , , ,18, , , , , ,19, , , , , ,20, , , , , ,];

    
</script>






    <script>
// Initialize and add the map
function initMap() {
  // The location of Uluru
  var uluru = [{lat: 17.4477736, lng: 78.3677646},{lat: 17.4361208, lng: 78.4418253},{lat: 17.4121472, lng: 78.5083363},{lat: 17.3855692, lng: 78.4789916},{lat: 17.5266393, lng: 78.4392775},{lat: 17.373834, lng: 78.4697},{lat: 17.3261337, lng: 78.55631},{lat: 17.4237643, lng: 78.4137633}];
  
  // The map, centered at Uluru
  var map = new google.maps.Map(document.getElementById('map'), {zoom: 11, center: {lat : 17.4345588,lng : 78.4564247}});
  
  setTimeout(function () {
      for(var i=0;i<uluru.length;i++) {
        createMarker(uluru[i],map,i);
      }
  },500);

  // The marker, positioned at Uluru
}

function createMarker(pos,m,i) {

    var flag_url = "";

    if(sensor[i].flag == "green")
    {
      flag_url = "http://maps.google.com/mapfiles/ms/icons/green-dot.png";
    }
    if(sensor[i].flag == "orange")
    {
      flag_url = "http://maps.google.com/mapfiles/ms/icons/orange-dot.png";
    }


    var marker = new google.maps.Marker({       
        position: pos, 
        map: m,  // google.maps.Map   
        icon :flag_url

    }); 
    google.maps.event.addListener(marker, 'click', function() { 
      $(document).ready(function(){

          $('html,body').animate({scrollTop: $('#anch').offset().top},'slow');

          // chart(year,sensor[0].co2,"some");
          console.log(i);
          if(sensor[i].flag == "orange")
          {
            chart (days , sensor[i].co2 , "CO2","myChart1","#6699ff");
            chart (days , sensor[i].no2 , "NO2","myChart2","#996600");
            chart (days , sensor[i].so2 , "SO2","myChart3","purple");
            chart (days , sensor[i].o3 , "O3","myChart4","#00ffff");  
          } 
          else
          {
            chart (year , sensor[i].co2 , "CO2","myChart1","#6699ff");
            chart (year , sensor[i].no2 , "NO2","myChart2","#996600");
            chart (year , sensor[i].so2 , "SO2","myChart3","purple");
            chart (year , sensor[i].o3 , "O3","myChart4","#00ffff");
          }
        });
    }); 
    return marker;  
}
    </script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>


<script>
    
  function chart(time , dataset,title,name,color)
  {

  new Chart(document.getElementById(name),
    {
      "type":"line",
      "data":{"labels":time,
      "datasets":[{"label":title,"data":dataset,
      "fill":false,
      "borderColor":color,
      "lineTension":0}]},
      "options":{
        "scales": {
          "xAxes": [{
            "display": true,
            "scaleLabel": {
              "display": true,
              "labelString": 'Time'
            }
          }],
          "yAxes": [{
            "display": true,
            "scaleLabel": {
              "display": true,
              "labelString": 'Parts Per Million'
            }
          }]
        }
      }});
  }

</script>

  </body>
</html>