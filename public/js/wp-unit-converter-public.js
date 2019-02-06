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

  /**
   * Sends Ajax request with selected 'to', 'from', and user entered value. It displays the conversion as response handler, recieved from server.
   */

  $(document).ready(function($) {           
    $(document).on( "click", "#wpuc_convert", function() {

      $.ajax({
        url: wpuc_ajax_obj.metrics_json,
        type: "POST",
        dataType: "json",
        success: convertUnits,
        error: function(xhr, status) {
          console.log("There was an error. Request couldn't be completed.");
        }
      });

      function convertUnits(data) {
        var wpuc_from = $("#wpuc_from").val();
        var wpuc_to = $("#wpuc_to").val();
        var wpuc_value = $("#wpuc_value").val();
        var wpuc_converter_type = $("#wpuc_converter_type").val();

        var wpuc_metrics = data['metrics'];
        var wpuc_converter_data = wpuc_metrics[wpuc_converter_type];
        var wpuc_converter_base_unit = wpuc_converter_data['base_unit'];
        var wpuc_converter_to = wpuc_converter_data['convert_to'];
        var wpuc_converted_value;

        if (wpuc_converter_type != 'temperature') {

          wpuc_converted_value = wpuc_value * wpuc_converter_to[wpuc_from] * wpuc_converter_to[wpuc_converter_base_unit] / wpuc_converter_to[wpuc_to];
    
        } else {
    
          wpuc_converted_value = ((wpuc_value - wpuc_converter_to[wpuc_from]['base']) / wpuc_converter_to[wpuc_from]['ratio']) * wpuc_converter_to[wpuc_to]['ratio'] + wpuc_converter_to[wpuc_to]['base'];
              
        }

        function toFixed(num, fixed) {
          var re = new RegExp('^-?\\d+(?:\.\\d{0,' + (fixed || -1) + '})?');
          return num.toString().match(re)[0];
        }

        $("#wpuc_convert_result").html( 'Result: ' + toFixed(wpuc_converted_value, 2) + ' ' + wpuc_to );
        $("#wpuc_convert_result").fadeIn();
      }

    });
});

  /**
   * Sends Ajax request of selected metrics type by the user. It displays the units of the selected metrics as response handler.
   */

  $(document).ready(function($) {           
    $("#converter-selection .wpuc-select").change(function() {
      var _this = this.value;
      $.ajax({
        url: wpuc_ajax_obj.metrics_json,
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

        $(".wpuc-field-value.wpuc-select").html(wpuc_convert_options);
        
      }
    });
});
})(jQuery);
