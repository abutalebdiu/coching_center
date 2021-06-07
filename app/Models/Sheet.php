<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    public function classes()
	{
		return $this->belongsTo(Classes::class,'classes_id');
	}

	public function sessiones()
	{
		return $this->belongsTo(Sessiones::class,'sessiones_id');
	}

	public function batch()
	{
		return $this->belongsTo(Batch::class,'batch_id');
	}

	public function batchsetting()
	{
		return $this->belongsTo(BatchSetting::class,'batch_setting_id');
	}

}
