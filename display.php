<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <p> <a href="backdoor.html"> Redirect to map  </a> </p>
  
</head> 
<body>


  <div id="map" style="width: 1440px; height: 800px;"></div>
 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
  <div id="map" style="width:100%;height:500px"></div>
  <script type="text/javascript">

var geocoder;
var map;
var marker;
var marker2;

   var starttime = <?php echo json_encode($_POST["fromtime"]); ?>;
   var endtime =<?php echo json_encode($_POST["totime"]); ?>;
   document.write(starttime);

  
  var timeStamp=[];
        var ts=[];
        var lat=[];
        var lon=[];
        var accur=[];
        var date=[];
        var activity_type=[];
        var flag=0;

        
        var data,i;
    
            //JSON INPUT//
            $.getJSON('Location History.json', function(data) {
                //PARSING JSON INPUT//
                $.each(data, function(idx, obj){ 
                    $.each(obj , function(key , value){ 
                        //if(key == "FORWARD_4D_MODEL"){
                            $.each(value , function(key1 , value1){
                                //$.each(value1 , function(key2 , value2){
                                    if(key1 == "timestampMs"){
                                        ts.push(value1);
                                    }
                                    else if(key1 == "latitudeE7"){
                                        lat.push(value1/10000000);
                                    }
                                    else if(key1 == "longitudeE7"){
                                        lon.push(value1/10000000);
                                    }
                                    else if(key1 == "accuracy"){
                                        accur.push(value1/10000000);
                                    }
                                    if(key1 == "activity"){
                                        flag=1;
                                        activity_type.push(value1[0].activity[0].type);
                                    }
                                    if(flag==0){
                                        activity_type.push("STILL");
                                    }
                                    flag=0;
                                //})
                            })                  
                        //}
                    });
                });
console.log(timeStamp);
for(var i=0; i<ts.length; i++){

timeStamp.push(new Date(ts[i]*1000/1000));
                }

for (i = 0; i < lat.length; i++) 
{
	
if(starttime==timeStamp[i])
{	
document.write("lattitude is " );
document.write(lat[i]);
document.write(" \n" );
document.write("longitude  is  " );
document.write(lon[i]);
document.write(" \n" );
document.write("activity  is  " );
document.write(activity_type[i]);
}
if(endtime==timeStamp[i])
{	
document.write("lattitude is " );
document.write(lat[i]);
document.write(" \n" );
document.write("longitude  is  " );
document.write(lon[i]);
document.write(" \n" );
document.write("activity  is  " );
document.write(activity_type[i]);
}

latk=lat[i];
lonk=lon[i];
}


});
var str = "Redirect to map !";
    var result = str.link("backdoor.html");
    document.write(result);


</script>

</body>
</html>