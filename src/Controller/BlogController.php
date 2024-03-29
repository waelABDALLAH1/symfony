<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;                                           
use App\Form\ArticleType;
use App\Form\ContactType;
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
     * @Route("/blog/{id}/edit", name="bloc_create")
     */
    public function form(Article $article = null  , Request $request , ObjectManager $manager    ){
        
        if (!$article){
            $article = new Article();
        }

        // $form=$this->createFormBuilder($article)
        //            ->add('title',TextType::class,[
        //             'attr' => [
        //                 'placeholder' =>"titre",
        //             ]
        //            ] )
        //            ->add('content',TextType::class,[
        //             'attr' => [
        //                 'placeholder' =>"contenu",
        //             ]
        //            ])
        //            ->add('image',TextType::class,[
        //             'attr' => [
        //                 'placeholder' =>"L'URL de l'image",
        //             ]
        //            ])
        //            ->add('save ', SubmitType::class, [
        //             'label' =>'Enregistrer '
        //            ])
                   
        //            ->getForm();

        $form= $this->createForm(ArticleType::class, $article );
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            if(!$article->getId()){
                $article->setCreatedat( new \DateTime());
            }
            

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('blog_show',['id' => $article->getId()]);

        }
        
        return $this->render('blog/create.html.twig', [
            'formArticle'=> $form->createView() ,
            'editMode'=>  $article->getId() !== null                                        


        ]);
     
    }


     /**
     * @Route("/blog/contact", name="blog_contact")
     */
    public function form1(Contact $contact = null  , Request $request , ObjectManager $manager    ){
        
        if (!$contact){
            $contact = new Contact();
        }

        

        $form= $this->createForm(ContactType::class, $contact );
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            

            $manager->persist($contact);
            $manager->flush();

            return $this->redirectToRoute('blog_showContact');

        }
        
        return $this->render('blog/contact.html.twig', [
            'formContact'=> $form->createView()                    


        ]);
     
    }



 
     /**
     * @Route("/blog/showcontact", name="blog_showContact")
     */
     public function showcontact()
     {
     $repo = $this->getDoctrine()->getRepository(Contact::class);
     $contact= $repo->findAll();

     return $this->render('blog/showcontact.html.twig', [
        'contact' => $contact,
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


