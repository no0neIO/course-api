<?php

namespace App\Controller;

use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Course;
use App\Service\CourseServiceInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/courses')]
class CourseController extends AbstractController
{
    private $courseService;
    private $validator;

    public function __construct(
        CourseServiceInterface $courseService,
        ValidatorInterface $validator
    ) {
        $this->courseService = $courseService;
        $this->validator = $validator;
    }

    #[Route('', methods: ['GET'])]
    public function index(): Response
    {
        $courses = $this->courseService->getAllCourses();
        return $this->json($courses);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function show($id): Response
    {
        $course = $this->courseService->getCourse($id);
        if (!$course) {
            throw $this->createNotFoundException('Course not found');
        }

        return $this->json($course);
    }
}
