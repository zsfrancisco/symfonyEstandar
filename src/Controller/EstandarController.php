<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Producto;
use App\Entity\Categoria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class EstandarController extends AbstractController
{
    /**
     * @Route("/estandar", name="estandar")
     */
    public function index()
    {
        return $this->render('estandar/index.html.twig', [
            'controller_name' => 'EstandarController',
        ]);
    }

    /**
     * @Route("/acerca/{nombre}", name="acerca")
     */
    public function acerca($nombre)
    {
        $num1 = 10;
        $num2 = 1;
        $suma = $num1 + $num2;
        return $this->render('estandar/acerca.html.twig', [
            'parametro' => $nombre,
            'suma' => $suma,
            'nombre' => 'Francisco,Javier,Zambrano,Santacruz',
        ]);
    }

    /**
     * @Route("/producto", name="producto")
     */
    public function createProducto(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        //$categoria = new Categoria('Juegos');

        //$producto = new Producto('Nevera', '100');
        //$producto1 = new Producto('pes', '2019');
        //$producto2 = new Producto('fifa', '20');
        //$producto->setCategoria($categoria);
        //$producto1->setCategoria($categoria);
        //$producto2->setCategoria($categoria);
        //$producto->setNombre('Xbox');
        //$producto->setCodigo('2019');

        $entityManager->persist($producto);
        //$entityManager->persist($producto1);
        //$entityManager->persist($producto2);

        $entityManager->flush();

        return new Response('A guardado un nuevo producto con el id: '.$producto->getId());
    }

    /**
     * @Route("/busqueda/{parametro}", name="busqueda")
     */
    public function buscarProducto($parametro)
    {
        $repositorio = $this->getDoctrine()->getRepository(Producto::class);
        
        //$productos = $repositorio->findBy([
        //    'codigo' => $parametro
        //    ]);
        

        $prodRepo = $this->getDoctrine()->getRepository(Producto::class)
        ->buscarPorId($parametro);

        //$nombre_producto = $productos->getNombre();
        //$categoryName = $productos->getCategoria()->getNombreCategoria();
        //return $this->render('estandar/busqueda.html.twig', [
        //    'nombre_categoria' => $categoryName,
        //    'nombre_producto' => $nombre_producto,
        //]);
        return $this->render('estandar/busqueda.html.twig', [
            'buscarPorCodigo' => $prodRepo,
        ]);
    }

    /**
     * @Route("/buscarPacho", name="buscarPacho")
     */
    public function buscarDos()
    {
        $repositorio = $this->getDoctrine()->getRepository(Producto::class);
        
        $productos = $repositorio->findAll();
        
        return $this->render('estandar/busquedaDos.html.twig', [
            'productos' => $productos,
        ]);
    }

    /**
     * @Route("/buscarCategoria/{parametro}", name="buscarCategoria")
     */
    public function buscarCate($parametro)
    {
        $repositorio = $this->getDoctrine()->getRepository(Producto::class);
        
        $prodRepo = $this->getDoctrine()->getRepository(Producto::class)
        ->buscarPorCategoria($parametro);
        
        return $this->render('estandar/busquedaCate.html.twig', [
            'buscarPorCategoria' => $prodRepo,
        ]);
    }

}
