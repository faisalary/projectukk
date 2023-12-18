<?php

namespace App\Http\Controllers;
use App\Http\Requests\MasterEmailRequest;
use App\Models\email_template;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class MasterEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $email = email_template::all();
        return view('company.master_email.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MasterEmailRequest $request)
    {
        try {

            $email = email_template::create([
                'subject_email' => $request->subject_email,
                'headline_email' => $request->headline_email,
                'content_email' => $request->content_email,
                'attachment' => $request->attachment,
                'status' => true,
            ]);
            return response()->json([
                'error' => false,
                'message' => 'Template successfully Created!',
                'modal' => '#modal-email',
                'table' => '#table-master-email'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }

        return $request->file('attachment')->store('post');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $email = email_template::orderBy('subject_email', 'asc')->get();

        return DataTables::of($email)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                }
            })
            ->addColumn('attachment', function ($row) {
                return "<a href='" . asset('storage/' . $row->id_email_template) . "' data-id='{$row->id_email_template}'>Attachment</a>";
            })
            
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "success";

                $btn = "<a data-bs-toggle='modal' data-id='{$row->id_email_template}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$row->status}' data-id='{$row->id_email_template}' data-url='master-email/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

                return $btn;
            })
            ->rawColumns(['action', 'status','attachment'])

            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $email = email_template::where('id_email_template', $id)->first();
        return $email;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MasterEmailRequest $request, string $id)
    {
        try {
            $email = email_template::where('id_email_template', $id)->first();

            $email->subject_email = $request->subject_email;
            $email->headline_email = $request->headline_email;
            $email->content_email = $request->content_email;
            $email->attachment = $request->attachment;
            $email->save();

            return response()->json([
                'error' => false,
                'message' => 'Email Template successfully Updated!',
                'modal' => '#modal-email',
                'table' => '#table-master-email'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        try {
            $email = email_template::where('id_email_template', $id)->first();
            $email->status = ($email->status) ? false : true;
            $email->save();

            return response()->json([
                'error' => false,
                'message' => 'Status Universitas successfully Updated!',
                'modal' => '#modal-email',
                'table' => '#table-master-email'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                
            ]);
        }
    }

}