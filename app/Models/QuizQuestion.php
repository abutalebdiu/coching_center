<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    public function classes()
	{
		return $this->belongsTo(Classes::class,'classes_id','id');
	}

	public function sessiones()
	{
		return $this->belongsTo(Sessiones::class,'sessiones_id','id');
	}
	public function sections()
	{
		return $this->belongsTo(Section::class,'section_id','id');
	}

	public function batch()
	{
		return $this->belongsTo(Batch::class,'batch_id','id');
	}

	public function batchsetting()
	{
		return $this->belongsTo(BatchSetting::class,'batch_setting_id','id');
	}

	public  function  subject()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }

	public  function  quiz()
    {
        return $this->belongsTo(Quiz::class,'quiz_id');
    }


	




    public  function  QuizQuestionValue()
    {
        return $this->hasMany(QuizQuestionOption::class,'quiz_question_id');
    }
}
