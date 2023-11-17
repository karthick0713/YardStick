<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionBankController extends Controller
{
    public function manageQuestions(){
        $heading = "Questions Banks";
        $sub_heading = "Manage Questions";
        return view("admin.question-bank.manage-questions", compact("heading",'sub_heading'));  
    }

    public function addQuestions(){
        $heading = "Questions Banks";
        $sub_heading = "Add Questions";
        return view("admin.question-bank.add-questions", compact("heading",'sub_heading'));  
    }

    public function editQuestions(){
        $heading = "Questions Banks";
        $sub_heading = "Edit Questions";
        return view("admin.question-bank.edit-questions", compact("heading",'sub_heading'));  
    }

    public function uploadQuestions(){
        $heading = "Questions Banks";
        $sub_heading = "Upload Questions";
        return view("admin.question-bank.upload-questions", compact("heading",'sub_heading'));  
    }

    public function filterQuestions($skill){
        $heading = "Questions Banks";
        $sub_heading = $skill;
        return view("admin.question-bank.skillwise-questions", compact("heading",'sub_heading'));  
    }

    public function viewFilterQuestions(){
        $heading = "Questions Banks";
        $sub_heading = "View Questions";
        return view("admin.question-bank.view-filtered-questions", compact("heading",'sub_heading'));  
    }


}