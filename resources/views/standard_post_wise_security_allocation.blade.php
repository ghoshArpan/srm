<?php $title = 'Standard Post Wise Security Allocation'; ?>
@extends('layouts.master')
@section('content')
   <div class="top-bar">
         <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="">Application</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="breadcrumb__icon feather feather-chevron-right">
               <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
            <a href="" class="breadcrumb--active">Standard Post Wise Security Allocation</a>
         </div>
         <div class="intro-x relative mr-3 sm:mr-6">
        <a href="department_details"><button type="button" class="btn btn-info">
         <span class="glyphicon glyphicon-search"></span> ##
        </button></a>
     </div>
    </div>

        <div class=" mt-8 card shadow-lg p-3  bg-white rounded h-75">
           <div class=" items-center h-10">
              <h1 class="text-lg font-medium truncate mr-5"><span id="add_update"> Add </span> Standard Post Wise Security</h1>
            </div>

            <div class="card-body" style="background-color: white ;" >
                 {!! Form::open(['url' => '', 'name' => 'post_wise_security_search_form', 'id' => 'post_wise_security_search_form', 'method' => 'post' ,'class'=>'animate-form form-horizontal','role'=>'form']) !!}
                 {!! Form::hidden('code', '',['id'=>'edit_code']) !!}
                                
                <div class="row form-group">
                    <div class="col-sm-4  font-weight-bold" style="font-size: 16Px;">
                        {!! Form::label('location', ' Location:', ['class' =>'']) !!}
                    {!! Form::select('location',[''=>'Select Location'],null,['class' => 'form-control','id'=>'location']); !!}
                    </div>
                    <div class="col-sm-4 font-weight-bold" style="font-size: 16Px;">
                        {!! Form::label('post', ' Post:', ['class' =>'']) !!}
                    
                       {!! Form::select('post',[''=>'Select Post'],null,['class' => 'form-control','id'=>'post']); !!}
                    </div>
                    <div class="col-sm-4  font-weight-bold" style="font-size: 16Px;">
                        {!! Form::label('shift', ' Shift:', ['class' =>'']) !!}
                    
                         {!! Form::select('shift',[''=>'Select Shift'],null,['class' => 'form-control','id'=>'shift']); !!}
                    </div>
                    
                </div>             
                <div class="row form-group">
                    <div class="col-sm-12" style="text-align: center;">
                        <button id="save_update" type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
               
                   {!! Form::close() !!}             
             
            </div>
        
     </div>
   
     <script type="text/javascript">
         
         $(function () { 

            get_all_location();

        $("#location").change(function(){
           var location =  $("#location").val();

            get_all_post(location);

        });

        $("#post").change(function(){
          
            get_all_shift();

        });

            
                 $('#post_wise_security_search_form').bootstrapValidator({
                    message: 'This value is not valid',
                    feedbackIcons: {
                        
                    },

                    fields: {
                        location: {
                            validators: {
                                notEmpty: {
                                    message: 'Location is Required'
                                }
                            }
                        },
                        post: {
                            validators: {
                                notEmpty: {
                                    message: 'Post is Required'
                                }
                            }
                        } ,
                        shift: {
                            validators: {
                                notEmpty: {
                                    message: 'Shift is Required'
                                }
                            }
                        }     

                    }
                }).on('success.form.bv', function (e) {
                    e.preventDefault();
                    search_post_wise_security();               
                });   

        });

       function  search_post_wise_security(){

             var token = $("input[name='_token']").val();
             var location = $("#location").val();
             var post = $("#post").val();
             var shift = $("#location").val();


             var formData_save = new FormData();
                formData_save.append('_token', token);
                formData_save.append('location', location);
                formData_save.append('post', post);
                formData_save.append('shift', shift);

                $.ajax({
                    type: "POST",
                    url: "search_post_wise_security",
                    data: formData_save,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {

                    //      if (data.status == 1) {
                    
                    //     var msg = "<strong>SUCCESS: </strong>Department Saved Successfully";

                    //     $.confirm({
                    //     title: 'Success!',
                    //     type: 'green',
                    //     icon: 'fa fa-check',
                    //     content: msg,
                    //     buttons: {
                    //         ok: function () {
                                
                    //             $('#department_form').get(0).reset();
                    //              location.reload();
                                
                    //         }

                    //     }
                    // });
                        
                    // }
                    // else if(data.status == 2)
                    // {
                    //      var msg = "<strong>SUCCESS: </strong>Department Updated Successfully";

                    //     $.confirm({
                    //     title: 'Success!',
                    //     type: 'green',
                    //     icon: 'fa fa-check',
                    //     content: msg,
                    //     buttons: {
                    //         ok: function () {
                              
                    //              window.location.href = "department_details";
                    //         }

                    //     }
                    // });

                    // }
                     
                    


                    },
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


         function get_all_location(){

             var token = $("input[name='_token']").val();
            $.ajax({
              type: "post",
              url: "get_all_location",
              data:{_token:token},
              dataType: 'json',
              success: function (data) {
              
                $('#location').html('<option value=""> Select Location </option>');
                $.each(data.options, function (key, value) {
                
                    $("#location").append('<option value=' + key + '>' + value + '</option>');
                  
                });
              }

            });
         }

          function get_all_post(location){

             var token = $("input[name='_token']").val();
            $.ajax({
              type: "post",
              url: "get_all_post",
              data:{_token:token,location:location},
              dataType: 'json',
              success: function (data) {
              
                $('#post').html('<option value=""> Select Post </option>');
                $.each(data.options, function (key, value) {
                
                    $("#post").append('<option value=' + key + '>' + value + '</option>');
                  
                }); 

              }

            });

         }

         function get_all_shift(){

             var token = $("input[name='_token']").val();
            $.ajax({
              type: "post",
              url: "get_all_shift",
              data:{_token:token},
              dataType: 'json',
              success: function (data) {
              
                $('#shift').html('<option value=""> Select Shift </option>');
                $.each(data.options, function (key, value) {
                
                    $("#shift").append('<option value=' + key + '>' + value + '</option>');
                  
                }); 

              }

            });

         }
     </script>


                      
  
@stop