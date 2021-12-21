<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

class FullCalenderController extends Controller
{
	public function index(Request $request)
	{

		if ($request->ajax()) {
			if ($request->tipoesame == 'Vuoto') {
				$data = Event::whereDate('start', '>=', $request->start)
					->whereDate('end', '<=', $request->end)
					->where('codice', '=', $request->codice)

					->get(['id', 'title', 'start', 'end', 'codice']);
				return response()->json($data);
			}
			else {
				$data = Event::whereDate('start', '>=', $request->start)
					->whereDate('end', '<=', $request->end)
					->where('codice', '=', $request->codice)
					->where('tipoesame', '=', $request->tipoesame)
					->get(['id', 'title', 'start', 'end', 'codice', 'tipoesame']);
				return response()->json($data);
			}
		}
		return view('full-calender');
	}

	public function action(Request $request)
	{
		if ($request->ajax()) {
			if ($request->type == 'add') {
				$event = Event::create([
					'title' => $request->title,
					'start' => $request->start,
					'end' => $request->end,
					'codice' => $request->codice,
					'tipoesame' => $request->tipoesame,
				]);

				return response()->json($event);
			}

			if ($request->type == 'update') {
				$event = Event::find($request->id)->update([
					'title' => $request->title,
					'start' => $request->start,
					'end' => $request->end,
					'codice' => $request->codice,
				]);

				return response()->json($event);
			}

			if ($request->type == 'delete') {
				$event = Event::find($request->id)->delete();

				return response()->json($event);
			}
		}
	}
}
?>