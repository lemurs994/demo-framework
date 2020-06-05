<?php


namespace App\Controllers;


use App\Helpers\Sanitize;
use App\Helpers\Validate;
use App\Libraries\Controller;

class Navigations extends Controller
{
    private $errors;
    private $permissions;

    public function __construct()
    {
        $this->model('navigation');
    }

    public function ViewAll()
    {
        $data = [
           'navigations' => $this->navigation->GetAllNavigations()
        ];

        $this->view('dashboard/index', $data, ['navigation/view-all']);
    }

    public function AddFormView($errors = [], $post = [])
    {

        $data = [
            'errors' => $errors,
            'post' => $post,
            'locations' => $this->navigation->GetAllLocations()
        ];

        $this->view('dashboard/index', $data, ['navigation/add-form']);

    }

    public function ProcessAddForm()
    {
        $post = Sanitize::Post($_POST);

        if($this->ValidateSubmitForm($post))
        {
            $this->navigation->InsertNavigation($post['link'], $post['name'], $post['icon'], $post['location'] ,$this->permissions);
            // TODO: Needs redirect
            //TODO: INSERT DOES NOT WORK
        }
        else
        {
            $this->AddFormView($this->errors, $post);
        }
    }

    public function ValidateSubmitForm($post)
    {
        $this->CheckIfEmpty($post);

        if(empty($this->errors))
            $this->CheckIfLinkValid($post);

        if(empty($this->errors))
            $this->CheckIfLocationValid($post);

        if(empty($this->errors))
            $this->CheckFormPermissionArray($post['permissions']);

        if(empty($this->errors))
            return true;

        return false;
    }

    public function CheckIfEmpty($post)
    {
        foreach ($post as $name => $value)
        {
            if(empty($post[$name]))
            {
                $this->errors[$name] = 'Field Cannot be empty';
            }
        }

        if(!isset($post['permissions']) || empty($post['permissions']))
            $this->errors['permissions'] = 'Please select atleast one permission';
    }

    public function CheckIfLinkValid($post)
    {
        if (!isset($post['link']) || !Validate::Link($post['link']))
            $this->errors['link'] = 'Please enter a valid link';
    }

    public function CheckIfLocationValid($post)
    {

        if(!isset($post['location']) || !$this->navigation->GetLocationById($post['location']))
            $this->errors['location'] = 'Please Select a valid Loaction';

    }

    public function CheckFormPermissionArray($array)
    {
        $valid = [1,2,3,4,5];

        if(!empty($array))
        foreach ($array as $el)
        {
            $el = intval($el);

            if(in_array($el, $valid))
                $this->permissions[] = $el;
        }

        if(empty($this->permissions))
            $this->errors['permissions'] = "Please select valid permissions";
    }
}
