<?php

namespace Modules\Applications\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Input;
use VolcatorLanguage;
use Route;
use Schema;
use Session;
use Twedoo\Volcator\Core\VolcatorApplication;
use Twedoo\Volcator\Core\VolcatorSpace;
use Twedoo\Volcator\Modules\Applications\Models\Applications;
use Validator;
use DB;
use Storage;
use App;
use Twedoo\VolcatorGuard\Models\User;

// TODO : Pagination
class Spaces extends Controller
{
    /**
     * @param $space
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchSpace($space)
    {
        VolcatorSpace::setCurrentSpace($space);
        VolcatorApplication::setCurrentApplication(VolcatorApplication::getCurrentApplication()->id);
        return Redirect::back();
    }

    /**
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $id = null)
    {
        $errors = null;
        $status = 201;
        $name = $request->get('name');
        $image = $request->file('image');

        $validation = [
            'name' => strlen($name) >= 3,
            'image' => $request->hasFile('image'),
            'extension' => $request->hasFile('image') ? in_array($image->guessExtension(), ['jpg', 'jpeg', 'png', 'svg']) : true,
        ];

        foreach ($validation as $key => $validate) {
            if (!$validate) {
                $errors[$key.'-space'] = [
                    'error' => trans('Applications::Space/space.error_'.$key)
                ];
            }
        }

        if (!$errors) {
            $generateFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '-' .time();
            $storageFileName = $generateFileName.'.'.$image->guessExtension();
            if ($image->storeAs(storage_path().'/'.'app/public/file', $storageFileName)) {
                VolcatorSpace::createSpace($name, $storageFileName);
            } else {
                $errors['image-space'] = [
                    'error' => trans('Applications::Space/space.error_image')
                ];
            }
        } else {
            $status = 400;
        }

        return response()->json($errors, $status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
    }

    public function createType()
    {
    }
}
