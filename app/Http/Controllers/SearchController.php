<?php

namespace App\Http\Controllers;

use App\Company;
use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
    	$companies = Company::with('products')->get();
    	return view('search',compact('companies'));
    }

    public function search(Request $request)
    {
    	// $search = $request->search;
    	if($request->search)
    	{
	    	$company = Company::where('company','LIKE','%'.$request->search."%")
	    	->orWhere('id', 'LIKE', '%'.$request->search."%")
	    	->get();

	    	if($company)
	    	{
	    		$data['company'] = $company;
	    		return json_encode($data);
	    	}
	    	else
	    	{
	    		$company = "Data Not Found";
	    		$data['company'] = $company;
	    		return json_encode($data);
	    	}
    	}
    }

    public function company($id)
    {
    	return $company = Company::find($id);
    }

    public function companies(Request $request)
    {
    	$product = Product::where('company_id','=',$request->company)->get();
    	$data['product'] = $product;
    	return json_encode($data);
    }
}
