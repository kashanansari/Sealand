<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\User;
use App\Models\Vendor;

use App\Models\Customer;
use App\Models\Bank;
use App\Models\Client;
use App\Models\Expense;
use App\Models\Expense_details;
use App\Models\Print_data;
use App\Models\Print_books;
use App\Models\customer_owner;
use App\Models\Purchase;
use App\Models\Products;
use App\Models\Purcahses_product;
use App\Models\Vendor_bill;
use App\Models\Report;
use App\Models\Invoices;
use App\Models\ledger_acc;
use Carbon\Carbon;



use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
class usercontroller extends Controller
{
    //
    public function create_user(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages(),
                'data' => null
            ], 400);
        }

        // Check if the role exists in the 'roles' column
        $rolesExist = DB::table('roles')
            ->whereRaw("FIND_IN_SET(?, roles)", [$request->role])
            ->exists();

        if (!$rolesExist) {
            return response()->json([
                'success' => false,
                'msg' => 'Selected role is not found'
            ], 200);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ];

        $user = User::create($data);

        if ($user) {
            return response()->json([
                'success' => true,
                'msg' => 'User created successfully',
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Error in submission, please try again',
            ], 200);
        }
    }

    public function login_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages(),
                'data' => null
            ], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'msg' => 'Email not found',
            ], 200);
        }
        else{
        if ($request->password==$user->password) {
            $token = $user->createToken($user->email)->plainTextToken; // Adjust 'authToken' to your desired token name
            return response()->json([
                'success' => true,
                'msg' => 'Logged in successfully',
                'data'=>$user,
                'token'=>$token
            ], 200);
        }
        else {
            return response()->json([
                'success' => false,
                'msg' => 'Wrong password',
            ], 200);
        }

    }

    }
    public function create_customers(Request $request){
       $auth=auth()->user();
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required',
            'company_name' => 'required',
            'customer_address' => 'required|nullable',
            'customer_contact_number' => 'required',
            'company_detail' => 'required',
            'customer_ntn_number' => 'required',
            'customer_owner' => 'required',
            'customer_gst_number' => 'required|nullable',
            'prev_customer_balance' => 'required|nullable',



        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages(),
                'data' => null
            ], 400);
        }
        $data=[
            'customer_name'=>$request->customer_name,
            'company_name'=>$request->company_name,
            'customer_address'=>$request->customer_address,
            'customer_contact_number'=>$request->customer_contact_number,
            'company_detail'=>$request->company_detail,
            'customer_ntn_number'=>$request->customer_ntn_number,
            'customer_owner'=>$request->customer_owner,
            'customer_gst_number'=>$request->customer_gst_number,
            'prev_customer_balance'=>$request->prev_customer_balance,
            'user_id'=>$auth->id,
            // 'customer_name'=>$request->customer_name,

        ];
        $customer=Customer::create($data);
        if($customer){
            return response()->json([
                'success'=>true,
                'msg'=>'customer creted successfully',
                'data'=>$data
            ], 200, );
        }
        else{
            return response()->json([
                'success'=>false,
                'msg'=>'Error in submission',
                'data'=>null
            ], 200, );
        }
    }

public function get_roles(){
    $roles=DB::table('roles')->value('roles');
    return response()->json([
        'success'=>true,
        'msg'=>'roles has been found',
        'roles'=>$roles
    ], 200, );
}

