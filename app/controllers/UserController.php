<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UserController extends Controller {
    public function home() {
        $this->load->model('ProdModel');
        $data['products'] = $this->ProdModel->getInfo(); // Assuming your model method is named getInfo

        $this->load->view('user_home', $data);
    }
}


?>