/* CPT Table */
(function($){
  // Our DataTable options
  const dtOptions = {
    dom: '<"dataTables_wrapper" <"dt-row" lf>t<"dt-row" ip>>'
  };

  // Initialize the DataTable
  var table = $(`#${wpvars.tableId}`).DataTable(dtOptions);

  // Scroll to Top Upon Page Change
  table.on('page.dt', function(){
    $('html, body').animate({
      scrollTop: $('.dataTables_wrapper').offset().top
    }, 'slow');
  });
})(jQuery);