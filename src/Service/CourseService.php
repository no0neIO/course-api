<?php

namespace App\Service;

use App\Entity\Course;
use App\Repository\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;

class CourseService implements CourseServiceInterface
{
    private $entityManager;
    private $courseRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        CourseRepository $courseRepository
    ) {
        $this->entityManager = $entityManager;
        $this->courseRepository = $courseRepository;
    }

    public function getCourse(int $id): ?Course
    {
        return $this->courseRepository->find($id);
    }

    public function getAllCourses(): array
    {
        return $this->courseRepository->findAll();
    }

    public function createCourse(array $data): Course
    {
        $course = new Course();
        $course->setTitle($data['title']);
        $course->setDescription($data['description'] ?? null);
        $course->setStatus($data['status']);
        $course->setIsPremium($data['is_premium']);
        $this->entityManager->persist($course);
        $this->entityManager->flush();

        return $course;
    }

    public function updateCourse(Course $course, array $data): Course
    {
        $course->setTitle($data['title']);
        $course->setDescription($data['description'] ?? null);
        $course->setStatus($data['status']);
        $course->setIsPremium($data['is_premium']);
        $this->entityManager->flush();

        return $course;
    }

    public function deleteCourse(Course $course): void
    {
        // $this->entityManager->remove($course);
        $course->setDeletedAt(new \DateTime());
        $this->entityManager->flush();
    }
}