<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Apiemployeecontroller extends RestController{
     private $valid_api_key;
    public function  __construct() {
        parent::__construct();
        $this->load->model('EmployeeModel');
          $this->valid_api_key = 'venky143';
    }
 
    public function index_get(){
        // echo"i am a employee api ";
        $employee= new EmployeeModel;
        $result_emp= $employee->get_Emplyee();
        $this->response($result_emp,200);
    }



    public function storeEmployee_post() {
       
        $employee= new EmployeeModel;

       
        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'mobile_no' => $this->input->post('mobile_no'),
            'email' => $this->input->post('email'),
        ];
        $result = $employee->insertemployee($data);
        if($result > 0){
            $this->response([
                'status'=>true,
                'message'=>'NEW EMPLOYEE CREATED SUCCESSFULLY'
            ],RestController::HTTP_OK);
        } else{
             $this->response([
                'status'=>false,
                'message'=>' FAILED TO  CREATE NEW EMPLOYEE SUCCESSFULLY'
            ],RestController::HTTP_BAD_REQUEST);
        }       
    }
    public function findEmployee_get($id)
    {
        $employee= new EmployeeModel;
        $result =  $employee->editEmployee($id);
        if ($result === false || $result === null) {
         $this->response([
        'status' => false,
        'message' => 'NO EMPLOYEE FOUND WITH THIS ID'
         ], 404); 
     } else {
         $this->response($result, 200);
        }
   
    }
    public function updateEmployee_put($id)
    {
        $employee= new EmployeeModel;

       
        $data = [
            'first_name' => $this->put('first_name'),
            'last_name' => $this->put('last_name'),
            'mobile_no' => $this->put('mobile_no'),
            'email' => $this->put('email'),
        ];
        $update_result = $employee->update_Employee($id,$data);
        if($update_result > 0){
            $this->response([
                'status'=>true,
                'message'=>' EMPLOYEE UPDATED SUCCESSFULLY'
            ],RestController::HTTP_OK);
        } else{
             $this->response([
                'status'=>false,
                'message'=>' FAILED TO  UPDATED  EMPLOYEE '
            ],RestController::HTTP_BAD_REQUEST);
        }       
    }
    public function deleteEmployee_delete($id)
    {
        $employee= new EmployeeModel;
        $result_emp = $employee->delete_employee($id);
         if($result_emp > 0){
            $this->response([
                'status'=>true,
                'message'=>' EMPLOYEE DELETE SUCCESSFULLY'
            ],RestController::HTTP_OK);
        } else{
             $this->response([
                'status'=>false,
                'message'=>' FAILED TO  DELETE  EMPLOYEE '
            ],RestController::HTTP_BAD_REQUEST);
        }  
    }

    
    }

?>