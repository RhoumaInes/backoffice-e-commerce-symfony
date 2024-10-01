<?php

namespace App\Test\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ProductRepository $repository;
    private string $path = '/product/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
      
    }

    public function testIndex(): void
    {
       
        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
    }

    public function testShow(): void
    {
        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
       
    }

    public function testRemove(): void
    {
        
    }
}
