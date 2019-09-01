<?php 
namespace app;

use App\Marksheet;

class Gradecalculator
{
	private $totalmark;
	private $total_mark_obtained;
		
			
	public function __construct($totalmark,$total_mark_obtained)
	{

		$this->totalmark = $totalmark;
		$this->total_mark_obtained = $total_mark_obtained;
	}

	public function calculategrade($totalmark,$total_mark_obtained)
	{
		$percentage = $total;

        if ($percentage >= 90)
        {
            $grade  = 'A+';
            $detail = 'Outstanding';
            $point  = '4.0';
        }
        elseif ($percentage < 90 && $percentage >= 80)
        {
            $grade  = 'A';
            $detail = 'Excellent';
            $point  = '3.6';
        }
        elseif ($percentage < 80 && $percentage >= 70)
        {
            $grade  = 'B+';
            $detail = 'Very Good';
            $point  = '3.2';
        }
        elseif ($percentage < 70 && $percentage >= 60)
        {
            $grade  = 'B';
            $detail = 'Good';
            $point  = '2.8';
        }
        elseif ($percentage < 60 && $percentage >= 50)
        {
            $grade  = 'C+';
            $detail = 'Satisfactory';
            $point  = '2.4';
        }
        elseif ($percentage < 50 && $percentage >= 40)
        {
            $grade  = 'C';
            $detail = 'Acceptable';
            $point  = '2.0';
        }
        elseif ($percentage < 40 && $percentage >= 30)
        {
            $grade  = 'D+';
            $detail = 'Partially Acceptable';
            $point  = '1.6';
        }
        elseif ($percentage < 30 && $percentage >= 20)
        {
            $grade  = 'D';
            $detail = 'Insufficient';
            $point  = '1.2';
        }
        else
        {
            $grade  = 'E';
            $detail = 'Very Insufficient';
            $point  = '0.8';
        }
        // dd($grade);

        $mark = Marksheet::create([
            'student_id'  => $request->student_id,
            'percentage'  => $request->percentage,
            'terminal_id' => $request->terminal_id,
            'grade'       => $grade,
            'details'     => $detail,
            'grade_point' => $point,
        ]);
	}
	
}


