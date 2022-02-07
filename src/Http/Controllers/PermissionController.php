<?php

namespace Twedoo\Stone\Http\Controllers;

use App\Models\Permission;
use Artisan;
use DB;
use Hash;
use Illuminate\Http\Request;
use Schema;
use Session;
use Validation;

class PermissionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {

        // echo app('theme')[0].' /  ';
        // $request = Request();
        // return  'okk';
        // return app('houssem');


        //$schema = DB::getDoctrineSchemaManager();

        //  return  DB::connection()->getDoctrineColumn('permissions','id')->getType()->getName();


        //  Schema::create('usersss', function($table) {
        //       $table->integer("paied");
        //       $table->string("title");
        //       $table->text("description");
        //       $table->timestamps();
        //   });
        //
        //   if(Artisan::call('migrate --refresh'))
        //   {
        //     return 'okk';
        //   }
        //   else {
        //     return 'error';
        //   }
        //


        // $columns = \DB::connection()->getSchemaBuilder()->getColumnListing("permissions");
        //
        // foreach ($columns as $key => $value) {
        //   echo '  '.$value.' ';
        // }
        // return $columns;


        $data = Permission::orderBy('id', 'DESC')->where('id_module', '!=', '')->get();

        return view('elements.super.permissions.index')->with('data', $data->all());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('elements.super.permissions.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required'
        ]);

        $input = $request->all();
        return redirect()->route(app('urlBack') . '.super.permissions.index')
            ->with('success', 'User created successfully');

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = User::find($id);
        return view('elements.super.permission.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $permission = permission::find($id);
        return view('elements.super.permissions.edit', compact('permission'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required'
        ]);

        $input = $request->all();
        $permission_up = Permission::find($id);
        $permission_up->update($input);

        return redirect()->route(app('urlBack') . '.super.permissions.index')
            ->with('success', 'User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Permission::find($id)->delete();
        return redirect()->route(app('urlBack') . '.super.permissions.index')
            ->with('success', 'User deleted successfully');
    }

}