public static function create_vendors(Request $request){
    $auth=auth()->user();
    if($auth){
    $validator = Validator::make($request->all(), [
        'vendor_name' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->messages(),
            'data' => null
        ], 400);
    }
    $value=[
        'vendor_name'=>$request->vendor_name,
        'user_id'=>$auth->id,
    ];
   $vendor= Vendor::create($value);
   if($vendor){
    return response()->json([
        'success'=>true,
    'msg'=>'vendor created successfully',
    'data'=>$vendor
], 200, );
   }
else{
    return response()->json([
        'success'=>false,
        'msg'=>'error in submission',
        'data'=>null
    ], 200, );
}
    }


}
public function create_bank(Request $request){
$auth=Auth::user();
if($auth){
    $validator= Validator::make($request->all(),[
        'add_bank'=>'required',
        'bank_description'=>'required',
        'amount'=>'required|nullable',
    ]);
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->messages(),
            'data' => null
        ], 400);
    }
    $data=[
        'add_bank'=>$request->add_bank,
        'bank_description'=>$request->bank_description,
        'amount'=>$request->amount,
        'user_id'=>$auth->id,

    ];
    $bank=Bank::create($data);
    if($bank){
        return response()->json([
            'success'=>true,
            'msg'=>'bank created successfully',
            'data'=>$bank,
        ], 200, );
    }
    else{
        return response()->json([
            'success'=>false,
            'msg'=>'error in submission',
            'data'=>null
        ], 200, );
    }

}
}
public function get_banks(Request $request){
    $auth=Auth::user();
    if($auth){
        $details=Bank::where('user_id',$auth->id)->get();

    }
    return response()->json([
        'success'=>true,
        'msg'=>'data has been found',
        'data'=>$details
    ], 200, );
}
public function create_client(Request $request){
    $auth=Auth::user();
    if($auth){
        $validator= Validator::make($request->all(),[
            'client_name'=>'required',
            'image'=>['required','image','mimes:jpeg,jpg,png','max:2048'],
            'short_description'=>'required|nullable',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages(),
                'data' => null
            ], 400);
        }
        if($request->hasFile('image')){
            $imagepath=$request->file('image')->store('image','public');
            $image=('/storage' .$imagepath);


        $data=[
            'client_name'=>$request->client_name,
            'image'=>$image,
            'short_description'=>$request->short_description,
            'user_id'=>$auth->id,
        ];
       $client= Client::create($data);
       if($client){
        return response()->json([
            'success'=>true,
            'msg'=>'client cretaed successfully',
            'data'=>$client
        ], 200, );
       }
       else{
        return response()->json([
            'success'=>false,
            'msg'=>'error in submission',
            'data'=>null
        ], 200, );

    }


    }

}

}
public function user_logout(Request $request){
    $auth=Auth::user();
    if($auth){
        $auth->tokens()->delete();

        return response()->json([
            'success'=>true,
            'msg'=>' user logout successfully'
        ], 200, );
    }
    else{
        return response()->json([
            'success'=>false,
            'msg'=>'error'
        ], 200, );
    }
}
public function create_expense(Request $request)
{
    $auth=Auth::user();
    if($auth){
$validator=Validator::make($request->all(),[
    'no_of_pkgs'=>'required|nullable',
    'expense_voucher'=>'required|nullable',
    'vir_no'=>'required|nullable',
    'index_no'=>'required|nullable',
    'dated_two'=>'required|nullable',
    'exchange_rate'=>'required|nullable',
    'document_encl'=>'required|nullable',
    'exchange_copy'=>'required|nullable',
    'invoice_list'=>'required|nullable',
    'po'=>'required|nullable',
    'vessel'=>'required|nullable',
    'dated_one'=>'required|nullable',
    'be_no'=>'required|nullable',
    'description'=>'required|nullable',
    'i_value'=>'required|nullable',
    'custom_be'=>'required|nullable',
    'importer_copy'=>'required|nullable',
    'lc_copy'=>'required|nullable',
    'shipper'=>'required|nullable',
    'custom_duties'=>'required|nullable',
    'pd_account'=>'required|nullable',
    'itax'=>'required|nullable',
    'aduty'=>'required|nullable',
    'sapt_boml'=>'required|nullable',
    'pd_account_two'=>'required|nullable',
    'infrastructure'=>'required|nullable',
    'pd_account_three'=>'required|nullable',
    'cntr_thc_two'=>'required|nullable',
    'lolo_chg_three'=>'required|nullable',
    'endrosment_chg_two'=>'required|nullable',
    'total_one'=>'required|nullable',
    'custom_fine'=>'required|nullable',
    'lolo_chg'=>'required|nullable',
    'cntr_thc'=>'required|nullable',
    'bond_paper'=>'required|nullable',
    'sapt_pict'=>'required|nullable',
    'endrosment_chg'=>'required|nullable',
    'lifter_labour'=>'required|nullable',
    'infrastructure_two'=>'required|nullable',
    'lolo_chg_two'=>'required|nullable',
    'lolo_chg_four'=>'required|nullable',
    'test_memo'=>'required|nullable',
    'labour_loading'=>'required|nullable',
    'bill_entry'=>'required|nullable',
    'cartage'=>'required|nullable',
    'assesment_pdc'=>'required|nullable',
    'exam_chrgs'=>'required|nullable',
    'fta_chrgs'=>'required|nullable',
    'rent_chrgs'=>'required|nullable',
    'other_expense'=>'required|nullable',
    'agency_commission'=>'required|nullable',
    'other'=>'required|nullable',
    'total_two'=>'required|nullable',
    'advance'=>'required|nullable',
    'balance'=>'required|nullable',
    'customer_name'=>'required',
    'expense_title'=>'required',
    'expense_amount'=>'required',
   

]);
if($validator->fails()){
    return response()->json([
        'success'=>false,
        'messsge'=>$validator->messages(),
        'data'=>null

    ], 400, );
}
$customer=Customer::where('customer_name',$request->customer_name)
->first();
if(!$customer){
    return response()->json([
        'success'=>false,
        'msg'=>'This customer is not added yet',
        'data'=>null
    ], 200, );
}

$data = $request->only([
    'no_of_pkgs', 'expense_voucher', 'vir_no', 'index_no', 'dated_two',
    'exchange_rate', 'document_encl', 'exchange_copy', 'invoice_list',
    'po', 'vessel', 'dated_one', 'be_no', 'description', 'i_value',
    'custom_be', 'lc_copy', 'shipper', 'custom_duties', 'pd_account',
    'itax', 'aduty', 'sapt_boml',
    'total_one', 'custom_fine', 'lolo_chg', 'cntr_thc', 'bond_paper',
    'sapt_pict', 'endrosment_chg', 'lifter_labour', 'infrastructure_two',
    'lolo_chg_two', 'lolo_chg_four', 'test_memo', 'labour_loading',
    'bill_entry', 'cartage', 'assesment_pdc', 'exam_chrgs', 'fta_chrgs',
    'rent_chrgs', 'other_expense', 'agency_commission', 'other', 'total_two',
    'advance', 'balance',
    
]);
$data['customer_id']=$customer->id;
$Expense=Expense::create($data);

if($Expense){
    $expense_details=[
        'expense_id'=>$Expense->id,
        'expense_title'=>$request->expense_title,
        'expense_amount'=>$request->expense_amount,
    ];
}
   $details= Expense_details::create($expense_details);
   if($details){
    return response()->json([
        'success'=>true,
        'msg'=>'Expense added successfullly',
        'data'=>$Expense,
    ], 200);
}
    
else{
    return response()->json([
        'success'=>false,
        'msg'=>'error in creation please try again'
    ], 200, );
}
}
}
public function create_customer_owner(Request $request){
    $auth=Auth::user();
    if($auth){
        $validator=Validator::make($request->all(),[
            'customer_owner_name'=>'required',
            'owner_mon_amount'=>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'messsge'=>$validator->messages(),
                'data'=>null
        
            ], 400, );
        }
        $data=[
            'customer_owner_name'=>$request->customer_owner_name,
            'owner_mon_amount'=>$request->owner_mon_amount,
            'user_id'=>$auth->id,
        ];
       $table= DB::table('customer_owner')->insert($data);
       if($table){
        return response()->json([
            'success'=>true,
            'msg'=>'data inserted successfully',
            'data'=>$table,
        ], 200, );
       }
       else{
        return response()->json([
            'success'=>false,
            'msg'=>'error in submission',
            'data'=>null
        ], 200, );
       }
        }
    }
    public function create_cheque_book(Request $request)
    {
        $auth=Auth::user();
        if($auth){

        
        $validator=Validator::make($request->all(),[
            'add_bank'=>'required|nullable',
            'amount'=>'required|nullable',
            'bank_description'=>'required|nullable',
           
        ]);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'message'=>$validator->messages(),
                'data'=>null
            ], 200, );
        }
        DB::beginTransaction();
        $data=[
            'add_bank'=>$request->add_bank,
            'amount'=>$request->amount,
            'bank_desc'=>$request->bank_description,
            'user_id'=>$auth->id,

        ];
        $cheque_book=Print_books::create($data);
        Db::commit();
        if($cheque_book){
            return response()->json([
                'success'=>true,
                'msg'=>'Data saved successfully',
                'data'=>$cheque_book
            ], 200, );
        }
        else{
            return response()->json([
                'success'=>false,
                'msg'=>'error in submission',
                'data'=>null
            ], 200, );
        }

    

    
    }
}
public function create_cheque_data(Request $request)
{
    $auth=Auth::user();
    if($auth){

    
    $validator=Validator::make($request->all(),[
        'select_bank'=>'required|nullable',
        'pay'=>'required|nullable',
        'amount'=>'required|nullable',
        'cheque_type'=>'required|nullable',
        'date'=>'required|nullable|date_format:d-m-Y',
        // 'amount'=>'required|nullable',
       
    ]);
    if($validator->fails()){
        return response()->json([
            'success'=>false,
            'message'=>$validator->messages(),
            'data'=>null
        ], 200, );
    }
    DB::beginTransaction();
    $data=$request->only([
        'select_bank','pay','amount','cheque_type','date',
    ]);
    $data['user_id']=$auth->id;
    $cheque_data=Print_data::create($data);
    Db::commit();
    if($cheque_data){
        return response()->json([
            'success'=>true,
            'msg'=>'Data saved successfully',
            'data'=>$cheque_data
        ], 200, );
    }
    else{
        return response()->json([
            'success'=>false,
            'msg'=>'error in submission',
            'data'=>null
        ], 200, );
    }
}
}
public function create_purchses(Request $request){
     $auth=Auth::user();
     if($auth){
    $validator=Validator::make($request->all(),[
        'pay'=>'required|nullable',
        'status'=>'required|nullable',
        'attach_document' => ['required', 'nullable', 'mimes:pdf'],
        'date'=>['required','nullable','date_format:d-m-Y'],
        'supplier'=>'required|nullable',
        'purchases_voucher'=>'required|nullable',
        'order_tax'=>'required|nullable',
        'discount'=>'required|nullable',
        'shipping'=>'required|nullable',
        'payment_term'=>'required|nullable',
        'note'=>'required|nullable',
        
       
    ]);

if($validator->fails()){
    return response()->json([
        'success'=>false,
        'message'=>$validator->messages(),
        'data'=>null,
    ], 200, );
}
if($request->hasFile('attach_document')){
    $docpath=$request->file('attach_document')->store('documents','public');
    $DOC=('/storage' .$docpath);
}
$data=$request->only([
    'pay','status','date','supplier','purchases_voucher','order_tax','discount','shipping','purchases_voucher','payment_term',
]);
$data['attach_document']=$DOC;
$data['user_id']=$auth->id;

$purcahse=Purchase::create($data);
if($purcahse){
    return response()->json([
        'success'=>true,
        'messsage'=>'data submitted successfully',
        'data'=>$purcahse
    ], 200, );
}
else{
    return response()->json([
        'success'=>false,
        'messsage'=>'error in submission'
    ], 200, );
}
}
     }

