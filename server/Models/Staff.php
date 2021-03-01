<?php
use Illuminate\Database\Eloquent\Model;

class Staff extends Model {
    protected $table = 'staffs';
    protected $guarded = [];

    public function roles() {
        return $this->belongsTo(Role::class);
    }

}

?>