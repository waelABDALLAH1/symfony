<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
                                             

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(): Response
    {
        $repo= $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    
    }
    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('blog/home.html.twig');
    }

    /**
     * @Route("/blog/new", name="blog_create")
     */
    public function create(Request $request , ObjectManager $manager    ){
        
        $article=new Article(); 

        $form=$this->createFormBuilder($article)
                   ->add('title',TextType::class,[
                    'attr' => [
                        'placeholder' =>"titre",
                        'class'=>'form-control'
                    ]
                   ] )
                   ->add('content',TextType::class,[
                    'attr' => [
                        'placeholder' =>"contenu",
                        'class'=>'form-control'
                    ]
                   ])
                   ->add('image',TextType::class,[
                    'attr' => [
                        'placeholder' =>"image",
                        'class'=>'form-control'
                    ]
                   ])
                   ->getForm();
        
        return $this->render('blog/create.html.twig', [
            'formArticle'=> $form->createView()                                         


        ]);
     
    }

    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show($id){
        $repo= $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->find($id);
        return $this->render('blog/show.html.twig',[
            'article' => $article

        ]);
    }
    
    
}
