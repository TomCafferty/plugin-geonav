var lat;
var lon;

  
function plugin_geonav() {
      page = plugin_geonav_category;
      initPage (page);
      google.earth.createInstance('map3d', initCallback, failureCallback);
        addSampleButton('focus-btn', 'Focus In', buttonClick);
}
    
  function addSampleButton(btnLoc, caption, clickHandler) {
      var focus = document.getElementById(btnLoc);
      focus.addEventListener('click', clickHandler, false);
  }
  
  function exchangeHandler(btnLoc, oldHandler, newHandler) {
      var focus = document.getElementById(btnLoc);
      focus.removeEventListener('click', oldHandler, false);
      focus.addEventListener('click', newHandler, false);
  }
 
  function hideButton(which){
      if (!document.getElementById(which))
        return;
      document.getElementById(which).style.display="none";
  }
 
  function showButton(which){
      if (!document.getElementById(which))
        return;
      document.getElementById(which).style.display="inherit";
  }
 
  function takeOut(which){
      if (!document.getElementById)
        return;
      which.style.display="none";
  }
      
  function addSampleUIHtml(item, html) {
      document.getElementById(item).innerHTML = html;
  }

  function initCallback(instance) {
      ge = instance;
      ge.getWindow().setVisibility(true);
    
      // add a navigation control
      ge.getNavigationControl().setVisibility(ge.VISIBILITY_AUTO);
    
      // add some layers
      ge.getLayerRoot().enableLayerById(ge.LAYER_BORDERS, true);
      ge.getLayerRoot().enableLayerById(ge.LAYER_ROADS, false);   
  }
    
  function failureCallback(errorCode) {
    if (errorCode == "ERR_CREATE_PLUGIN") {
        alert("Google Earth Plugin not installed. To view more local data on a topic this Plugin is required.  The window at the top left provides a download link to download the Plugin. Then by running the downloaded file the Plugin would be installed.");
    } else {
        alert("Other failure loading the Google Earth Plugin: " + errorCode);
    }
  }
    
  function zoomIn(altitude) {
      var lookAt = ge.createLookAt('');
      lookAt.set(parseFloat(lat), parseFloat(lon), 10, ge.ALTITUDE_RELATIVE_TO_GROUND, 0, 0,altitude);
      ge.getView().setAbstractView(lookAt);
  }
    
  function buttonClick(e) {
      var geocodeLocation = document.getElementById('location').value;
      var geocoder = new google.maps.ClientGeocoder();
      
      var element = e.target;
      
      geocoder.getLatLng(geocodeLocation, function(point) {
          console.log("loc= "+geocodeLocation);         
          console.log("loc= "+point);         
          if (!point) {
              alert(geocodeLocation + " not found");
          } else {
              var matchll=/\(([-.\d]*), ([-.\d]*)/.exec(point);
              if(matchll){
                  lat=parseFloat(matchll[1]);
                  lon=parseFloat(matchll[2]);
                  lat=lat.toFixed(6);
                  lon=lon.toFixed(6);}          
              var lookAt = ge.createLookAt('');
              console.log("y= "+lat);         
              console.log("x= "+lon);
              lookAt.set(parseFloat(lat), parseFloat(lon), 10, ge.ALTITUDE_RELATIVE_TO_GROUND,0, 0,6000000);
              ge.getView().setAbstractView(lookAt);
              reverseGeocode(lat, lon, element.id);
          }
      }
    );
  }  
  
  var ge;
  google.load("earth", "1");
  google.setOnLoadCallback(plugin_geonav);

