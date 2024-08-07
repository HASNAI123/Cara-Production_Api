<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Generatesop extends Model
{
    use HasFactory,SoftDeletes;


        protected $table = 'generatesops';

        public const STATUS_SELECT = [
            'Pending' => 'In-Progress',
            'Accepted'   => 'Accepted',
            'Declined'   => 'Declined',
        ];
        protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        protected $casts=[

            'Procedure'=>'array',
            'Description'=>'array',
            'Appendix'=>'array',
            'action' => 'array',
            'Sop_file' => 'array',
            'Version_history' => 'array'

        ];

        protected $fillable = [

            //SOP Details and Version History
            'sop_title',
            'business_unit',
           'approved_by',
            'uploaded_by',
            'Employee_id',
            'created_at',
            'status',
            'updated_at',
            'deleted_at',
            'Sop_file',
            'effective_date',
            'version_no',
            'doc_no',
            'folder',
            'Process_owner',
            'Process_exec',
            'revised_by',
            'edited_by',
            'assign_reviewers',
            'assign_approvers',
            'Approvedin',
            'Reviewedin',
            'SopNumber',
            'aeon_type',
            'language',

            // SOP details content
            'Version_history',
            'Purpose',
            'Scope',
            'Defination',
            'Department',
            'Responsibilities',
            'General_Information',
            'Process_flow', // Chart Flow
            'Reference',

            //Sop Procedure Details
            'Procedure',
            'Description',
            'Appendix',


            'action',
            'Appendix_file'
        ];


}
