<?php

    namespace App\Models;

    use App\Libraries\Database;

 /**
 *
 */
class Route extends Database
{

    public function GetAllRoutes()
    {
      $this->Query("SELECT * FROM routes ORDER BY controller");
      return $this->ReadAll();
    }

    public function AddRoute($type, $link, $regex, $controller, $method, $access)
    {

    }

    public function GetRoutesByRequestAndUserType($type, $request)
    {

      $this->Query("
      SELECT
        routes.*
      FROM
        route_access
        INNER JOIN routes ON routes.id = route_access.route_id
      WHERE
        route_access.role_id = :role_id
        AND routes.type = :request
      ");

      $this->Bind(':role_id', $type);
      $this->Bind(':request', $request);

      return $this->ReadAll();

    }

    public function GetRouteByRequestType($type)
    {
        $this->Query("SELECT * FROM routes WHERE type = :type");
        $this->Bind(':type', $type);

        return $this->ReadAll();
    }

    public function InsertRoute($link, $name, $type, $controller, $method, $permissions)
    {
        $this->Query('
            INSERT INTO 
                routes(link, name, type, controller, method)
            VALUES (:link, :name, :type, :controller, :method)
        ');

        $this->Bind(':link', $link);
        $this->Bind(':name', $name);
        $this->Bind(':type', $type);
        $this->Bind(':controller', $controller);
        $this->Bind(':method', $method);

        $result =  $this->Execute();

            if($result)
            {
                $id = $this->LastInsert();

                foreach ($permissions as $permission)
                {
                    $this->InsertPermissions($id, $permission);
                }

            }

        return $result;
    }

    private function InsertPermissions($routeId, $roleId)
    {
            $this->Query("INSERT INTO route_access (route_id, role_id) VALUES (:route_id, :role_id)");
            $this->Bind(':route_id', $routeId);
            $this->Bind(':role_id', $roleId);
            $this->Execute();
    }

    public function DeleteRoute($id)
    {
        $this->Query("DELETE FROM routes WHERE id = :id");
        $this->Bind(':id', $id);
        return $this->Execute();
    }

    public function GetRouteById($id)
    {

        $this->Query("SELECT * FROM route_access WHERE route_id = :id");
        $this->Bind(':id', $id);
        $permissions = $this->ReadAll();

        $this->Query("SELECT * FROM routes WHERE id = :id");
        $this->Bind(':id', $id);
        $route = $this->ReadSingle();

        $route->permissions = [];

        foreach ($permissions as $permission)
        {
            $route->permissions[] = intval($permission->role_id);
        }

        return $route;

    }

    public function UpdateRoute($id, $link, $name, $type, $controller, $method, $permissions)
    {
        $this->Query('
            UPDATE 
                routes
            SET
                link = :link,
                name = :name,
                type = :type,
                controller = :controller,
                method = :method
            WHERE 
                id = :id
        ');

        $this->Bind(':link', $link);
        $this->Bind(':name', $name);
        $this->Bind(':type', $type);
        $this->Bind(':controller', $controller);
        $this->Bind(':method', $method);
        $this->Bind(':id', $id);
        $this->Execute();

        $this->UpdateRouteAccess($id, $permissions);

    }

    public function UpdateRouteAccess($id, $permissions)
    {
        $this->DeleteAllRouteAccess($id);
        foreach ($permissions as $permission)
        {
            $this->InsertPermissions($id, $permission);
        }
    }

    public function DeleteAllRouteAccess($id)
    {
        $this->Query("DELETE FROM route_access WHERE route_id = :route_id");
        $this->Bind(':route_id', $id);
        $this->Execute();
    }






}
