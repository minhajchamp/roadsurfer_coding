<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Service\FruitService;
use App\Service\VegetableService;
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
        // Instantiate both services
        $fruitService = new FruitService();
        $vegService = new VegetableService();
        // Fetch data from JSON file situated at root
        $jsonData =  file_get_contents($this->appKernel->getProjectDir() . '/request.json');
        // Process the data and create collections
        $fruitsResult = $fruitService->processData($jsonData);
        $vegsResult = $vegService->processData($jsonData);
        // Access the fruits and vegetables collections
        echo '<pre>';
        echo '======Fruits======';
        echo '</br>';
        print_r($fruitsResult);
        echo '======Vegs======';
        echo '</br>';
        print_r($vegsResult);
        // Return a response
        return new Response('File processed successfully.');
    }
}
