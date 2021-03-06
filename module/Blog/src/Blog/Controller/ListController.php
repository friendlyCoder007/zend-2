<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Blog\Service\PostServiceInterface;

class ListController extends AbstractActionController{
 
    
    /**
      * @var \Blog\Service\PostServiceInterface
      */
    
    
    protected $postService;
    
    
    public function __construct(PostServiceInterface $postService){
        
     $this->postService = $postService;   
        
        
    }
    
    
    
    public function indexAction()
    {
        
        return array(
            
        'posts' => $this->postService->findAllPosts()    
            
        );
        
    }
    
    
    
  public function detailAction()
     {
         $id = $this->params()->fromRoute('id');

         try {
             $post = $this->postService->findPost($id);
         } catch (\InvalidArgumentException $ex) {
             return $this->redirect()->toRoute('post');
         }

         return new ViewModel(array(
             'post' => $post
         ));
     }
    
    
    
}
