<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\CourseServiceInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

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
        $this->checkIfCourseExists($course);

        return $this->json($course);
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $violations = $this->validateData($data);
        if ($violations) {
            return $this->json($violations, Response::HTTP_BAD_REQUEST);
        }

        $course = $this->courseService->createCourse($data);
        return $this->json($course, Response::HTTP_CREATED);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update($id, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $course = $this->courseService->getCourse($id);
        $this->checkIfCourseExists($course);

        $violations = $this->validateData($data);
        if ($violations) {
            return $this->json($violations, Response::HTTP_BAD_REQUEST);
        }

        $this->courseService->updateCourse($course, $data);
        return $this->json($course);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete($id, Request $request): Response
    {
        $course = $this->courseService->getCourse($id);
        $this->checkIfCourseExists($course);

        $this->courseService->deleteCourse($course);
        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

    public function validateData($data): array
    {
        $errors = [];
        $constraints = new Assert\Collection([
            'title' => new Assert\NotBlank(),
            'description' => new Assert\Optional(new Assert\Type('string')),
            'status' => new Assert\Choice(['choices' => ['Published', 'Pending']]),
            'is_premium' => new Assert\Type('boolean'),
        ]);

        $violations = $this->validator->validate($data, $constraints);
        if (count($violations) > 0) {
            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()] = $violation->getMessage();
            }
        }

        return $errors;
    }

    public function checkIfCourseExists($course): void
    {
        if (!$course) {
            throw $this->createNotFoundException('Course not found');
        }
    }
}
