jQuery(document).ready(function($){
  $('.chosen-select').chosen({allow_single_deselect:true});
  $('#publishedAt').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd/mm/yyyy'
  });
  $('#publishedAt_min').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd/mm/yyyy'
  }).on('changeDate', function (selected) {
    var startDate = new Date(selected.date.valueOf());
    $('#publishedAt_max').datepicker('setStartDate', startDate);
  }).on('clearDate', function (selected) {
    $('#publishedAt_max').datepicker('setStartDate', null);
  });
  $('#publishedAt_max').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd/mm/yyyy'
  }).on('changeDate', function (selected) {
    var endDate = new Date(selected.date.valueOf());
    $('#publishedAt_min').datepicker('setEndDate', endDate);
  }).on('clearDate', function (selected) {
    $('#publishedAt_min').datepicker('setEndDate', null);
  });
  var newsletter_table = $('#newsletter-table').DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
    "ajax": {
      url: "/newsletters"
    },
    "columns": [
      { data: 'name' },
      { data: 'publishedAt' },
      { data: 'publishedIn' },
      { data: 'locality' },
      { data: 'description' },
      { data: 'requirements' },
      { data: 'contract_type' },
      { data: 'contact' },
      { data: 'options' }],
    "bSort" : true,
    "bFilter": true,
    "aaSorting": [[ 0, "DESC" ]],
    "iDisplayLength": 100,
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'excel',
        text: '<span class="fa fa-file-excel-o"></span> Exportar a Excel',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        }
      },
      {
        extend: 'csv',
        text: '<span class="glyphicon-export"></span> Exportar a Csv',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        }
      },
      {
        extend: 'pdf',
        text: '<span class="fa fa-file-pdf-o"></span> Exportar a Pdf',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        }
      },
      {
        extend: 'print',
        text: '<span class="fa fa-print bigger-110"></span> Imprimir',
        exportOptions: {
          modifier: {
            search: 'applied',
            order: 'applied'
          }
        }
      }

    ],
  });
  $('#newsletter-filter').on('click',function () {

    newsletter_table.columns(0).search($('#name').val());
    newsletter_table.columns(1).search($('#publishedAt_min').val()+'-'+$('#publishedAt_max').val());
    newsletter_table.columns(2).search($('#publishedIn').val());
    newsletter_table.columns(3).search($('#locality').val());
    newsletter_table.columns(4).search($('#description').val());
    newsletter_table.columns(5).search($('#requirements').val());
    newsletter_table.columns(6).search($('#contract_type').chosen().val());
    newsletter_table.columns(7).search($('#contact').val());
    newsletter_table.draw();
  });

  $('#newsletterForm').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    rules: {
      name: {required: true},
      publishedAt: {required: true},
      publishedIn: {required: true},
      description: {required: true},
      requirements: {required: true},
      contract_type: {required: true},
      contact: {required: true}
    },
    messages: {
      name: {
        required: 'Requerido'
      },
      publishedAt: {
        required: 'Requerido'
      },
      publishedIn: {
        required: 'Requerido'
      },
      description: {
        required: 'Requerido'
      },
      requirements: {
        required: 'Requerido'
      },
      contract_type: {
        required: 'Requerido'
      },
      contact: {
        required: 'Requerido'
      }
    },
    highlight: function (e) {
      $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
    },
    success: function (e) {
      $(e).closest('.form-group').removeClass('has-error');
      $(e).remove();
    },
    errorPlacement: function (error, element) {
      if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
        var controls = element.closest('div[class*="col-"]');
        if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
        else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
      }
      else if(element.is('.select2')) {
        error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
      }
      else if(element.is('.chosen-select')) {
        error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
      }
      else error.insertAfter(element.parent());
    },
    submitHandler: function (form) {
      form.submit();
    },
    invalidHandler: function (form) {}
  });
});
