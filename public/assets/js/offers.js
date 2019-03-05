jQuery(document).ready(function($){
  $('#due_date').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd/mm/yyyy',
    startDate: new Date()
  });
  $('#start_date').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd/mm/yyyy',
    startDate: new Date()
  });
  $('#start_date_min').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd/mm/yyyy'
  }).on('changeDate', function (selected) {
    var startDate = new Date(selected.date.valueOf());
    $('#start_date_max').datepicker('setStartDate', startDate);
  }).on('clearDate', function (selected) {
    $('#start_date_max').datepicker('setStartDate', null);
  });
  $('#start_date_max').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd/mm/yyyy'
  }).on('changeDate', function (selected) {
    var endDate = new Date(selected.date.valueOf());
    $('#start_date_min').datepicker('setEndDate', endDate);
  }).on('clearDate', function (selected) {
    $('#start_date_min').datepicker('setEndDate', null);
  });

  $('#due_date_min').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd/mm/yyyy'
  }).on('changeDate', function (selected) {
    var startDate = new Date(selected.date.valueOf());
    $('#due_date_max').datepicker('setStartDate', startDate);
  }).on('clearDate', function (selected) {
    $('#due_date_max').datepicker('setStartDate', null);
  });
  $('#due_date_max').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd/mm/yyyy'
  }).on('changeDate', function (selected) {
    var endDate = new Date(selected.date.valueOf());
    $('#due_date_min').datepicker('setEndDate', endDate);
  }).on('clearDate', function (selected) {
    $('#due_date_min').datepicker('setEndDate', null);
  });
  var offer_table = $('#offer-table').DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
    "ajax": {
      url: "/admin/offers"
    },
    "columns": [
      { data: 'requested_job' },
      { data: 'vacancy' },
      { data: 'tasks' },
      { data: 'due_date' },
      { data: 'contract_type' },
      { data: 'start_date' },
      { data: 'duration' },
      { data: 'locality' },
      { data: 'hours' },
      { data: 'salary' },
      { data: 'requirements' },
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
  $('#offer-filter').on('click',function () {
    offer_table.columns(0).search($('#requested_job').val());
    offer_table.columns(1).search($('#vacancy').val());
    offer_table.columns(2).search($('#tasks').val());
    offer_table.columns(3).search($('#due_date_min').val()+'-'+$('#due_date_max').val());
    offer_table.columns(4).search($('#contract_type').val());
    offer_table.columns(5).search($('#start_date_min').val()+'-'+$('#start_date_max').val());
    offer_table.columns(6).search($('#duration_min').val()+'-'+$('#duration_max').val());
    offer_table.columns(7).search($('#locality').val());
    offer_table.columns(8).search($('#salary_min').val()+'-'+$('#salary_max').val());
    offer_table.draw();
  });
  $('#offerForm').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    rules: {
      requested_job: {required: true},
      vacancy: {required: true},
      tasks: {required: true},
      due_date: {required: true},
      contract_type: {required: true},
      start_date: {required: true},
      duration: {required: true},
      locality: {required: true},
      hours: {required: true},
      "requirements[]": {
        required: true
      }
    },
    messages: {
      requested_job: {
        required: 'Requerido'
      },
      vacancy: {
        required: 'Requerido'
      },
      tasks: {
        required: 'Requerido'
      },
      due_date: {
        required: 'Requerido'
      },
      contract_type: {
        required: 'Requerido'
      },
      start_date: {
        required: 'Requerido'
      },
      duration: {
        required: 'Requerido'
      },
      locality: {
        required: 'Requerido'
      },
      hours: {
        required: 'Requerido'
      },
      "requirements[]": 'Requerido'
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
  $('#other_requirements_container').hide();
  var $others = $('#other_requirements_container').data('others');
  if($others!==false){
    $('#other_requirements_container').show();
  }
  $('#others_check').on('click',function(){
    if($(this).prop('checked')==true){
      $('#other_requirements_container').show();
    }else{
      $('#other_requirements_container').hide();
    }
  })
});
