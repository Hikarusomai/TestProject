<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companies;
use App\Employees;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Http\Requests\StoreCompany;
 
class CompaniesController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Companies::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function(Companies $company){
                        $btn = '<a href="javascript:void(0)" data-id="'.$company->id.'" class="edit btn btn-primary btn-sm" ><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0)" data-id="'.$company->id.'" class="delete btn btn-primary btn-sm" onclick="if (confirm(`Are you sure you want to delete?`)) { deletecompany('.$company->id.'); } "><i class="fas fa-trash"></i></a>'; 
                        return $btn;
                    })
                    ->editColumn('logo_url', function(Companies $company) {
                        $html =  '<img class="table-logo" src="/storage/'.$company->logo_url.'"/>';
                        if(!isset($company->logo_url) || $company->logo_url == '') $html = '';
                        return $html;
                    })
                    ->editColumn('website', function(Companies $company) {
                        $string = '';
                        if(!isset($company->website) || $company->website == '') $string = 'disabled';
                        $html =  '<button class="btn btn-secondary table-website btn-sm" data-url="'.$company->website.'" '.$string.'><i class="fas fa-share-square"></i> Link</button>';
                        return $html;
                    })
                    ->rawColumns(['action','logo_url','website'])
                    ->make(true);
        }
        return view('companies.index');
    } 
    public function create(StoreCompany $request){
        try{
            if ($request->has('logo_url')) {
                $file = $request->file('logo_url');
                //save format
                $format = $request->logo_url->extension();
                //save full adress of image
                $name = $file->getClientOriginalName(); 
                Storage::disk('public')->put($name , file_get_contents($file));

            }
            // //validation
            // $rules = [
            //     'name' => 'required|max:255|unique:companies,name', 
            // ];
            // $messages = [
            //     'name.required' => 'Company Name is required!',
            //     'name.unique' => 'Company Name must be a unique!',
            // ];
            // if(isset($name)){
            //     $rules['logo_url'] = 'max:10000|mimes:png,jpg,jpeg,gif';
            //     $messages['logo_url.max'] = 'Logo size cannot exceeds 10mb!';
            //     $messages['logo_url.mimes'] = 'Invalid file type, The supported types: png, jpg, jpeg, gif.';
            // } 
            // $validated = $request->validate($rules,$messages);
            // $validated =  Validator::make($request->all(), $rules, $messages)->validate();
           
            //data insertion 
            $data = [
                'name' => $request->name,
                'email' => $request->email ?? '',
                'website' => $request->website ?? '', 
            ];
            if(isset($name)) $data['logo_url'] = $name;
            Companies::insert($data);
            return response()->json(['status'=>true,'message'=>'Successfully Created!']);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }
    public function edit(StoreCompany $request){ 
        try{
            if ($request->has('logo_url')) {
                $file = $request->file('logo_url');
                //save format
                $format = $request->logo_url->extension();
                //save full adress of image
                $name = $file->getClientOriginalName(); 
                Storage::disk('public')->put($name , file_get_contents($file));

            }
            //validation
            // $rules = [
            //     'name' => 'required|max:255|unique:companies,name,'.$request->id, 
            // ];
            // $messages = [
            //     'name.required' => 'Company Name is required!',
            //     'name.unique' => 'Company Name must be a unique!',
            // ];
            // if(isset($name)){
            //     $rules['logo_url'] = 'max:10000|mimes:png,jpg,jpeg,gif';
            //     $messages['logo_url.max'] = 'Logo size cannot exceeds 10mb!';
            //     $messages['logo_url.mimes'] = 'Invalid file type, The supported types: png, jpg, jpeg, gif.';
            // } 
            // $validated = $request->validate($rules,$messages);
            // $validated =  Validator::make($request->all(), $rules, $messages)->validate();
            
            //data insertion
            $data = [
                'name' => $request->name,
                'email' => $request->email ?? '',
                'website' => $request->website ?? '', 
            ];
            if(isset($name)) $data['logo_url'] = $name;
            Companies::whereId($request->id)->update($data);
            return response()->json(['status'=>true,'message'=>'Successfully Updated!']);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }
    public function delete(Request $request){
        try{
            $getcompanyid = Employees::where('company_id',$request->id)->get();
            if(!empty($getcompanyid) && count($getcompanyid) > 0 && !isset($request->confirmed)){
                return response()->json(['status'=>'2','message'=>'One or more employees are linked to this company, Are you sure you want to delete!']);
            }
            if(isset($request->confirmed) && $request->confirmed == true){
                Employees::where('company_id',$request->id)->delete();
            }
            $company = Companies::whereId($request->id)->delete();
            return response()->json(['status'=>true,'message'=>'Successfully deleted!']);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }
    public function getById(Request $request){
        try{
            $company = Companies::whereId($request->id)->first();
            return response()->json(['status'=>true,'company'=>$company]);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }
}
