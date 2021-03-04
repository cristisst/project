<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payments extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $dateFormat = 'd/m/Y';

    protected $fillable = [
    	'body_name',
    	'organisation_unit',
    	'expense_category',
    	'expenditure_code',
    	'date',
    	'transaction_number',
    	'amount',
    	'supplier_name'
    ];
}
