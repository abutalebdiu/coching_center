<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WrittenQuestion extends Model
{
    public function classes()
	{
		return $this->belongsTo(Classes::class,'class_id','id');
	}

	public function sessiones()
	{
		return $this->belongsTo(Sessiones::class,'session_id','id');
	}

	public function batchsetting()
	{
		return $this->belongsTo(BatchSetting::class,'batch_setting_id','id');
	}

	public  function  subject()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }



}
