<?php

namespace App\Http\Controllers;
use App\Models\Planifier;
use Illuminate\Http\Request;

class PlanifierController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Planifier::whereDate('debut', '>=', $request->start)
                       ->whereDate('fin',   '<=', $request->end)
                       ->get(['id', 'title', 'debut', 'fin']);
            return response()->json($data);
    	}
    	return view('Apprenant.calender-planifier');
    }

    public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Planifier::create([
    				'title'		=>	$request->title,
    				'debut'		=>	$request->start,
    				'fin'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Planifier::find($request->id)->update([
    				'title'		=>	$request->title,
    				'debut'		=>	$request->start,
    				'fin'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = Planifier::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
    }
}
