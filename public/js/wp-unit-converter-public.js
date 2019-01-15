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
   * Sends Ajax request with selected 'to', 'from' options, and user entered value. It displays the conversion as response handler, recieved from server.
   */

  $(document).ready(
    $(document).on( "click", "#oppso_convert", function() {

        from = $("#oppso_from").val();

        to = $("#oppso_to").val();

        converter_type = $("#oppso_converter_type").val();

        oppso_value = $("#oppso_value").val();

        var data = {
		
          action: "oppso_do_convert",

          from: from,

          to: to,

          converter_type: converter_type,

		  oppso_value: oppso_value
		
        };

        $.post(wpuc_ajaxurl, data, function(response) {
		
          response = JSON.parse(response);

          $("#oppso_convert_result").html("Result: " + response + " " + to);

		  $("#oppso_convert_result").fadeIn();
		
        });
      }
    )
  );

  /**
   * Sends Ajax request of selected metrics type by the user. It displays the units of the selected metrics as response handler, recieved from server.
   */

  $(document).ready(
    $(document).on(
      "change",
      " #converter-selection .oppso-select",

      function() {
        converter_type = $(this).val();

        var data = {
          action: "oppso_do_change",

          converter_type: converter_type
        };

        $.post(wpuc_ajaxurl, data, function(response) {
          $("#oppso-converter-type").html(response);
        });
      }
    )
  );
})(jQuery);
