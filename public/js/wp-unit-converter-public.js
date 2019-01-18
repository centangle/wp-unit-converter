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
      var from = $("#wpuc_from").val();
      var to = $("#wpuc_to").val();
      var wpuc_value = $("#wpuc_value").val();
      var converter_type = $("#wpuc_converter_type").val();

        $.post(wpuc_ajax_obj.ajax_url, {
           _ajax_nonce: wpuc_ajax_obj.nonce,
            action: "wpuc_do_convert",
            from: from,
            to: to,
            wpuc_value: wpuc_value,
            converter_type: converter_type
        }, function(data) {
          data = JSON.parse(data);
          $("#wpuc_convert_result").html( "Result: " + data + " " + to );
    		  $("#wpuc_convert_result").fadeIn();
        });
    });
});

  /**
   * Sends Ajax request of selected metrics type by the user. It displays the units of the selected metrics as response handler, recieved from server.
   */

  $(document).ready(function($) {           
    $("#converter-selection .wpuc-select").change(function() {
        $.post(wpuc_ajax_obj.ajax_url, {
           _ajax_nonce: wpuc_ajax_obj.nonce,
            action: "wpuc_do_change",
            converter_type: this.value
        }, function(data) {
          $("#wpuc-converter-type").html(data); //insert server response
        });
    });
});
})(jQuery);
