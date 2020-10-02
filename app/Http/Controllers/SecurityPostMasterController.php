<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_security_posts;
use App\tbl_designation;

class SecurityPostMasterController extends Controller
{
    //
    public function security_post_master()
    {
        # code...
        return view('security_post_master');
    }

    public function add_security_post()
    {
        # code...
        return view('security_post_entry');
    }

    public function security_post_save(Request $request)
    {

    //    dd($request->all());
        # code...
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in form submit.');
            return response()->json($response, $statusCode);
        }




        $this->validate($request,[
            'security_post_name'=>"required",
            'location_name'=>"required",
            'designation_name'=>"required",
           

               ],[
            'security_post_name.required' => 'Security Post Name is Required',
            'location_name.required' => 'Location Name is Required',
            'designation_name.required' => 'Designation Name is Required',
           
           ]);
        //    echo $request->security_post_name;
        //    die();


        
        //    $securityPostForm=new Registration();

        //    $securityPostForm->post_name=$request->security_post_name;

        //    $securityPostForm->save();

        
        try{
             $securityPostForm=new tbl_security_posts();
            

             $securityPostForm->post_name=$request->security_post_name;
             $securityPostForm->location_code=$request->location_name;
             $securityPostForm->designation=$request->designation_name;
           
    
            //    $securityPostForm->save();

               if( $securityPostForm->save()){
                    $response = array(
                        'status' => 1,
                    );
               }
             }
             catch(\Exception $e){
                $response = array(
                    'exception' => true,
                    'exception_message' => $e->getMessage(),
                );
                $statuscode=400;
             } 
             finally{
               return response()->json($response, $statusCode);
            }
    }

    public function get_all_designation(Request $request)
    {
        # code...
        $statusCode = 200;
        if (!$request->ajax()) {

          $statusCode = 400;
          $response = array('error' => 'Error occered in Json call.');
          return response()->json($response, $statusCode);
        }
        try {

          $designation = tbl_designation::pluck('designation', 'code');

          $response = array(
            'options' => $designation, 'status' => 1
          );
        }
        catch (\Exception $e) {
          $response = array(
            'exception' => true,
            'exception_message' => $e->getMessage(),
          );
          $statusCode = 400;
        } finally {
          return response()->json($response, $statusCode);
        }

    }

    public function list_of_security_post(Request $request)
    {
        # code...
        
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in form submit.');
            return response()->json($response, $statusCode);
        }
       
        try{
            $draw = $request->draw;
            $offset = $request->start;
            // dd($offset);
            $length = $request->length;
            //  dd($length);
            $search = $request->search ["value"];
            // dd($search);
            $order = $request->order;
            // dd($order);
            $data = array();
            // dd($data);
            $allSecurityPost =  tbl_security_posts::select('code','post_name', 'designation' )
                    ->where(function($q) use ($search) {
                        $q->orwhere('post_name', 'like', '%' . $search . '%');
                        // $q->orwhere('designation', 'like', '%' . $search . '%');
                       
            });
            // dd( tbl_security_posts::select('code','post_name', 'designation' ));



            $record = $allSecurityPost;
            
            for ($i = 0; $i < count($order); $i ++) {
            $record = $record->orderBy($request->columns [$order [$i] ['column']] ['data'], strtoupper($order [$i] ['dir']));
              }

            $filtered_count = $allSecurityPost->count();
            // dd($filtered_count);
            $page_displayed = $record->offset($offset)->limit($length)->get();

            //   dump($page_displayed);


            $count = $offset + 1;
            foreach ($page_displayed as $singledata) {
                $nestedData['id'] = $count;
                $nestedData['post_name'] = $singledata->post_name;
               
                 $arrStr = explode(",", $singledata->designation);
               
                // dd($arrStr);
                // print_r($arrStr);
                $edit_button = $delete_button =  $singledata->code;
                $nestedData['edit'] = $edit_button;

                $nestedData['delete'] = $delete_button;
                // $nestedData['action'] = array('e' => $edit_button, 'd' => $delete_button);


                $dsgtion_nm = tbl_designation::whereIn('code', $arrStr)->select('designation')->get();
                // echo "<pre>";
                // print_r($dsgtion_nm);
                // // dd($dsgtion_nm);
                // echo "<pre>";
              
                // echo "<pre>";
                // print_r($imp_dsgtion_nm);
                 // echo "<pre>";
                 $arr = [];
                 $tbl_designation = "<table style='width: 100%' class='table table-hover table-bordered table-striped'>";
                 foreach ($dsgtion_nm as $val) {
                     # code...
                    
                    //  array_push($arr, $val->designation);
                    $tbl_designation .= "<tr style='text-align:center;'>";
                    $tbl_designation .= "<td style='padding: 3px'>";
                    $tbl_designation .= $val->designation;
                    $tbl_designation .= "<br>";
                    $tbl_designation .= "</td>";
                    $tbl_designation .= "</tr>";


                 }
                 $tbl_designation .= "</table>";
                //  $imp_dsgtion_nm = implode(" ",  $arr);

                $nestedData['designation'] = $tbl_designation;
                unset($arr);
                $count++;
                $data[] = $nestedData;
            }
            $response = array(
                "draw" => $draw,
                "recordsTotal" => $filtered_count,
                "recordsFiltered" => $filtered_count,
                'record_details' => $data
            );
            }
            catch (\Exception $e) {
                $response = array(
                    'exception' => true,
                    'exception_message' => $e->getMessage(),
                );
                $statusCode = 400;
            }
            
            finally {
                return response()->json($response, $statusCode);
            }
    }

    public function security_post_edit(Request $request)
    {
        # code...
        // dd($request->all());
        $this->validate($request, [
        'security_post_code' => 'required|integer',
            ], [        
        'security_post_code.required' => 'Security Post is required',
        'security_post_code.integer' => 'Security Post Code Accepted Only Integer',
    ]); 

    try{
        
        $security_post_code = $request->security_post_code;
        
        if($security_post_code!=0){
            
          $edit_data=tbl_security_posts::where('code','=',$security_post_code)->select('post_name', 'location_code', 'designation')->first();  
       
        }

//print_r($new_arr);die;
// print_r($edit_data);
       
       } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {

           return  view('security_post_entry')->with('security_post_data', $edit_data);
        //    ->with('new_arr',$new_arr);
        //    ->with('security_post_data',$edit_data);
        } 
    }

}
