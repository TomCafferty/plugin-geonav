// Create xmlhttprequest object
var xmlhttp = createXmlHttpRequestObject();
var country;
var state;
var county;
var locality;
var deplocality;
var saveLat;
var saveLong;
var page;
var modeAll = false;
  document.write('<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;" type="text/javascript"></script>');
  
function initPage(alias) { 
  page = alias;
}
   
function reverseGeocode(latitude,longitude, btn){
  var geocoder = new GClientGeocoder();
  var latlng = new GLatLng(latitude, longitude);
  hideButton('location');
  addSampleUIHtml('focus-btn', 'Show a Closer Focus');  
  addSampleUIHtml('userInput', ' ');  
  saveLat  = latitude;
  saveLong = longitude;

  geocoder.getLocations(latlng, function(addresses) {
    if(addresses.Status.code != 200) {
      alert("reverse geocoder failed to find an address for " + latlng.toUrlValue());
    } else {
      var googleAddr = new GoogleAddress(addresses.Placemark[0]) ;
      country = googleAddr.CountryNameCode;
      state   = googleAddr.AdministrativeAreaName;
      county  = googleAddr.SubAdministrativeAreaName;
      locality = googleAddr.LocalityName;
      deplocality = googleAddr.DependentLocalityName;
      
      if (locality === undefined)
        locality = deplocality;
  
      xmlhttp.open("GET","lib/plugins/geonav/server/get_continent.php?q="+country+"&p="+page,true);
      modeAll=false;
      xmlhttp.onreadystatechange = displayContinent;
      xmlhttp.send();
    } 
    });
}

function processGeoCoderResult(response) {
  if (response.Status.code == 200) {
    var googleAddr = new GoogleAddress(response.Placemark[0]) ;
        var zip = googleAddr.PostalCodeNumber ;
        var latitude = googleAddr.coordinates[1] ;
        var longitude =  googleAddr.coordinates[0] ;
    }
  }

function displayContinent() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("dokuwiki__content").innerHTML=xmlhttp.responseText;
      exchangeHandler('focus-btn', buttonClick, readCountry);
      jQuery('#bar__bottomleft').hide();
    }
}

function readCountry(e) { 
    var element = e.target;
    zoomIn(3500000);
    xmlhttp.open("GET","lib/plugins/geonav/server/get_country.php?q="+country+"&p="+page,true);
    xmlhttp.onreadystatechange = displayCountry;
    modeAll=false;
    xmlhttp.send();
}

function readState(e) { 
    var element = e.target;
    zoomIn(500000);
    xmlhttp.open("GET","lib/plugins/geonav/server/get_state.php?ctry="+country+"&q="+state+"&p="+page,true);
    xmlhttp.onreadystatechange = displayState;
    modeAll=false;
    xmlhttp.send();
}

function readCounty(e) { 
    var element = e.target;
    zoomIn(19000);
    xmlhttp.open("GET","lib/plugins/geonav/server/get_county.php?ctry="+country+"&q="+state+"&county="+county+"&p="+page,true);
    xmlhttp.onreadystatechange = displayCounty;
    modeAll=false;
    xmlhttp.send();
}

function readLocality(e) { 
    var element = e.target;
    zoomIn(2000);
    xmlhttp.open("GET","lib/plugins/geonav/server/get_locality.php?ctry="+country+"&q="+state+"&county="+county+"&locality="+locality+"&p="+page,true);
    xmlhttp.onreadystatechange = displayLocality;
    modeAll=false;
    xmlhttp.send();
}

function displayCountry() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    document.getElementById("dokuwiki__content").innerHTML=xmlhttp.responseText;
    // execute any scripts from page
    var myDiv = document.getElementById("dokuwiki__content");
    var myscripz = myDiv.getElementsByTagName('script');
    for(var i=myscripz.length; i--;){
          eval(myscripz[i].innerHTML);
    }
    // manage buttons
     exchangeHandler('focus-btn', readCountry, readState);
  }
}

function displayState() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    document.getElementById("dokuwiki__content").innerHTML=xmlhttp.responseText;
    // execute any scripts from page
    var myDiv = document.getElementById("dokuwiki__content");
    var myscripz = myDiv.getElementsByTagName('script');
    for(var i=myscripz.length; i--;){
          eval(myscripz[i].innerHTML);
    }
    // manage buttons
     exchangeHandler('focus-btn', readState, readCounty);
  }
}

function displayCounty() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    document.getElementById("dokuwiki__content").innerHTML=xmlhttp.responseText;
    // execute any scripts from page
    var myDiv = document.getElementById("dokuwiki__content");
    var myscripz = myDiv.getElementsByTagName('script');
    for(var i=myscripz.length; i--;){
          eval(myscripz[i].innerHTML);
    }
    // manage buttons
     exchangeHandler('focus-btn', readCounty, readLocality);
  }
}

function displayLocality() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    document.getElementById("dokuwiki__content").innerHTML=xmlhttp.responseText;
    // execute any scripts from page
    var myDiv = document.getElementById("dokuwiki__content");
    var myscripz = myDiv.getElementsByTagName('script');
    for(var i=myscripz.length; i--;){
          eval(myscripz[i].innerHTML);
    }
    // manage buttons
    exchangeHandler('focus-btn', readLocality, readLocality);
    hideButton('focus-btn');
  }
}

// creates an XMLHttpRequest instance
function createXmlHttpRequestObject() {
     // will store the reference to the XMLHttpRequest object
     var xmlHttp;
     // this should work for all browsers except IE6 and older
     try
     {
        // try to create XMLHttpRequest object
        xmlHttp = new XMLHttpRequest();
     }
      catch(e)
     {
       // assume IE6 or older
       try
     {
       xmlHttp = new ActiveXObject("Microsoft.XMLHttp");
     }
      catch(e) { }
    }
     // return the created object or display an error message
      if (!xmlHttp)
        alert("Error creating the XMLHttpRequest object.");
     else
      return xmlHttp;
}
   
function GoogleAddress(placeMark, curDepth)
{
  if(curDepth == null || isNaN(curDepth))
    curDepth = 1 ;
  else if (++curDepth == 10) // just to be safe do not recurse more than 10 times
    return ;

  for (var attr in placeMark)
  {
      if ((typeof(placeMark[attr]) != 'object') || (placeMark[attr] instanceof Array))
      {
          this[attr] = placeMark[attr] ;
      } else {  // recurse thru sub-objects
          GoogleAddress.call(this, placeMark[attr], curDepth) ;
      }
  }
}
