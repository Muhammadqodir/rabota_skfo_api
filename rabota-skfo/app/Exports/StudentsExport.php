<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if(Auth::user()->role != 'university'){
            return abort(403, 'Unauthorized action.');
        }
        $univer_id = Auth::user()->getDetails()->id;
        $customer_data = User::select('users.*')->join('students', 'students.id', '=', 'users.details')->where('users.role', 'student')->where('students.university_id', $univer_id)->get();
        $customer_array[] = array('Ф.И.О.', 'Регион', 'Универтитет', 'Дата рождения', 'Почта', 'Номер телефона', 'Должность', 'Навыки');
        foreach($customer_data as $customer)
        {
            $student_data = array(
                'Ф.И.О'  => $customer->name,
                'Регион'  => $customer->getRegionName(),
                'Универтитет'   => $customer->getDetails()->university_id != -1 ? $customer->getDetails()->getUniversity()->fullName : '',
                'Дата рождения'    => $customer->getDetails()->bday,
                'Почта'  => $customer->email,
                'Номер телефона'   => $customer->phone
            );
            if($customer->getDetails()->hasResume()){
                $student_data['Должность'] = $customer->getDetails()->getResume()->position;
                $student_data['Навыки'] = $customer->getDetails()->getResume()->getSkillsString();
            }
            $customer_array[] = $student_data;
        }
        return collect($customer_array);
    }
}
