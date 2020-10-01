/* CPT Table */
(function($){
  console.log(`cpttable.js loaded.`, wpvars );
  $(`#${wpvars.tableId}`).DataTable({
    dom: '<"wrapper" <"dt-row" lf>t<"dt-row" ip>>'
  });
})(jQuery);