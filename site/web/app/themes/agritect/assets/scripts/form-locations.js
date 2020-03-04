(function($) {
// Google Maps API Key
  var googleMapsKey = "AIzaSyD7o0-_t2n5yRc-Yt60mfX1HngTplo1jwY"

  //when the user clicks off of the zip field:
  var locationSelectEvents = function() {
    $('#zip').blur(function(){
      var zip = $(this).val();
      var city = '';
      var state = '';

      //make a request to the google geocode api
      $.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address='+zip+'&key='+googleMapsKey).done(function(response){
        console.log(response);
        //check for multiple cities
        var cities = response.results[0].postcode_localities;
        if(cities) {
          //turn city into a dropdown if necessary
          var $select = $(document.createElement('select'));
          $select.addClass('form-control');
          $.each(cities, function(index, locality){
            var $option = $(document.createElement('option'));
            $option.html('&nbsp;&nbsp;&nbsp;'+locality);
            $option.attr('value',locality);
            if(city == locality) {
              $option.attr('selected','selected');
            }
            $select.append($option);
          });
          $select.attr('id','city');
          $('#city_wrap').html($select);
        } else {
          $('#city_wrap').html('<input type="text" id="city" class="form-control">').find('#city').val(city);
        }

        var address_components = response.results[0].address_components;
        $.each(address_components, function(index, component){
          var types = component.types;
          $.each(types, function(index, type){
            if(type == 'locality') {
              city = component.long_name;
              console.log('this is the city: ' + city);
            } else if (type == 'sublocality') {
              city = component.long_name;
              console.log('this is the city: ' + city);
            }

            if(type == 'administrative_area_level_1') {
              state = component.short_name;
              console.log('this is the state: ' + state);
            }
          });
        });

        //pre-fill the city and state
        $('#city').val(city);
        $('#state').val(state);
      });
    });
  }

});
