<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ExamType;
class WrittenQuestion extends Model
{
	protected $fillable = ['question_no','class_id','session_id','subject_id','examination_type_id','attachment','description','status','deleted_at'];
    
	
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
	public  function  ExamTypies()
    {
        return $this->belongsTo(ExamType::class,'examination_type_id');
    }



}
