<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\MovimientosModel;
use App\Models\VentasModel;
use App\Models\IngresosModel;
use App\Models\UsuariosModel;
use CodeIgniter\Shield\Entities\User;


class Usuarios extends BaseController
{
    function index() //verInventario
    {
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Inventario";
        $datos['menu_activo'] = "dashboard";
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
?>
        <pre>
        <?php
        // echo 'suma total';
        // print_r($datos['productos']);
        // echo '<hr>';
        ?>
        </pre>
<?php
        echo view('dashboard/ver_inventario');
        echo view('dashboard/templates/footer');
    }
    function verUsuarios()
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $usuario_model = new UsuariosModel();
        $usuarios = $usuario_model->select('users.id, nombres, apellido_paterno, apellido_materno, group, telefono, telefono_emergencia')->join('users', 'users.id = users_information.user_id')->join('auth_groups_users', 'users.id = auth_groups_users.user_id')->findAll();
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Ver Usuarios";
        $datos['menu_activo'] = "verusuarios";
        $datos['usuarios'] =  $usuarios;
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        //print_r($usuarios);
        echo view('dashboard/lista_usuarios');
        echo 'Ver Usuarios';
        echo view('dashboard/templates/footer');
    }
    function nuevoUsuario()
    {
        helper('form');
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }

        $usuario_model = new UsuariosModel();



        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Nombre de Usuario" es requerido',
                    ]
                ],
                'email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Correo Electrónico" es requerido',
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Contraseña" es requerido',
                    ]
                ],
                'nombres' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Nombres" es requerido',
                    ]
                ],
                'apellido_paterno' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Apellido Paterno" es requerido',
                    ]
                ],
                'apellido_materno' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Apellido Materno" es requerido',
                    ]
                ],
                'documento_ci' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Documento CI" es requerido',
                    ]
                ],
                'telefono' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Teléfono" es requerido',
                    ]
                ],
                'telefono_emergencia' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Teléfono de Emergencia" es requerido',
                    ]
                ],
                'contacto_emergencia' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Contacto de Emergencia" es requerido',
                    ]
                ],
                'direccion' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Dirección" es requerido',
                    ]
                ],
                'user_id' => [],
            ];

            $data = $this->request->getPost(array_keys($rules));
            if ($this->validateData($data, $rules)) {
                $validData = $this->validator->getValidated();
                // Users record
                $users = auth()->getProvider();
                $user = new User([
                    'username' => $validData['username'],
                    'email'    => $validData['email'],
                    'password' => $validData['password'],
                ]);

                // Save the new user information
                $users->save($user);
                $ultimo_id = $users->getInsertID();
                // To get the complete user object with ID, we need to get from the database
                $user = $users->findById($ultimo_id);
                // Add to default group
                $users->addToDefaultGroup($user);
                $validData['user_id'] = $ultimo_id;
                $usuario_model->insert($validData);
                //$modelo_movimientos->insert($dato_movimiento);
                return redirect()->to('/dashboard/verusuarios');
            }
            // return redirect()->to('/dashboard/new_link')->withInput();
            //return redirect()->back()->withInput();
        }



        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Nuevo Usuario";
        $datos['menu_activo'] = "nuevousuario";
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/nuevo_usuario');
        echo 'Ver Usuarios';
        echo view('dashboard/templates/footer');
    }
}
