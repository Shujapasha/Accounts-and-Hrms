<?php

namespace App\Http\Controllers;

use App\Exports\HolidayExport;
use App\Imports\HolidayImport;
use App\Models\Holiday;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class HolidayController extends Controller
{

    public function index(Request $request)
    {
        if(\Auth::user()->can('manage holiday'))
        {
            $holidays = Holiday::where('created_by', '=', \Auth::user()->creatorId());

            if(!empty($request->start_date))
            {
                $holidays->where('date', '>=', $request->start_date);
            }
            if(!empty($request->end_date))
            {
                $holidays->where('date', '<=', $request->end_date);
            }
            $holidays = $holidays->get();

            return view('holiday.index', compact('holidays'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }


    public function create()
    {
        if(\Auth::user()->can('create holiday'))
        {
            return view('holiday.create');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }


    public function store(Request $request)
    {
        if(\Auth::user()->can('create holiday'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                    'occasion' => 'required',
                                    'start_date' => 'required',
                                    'end_date' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $holiday             = new Holiday();
             $holiday->occasion          = $request->occasion;
            $holiday->start_date        = $request->start_date;
            $holiday->end_date          = $request->end_date;
            $holiday->created_by = \Auth::user()->creatorId();
            $holiday->save();

            // slack 
            $setting = Utility::settings(Auth::user()->creatorId());
            if(isset($setting['Holiday_notification']) && $setting['Holiday_notification'] ==1){
                $msg = $request->occasion.' '. __("on").' '.$request->date . '.'; 
                Utility::send_slack_msg($msg);
            }

            // telegram
            $setting = Utility::settings(\Auth::user()->creatorId());
            if(isset($setting['telegram_Holiday_notification']) && $setting['telegram_Holiday_notification'] ==1){
                $msg = $request->occasion.' '. __("on").' '.$request->date.'.'; 
                Utility::send_telegram_msg($msg);
            }

            return redirect()->route('holiday.index')->with(
                'success', 'Holiday successfully created.'
            );
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }


    public function show(Holiday $holiday)
    {
        //
    }


    public function edit(Holiday $holiday)
    {
        if(\Auth::user()->can('edit holiday'))
        {
            return view('holiday.edit', compact('holiday'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }


    public function update(Request $request, Holiday $holiday)
    {
        if(\Auth::user()->can('edit holiday'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'occasion' => 'required',
                                    'start_date' => 'required',
                                    'end_date' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $holiday->occasion          = $request->occasion;
            $holiday->start_date        = $request->start_date;
            $holiday->end_date          = $request->end_date;
            $holiday->save();

            return redirect()->route('holiday.index')->with(
                'success', 'Holiday successfully updated.'
            );
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }


    public function destroy(Holiday $holiday)
    {
        if(\Auth::user()->can('delete holiday'))
        {
            $holiday->delete();

            return redirect()->route('holiday.index')->with(
                'success', 'Holiday successfully deleted.'
            );
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }

    public function calender(Request $request)
    {
        if (\Auth::user()->can('manage holiday')) {
            $holidays = Holiday::where('created_by', '=', \Auth::user()->creatorId());
            $today_date = date('m');
             $current_month_event = Holiday::select( 'occasion','start_date','end_date', 'created_at')->whereRaw('MONTH(start_date)=' . $today_date,'MONTH(end_date)=' . $today_date)->get();

            if (!empty($request->start_date)) {
                $holidays->where('date', '>=', $request->start_date);
            }
            if (!empty($request->end_date)) {
                $holidays->where('date', '<=', $request->end_date);
            }
            $holidays = $holidays->get();

            $arrHolidays = [];

            foreach ($holidays as $holiday) {

                $arr['id']        = $holiday['id'];
                $arr['title']     = $holiday['occasion'];
                $arr['start']     = $holiday['start_date'];
                $arr['end']       = $holiday['end_date'];
                $arr['className'] = 'event-primary';
                $arr['url']       = route('holiday.edit', $holiday['id']);
                $arrHolidays[]    = $arr;
            }
            // $arrHolidays = str_replace('"[', '[', str_replace(']"', ']', json_encode($arrHolidays)));
            $arrHolidays =  json_encode($arrHolidays);


            return view('holiday.calender', compact('arrHolidays','current_month_event'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function export(Request $request)
    {
        $name = 'holidays_' . date('Y-m-d i:h:s');
        $data = Excel::download(new HolidayExport(), $name . '.xlsx'); 

        return $data;
    }
    public function importFile(Request $request)
    {
        return view('holiday.import');
    }
    public function import(Request $request)
    {
        $rules = [
            'file' => 'required|mimes:csv,txt',
        ];
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }
        $holiday = (new HolidayImport())->toArray(request()->file('file'))[0];
         

        $totalholiday = count($holiday) - 1;
        $errorArray    = [];
        for ($i = 1; $i <= $totalholiday; $i++) {
            $holidays = $holiday[$i];
            
            $holiydayData=Holiday::where('date',$holidays[0])->where('occasion',$holidays[1])->first();
            
            if(!empty($holiydayData))
            {   
                $errorArray[]=$holiydayData;
            }
            else
            {
                $holi_days=new Holiday();
                $holi_days->date=$holidays[0];
                $holi_days->occasion=$holidays[1];
                $holi_days->created_by=Auth::user()->id;
                $holi_days->save();
            }
         }
       
        
        if (empty($errorArray)) {
            $data['status'] = 'success';
            $data['msg']    = __('Record successfully imported');
        } else {
           
            $data['status'] = 'error';
            $data['msg']    = count($errorArray) . ' ' . __('Record imported fail out of' . ' ' . $totalholiday . ' ' . 'record');

           
            foreach ($errorArray as $errorData) {
                $errorRecord[] = implode(',', $errorData->toArray());
            }
            
            \Session::put('errorArray', $errorRecord);
        }

        return redirect()->back()->with($data['status'], $data['msg']);
    }
}
