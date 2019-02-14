(function($) {
  "use strict";

  /**
   * All of the code for your public-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */

  $(document).ready(function($) {
    
    /**
     * 
     * Gets the user entered values and run through calcuations by math.js library. Displays the value to the user.
     * 
     */


    // get new value of wpuc_from_value (input field)
    $('#wpuc_from_value').keyup(function() {
      var wpuc_value = $(this).val();
      var wpuc_from = $('#wpuc_from').val();
      var wpuc_to = $('#wpuc_to').val();

      wpuc_input_from(wpuc_value, wpuc_from, wpuc_to);
    });
  
    // get new value of wpuc_from (select option)
    $('#wpuc_from').on('change', function() {
      var wpuc_value = $('#wpuc_from_value').val();
      var wpuc_from = $('#wpuc_from').val();
      var wpuc_to = $('#wpuc_to').val();

      wpuc_input_from(wpuc_value, wpuc_from, wpuc_to);
    });

    // get new value of wpuc_to (select option)
    $('#wpuc_to').on('change', function() {
      var wpuc_value = $('#wpuc_from_value').val();
      var wpuc_from = $('#wpuc_from').val();
      var wpuc_to = $('#wpuc_to').val();
      
      wpuc_input_from(wpuc_value, wpuc_from, wpuc_to);
    });

    // Callback function for 'from field' values change
    function wpuc_input_from(wpuc_value, wpuc_from, wpuc_to) {

        var wpuc_converted_value;
        var wpuc_temperature = $("#converter-selection .wpuc-select").val();
        wpuc_converted_value = math.number(math.unit(wpuc_value, wpuc_from), wpuc_to);
        wpuc_converted_value = Number( wpuc_converted_value.toPrecision(14) );
  
        if ( 0 == wpuc_converted_value ) {
          $('#wpuc_to_value').val( '' );
        } else {
          $('#wpuc_to_value').val( wpuc_converted_value );
        }

        if ( 'temperature' == wpuc_temperature ) {
          if ( '' == wpuc_value ) {
            $('#wpuc_to_value').val( '' );
          }
        }
    }

    // get new value of wpuc_to_value (input field)
    $('#wpuc_to_value').keyup(function() {
      var wpuc_value = $(this).val();
      var wpuc_from = $('#wpuc_from').val();
      var wpuc_to = $('#wpuc_to').val();

      wpuc_input_to(wpuc_value, wpuc_from, wpuc_to);
    });
  
    // Callback function for 'to field' values change
    function wpuc_input_to(wpuc_value, wpuc_from, wpuc_to) {
  
        var wpuc_converted_value;
        var wpuc_temperature = $("#converter-selection .wpuc-select").val();
        wpuc_converted_value = math.number(math.unit(wpuc_value, wpuc_to), wpuc_from);
        wpuc_converted_value = Number( wpuc_converted_value.toPrecision(14) );
  
        if ( 0 == wpuc_converted_value ) {
          $('#wpuc_from_value').val( '' );
        } else {
          $('#wpuc_from_value').val( wpuc_converted_value );
        }

        if ( 'temperature' == wpuc_temperature ) {
          if ( '' == wpuc_value ) {
            $('#wpuc_from_value').val( '' );
          }
        }
    }

    /**
     * 
     * Sends Ajax request of selected metrics type by the user. It displays the units of the selected metrics as response handler.
     * 
     */

    $("#converter-selection .wpuc-select").change(function() {
      var _this = this.value;
      $.ajax({
        url: wpuc_js_obj.wpuc_metrics_json,
        type: "GET",
        dataType: "json",
        success: displayUnits,
        error: function(xhr, status) {
          console.log("There was an error. Request couldn't be completed.");
        }
      });

      function displayUnits(data) {
        var wpuc_metrics = data['metrics'];
        var converter = _this;
        var wpuc_converter_data = wpuc_metrics[converter];
        var wpuc_convert_options_array = wpuc_converter_data['select_box'];
        
        var wpuc_convert_options;

        $.each( wpuc_convert_options_array, function( key, value ) {
          
          wpuc_convert_options += '<option value="' + key + '">' + value + '</option>';
        });

        $("#wpuc_from_value").val("");
        $("#wpuc_to_value").val("");
        $(".wpuc-field-value.wpuc-select").html(wpuc_convert_options);

      }
    });

    /**
    * 
    * Changes Plugin Orientation based on admin user selection.
    * 
    */

    if ( 'vertical' == wpuc_js_obj.wpuc_orientation ) {
      $('.wpuc-main-form').addClass('wpuc-main-form_vertical');
      $('.wpuc-equalizer').addClass('wpuc-equalizer_vertical');
    }

  });
})(jQuery);
