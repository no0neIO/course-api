<?php

namespace App\Service;

use App\Entity\Course;
use App\Repository\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;

class CourseService implements CourseServiceInterface
{
    private $entityManager;
    private $courseRepository;

    public function __construct(EntityManagerInterface $entityManager, CourseRepository $courseRepository) {
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

}