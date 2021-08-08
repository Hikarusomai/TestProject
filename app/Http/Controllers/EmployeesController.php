<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employees;
use App\Companies;
use DataTables;
use App\Http\Requests\StoreEmployees;
use App\Notifications\EmployeeCreate; 
use Notification;

class EmployeesController extends Controller
{ 
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Employees::with('company')->get(); 
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function(Employees $employee){
                        $btn = '<a href="javascript:void(0)" data-id="'.$employee->id.'" class="edit btn btn-primary btn-sm" ><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0)" data-id="'.$employee->id.'" class="delete btn btn-primary btn-sm" onclick="if (confirm(`Are you sure you want to delete?`)) { deleteemployee('.$employee->id.'); } "><i class="fas fa-trash"></i></a>'; 
                        return $btn;
                    })
                    ->editColumn('company', function(Employees $employee) { 
                        return '<a href="javascript:void(0)" class="company-view" data-id="'.$employee->company->id.'"><i class"fas fa-eye"></i>'.$employee->company->name.'</button>';
                    })
                    ->editColumn('full_name', function(Employees $employee) { 
                        return $employee->first_name.' '.$employee->last_name;
                    })
                    ->rawColumns(['action','company'])
                    ->make(true);
        }
        $companies = Companies::select('id','name')->get();
        return view('employees.index',['companies'=>$companies]);
    }
    public function create(StoreEmployees $request){
        try{  
            // $rules = [
            //     'first_name' => 'alpha|required|max:255',
            //     'last_name' => 'alpha|required|max:255',
            //     'company_id' => 'required|max:20',
            // ]; 
            // if(isset($request->phone) || $request->phone != '') $rules['phone'] = 'numeric';
            // if(isset($request->email) || $request->email != '') $rules['email'] = 'email';
            // $validated = $request->validate($rules); 
           
            //data insertion 
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_id' => $request->company_id,
                'email' => $request->email ?? '',
                'phone' => $request->phone ?? '', 
            ]; 
            Employees::insert($data);
            //notifier
            $company_details = Companies::whereId($request->company_id)->first();
            $details = [
                'greeting' => 'Hi there,',
                'body' => 'New employee: '.$request->first_name. $request->last_name.' has joined '.$company_details->name,
                'thanks' => 'Regards', 
                'email' => $company_details->email,
                'name' => $company_details->name,
                'id' => $request->company_id
            ];
            try{  
                $status = $company_details->notify(new EmployeeCreate($details));
                // $status = Notification::send([], new EmployeeCreate($details));
            }catch(\Exception $e){
            }
            
            return response()->json(['status'=>true,'message'=>'Successfully Created!']);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }
    public function edit(StoreEmployees $request){ 
        try{ 
            //validation
            // $rules = [
            //     'first_name' => 'alpha|required|max:255',
            //     'last_name' => 'alpha|required|max:255',
            //     'company_id' => 'required|max:20',
            // ]; 
            // if(isset($request->phone) || $request->phone != '') $rules['phone'] = 'numeric';
            // if(isset($request->email) || $request->email != '') $rules['email'] = 'email';
            // $validated = $request->validate($rules); 
           
            //data insertion 
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_id' => $request->company_id,
                'email' => $request->email ?? '',
                'phone' => $request->phone ?? '', 
            ]; 
            Employees::whereId($request->id)->update($data);
            return response()->json(['status'=>true,'message'=>'Successfully Updated!']);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }
    public function delete(Request $request){
        try{
            $employee = Employees::whereId($request->id)->delete();
            return response()->json(['status'=>true,'message'=>'Successfully deleted!']);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }
    public function getById(Request $request){
        try{ 
            $employee = Employees::whereId($request->id)->first();
            return response()->json(['status'=>true,'employee'=>$employee]);
        }catch(\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }
}
