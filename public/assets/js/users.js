jQuery(document).ready(function($){
  $('#userForm').validate({
    errorElement: 'div',
    errorClass: 'help-block',
    focusInvalid: false,
    rules: {
      name: {required: true},
      last_name: {required: true},
      dni: {required: true,Dni: true},
      birth: {required: true, validDate: true},
      address: {required: true},
      postal_code: {required: true},
      phone: {required: true,phone: true},
      email: {required: true, email: true}
    },
    messages: {
      name: {
        required: 'Requerido'
      },
      last_name: {
        required: 'Requerido'
      },
      dni: {
        required: 'Requerido',
        Dni: 'Erroneo'
      },
      birth: {
        required: 'Requerido',
        validDate: 'Error'
      },
      address: {
        required: 'Requerido'
      },
      postal_code: {
        required: 'Requerido'
      },
      phone: {
        required: 'Requerido',
        phone: 'Erroneo'
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
  $('.chosen-select').chosen({allow_single_deselect:true});
  var user_table = $('#users-table').DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
    "lengthMenu": [[100,-1], [100, "All"]],
    "iDisplayLength": 1000,
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'excel',
        text: '<span class="fa fa-file-excel-o"></span> Exportar a Excel',
        exportOptions: {
          modifier: {
            search: 'applied',
            page : 'all',
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
            page : 'all',
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
            page : 'all',
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
            page : 'all',
            order: 'applied'
          }
        }
      }
    ],
    "ajax": {
      url: "/admin/users"
    },
    "columns": [
      { data: 'surname' },
      { data: 'name' },
      { data: 'age' },
      { data: 'email' },
      { data: 'cif' },
      { data: 'telephone' },
      { data: 'options' }],
    "bSort" : true,
    "bFilter": true,
    "aaSorting": [[ 0, "DESC" ]]
  });
  $('#user-filter').on('click',function () {
    user_table.columns(0).search($('#name').val());
    user_table.columns(1).search($('#surname').val());
    user_table.columns(2).search($('#dni').val());
    user_table.columns(3).search($('#email').val());
    user_table.columns(4).search($('#phone').val());
    user_table.columns(5).search($('#min-age').val()+'-'+$('#max-age').val());
    user_table.draw();
  });
  $('#specialtyC').hide();
  $('#studies').on('change',function(e){
    e.preventDefault();
    var $study = $(this).val();
    if($study==='1' || $study==='2' || $study==='3'){
      $('#specialtyC').hide();
      $('#specialty').html('');
      return;
    }
    $.ajax({
      url:'/studies/'+$study+'/specialties',
      method: 'GET',
      type:'JSON',
      beforeSend: function () {
        
      },
      success: function (response) {
        $('#specialtyC').show();
        $('#specialty').html(response);
      }
    })
  });

  $('#province').on('change',function(e){
    e.preventDefault();
    var $province = $(this).val();
    var $text = $("option:selected",this).text();
    if($text==='Otra'){
      $('#other_province').show();
      //$('#hall').hide();
      $('#hall_chosen').hide();
      $('#other_hall').show();
      return;
    }
    else{
      $('#other_province').hide();
      //$('#hall').show();
      $('#hall_chosen').show();
      $('#other_hall').hide();
    }
    $.ajax({
      url:'/province/'+$province+'/concellos',
      method: 'GET',
      type:'JSON',
      beforeSend: function () {},
      success: function (response) {

        $('#hall').html(response).trigger("chosen:updated");
      }
    })
  });
  var lang_input = $('#languages');
  lang_input.tag({placeholder:lang_input.attr('placeholder')});
  var computer_skills = $('#computer_skills');
  computer_skills.tag({placeholder:computer_skills.attr('placeholder')});
  $.mask.definitions['~'] = '[+-]';
  $('#birth').mask('99/99/9999');
  $('#birth').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd/mm/yyyy'
  }).on('changeDate', function (selected) {

  }).on('clearDate', function (selected) {

  });
});
