<?php $title = 'Location'; ?>
@extends('layouts.master')
@section('content')
   <div class="top-bar">
         <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="">Application</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="breadcrumb__icon feather feather-chevron-right">
               <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
            <a href="" class="breadcrumb--active">Location</a>
         </div>
          <div class="intro-x relative mr-3 sm:mr-6">
        <a href="add_location"><button type="button" class="btn btn-info">
         <span class="glyphicon glyphicon-search"></span>Add Location
        </button></a>
      
        
     </div>
        
    </div>

        <div class=" mt-8 card shadow-lg p-3  bg-white rounded h-75">
           <div class=" items-center h-20">
              <h1 class="text-lg font-medium truncate mr-5"> List of Location</h1>
            </div>

            <div class="card-body" style="background-color: white ;" >


            <div class="datatbl table-responsive">
                <table class="table table-striped table-bordered table-hover notice-types-table" id="tbl_of_location">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 10%;">SL#</th>
                            <th style="width: 60%;">Location Name</th>
                            <th style="width: 30%;">ACTIONS</th>
                        </tr>
                   </thead>
                    <tbody >
                    </tbody>
                </table> 
            </div>
       
                            
                         
             
            </div>
        
     </div>
     {{csrf_field()}}

     <script>


$(function () { 
    location_details();
    });


function location_details(){
    $("#tbl_of_location").dataTable().fnDestroy();
            $('#tbl_of_location').dataTable({
                "processing": true,
              "serverSide": true,
              "ajax": {
            url: "list_of_location",
            type: "post",
            data: {'_token': $('input[name="_token"]').val()},
            dataSrc: "record_details",
              },

              "dataType": 'json',
        "columnDefs":
                [
                    {className: "table-text", "targets": "_all"},
                    {
                        "targets": 0,
                        "data": "id",
                        "defaultContent": "",
                        "searchable": false,
                        "sortable": false,
                    },
                    {
                        "targets": 1,
                        "data": "location_name",
                        
                    },

                    {
                        "targets": -1,
                            "data": 'action',
                            "searchable": false,
                            "sortable": false,
                            "render": function (data, type, full, meta) {
                                var str_btns = "";
                                
                                str_btns+='<button type="submit" data-toggle="tooltip"  style="margin-left: 1px" class="btn btn-warning btn-sm Small edit_data" id="' +data.e+ '" title="Edit"><i class="fa fa-edit"></i> </button> &nbsp;';
                                 str_btns+= '<button type="submit" data-toggle="tooltip" style="margin-left: 1px" class="btn btn-danger btn-sm Small delete-button" id="' + data.d + '" title="Delete"><i class="fa fa-trash"></i> </button';

                                return str_btns;
                            }
                    }

                   

                  
                   
                   
                  

                    ],
                    "order": [[1, 'asc']]
            });

}



// $('.edit_data').click(function)

var table = $('#tbl_of_location').DataTable();
    table.on('draw.dt', function (){
        $('.edit_data').click(function (){
            // alert("hi");
            var location_code = this.id;
            // echo registration_id;
            // alert(registration_id);
            // console.log(location_code);

            var datas = {'location_code': location_code, '_token': $('input[name="_token"]').val()};
                redirectPost('{{url("location_edit")}}', datas);

        });
    });

  
 </script>                
  
@stop