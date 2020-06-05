<?php


namespace App\Models;


use app\libraries\Database;

class Navigation extends Database
{

    public function GetAllNavigations()
    {
        $this->Query("SELECT * FROM nav_options");
        return $this->ReadAll();
    }

    public function GetNavigationsByRoleId($roleId)
    {
        $this->query('
            SELECT
                nav_options.*,
                nav_locations.name as location

            FROM
                 nav_access
            INNER JOIN
                 nav_options
                ON nav_options.id = nav_access.nav_option_id
            INNER JOIN
                 nav_option_locations
                ON nav_option_locations.nav_option_id = nav_options.id
            INNER JOIN
                 nav_locations
                On nav_locations.id = nav_option_locations.nav_location_id
            WHERE
                nav_access.role_id = :role_id
        ');

        $this->bind(':role_id', $roleId);

//        var_dump($this->readAll());
//        die();
        return $this->readAll();
    }

    public function GetAllLocations()
    {
        $this->Query("SELECT * FROM nav_locations");
        return $this->ReadAll();
    }

    public function InsertNavigation($link, $name, $icon, $location, $permissions)
    {
        $this->query('
            INSERT INTO
                nav_options (link, name, icon)
                VALUES  (:link, :name, :icon)

        ');

        $id = $this->LastInsert();

        foreach ($permissions as $permission)
            $this->InsertPermission($id, $permission);


        $this->InsertLocation($id, $location);
    }

    public function InsertPermission($id, $permission)
    {

    }

    public function InsertLocation()
    {

    }

    public function GetLocationById($id)
    {
        $this->query("SELECT * FROM nav_locations WHERE id = :id");
        $this->bind(':id', $id);
        return $this->readSingle();
    }


}
