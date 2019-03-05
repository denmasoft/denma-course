jQuery(document).ready(function($){
  $('#driving_permit-table').DataTable({
    responsive: true,
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
  $('#drivingPermitForm').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    rules: {
      code: {required: true},
      description: {required: true}
    },
    messages: {
      code: {
        required: 'Requerido'
      },
      description: {
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
