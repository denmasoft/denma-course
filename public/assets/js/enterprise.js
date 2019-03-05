jQuery(document).ready(function($){

  $(document).on('click','#remove_link',function(e){
      e.preventDefault();
      var url = $(this).attr('href');
    if (window.confirm("'Realmente desea eliminar este elemento?'")) {
        window.location = url;
      }
  });
  var enterprise_table = $('#enterprise-table').DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
    "ajax": {
      url: "/enterprises"
    },
    "columns": [
      { data: 'name' },
      { data: 'social' },
      { data: 'cif' },
      { data: 'contact' },
      { data: 'position' },
      { data: 'phone' },
      { data: 'email' },
      { data: 'approval' },
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
  $('#user-filter').on('click',function () {
    enterprise_table.columns(0).search($('#name').val());
    enterprise_table.columns(1).search($('#social').val());
    enterprise_table.columns(2).search($('#dni').val());
    enterprise_table.columns(3).search($('#contact').val());
    enterprise_table.columns(4).search($('#phone').val());
    enterprise_table.columns(5).search($('#email').val());
    enterprise_table.columns(6).search($('#position').val());
    enterprise_table.draw();
  });

  $('#enterpriseForm').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    rules: {
      name: {required: true},
      social: {required: true},
      nif: {required: true, Dni: true},
      contact: {required: true},
      email: {required: true, email:true},
      phone: {required: true, phone: true},

    },
    messages: {
      name: {
        required: 'Requerido'
      },
      social: {
        required: 'Requerido'
      },
      nif: {
        required: 'Requerido',
        Dni: 'Error'
      },
      contact: {
        required: 'Requerido'
      },
      email: {
        required: 'Requerido',
        email:'Error'
      },
      phone: {
        required: 'Requerido',
        phone: 'Error'
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
