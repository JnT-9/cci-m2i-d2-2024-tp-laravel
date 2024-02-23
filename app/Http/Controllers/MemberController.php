<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Controller\ControllerResolver as Controller;

include_once 'vendor/autoload.php';

class MemberController extends  Controller {

    function index() {
        $new = (new MemberController);
        echo $new->rendu('member.index');
    }

    function create() {
        $new = (new MemberController);
        echo $new->rendu('member.create');
        }

    function store() {
        DB::table('users')->insert(
            ['name' => $_POST['name'], 'email' => $_POST['email'], 'password' => $_POST['password']]
        );
        }

    function show() {
    $id = $_GET['id'];
    $member = DB::table('users')->whereRaw('id = '.$id)->get();
    $this->rendu($member->first());
    }

    function destroy() {
            $id = $_GET['id'];
            $r = DB::table('users')->whereRaw('id = '.$id)->delete($id);
            if ($r) {
                $this->index();
            } else {
                echo 'Erreur';
            }

        }

    function rendu($vueName = '') {
        echo view('member.'.$vueName);
        }

    function test($var) {
        // var_dump(
        // $var);
    }
}


