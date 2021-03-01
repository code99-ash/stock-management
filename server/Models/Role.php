<?php
use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    // protected $fillable = ['name'];
    protected $guarded = [];


    public function staffs() {
        return $this->hasMany(Staff::class);
    }
}

?>