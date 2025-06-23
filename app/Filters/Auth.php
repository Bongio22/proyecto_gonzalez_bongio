<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
class Auth implements FilterInterface{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/iniciarSesion')-> with('msg', [
                'type'=>'warning',
                'body'=>'Inicie sesión para continuar'
            ]);
        }

        if(session()->get('idRol') != 1){
            return redirect()->to('/iniciarSesion')->with('msg', [
                'type'=>'warning',
                'body'=>'Inicie sesión como ADMIN para acceder'
            ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    
    }
}