<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use App\Http\Requests\LogoFormRequest;

class LogoController extends Controller
{

    public function index()
    {
        Gate::authorize('view-any', Logo::class);

        $logos = $this->getLogoData();

        return view('admin.logo.index', compact('logos'));
    }


    public function createOrUpdate(LogoFormRequest $request)
    {
        Gate::authorize('create', Logo::class);
        
        $logo = Logo::where('id',$request->logo_id)->where('type', $request->logo_type)->first();

        
        if(!is_null($logo) && $logo->image != null){
            unlink(base_path('public/uploads/logo/'.$logo->image));
        }

        $uploaded_img = $request->file('logo_image');
        $new_img_name = 'logo-'.$request->logo_type.'-'.now()->timestamp.'.'.$uploaded_img->getClientOriginalExtension();
        $new_img_location = base_path('public/uploads/logo/'.$new_img_name);

        Image::make($uploaded_img)->save($new_img_location);

        $new_logo = Logo::updateOrCreate(
            ['type' => $request->logo_type],
            ['image' => $new_img_name]
        );

        $data = [
            'id'=>$new_logo->id,
            'image'=>$new_logo->image,
            'type'=>$new_logo->type,
        ];

        return response()->json(['status'=>'success','message'=>'Updated succesfully!','data'=>$data]);
    }


    public function destroy(Logo $logo)
    {
        Gate::authorize('delete', $logo);

        if($logo->image != null){
            unlink(base_path('public/uploads/logo/'.$logo->image));
        };

        $logo->delete();

        return response()->json(['status' => 'success', 'message' => 'Deleted successfully!']);
    }


    protected function getLogoData()
    {
        $logos = [
            'light'=> [
                'id' => null,
                'image' => '',
                'type' => 'light',
            ],
            'dark'=> [
                'id' => null,
                'image' => '',
                'type' => 'dark',
            ],
            'mobile'=> [
                'id' => null,
                'image' => '',
                'type' => 'mobile',
            ],
            'favicon'=> [
                'id' => null,
                'image' => '',
                'type' => 'favicon',
            ],
        ];


        $logo_data = Logo::select('id','image','type')
                        ->get()
                        ->groupBy('type')
                        ->map(function($data){
                            $new_data = [];

                            foreach ($data as $d) {
                                $new_data = [
                                    'id' => $d->id,
                                    'image' => $d->image,
                                    'type' => $d->type,
                                ];
                            }

                            return $new_data;
                        });


        if($logo_data->count() > 0){
            foreach ($logo_data as $key => $logo) {
                if(isset($logos[$key])){
                    $logos[$key] = $logo;
                }
            }
        }


        return $logos;
    }


}
