/*=========================================================================================
    File Name: form-select2.js
    Description: Select2 is a jQuery-based replacement for select boxes.
    It supports searching, remote data sets, and pagination of results.
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: Pixinvent
    Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/
(function (window, document, $) {
  "use strict";
  var select = $(".select2");

  select.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      allowClear: true,
      placeholder: $this.data("placeholder") ?? "Select an option",
      dropdownAutoWidth: true,
      width: "100%",
      dropdownParent: $this.parent(),
    });
  });
})(window, document, jQuery);
