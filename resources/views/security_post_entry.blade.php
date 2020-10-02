<?php $title = 'Security Post Master'; ?>
@extends('layouts.master')
@section('content')
   <div class="top-bar">
         <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="">Application</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="breadcrumb__icon feather feather-chevron-right">
               <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
            <a href="" class="breadcrumb--active">Security Post Master</a>
         </div>
         <div class="intro-x relative mr-3 sm:mr-6">
        <a href="security_post_master"><button type="button" class="btn btn-info">
         <span class="glyphicon glyphicon-search"></span> List Of Security Post Master
        </button></a>
     </div>
    </div>

        <div class=" mt-8 card shadow-lg p-3  bg-white rounded h-75">
           <div class=" items-center h-20">
              <h1 class="text-lg font-medium truncate mr-5"><span id="add_update"> Add </span> Security Post Master</h1>
            </div>

            <div class="card-body" style="background-color: white ;" >
            
                 {!! Form::open(['url' => '', 'name' => 'security_post_form', 'id' => 'security_post_form', 'method' => 'post' ,'class'=>'animate-form form-horizontal','role'=>'form']) !!}
                 {!! Form::hidden('code', '',['id'=>'edit_code']) !!}
                 <input type='text' name='test_arra' id='test_arra' value=''>
                   <div class="row form-group">
                    <div class="col-sm-4 text-right font-weight-bold" style="font-size: 20Px;">
                        {!! Form::label('security_post_name', ' Security Post Name:', ['class' =>'required']) !!}
                    </div>   
                    <div class="col-sm-6">
                        {!! Form::text('security_post_name', null, ['id'=>'security_post_name','class'=>'form-control','placeholder'=>'Enter Post Name','autocomplete'=>'off']) !!}
                    </div>
                    
                </div>      

                  <div class="row form-group">
                    <div class="col-sm-4 text-right font-weight-bold" style="font-size: 20Px;">
                        {!! Form::label('location_name', ' Location:', ['class' =>'required']) !!}
                    </div>   
                    <div class="col-sm-6">
                    {!! Form::select('location',[''=>'Select Location'],null,['class' => 'form-control','id'=>'location_name']); !!}

                    </div>
                    
                </div>   

                 <div class="row form-group">
                    <div class="col-sm-4 text-right font-weight-bold" style="font-size: 20Px;">
                        {!! Form::label('designation_name', ' Designation Name:', ['class' =>'required']) !!}
                    </div>   
                    <div class="col-sm-6">


                     
                      {!! Form::select('designation_name',[],null,['class' => 'form-control','id'=>'designation_name','multiple'=>'multiple']); !!}

                      
                     
                    </div>
                    
                </div>     

                <div class="row form-group">
                    <div class="col-sm-12" style="text-align: center;">
                        <button id="save_update" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
               
                   {!! Form::close() !!}             
             
            </div>
        
     </div>




  
     <script>
      
      $(function () {

        get_all_location('');
         get_all_designation('');
         
            // if()
            // echo "<pre>";
            // print_r($security_post_data);
            // echo "</pre>";

        //  echo $security_post_data;
            
             
    //  echo $security_post_data;
    // echo "<pre>";
    // print_r($security_post_data);
    // echo "</pre>";



    <?php if (isset($security_post_data)) {

//$arrStr = explode(",", $security_post_data->designation);
// echo "kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk";
// print_r($arrStr);
// die;
               
        ?>
//alert();
// var nnnn=split(',',);
// $("#test_arra").val(nnnn);
$("#edit_code").val("<?php echo $security_post_data->code ;?>");

$("#designation_name").val('<?php echo $security_post_data->designation; ?>');

$("#security_post_name").val('<?php echo $security_post_data->post_name; ?>');

get_all_location('<?php echo $security_post_data->location_code ?>') ;

// get_all_designation('') ;

$("#save_update").html('Update');
$("#add_update").html('Update');


<?php } ?>

        
     
         $('#designation_name').select2({
            //  placeholder: 'Select Designation Name'
         });
            // document.multiselect('#designation_name');
            $('#security_post_form').bootstrapValidator({

                        message: 'This value is not valid',
                        fields: {
                        security_post_name: {
                                        validators: {
                                            notEmpty: {
                                                message: 'Security Post Name is Required'
                                            }
                                        }
                                    },
                        
                        
                                    location: {
                                        validators: {
                                            notEmpty: {
                                                message: 'Location Name is Required'
                                            }
                                        }
                                    },
                                 
                                    designation_name: {
                                        validators: {
                                            notEmpty: {
                                                message: 'Designation Name is Required'
                                            }
                                        }
                                    }

                        }

                        }).on('success.form.bv', function (e) {
                            e.preventDefault();
                            save_security_post();               
                        }); 

      
      });

      function save_security_post(){
            var token = $("input[name='_token']").val();
             var security_post_name = $("#security_post_name").val();
            //  alert(security_post_name);
             var location_name = $("#location_name").val();
             var designation_name = $("#designation_name").val();
             var editcd = $("#edit_code").val();

             var formData_save = new FormData();
                formData_save.append('_token', token);
                formData_save.append('security_post_name', security_post_name);
                // alert("hi");
                formData_save.append('location_name', location_name);
                // alert(location_name);
                formData_save.append('designation_name', designation_name);
                
                formData_save.append('editcd', editcd);


                $.ajax({
                            type: "POST",
                            url: "security_post_save",
                            data: formData_save,
                            processData: false,
                            contentType: false,
                            async: false,
                            dataType: "json",
                            // alert("hi");
                            success: function (data) {

                                if (data.status == 1) {
                    
                                         var msg = "<strong>SUCCESS: </strong>Security Post Saved Successfully";

                                            $.confirm({
                                            title: 'Success!',
                                            type: 'green',
                                            icon: 'fa fa-check',
                                            content: msg,
                                            buttons: {
                                                ok: function () {
                                                    
                                                    $('#security_post_form').get(0).reset();
                                                    location.reload();
                                                    
                                                }

                                            }
                                        });
                    
                                  }
                                
                            },

                    //  alert("hi");

                    error: function (jqXHR, textStatus, errorThrown) {
                        $(".se-pre-con").fadeOut("slow");
                        var msg = "";
                        if (jqXHR.status !== 422 && jqXHR.status !== 400) {
                            msg += "<strong>" + jqXHR.status + ": " + errorThrown + "</strong>";
                        } else {
                            if (jqXHR.responseJSON.hasOwnProperty('exception')) {
                                msg += "Exception: <strong>" + jqXHR.responseJSON.exception_message + "</strong>";
                            } else {
                                msg += "Error(s):<strong><ul>";
                                $.each(jqXHR.responseJSON['errors'], function (key, value) {
                                    msg += "<li>" + value + "</li>";
                                });
                                msg += "</ul></strong>";
                            }
                        }
                        $.alert({
                            title: 'Error!!',
                            type: 'red',
                            icon: 'fa fa-warning',
                            content: msg,
                        });
                    }

                             });



      }
    

      function get_all_location(securityLocationcd){

               var token = $("input[name='_token']").val();
               $.ajax({
               type: "post",
               url: "get_all_location",
               data:{_token:token},
               dataType: 'json',
               success: function (data) {
               
                //   $('#location').html('<option value=""> Select Location </option>');
                  $.each(data.options, function (key, value) {
                  
                     $("#location_name").append('<option value=' + key + '>' + value + '</option>');
                  
                  });
                  if(securityLocationcd  !=''){
                    $("#location_name").val(securityLocationcd);

                  }
                  
               }

            });
         }

         
      function get_all_designation(){
        //   alert(securityDesignation);
            var token = $("input[name='_token']").val();
            $.ajax({
            type: "post",
            url: "get_all_designation",
            data:{_token:token},
            dataType: 'json',
            async: false,
            success: function (data) {

            //   $('#designation_name').html('<option value=""> Select Designation Name </option>');
            $.each(data.options, function (key, value) {
            
                $("#designation_name").append('<option value=' + key + '>' + value + '</option>');
            
            });
            // if(securityDesignation !=''){
            //     $("#designation_name").;
            // }
            // if(!empty(securityDesignation)){
               
            // }
            // if(securityDesignation  !=''){
            //         $("#designation_name").val([securityDesignation]);

            //       }
            }

            });
            }

  
     
   
      </script>     

@stop