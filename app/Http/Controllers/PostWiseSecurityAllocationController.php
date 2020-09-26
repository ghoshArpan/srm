<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\tbl_security_posts;
use App\tbl_duty_shift;

class PostWiseSecurityAllocationController extends Controller
{
    public function Standerd_post_wise_security_allocation(){

        return view('standard_post_wise_security_allocation');

    }

    public function get_all_location(Request $request){

          $statusCode = 200;
          if (!$request->ajax()) {

            $statusCode = 400;
            $response = array('error' => 'Error occered in Json call.');
            return response()->json($response, $statusCode);
          }
          try {

            $locations = Location::pluck('location_name', 'code');

            $response = array(
              'options' => $locations, 'status' => 1
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

     public function get_all_post(Request $request){

          $statusCode = 200;
          if (!$request->ajax()) {

            $statusCode = 400;
            $response = array('error' => 'Error occered in Json call.');
            return response()->json($response, $statusCode);
          }
          try {

            $location=$request->location;

            $posts = tbl_security_posts::where('location_code', $location)->pluck('post_name', 'code');

            $response = array(
              'options' => $posts, 'status' => 1
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


     public function get_all_shift(Request $request){

          $statusCode = 200;
          if (!$request->ajax()) {

            $statusCode = 400;
            $response = array('error' => 'Error occered in Json call.');
            return response()->json($response, $statusCode);
          }
          try {

            $location=$request->location;

            $shifts = tbl_duty_shift::pluck('shift', 'code');

            $response = array(
              'options' => $shifts, 'status' => 1
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

    public function search_post_wise_security(Request $request){


          $statusCode = 200;
          if (!$request->ajax()) {

            $statusCode = 400;
            $response = array('error' => 'Error occered in Json call.');
            return response()->json($response, $statusCode);
          }
          try {

            $location=$request->location;
            $post=$request->post;
            $shift=$request->shift;
           
            $result=tbl_security_posts::

            $response = array(
              'options' => $shifts, 'status' => 1
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


}
