
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";


$(document).ready(function() {
  
  $('#employeeMainNav').addClass('active');
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'employee/fetchCategoryData',
    'order': []
  });

  // submit the create from 
  $("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);
    var name = jQuery("#name").val();
    var emp_code = jQuery("#emp_code").val();
    var department = jQuery("#department").val();
    var dob = jQuery("#dob").val();
    var joining = jQuery("#joining").val();
    var alpha = /[A-Za-z ]+$/;
    var alphanum = /[A-Za-z0-9 ]+$/;
    
        if(name == '' ) {          
            swal("Warning!", "Enter your name", "warning", {
            button: "OK",
            });
            return false;              
        }else if(name.charAt(0)==' ') {
            swal("Warning!", "First Letter should not be a space ", "warning", {
            button: "OK",
            });
            return false;              
        }else if(!alpha.test(name)) {
          swal("Warning!", "Enter a valid Name", "warning", {
          button: "OK",
              });
          
          return false;          
        }else if(name.length > 30){
            swal("Warning!", "Enter your First Name less than 30 character", "warning", {
            button: "OK",
            });
            
            return false;
        }else if(emp_code == ''){
          swal("Warning!", "Enter Employee Code", "warning", {
            button: "OK",
            });
            return false;  
        }else if(!alphanum.test(emp_code)) {
          swal("Warning!", "Enter a valid Employee Code", "warning", {
          button: "OK",
              });
          
          return false;          
        }else if(department == ''){
          swal("Warning!", "Enter Department", "warning", {
            button: "OK",
            });
            return false;
        }else if(!alpha.test(department)) {
            swal("Warning!", "Enter a valid Department", "warning", {
            button: "OK",
            });
            return false;              
        }else if(dob == '' ) {          
            swal("Warning!", "Enter Date of Birth", "warning", {
            button: "OK",
            });
            return false;              
        }else if(joining == '' ) {          
            swal("Warning!", "Enter Date of Joining", "warning", {
            button: "OK",
            });
            return false;              
        }else{
          $(".text-danger").remove();
          $.ajax({
            url: 'create',
            type: form.attr('method'),
            data: form.serialize(), // /converting the form data into array and sending it to server
            dataType: 'json',
            success:function(response) {

              manageTable.ajax.reload(null, false); 

              if(response.success === true) {
                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                '</div>');


                // hide the modal
                $("#addModal").modal('hide');

                // reset the form
                $("#createForm")[0].reset();
                $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

              } else {

                if(response.messages instanceof Object) {
                  $.each(response.messages, function(index, value) {
                    var id = $("#"+index);

                    id.closest('.form-group')
                    .removeClass('has-error')
                    .removeClass('has-success')
                    .addClass(value.length > 0 ? 'has-error' : 'has-success');
                    
                    id.after(value);

                  });
                } else {
                  $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                  '</div>');
                }
              }
            }
          }); 
        }
        
    // remove the text-danger
    // $(".text-danger").remove();
  
    // $.ajax({
    //   url: 'create',
    //   type: form.attr('method'),
    //   data: form.serialize(), // /converting the form data into array and sending it to server
    //   dataType: 'json',
    //   success:function(response) {

    //     manageTable.ajax.reload(null, false); 

    //     if(response.success === true) {
    //       $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
    //         '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
    //         '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
    //       '</div>');


    //       // hide the modal
    //       $("#addModal").modal('hide');

    //       // reset the form
    //       $("#createForm")[0].reset();
    //       $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

    //     } else {

    //       if(response.messages instanceof Object) {
    //         $.each(response.messages, function(index, value) {
    //           var id = $("#"+index);

    //           id.closest('.form-group')
    //           .removeClass('has-error')
    //           .removeClass('has-success')
    //           .addClass(value.length > 0 ? 'has-error' : 'has-success');
              
    //           id.after(value);

    //         });
    //       } else {
    //         $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
    //           '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
    //           '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
    //         '</div>');
    //       }
    //     }
    //   }
    // }); 

    return false;
  });

});
// function viewemployees(){
// alert('ok');

//   $.ajax({
//     url: 'fetchCategoryData',
//     type: 'post',
//     dataType: 'json',
//     success:function(response) {
//       manageTable = $('#manageTable').DataTable({
    
//       'order': []
//      });

//     }
//   });
// }
// edit function
function editFunc(id)
{ 
  $.ajax({
    url: base_url + 'employee/fetchemployeeDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_store_name").val(response.name);
      $("#edit_active").val(response.active);

      // submit the edit from 
      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {

            manageTable.ajax.reload(null, false); 

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');


              // hide the modal
              $("#editModal").modal('hide');
              // reset the form 
              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');
                  
                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
              }
            }
          }
        }); 

        return false;
      });

    }
  });
}

// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { store_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 
          // hide the modal
            $("#removeModal").modal('hide');

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}


</script>