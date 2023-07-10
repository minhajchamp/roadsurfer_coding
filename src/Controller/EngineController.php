<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\StorageService;
use Symfony\Component\HttpKernel\KernelInterface;
class EngineController extends AbstractController
{
    // public function index(): JsonResponse
    // {
    //     return $this->json([
    //         'message' => 'Welcome to your new controller!',
    //         'path' => 'src/Controller/EngineController.php',
    //     ]);
    // }

    private $appKernel;
    public function __construct(KernelInterface $appKernel) 
    {
        $this->appKernel = $appKernel;
    }

    #[Route('/', name: 'app_engine')]
    public function index()
    {
        // Instantiate storage service
        $storageService = new StorageService();
        // Fetch data from JSON file situated at root
        $jsonData =  file_get_contents($this->appKernel->getProjectDir().'/request.json');
        // Process the data and create collections
        $collections = $storageService->createCollectionsFromJson($jsonData);
        // Access the fruits and vegetables collections
        $fruits = $collections['fruits'];
        $vegetables = $collections['vegetables'];
        echo '<pre>';
        echo '======Fruits======';
        echo '</br>';
        print_r($fruits);
        echo '======Vegs======';
        echo '</br>';
        print_r($vegetables);
        // Return a response
        return new Response('File processed successfully.');
    }
}
