<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purpose;
use Illuminate\Support\Facades\Storage;

class EditController extends Controller
{
    private $purposes;
    
    public function __construct()
    {
        $this->purposes = Purpose::all();
    }

    public function addPurpose(Request $request) {
        $validated = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'imageReference' => ['required', 'image']
        ]);

        if (!$validated) {
            return view('welcome', [
                'purposes' => $this->purposes, 
                'errors' => 'Required fields for adding new FAQ are empty.'
            ]);
        }

        //$image = $request->input('imageReference');
        //echo $path = Storage::putFile('Images', $request->input('imageReference'));
        //$imagePath = public_path() ."/Images/". $image;
        //Storage::disk('public_uploads')->put($imagePath, $file_content);


        $image = $request->file('imageReference');
        
        $input = time().'.'.$image->getClientOriginalExtension();
        $imagePath = 'Images';    
        $image->move($imagePath, $input);
        $imagePath .= '/' . $input;
    


        Purpose::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'imageReference' => $imagePath
        ]);

        session()->flash('messageAdd', 'Purpose Added Succesfully!'); 

        return redirect()->back();
    }

    public function deletePurpose($id) {
        Purpose::destroy($id);

        session()->flash('messageDelete', 'Purpose Removed Successfully!'); 

        return redirect()->back();
    }
}
