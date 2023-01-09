<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

use Illuminate\Support\Facades\Hash;


class UserController extends Controller{
    
    public function index(){

    	return view('loggin');
    }

    public function authenticate($pass){
        Auth::logoutOtherDevices($pass);

    }

  

    public function login(Request $request){


        $this->validate($request,[
            'username' => 'required',
            'password' => 'required'
        ],[
            'username.required' => 'Username é obrigatorio!',
            'password.required' => 'Senha é obrigatoria!',
        ]);

        $user = ($request->username);
        $pass  = $request->password;

        //dd($user);
        //dd($pass);

        
        if (auth()->attempt(array('name' => $user, 'password' => $pass))){
            //$this->authenticate($pass);
            
            //dd('logou');
            $teste = 1;
                 $radius = radius_auth_open();
                 if (!radius_add_server($radius,)) {
                     die('Radius Error: ' . radius_strerror($radius));
                 }
                 if (!radius_create_request($radius, RADIUS_ACCESS_REQUEST)) {
                     die('Radius Error: ' . radius_strerror($radius));
                 }
                 radius_put_attr($radius, RADIUS_USER_NAME, $user);
                 radius_put_attr($radius, RADIUS_USER_PASSWORD, $pass);
                 radius_put_attr($radius, RADIUS_NAS_IDENTIFIER, "172.17.67.41");
                 $response = radius_send_request($radius);

                 Auth::logoutOtherDevices($pass);
                 
                 if ($response == RADIUS_ACCESS_ACCEPT) {

                     $teste = 2;
                     //echo "Sucesso";
                        
                        
                     if ($teste == 2) {
                        //Auth::logoutOtherDevices($pass);

                        return redirect('/consulta');                             
                     }
                 } else {
                     if ($response == RADIUS_ACCESS_CHALLENGE) {

                         //echo "Falha";
                        if ($teste == 1) {
                            return redirect()->back()->with('danger', 'Username ou senha invalidos');                          
                        }
                        
                     }


                 }

                //echo "Falha";
                //dd('aqui');
                if ($teste == 1) {
                    return redirect()->back()->with('danger', 'Username ou senha invalidos');                          
                }

        }
        else{  
             
             return redirect()->back()->with('danger', 'Username ou senha invalidos');
        }

    }

    public function check_login(){
        if (Auth::check()){
    
        }

    }

    public function logout(){
        Auth::logout();
        return redirect('/login');

    }


}
