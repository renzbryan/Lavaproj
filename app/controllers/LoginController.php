<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class LoginController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->call->library('Lauth');
        $this->call->model('email');
        $this->call->library('session');
        $this->call->library('form_validation');
        $this->call->library('upload');
    }
    public function login(){
        if ($this->form_validation->submitted()) {
            $this->form_validation
            ->name('username')
                ->required()
            ->name('email')
                ->required()
            ->name('password')
                ->required();
            if ($this->form_validation->run()) {    
                if($this->Lauth->is_user_verified($this->io->post('username'))){
                $login=$this->Lauth->login($this->io->post('email'),$this->io->post('password'));
                if ($login) {
                    $this->Lauth->set_logged_in($login);
                    if ($this->Lauth->is_logged_in()) {
                        redirect('/user');
                    }
                    }
  
                }
                else {
                    $data['error_message'] = 'Email is not registered/it does not exist'; 
                    $this->call->view('login',$data);
                }
            }
        }
        $this->call->view('login');
    }

    public function sendEmailVerify($add,$verify_token,$user){
        $mail = new PHPMailer(true);
                    try {
                        //Server settings
                        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'justinepogi2703@gmail.com';                     //SMTP username
                        $mail->Password   = 'qerd fzmt waeh bave';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                        $mail->setFrom('justinepogi2703@gmail.com','Administrator');
                        $mail->addAddress($add);    
                        //Content
                        $mail->isHTML(true);                                 //Set email format to HTML
                        $mail->Subject = "Hello, $user Email Verfication for Activity of Justine Maderazo";
                        $mail->Body    = "
                        <h2>You have registered on the website</h2>
                        <h5>Verify your email address to login with the given link below</h5>
                        <br/><br/>
                        <a href='http://localhost/LAVAACT/verify-email?token=$verify_token'>Verify Now</a>
                        ";
                        $mail->send();

                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
    }

    public function verifyEmail(){
        if ($this->Lauth->verify_now($_GET['token'])) {
           echo 'user is successfully verified';
        }
        else {
            echo'Token does not exist';
            redirect('/register');
        }
    }

	public function register() {
		if ($this->form_validation->submitted()) {
            $this->form_validation
            ->name('name')
                ->required()
            ->name('email')
                ->required()
            ->name('password')
                ->required();
                $token=md5(rand());
            if ($this->form_validation->run()) {                
                $this->Lauth->register($this->io->post('name'),$this->io->post('email'),$this->io->post('password'),$token);
                $this->sendEmailVerify($this->io->post('email'),$token,$this->io->post('name'));
                
                    redirect('/register');
                    echo 'Email Registration Success';
                }
        }
        $this->call->view('register');
	}
}
?>
