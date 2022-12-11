<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Student;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // if ($request->ajax()) {
        //     $answer = Answer::create([
        //         'stu_id' => $request->input('student_id'),
        //         'question' => $request->input('question'),
        //         'given_answer' => $request->input('answer'),
        //         'true_answer' => $request->input('true_answer')
        //     ]);
        //     if ($request->input('answer') == $request->input('true_answer')) {
        //         $insert=Student::where('id',$request->input('student_id'))->increment('score');
        //     }
        //     return response($answer);
        // }else{
        //     return "ajax not done";
        // }

        $stu_id = $_POST['student_id'];
        $questions = $_POST['question'];

        $true_answer = $_POST['true_answer'];
        $given_answer = [];
        
        if(!isset($_POST['submit'])) {
            return "Failed";
        }

        for ($i = 0; $i < sizeof($questions); $i++) {
            $cmp = "answer" . $i;
            $given_answer[] = $_POST[$cmp];
        }
        // dd($given_answer);
        
        foreach ($questions as $i => $question) {
            // echo $question;
            // echo $stu_id;
            // echo $true_answer[$i];
            // echo '</br>';
            $answer = Answer::create([
                'stu_id' => $stu_id,
                'question' => $question,
                'given_answer' => $given_answer[$i],
                'true_answer' => $true_answer[$i]
            ]);

            if ($given_answer[$i] == $true_answer[$i]) {
                Student::where('id', $stu_id)->increment('score');
            }
        }

        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
