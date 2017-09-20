<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Gym;
use App\Help;
use App\Massive;
use App\Route;
use App\Topo;
use App\User;
use Illuminate\Http\Request;

class ToolPagesController extends Controller
{
    //Page de cotation
    public function gradePage(){
        return view('pages.tools.grade');
    }

    //Page des indexes
    public function indexPage(){

        $data = [
            'crags' => Crag::count(),
            'gyms' => Gym::count(),
            'climbers' => User::count(),
            'guideBooks' => Topo::count(),
            'massive' => Massive::count(),
            'routes' => Route::count(),
        ];

        return view('pages.tools.indexes', $data);
    }


    //Page des falaises
    public function cragsPage(Request $request){

        $getOrder = $request->input('order');
        $order = ($getOrder) ? $getOrder : 'label';

        $getDirection = $request->input('direction');
        $direction = ($getDirection) ? $getDirection : 'ASC';

        $crags = Crag::orderBy($order, $direction)->paginate(20);

        $data = [
            'crags' => $crags,
            'order' => $order,
            'direction' => $direction,
            'nb'=> Crag::count()
        ];

        return view('pages.tools.crags', $data);
    }


    //Page des salles
    public function gymsPage(Request $request){

        $getOrder = $request->input('order');
        $order = ($getOrder) ? $getOrder : 'label';

        $getDirection = $request->input('direction');
        $direction = ($getDirection) ? $getDirection : 'ASC';

        $gyms = Gym::orderBy($order, $direction)->paginate(20);

        $data = [
            'gyms' => $gyms,
            'order' => $order,
            'direction' => $direction,
            'nb'=> Gym::count()
        ];

        return view('pages.tools.gyms', $data);
    }


    //Page des grimpeurs
    public function usersPage(Request $request){

        $getOrder = $request->input('order');
        $order = ($getOrder) ? $getOrder : 'name';

        $getDirection = $request->input('direction');
        $direction = ($getDirection) ? $getDirection : 'ASC';

        $users = User::orderBy($order, $direction)->paginate(20);

        $data = [
            'users' => $users,
            'order' => $order,
            'direction' => $direction,
            'nb'=> User::count()
        ];

        return view('pages.tools.users', $data);
    }



    //Page des topos
    public function guidebooksPage(Request $request){

        $getOrder = $request->input('order');
        $order = ($getOrder) ? $getOrder : 'label';

        $getDirection = $request->input('direction');
        $direction = ($getDirection) ? $getDirection : 'ASC';

        $guidebooks = Topo::orderBy($order, $direction)->paginate(20);

        $data = [
            'guidebooks' => $guidebooks,
            'order' => $order,
            'direction' => $direction,
            'nb'=> Topo::count()
        ];

        return view('pages.tools.guidebooks', $data);
    }


    //Page des groupes
    public function groupsPage(Request $request){

        $getOrder = $request->input('order');
        $order = ($getOrder) ? $getOrder : 'label';

        $getDirection = $request->input('direction');
        $direction = ($getDirection) ? $getDirection : 'ASC';

        $groups = Massive::orderBy($order, $direction)->paginate(20);

        $data = [
            'groups' => $groups,
            'order' => $order,
            'direction' => $direction,
            'nb'=> Massive::count()
        ];

        return view('pages.tools.groups', $data);
    }


    //Page des voies
    public function routesPage(Request $request){

        $getOrder = $request->input('order');
        $order = ($getOrder) ? $getOrder : 'label';

        $getDirection = $request->input('direction');
        $direction = ($getDirection) ? $getDirection : 'ASC';

        $routes = Route::orderBy($order, $direction)->with('crag')->with('routeSections')->paginate(20);

        $data = [
            'routes' => $routes,
            'order' => $order,
            'direction' => $direction,
            'nb'=> Route::count()
        ];

        return view('pages.tools.routes', $data);
    }

}
