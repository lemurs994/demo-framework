<?php


namespace App\Controllers;


use App\Helpers\Redirect;
use App\Helpers\Regex;
use App\Helpers\Sanitize;
use App\Helpers\Validate;
use App\Libraries\Controller;

class Routes extends Controller
{

    private $errors = [];
    private $permissions = [];

    public function __construct()
    {
        $this->model('route');
    }


    public function  ViewAllRoutes()
    {

        $data = [
            'routes' => $this->route->GetAllRoutes()
        ];

        $this->view('dashboard/index', $data, ['routes/ViewAllRoutes']);
    }

    public function ViewAddForm($errors = [], $post = [])
    {
        $data = [
            'errors' => $errors,
            'post' => $post
        ];

        $this->view('dashboard/index', $data, ['routes/AddRouteForm']);
    }

    public function EditFormView($id, $errors = [])
    {
                        $data = [
                            'errors' => $errors,
                            'route' => $this->route->GetRouteById($id)
                        ];

        $this->view('dashboard/index', $data, ['routes/EditRouteForm']);
    }


    public function ProcessAddForm()
    {
                if($this->ValidateNewRoute($_POST))
                {
                    $this->SubmitFormData($_POST);
                    Redirect::To('/routes');
                } else {
                    $this->ViewAddForm($this->errors, $_POST);
                }

    }

    public function ValidateNewRoute($post)
    {

        $this->CheckForEmpty($post);

        if(empty($this->errors))
            $this->CheckIfValidLink($post['link']);

        if(empty($this->errors))
            $this->CheckIfLinkExists($post['link']);
        if(empty($this->errors))
            $this->CheckFormPermissionArray($post['permissions']);


        return empty($this->errors) ? true : false;

    }

    public function CheckForEmpty($post)
    {
        foreach ($post as $key => $value)
        {

            if(empty($value))
            {
                $this->errors[$key] = 'value cannot be empty';
            }
        }

        if (!isset($post['permissions']))
                $this->errors['permissions'] = "Please check permissions";
    }

    public  function CheckIfLinkExists($url)
    {
        $url = Regex::PrepareUrl($url);
        $routes = $this->route->GetRouteByRequestType($_POST['type']);

        foreach ($routes as $route)
        {

            if(preg_match($url, $route->link))
            {
                $this->errors['link'] = 'link for this request type already exists';
            }

        }
    }

    public  function CheckIfValidLink($link)
    {
        if(!Validate::Link($link))
        {
            $this->errors['link'] = 'link is not valid';
        }
    }

    public function CheckFormPermissionArray($array)
    {
        foreach ($array as $el)
        {
            $this->permissions[] = intval($el);
        }

        if(in_array(1, $this->permissions))
            $this->permissions = [1,2,3,4,5];

        if(!in_array(2, $this->permissions))
            $this->permissions[] = 2;


    }

    public function SubmitFormData($post, $formType = 'add', $id = 0)
    {
        $link = Sanitize::string($_POST['link']);
        $name = Sanitize::string($_POST['name']);
        $type = Sanitize::string($_POST['type']);
        $controller = Sanitize::string($_POST['controller']);
        $method = Sanitize::string($_POST['method']);

        if($formType =='add'):
            $this->route->InsertRoute($link, $name, $type, $controller, $method, $this->permissions);
        else:
            $this->route->UpdateRoute($id, $link, $name, $type, $controller, $method, $this->permissions);
            endif;
    }

    public function DeleteRoute($id)
    {
        $this->route->DeleteRoute($id);
        Redirect::To('/routes');
    }

    public function ProcessEditForm($id)
    {
        if($this->ValidOldRoute($id, $_POST))
        {
            $this->SubmitFormData($_POST, 'edit', $id);
            Redirect::To('/routes');
        }
        else
        {
            $this->EditFormView($id, $this->errors);
        }
    }

    public  function ValidOldRoute($id, $post)
    {
        $this->CheckForEmpty($post);

        if(empty($this->errors))
            $this->CheckIfValidLink($post['link']);


        if(empty($this->errors))
            $this->CheckIfNoNewLinkConflicts($id, $post['link']);


        if(empty($this->errors))
            $this->CheckFormPermissionArray($post['permissions']);

            return empty($this->errors) ? true : false;

    }

    public function CheckIfNoNewLinkConflicts($id, $link)
    {
        $url = Regex::PrepareUrl($link);
        $routes = $this->route->GetRouteByRequestType($_POST['type']);

        foreach ($routes as $route)
        {
            if($route->id != $id)
            {
                if(preg_match($url, $route->link))
                {
                    $this->errors['link'] = 'Edited link for this request type already exists';
                }
            }

        }
    }


}