public function create_products(Request $request){
    $auth=Auth::user();
    if($auth){
    $validator=Validator::make($request->all(),[
        'product_name'=>'required|nullable',
        'product_code'=>'required|nullable',
        'barcode' => 'required|nullable',
        'size'=>['required','nullable'],
        'brand'=>'required|nullable',
        'gramage'=>'required|nullable',
        'category'=>'required|nullable',
        'sub_category'=>'required|nullable',
        'product_unit'=>'required|nullable',
        'product_cost'=>'required|nullable',
        'product_price'=>'required|nullable',
        'product_image'=>['required','nullable','mimes:jpg,png,jpeg','max:2048'],
        'product_details'=>'required|nullable',
        'product_details_for_invoice'=>'required|nullable',
         
    ]);

if($validator->fails()){
    return response()->json([
        'success'=>false,
        'message'=>$validator->messages(),
        'data'=>null,
    ], 200, );
}
if($request->file('product_image')){
    $imagepath=$request->file('product_image')->store('Product images','public');
    $product_iamge=('/storage'.$imagepath);
}


DB::beginTransaction();
    $data=$request->only([
        'product_name','product_code','barcode','size','brand','gramage','category','sub_category','product_unit','product_cost','product_price','product_details','product_details_for_invoice',
    ]);
    $data['user_id']=$auth->id;
    $data['product_image']=$product_iamge;
try{
   $products= Products::create($data);
   DB::commit();
}
catch(\Exception $e){
   echo $e->getMessage();
   $products=null;
   DB::rollback();
}
   if($products){
    return response()->json([
        'success'=>true,
        'message'=>'products created successfully',
        'data'=>$products,
    ], 200, );
   }
   else{
    return response()->json([
        'success'=>false,
        'message'=>'error in submission',
        'data'=>null
    ], 200, );
   }
}
 }
 public function create_purchases_product(Request $request){
   $auth= Auth::user();
if($auth){
    $validator=Validator::make($request->all(),[
        'quantity'=>'required|nullable',
        'price'=>'required|nullable',
        'received_quantity' => 'required|nullable',
        'purchase_id'=>['required', 'exists:purchases,id'],
        'product_id'=>['required', 'exists:products,id'],
 
    ]);

if($validator->fails()){
    return response()->json([
        'success'=>false,
        'message'=>$validator->messages(),
        'data'=>null,
    ], 200, );
}
$data=$request->only([
    'quantity','price','received_quantity','purchase_id','product_id',

]);
$data['user_id']=$auth->id;
$purchases_product=Purcahses_product::create($data);
if($purchases_product){
    return response()->json([
        'success'=>true,
        'messsage'=>'Data inserted succsesfully',
        'data'=>$purchases_product
    ], 200, );
}
else{
    return response()->json([
        'success'=>false,
        'message'=>'error in submisssion',
        'data'=>null
    ], 200, );
}
 }
}
public function create_vendor_bill(Request $request){
    $validator=Validator::make($request->all(),[
        'grand_total'=>'required|nullable',
        'paid_amount'=>'required|nullable',
        'payment_status'=>'required|nullable',
        'purchase_id'=>['required', 'exists:purchases,id'],
        'vendor_id'=>['required', 'exists:vendor,id'],
 
    ]);
    if($validator->fails()){
        return response()->json([
            'success'=>false,
            'message'=>$validator->messages(),
            'data'=>null,
        ], 200, );
    }
    $data=$request->only([
        'grand_total','paid_amount','payment_status','purchase_id',
        'vendor_id'
    ]);
    
    $vendor_bill=Vendor_bill::create($data);
    if($vendor_bill){
        return response()->json([
            'success'=>true,
            'message'=>'Vendor bill craeated successfully',
            'data'=>$vendor_bill
        ], 200, );
    }
    else{
        return response()->json([
            'success'=>false,
            'message'=>'error in submission',
            'data'=>null
        ], 200, );
    }
}
public function create_report(Request $request){
    $auth=Auth::user();
    if($auth){
    $validator=Validator::make($request->all(),[
        'select_line'=>'required|nullable',
        
 
    ]);
    if($validator->fails()){
        return response()->json([
            'success'=>false,
            'message'=>$validator->messages(),
            'data'=>null,
        ], 200, );
    }
$data=[
    'select_line'=>$request->select_line,
    'user_id'=>$auth->id,
];
$report=Report::create($data);
if($report){
    return response()->json([
        'success'=>true,
        'message'=>'report created successfully',
        'data'=>$report
    ], 200, );

}
else{
    return response()->json([
        'success'=>false,
        'messsage'=>'error in submission',
        'data'=>null
    ], 200, );
}
}
}
public function create_invoices(Request $request){
    $auth=Auth::user();
    if($auth){
    $validator=Validator::make($request->all(),[
        'expense_id'=>['required','exists:expense,id'],
        'customer_id'=>['required','exists:customer,id'],
        // 'user_id'=>['required','exists:users,id'],
        'invoice_no'=>'required',
        'service_charges'=>'required|nullable',
        'sales_tax'=>'required|nullable',
        'sales_tax_amount'=>'required|nullable',
        'total'=>'required|nullable',
        'received_amount'=>'required|nullable',
        'inv_date'=>['required|nullable|format:Y-m-d'],
        'inv_status'=>'required|nullable',


    ]);
    if($validator->fails()){
        return response()->json([
            'success'=>false,
            'message'=>$validator->messages(),
            'data'=>null,
        ], 200, );
    }
    $data=$request->only([
        'expense_id','customer_id','invoice_no','service_charges','sales_tax','sales_tax_amount','total','received_amount','inv_date','inv_status'

    ]);
    $data['user_id']=$auth->id;
    $invoices=Invoices::create($data);
    if($invoices){
        return response()->json([
            'success'=>true,
            'message'=>'Invoice created successfully',
            'data'=>$invoices,
        ], 200, );
    }
    else{
        return response()->json([
            'success'=>false,
            'message'=>'Error in submission',
            'data'=>null
        ], 200, );
    }

}
} 
public function create_ledger_acc(request $request){
   $auth= Auth::user();
   if($auth){
    $validator=Validator::make($request->all(),[
        
        'customer'=>'required',
        'amount'=>'required|nullable',
        'description'=>'required|nullable',
        'balance'=>'required|nullable',
        'voucher_no'=>'required|nullable',
        'status'=>'required|nullable',
        'date' => ['required', 'date_format:Y-m-d'],
        'reference'=>'required|nullable',


    ]);
    if($validator->fails()){
        return response()->json([
            'success'=>false,
            'message'=>$validator->messages(),
            'data'=>null,
        ], 200, );
    }
    // $date=carbon::now()->format('Y-m-d');
    $data=$request->only([
        'customer','amount','description','balance','voucher_no','status','reference','date'

    ]);
    $data['user_id']=$auth->id;
    // $data['date']=$date;

    $ledger=Ledger_acc::create($data);
    if($ledger){
        return response()->json([
            'success'=>true,
            'messsage'=>'ledger created succsessfully',
            'data'=>$ledger
        ], 200, );
    }
    else{
        return response()->json([
            'success'=>false,
            'messsage'=>'error in submisssion',
            'data'=>null
        ], 200, );
    }

}
}
public function view_all_user(Request $request){
 $user=User::orderBy('created_at','desc')->get();
 if($user){
    return response()->json([
        'success'=>true,
        'message'=>'data found successfully',
        'user-details'=>$user
    ], 200, );
 }
 else{
    return response()->json([
        'success'=>false,
        'message'=>'not found',
        'data'=>null
    ], 200, );

 }  
}
public function view_all_vendors(Request $request)
{
    $vendors = Vendor::get();
    $userIds = Vendor::pluck('user_id')->toArray(); // Use toArray() to get a plain array

    $users = User::whereIn('id', $userIds)->get();

    $values = [];

    foreach ($users as $user) {
        $values[] = [
            'user-name' => $user->name, // Assuming 'name' is the attribute you want to retrieve
            'vendors' => $vendors
        ];
    }

    return response()->json([
        'success' => true,
        'msg' => 'data found successfully',
        'data' => $values,
    ], 200);
}
public function view_all_vendors_record(Request $request){
    $vendors=Vendor::get();
    $vendor=vendor::join('users','vendor.user_id','=','users.id')
->select('users.id as user-id',
'vendor.id as vendor-id',
'users.role as user-role',
'users.name as user-name',
'users.email as user-email',
'vendor_name as vendor-name')
->addSelect('vendor.created_at as vendor-creation','users.created_at as user-creation')

->get();
    $values=[];
    foreach($vendor as $names){
        $values[]=[
            'All-Details'=>$names,
           
            
        ];
    }
    return response()->json([
        'success'=>true,
        'msg'=>'data found successfully',
        'data'=>$values
    ], 200, );
}
public function view_all_customers_records(Request $request){
    $customer=Customer::with('user')->get();
return response()->json([
    'success'=>true,
    'msg'=>'data found succsessfully',
    'data'=>$customer,
], 200, );
}
public function view_all_vendors_bill(Request $request){
    $details=Vendor_bill::with('vendor_details','purchase_details')->get();
return response()->json([
    'success'=>true,
    'msg'=>'data found succsessfully',
    'data'=>$details,
], 200, );
}
}

