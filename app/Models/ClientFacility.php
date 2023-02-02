<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientFacility extends Model
{
    use HasFactory;
    public function department() {
        //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(FacilityDepartment::class, 'client_facility_departments', 'facility_id', 'department_id');
    }

    public function job() {
        //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(FacilityJobClass::class, 'facility_job_maps', 'facility_id', 'job_id');
    }

    public function location() {
        //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(FacilityLocation::class, 'facility_location_map', 'facility_id', 'location_id');
    }

    public function ftype() {
        //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(FacilityType::class, 'facility_type_map', 'facility_id', 'ftype_id');
    }
    // location_id
    
}
