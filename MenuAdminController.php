<?php
namespace src\controllers;

use \core\Controller;
use \core\Mensagem;
use \src\handlers\UserHandler;
use \src\models\Menu_Admin;
use \src\models\Menu_Admin_Sub;

class MenuAdminController extends Controller {

    private $loggedUser;

    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
        if($this->loggedUser === false) {
            $this->redirect('/admin/login');
        }
    }

    public function index() {
        $MenuAdmin = Menu_Admin::select()->get();
        $Menu_Admin_Sub = Menu_Admin_Sub::select()->get();
        $this->render('MenuAdmin/Lista', [
            'loggedUser' => $this->loggedUser,
            'menu' => $this->menu_admin(),
            'MenuAdmin' => $MenuAdmin,
            'Menu_Admin_Sub' => $Menu_Admin_Sub
        ]);
    }
    public function form($atts = []){
        //Se tiver id vai mostrar form para editar
        if(!empty($atts['id'])) {
            $MenuAdmin = Menu_Admin::select()->where('id', $id)->one();

            if(!$MenuAdmin){
                Mensagem::sucesso('MenuAdmin não encontrado!');
                $this->voltaPagina();
            }

            $titulo = $MenuAdmin['titulo'];
            $id = $atts['id'];

            $this->render('MenuAdmin/Form', [
                'loggedUser' => $loggedUser,
                'titulo' => $titulo,
                'MenuAdmin' => $MenuAdmin
            ]);

        }else{
            //Se não vai abrir FORM de inserir
            $titulo = 'Novo';

            $this->render('MenuAdmin/Form', [
                'loggedUser' => $loggedUser,
                'titulo' => $titulo,
                'MenuAdmin' => $MenuAdmin
            ]);
        }
    }

    public function action($atts = []){
        //Se tem id vai editar
        if(!empty($atts['id'])) {

            $id = $atts['id'];
            $MenuAdmin = Menu_Admin::select()->where('id', $id)->one();

            if(!$MenuAdmin){
                Mensagem::erro('MenuAdmin não encontrado!');
                $this->voltaPagina();
            }

            $dados = [];

            foreach([] as $item){

                $dados[$item] = filter_input(INPUT_POST, $item);

            }

            if(!$dados){
                Mensagem::erro('É necessário enviar todos os dados!');
                $this->voltaPagina();
            }

            $atualiza = User::update();

            foreach($dados as $nome => $valor){

                $atualiza->set($nome, $valor);

            }
            
            $atualiza->where('id', $id)->execute();

            Mensagem::sucesso('MenuAdmin atualizado com sucesso!');
            $this->voltaPagina();

        }else{
            //Se não vai inserir

            $dados = [];

            foreach([] as $item){

                $dados[$item] = filter_input(INPUT_POST, $item);

            }

            if(!$dados){
                Mensagem::erro('É necessário enviar todos os dados!');
                $this->voltaPagina();
            }

            Menu_Admin::insert([$dados])->execute();

            Mensagem::sucesso('MenuAdmin adicionado com sucesso!');
            $this->voltaPagina();
        }
    }

    public function delete($atts = []){

        if(!empty($atts['id'])) {

            $id = $atts['id'];
            Menu_Admin::delete()->where('id', $id)->execute();
            Mensagem::sucesso('Deletado com sucesso!');
            $this->voltaPagina();

        }else{

            Mensagem::sucesso('Erro ao excluir!');
            $this->voltaPagina();
            
        }

    }

}


