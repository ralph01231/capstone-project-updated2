<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // public function index()
    // {

    //     $query = Report::where('status' , '0')->get();
    //     if (request()->ajax()) {
    //         return datatables()->of($query)
    //             ->addColumn('action', 'admin.activereports.actions-button')
    //             ->rawColumns(['action'])
    //             ->addIndexColumn()
    //             ->make(true);
    //     }

    //     return view('admin.activereports.reports');
    // }

    public function index(Request $request)
    {
        $query = Report::select([
            'report_id',
            'dateandTime',
            'emergency_type',
            'resident_name',
            'locationName',
            'locationLink',
            'phoneNumber',
            'message',
            'imageEvidence',
            'responder_name'
        ])->where('status', '0');

        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchValue = $request->input('search')['value'];

            $query->where(function ($q) use ($searchValue) {
                $q->where('report_id', 'like', '%' . $searchValue . '%')
                    ->orWhere('responder_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('locationName', 'like', '%' . $searchValue . '%')
                    ->orWhere('emergency_type', 'like', '%' . $searchValue . '%')
                    ->orWhere('resident_name', 'like', '%' . $searchValue . '%');
            });
        }

        $totalRecords = $query->count();

        if ($request->has('start') && $request->has('length')) {
            $start = $request->input('start');
            $length = $request->input('length');

            if ($length != -1) {
                $query->skip($start)->take($length);
            }
        }

        $reports = $query->get();

        $formattedGuidelines = $reports->map(function ($report) {
            return [
                'report_id' => $report->report_id,
                'dateandTime' => $report->dateandTime,
                'emergency_type' => $report->emergency_type,
                'resident_name' => $report->resident_name,
                'locationName' => $report->locationName,
                'locationLink' => $report->locationLink,
                'phoneNumber' => $report->phoneNumber,
                'message' => $report->message,
                'imageEvidence' => $report->imageEvidence,
                'responder_name' => $report->responder_name,
            ];
        });

        $jsonData = [
            'data' => $formattedGuidelines,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
        ];

        if ($request->wantsJson()) {
            return response()->json($jsonData);
        }


        return view('admin.activereports.reports', $jsonData);
    }

    public function index2(Request $request)
    {
        $query = Report::select([
            'report_id',
            'dateandTime',
            'emergency_type',
            'resident_name',
            'locationName',
            'locationLink',
            'phoneNumber',
            'message',
            'imageEvidence',
            'responder_name'
        ])->where('status', '1');

        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchValue = $request->input('search')['value'];

            $query->where(function ($q) use ($searchValue) {
                $q->where('report_id', 'like', '%' . $searchValue . '%')
                    ->orWhere('responder_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('locationName', 'like', '%' . $searchValue . '%')
                    ->orWhere('emergency_type', 'like', '%' . $searchValue . '%')
                    ->orWhere('resident_name', 'like', '%' . $searchValue . '%');
            });
        }

        $totalRecords = $query->count();

        if ($request->has('start') && $request->has('length')) {
            $start = $request->input('start');
            $length = $request->input('length');

            if ($length != -1) {
                $query->skip($start)->take($length);
            }
        }

        $reports = $query->get();

        $formattedGuidelines = $reports->map(function ($report) {
            return [
                'report_id' => $report->report_id,
                'dateandTime' => $report->dateandTime,
                'emergency_type' => $report->emergency_type,
                'resident_name' => $report->resident_name,
                'locationName' => $report->locationName,
                'locationLink' => $report->locationLink,
                'phoneNumber' => $report->phoneNumber,
                'message' => $report->message,
                'imageEvidence' => $report->imageEvidence,
                'responder_name' => $report->responder_name,
            ];
        });

        $jsonData = [
            'data' => $formattedGuidelines,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
        ];

        if ($request->wantsJson()) {
            return response()->json($jsonData);
        }


        return view('admin.activereports.reports', $jsonData);
    }


    public function accept_report(Report $report)
    {
        $report->update([
            'status' => '1',
        ]);

        return response()->json(['message' => 'Report accepted']);
    }

    public function show(Report $report)
    {
        return response()->json(['data' => $report]);
    }

    public function destroy(Report $report)
    {
        try {
            $report->delete();

            return response()->json(['message' => 'Report rejected'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to reject report'], 500);
        }
    }
}
