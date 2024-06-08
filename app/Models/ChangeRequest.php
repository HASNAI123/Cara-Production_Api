<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeRequest extends Model
{
    use HasFactory;

    protected $table = 'change_requests';

    protected $fillable = [
        'report_number',
        'selected_budget',
        'selected_com',
        'selected_status',
        'selected_approver',
        'date1',
        'requested_by_name',
        'requested_by_staff_id',
        'change_request_name',
        'change_description',
        'change_reason',
        'impact_of_change_scope',
        'impact_of_change_budget',
        'impact_of_change_timeline',
        'impact_of_change_resourcing',
        'impact_of_change_communications',
        'impact_of_change_other',
        'proposed_action',
    ];
}
