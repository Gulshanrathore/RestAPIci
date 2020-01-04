<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Example extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user');

    }


    public function user_get($id = 0) {
        $users = $this->user->getRows($id);
        if (!empty($users)) {
            $this->response($users, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
                    ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function data_get($id = 0) {
        $users = $this->user->getRows($id);
        if (!empty($users)) {
            $this->response($users, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
                    ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function user_post() {
        $userData = array();
        $userData['first_name'] = $this->post('first_name');
        $userData['last_name'] = $this->post('last_name');
        $userData['email'] = $this->post('email');
        $userData['phone'] = $this->post('phone');
        if (!empty($userData['first_name']) && !empty($userData['last_name']) && !empty($userData['email']) && !empty($userData['phone'])) {
            $insert = $this->user->insert($userData);
            if ($insert) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'User has been added successfully.'
                        ], REST_Controller::HTTP_OK);
            } else {
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function user_put() {
        $userData = array();
        $id = $this->put('id');
        $userData['first_name'] = $this->put('first_name');
        $userData['last_name'] = $this->put('last_name');
        $userData['email'] = $this->put('email');
        $userData['phone'] = $this->put('phone');
        if (!empty($id) && !empty($userData['first_name']) && !empty($userData['last_name']) && !empty($userData['email']) && !empty($userData['phone'])) {
            //update user data
            $update = $this->user->update($userData, $id);

            //check if the user data updated
            if ($update) {
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'User has been updated successfully.'
                        ], REST_Controller::HTTP_OK);
            } else {
                //set the response and exit
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            //set the response and exit
            $this->response("Provide complete user information to update.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function user_delete($id) {
        if ($id) {
            //delete post
            $delete = $this->user->delete($id);

            if ($delete) {
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'User has been removed successfully.'
                        ], REST_Controller::HTTP_OK);
            } else {
                //set the response and exit
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            //set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
                    ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

}

?>