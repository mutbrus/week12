<?php

use Illuminate\Support\Facades\Route;
use App\Models\Classroom;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/students', function() {
    $students = Classroom::getStudents();
    return response()->json($students);
});

Route::get('/teachers', function() {
    $teachers = Classroom::getTeachers();
    return response()->json($teachers);
});

Route::get('/students/{id}', function($id) {
    $student = Classroom::getStudentById($id);
    return response()->json($student ?? ['message' => 'Student not found'], $student ? 200 : 404);
});

Route::get('/teachers/{id}', function($id) {
    $teacher = Classroom::getTeacherById($id);
    return response()->json($teacher ?? ['message' => 'Teacher not found'], $teacher ? 200 : 404);
});

Route::post('/students', function() {
    $body = request()->all();
    $student = Classroom::createStudent($body['name'], $body['age']);
    return response()->json(['message' => 'Student created', 'data' => $student]);
});

Route::post('/teachers', function() {
    $body = request()->all();
    $teacher = Classroom::createTeacher($body['name'], $body['subject']);
    return response()->json(['message' => 'Teacher created', 'data' => $teacher]);
});

Route::patch('/students/{id}', function($id) {
    $body = request()->all();
    $student = Classroom::editStudentById($id, $body['name'], $body['age']);
    return response()->json($student ?? ['message' => 'Student not found'], $student ? 200 : 404);
});

Route::put('/teachers/{id}', function($id) {
    $body = request()->all();
    // Assuming you want to update the teacher's name and subject
    // You can adjust this as per your requirements
    // For example, if you want to update the teacher's name and subject
    // $teacher = Classroom::editTeacherById($id, $body['name'], $body['subject']);
    $teacher = Classroom::editTeacherById($id, $body['name'], $body['subject']);
    return response()->json($teacher ?? ['message' => 'Teacher not found'], $teacher ? 202 : 404);
});

Route::delete('/students/{id}', function($id) {
    $deleted = Classroom::deleteStudentById($id);
    return response()->json(['message' => $deleted ? 'Student deleted' : 'Student not found'], $deleted ? 200 : 404);
});
