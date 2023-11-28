<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller {
	public function __construct(){
        parent::__construct();
        $this->call->model('product_model');
        
    }

    public function showProduct(){
      if($this->form_validation->submitted()){
            $this->form_validation
            ->name('name')
           
            ->name('product')
            
            ->name('quantity')
        
            ->name('address')
            ->name('total')
            ->name('phone')
            
            ->name('message')
            ;
                  if ($this->form_validation->run())
                  {
                    $products=$this->io->post('product');
                    $quantity=$this->io->post('quantity');
                    
                    foreach ($products as $index => $product_id) {
                      // Check if the index exists in the $quantity object
                      if (isset($quantity[$product_id])) {
                          $quantities = $quantity[$product_id];
                          $this->product_model->insert(
                              $this->io->post('name'),
                              $product_id,
                              $quantities,
                              $this->io->post('total'),
                              $this->io->post('address'),
                              $this->io->post('phone'),
                              $this->io->post('message')
                          );
                      } else {
                          // Handle the case where $product_id is not found in $quantity
                          // You may want to log an error, show a message, or handle it in a way that makes sense for your application.
                      }
                  }
              
                    
                    
                    redirect('user-add-order');
                  }
                  else{
                    $data['error_message'] = 'something went wrong'; 
                      redirect('/user-add-order');
                  }
                
         }
        $data=$this->product_model->show();
        $this->call->view('user_addorder',$data);

    }


    public function showOrder(){
      $data=$this->product_model->showOrder();
      $this->call->view('adminAllorder',$data);
    }
    public function updateStatus($id){
      if ($this->product_model->updateStatus($id)) {
        $this->product_model->updateStatus($this->io->post('status'));
      }
    }


}
?>
