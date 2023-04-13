<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Raffle;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function index(Raffle $raffle, Request $request) {
        $entries = Entry::where('raffle_id', $raffle->id);

        if($request->filter) {
            $entries->where('name','like',"%$request->filter%")
                ->orWhere('description','like',"%$request->filter%");
        }

        return inertia('entries.index', [
            'raffle' => $raffle,
            'entries' => $entries->paginate(22)
        ]);
    }

    public function store(Raffle $raffle, Request $request) {
        $request->validate([
            'name'=>'string|required',
            'description'=>'string|required',
        ]);

        Entry::create([
            'raffle_id' => $raffle->id,
            'ticket_no' => $request->ticket_no ? $request->ticket_no : rand(1,999999999),
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect("/raffles/$raffle->id/entries");
    }

    public function destroy(Entry $entry) {
        $entry->delete();
        return back();
    }

    public function importEntries(Raffle $raffle, Request $request) {

        $request->validate([
            'source_list' => 'required|file'
        ]);

        $file = $request->file('source_list');
        $handle = fopen($file->getRealPath(),'r');

        while(($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if(!is_numeric($row[0])) return back()->withErrors(['GeneralErrors'=>'Invalid File format! It should be [Ticket No., Name, Description]']);

            Entry::create([
                'raffle_id' => $raffle->id,
                'ticket_no' => $row[0],
                'name' => $row[1],
                'description' => $row[2]
            ]);
        }

        fclose($handle);

        return back();

    }
}
