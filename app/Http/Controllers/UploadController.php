<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logo;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function fileUpload(Request $request)
    {

        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $prefix = (Auth::user()->isAdmin()) ? 'admin' : Auth::user()->id;
        $image = $request->file('image');
        $input['imagename'] = $prefix.'_'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/logos');
        $image->move($destinationPath, $input['imagename']);

        $logo = array();
        $logo['logo_name'] = $input['imagename'];
        $logo['logo_type'] = $request['logoType'];
        $logo['base_price'] = 150.00;
//        $this->postImage->add($input);
        Logo::create($logo);

        return back()->with('success','Logo Upload successful');
    }

}