<?php

namespace App\Models;

class Classroom
{
    // Fake database
    protected static $data = [
        'students' => [
            ['name' => 'John Doe', 'age' => 20, 'id' => 1],
            ['name' => 'Jane Smith', 'age' => 22, 'id' => 2],
            ['name' => 'Sam Brown', 'age' => 19, 'id' => 3],
        ],
        'teachers' => [
            ['name' => 'Mr. Adams', 'subject' => 'Math', 'id' => 1],
            ['name' => 'Ms. Johnson', 'subject' => 'Science', 'id' => 2],
            ['name' => 'Mrs. Brown', 'subject' => 'English', 'id' => 3]
        ]
    ];

    public static function getStudents()
    {
        return self::$data['students'];
    }

    public static function getTeachers()
    {
        return self::$data['teachers'];
    }
    // Get teacher by ID
    public static function getTeacherById($id)
    {
        foreach (self::$data['teachers'] as $teacher) {
            if ($teacher['id'] == $id) {
                return $teacher;
            }
        }
        return null;
    }

    // Get student by ID
    public static function getStudentById($id)
    {
        foreach (self::$data['students'] as $student) {
            if ($student['id'] == $id) {
                return $student;
            }
        }
        return null;
    }
   // Delete student by ID
   public static function deleteStudentById($id)
   {
       $index = array_search($id, array_column(self::$data['students'], 'id'));
       if ($index !== false) {
           array_splice(self::$data['students'], $index, 1);
           return true;
       }
       return false;
   }

   // post student get by required fields 
    public static function createStudent($name, $age)
    {
         // Check for conflicting ID
         foreach (self::$data['students'] as $student) {
              if ($student['name'] == $name) {
                return false;
              }
         }
         $newStudent = [
              'name' => $name,
              'age' => $age,
              'id' => count(self::$data['students']) + 1
         ];
         self::$data['students'][] = $newStudent;
         return true;
    }

   // Create teacher
   public static function createTeacher($newTeacher)
   {
       // Check for conflicting ID
       foreach (self::$data['teachers'] as $teacher) {
           if ($teacher['id'] == $newTeacher['id']) {
               return false;
           }
       }
       self::$data['teachers'][] = $newTeacher;
       return true;
   }

   // Edit student by ID
   public static function editStudentById($id, $updates)
   {
       $index = array_search($id, array_column(self::$data['students'], 'id'));
       if ($index !== false) {
           self::$data['students'][$index] = array_merge(self::$data['students'][$index], $updates);
           return self::$data['students'][$index];
       }
       return null;
   }

   // Edit teacher by ID
    public static function editTeacherById($id, $updates)
    {
         $index = array_search($id, array_column(self::$data['teachers'], 'id'));
            // Check for conflicting ID
             if ($index !== false) {
              self::$data['teachers'][$index] = array_merge(self::$data['teachers'][$index], $updates);
              return self::$data['teachers'][$index];
         }
         return null;
    }
}