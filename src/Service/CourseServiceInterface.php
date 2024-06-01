<?php

namespace App\Service;

use App\Entity\Course;
interface CourseServiceInterface
{
    public function getCourse(int $id): ?Course;
    public function getAllCourses(): array;
//    public function createCourse(array $data): Course;
//    public function updateCourse(Course $course, array $data): Course;
//    public function deleteCourse(Course $course): Course;
}