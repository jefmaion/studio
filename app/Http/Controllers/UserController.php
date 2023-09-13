<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ZipcodeTrait;
use Illuminate\Http\Request;
use Image;

class UserController extends Controller
{


    use ZipcodeTrait;

    public function find($id) {

        $user = User::with('student')->where('phone_wpp', $id)->first();

        if(!$user) {
            return false;
        }

        return $user->toArray();
    }

    public function avatarUpload(User $user, Request $request) {
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //   ]);

          $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            ]);
    
         
            

            // $input = $request->all();
            // $input['image'] = time().'.'.$request->image->extension();
            // $request->image->move(public_path('images'), $input['image']);


            if($user->avatar) {
                if(file_exists(public_path('images' .'/' . $user->avatar))) {
                    unlink(public_path('images' .'/' . $user->avatar));
                }
            }
    
            $avatarName = time().'.'.$request->image->extension();
    
            $image = Image::make($request->image->path())->fit(300);
    
            if(!$image->save(public_path('images') . '/' . $avatarName, 100)) {
                return false;
            }
    
            $user->avatar = $avatarName;
            $user->save();


            // $image = $request->file('image');
            // $input['imagename'] = time().'.'.$image->extension();
        
            // $destinationPath = public_path('/images');
            
            // $img = Image::make($image->path())->fit(600);

            
            // $img->resize(35, 35, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save($destinationPath.'/'.$input['imagename']);


            // $img->fit(35, 35)->save($destinationPath.'/'.$input['imagename']);
    


            // $destinationPath = public_path('/images');
            // $image->move($destinationPath, $input['imagename']);
        
            //     $user->fill(['avatar' => $input['imagename']])->save();
        
            
         
    
    
            return redirect()->back()->with('success','Foto alterada com sucesso!');
    
    
    }
}
