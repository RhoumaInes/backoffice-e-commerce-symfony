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
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Product::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Product index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'product[title]' => 'Testing',
            'product[summary]' => 'Testing',
            'product[description]' => 'Testing',
            'product[totalQuantity]' => 'Testing',
            'product[minimumQuantityForSale]' => 'Testing',
            'product[unit]' => 'Testing',
            'product[reference]' => 'Testing',
            'product[createdAt]' => 'Testing',
            'product[updatedAt]' => 'Testing',
        ]);

        self::assertResponseRedirects('/product/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Product();
        $fixture->setTitle('My Title');
        $fixture->setSummary('My Title');
        $fixture->setDescription('My Title');
        $fixture->setTotalQuantity('My Title');
        $fixture->setMinimumQuantityForSale('My Title');
        $fixture->setUnit('My Title');
        $fixture->setReference('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Product');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Product();
        $fixture->setTitle('My Title');
        $fixture->setSummary('My Title');
        $fixture->setDescription('My Title');
        $fixture->setTotalQuantity('My Title');
        $fixture->setMinimumQuantityForSale('My Title');
        $fixture->setUnit('My Title');
        $fixture->setReference('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'product[title]' => 'Something New',
            'product[summary]' => 'Something New',
            'product[description]' => 'Something New',
            'product[totalQuantity]' => 'Something New',
            'product[minimumQuantityForSale]' => 'Something New',
            'product[unit]' => 'Something New',
            'product[reference]' => 'Something New',
            'product[createdAt]' => 'Something New',
            'product[updatedAt]' => 'Something New',
        ]);

        self::assertResponseRedirects('/product/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getSummary());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getTotalQuantity());
        self::assertSame('Something New', $fixture[0]->getMinimumQuantityForSale());
        self::assertSame('Something New', $fixture[0]->getUnit());
        self::assertSame('Something New', $fixture[0]->getReference());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Product();
        $fixture->setTitle('My Title');
        $fixture->setSummary('My Title');
        $fixture->setDescription('My Title');
        $fixture->setTotalQuantity('My Title');
        $fixture->setMinimumQuantityForSale('My Title');
        $fixture->setUnit('My Title');
        $fixture->setReference('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/product/');
    }
}
