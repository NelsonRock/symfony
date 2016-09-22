<?php 

namespace TS\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TS\PlatformBundle\Entity\Advert;

class AdvertController extends Controller
{
    //Ajouté à TSCoreBundle::layout.index.html
    public function menuAction($limit)
    {
        $listAdverts = array(
            array('id' => 2, 'title' => 'Se busca desarrollador symfony'),
            array('id' => 3, 'title' => 'Mision de webmaster'),
            array('id' => 4, 'title' => 'Oferta de stage webDesiner')
        );
        return $this->render('TSPlatformBundle:Advert:menu.html.twig',
        array('listAdverts' => $listAdverts)
        );  
    }
    public function indexAction($page)
    {
        //$url = $this->get('router')->generate('ts_platform_view', array('id' => 34));
        //$content = $this->get('templating')->render('TSPlatformBundle:Advert:index.html.twig', array('nom' => 'Nelsao101'));
        //return new Response($content);
        //return new Response('La url del anuncio id 34 es:'.$url );
        $listAdverts = array(
            array(
                'title' => 'Se busca desarrollador ASP',
                'id' => 1,
                'author' => 'Privado Agencia',
                'content' => 'Horarios flexibles',
                'date' => new \Datetime()
            ),
            array(
                'title' => 'Se busca desarrollador GO',
                'id' => 2,
                'author' => 'Nelson',
                'content' => 'Proponemos beneficios',
                'date' => new \Datetime()
            ),
            array(
                'title' => 'Se busca desarrollador NoldeJS',
                'id' => 3,
                'author' => 'Europa',
                'content' => 'PRopnemos beneficios',
                'date' => new \Datetime()
            )
        );
        
        if ($page < 1 ) {
            throw new NotFoundHttpException('Page "'.$page.'" no existe');
        }

        return $this->render('TSPlatformBundle:Advert:index.html.twig', array('listAdverts' => $listAdverts) );
    
    }

    /*Method para practicar templating y Response*/
    /*public function babyAction()
    {
        $content = $this->get('templating')->render('TSPlatformBundle:Advert:baby.html.twig');
        return new Response($content);
    }*/

    public function viewAction($id, Request $request)
    {
        //$tag = $request->query->get('tag');
        //$content = $this->get('templating')->render('TSPlatformBundle:Advert:advert.html.twig', array('advert_id' => $id));        return new Response($content);
        /*
            Diferentes formas de enviar una Response
        */
        //return new Response('El numero del anuncio id: '.$id.' con el tag '.$tag);
        /*return $this->get('templating')->renderResponse(
            'TSPlatformBupndle:Advert:view.html.twig',
            array('id' => $id, 'tag' => $tag)
            );*/
        //Este ultimo lo usaremos siempre
        
        $advert = array(
                'title' => 'Se busca desarrollador GO',
                'id' => $id,
                'author' => 'Nelson',
                'content' => 'Proponemos beneficios',
                'date' => new \Datetime()
            );
        return $this->render('TSPlatformBundle:Advert:view.html.twig', array('advert' => $advert));
        
    }

    public function viewSlugAction($slug, $year, $_format)
    {
        return new Response('<body>Podriamos abrir el anuncio conrrespondiente
        al slug '.$slug.' creado en '.$year.' et en el formato '.$_format.'</body>');
    }

    public function addAction(Request $request)
    {
        /*$session = $request->getSession();

        $session->getFlashBag()->add('info','Este es el primer info');

        $session->getFlashBag()->add('info', 'Este el seguncto info');
        */
        /**
        * Ejemplo con Doctrine
        */
        $advert = new Advert();
        $advert->setTitle('Busque desarrollador Symfony Urgente');
        $advert->setAuthor('Agencia Privada');
        $advert->setContent('Explotamos a todos los desarrolladores y pagamos muy mal');
        $advert->setPublished(true);
        /**
        * Manejamos la entidad 
        */
        $em = $this->getDoctrine()->getManager();
        $em->persist($advert);
        $em->flush();


        if ($request->isMethod('POST')) {
            
            $request->getSession()->getFlashBag()->add('notice', 'Anuncio bien registrado');

            return $this->redirectToRoute('ts_platform_view', array('id' => $advert->getId()));
        }
        return $this->render('TSPlatformBundle:Advert:add.html.twig');
    }
     public function editAction($id, Request $request)
     {
        if ($request->isMethod('POST')) {
            
            $request->getSession()->getFlashBag()->add('notice', 'Anuncio bien modificado');

            return $this->redirectToRoute('ts_platform_view', array('id' => 5));
        }
        return $this->render('TSPlatformBundle.Advert:edit.html.view');
     }

     public function deleteAction($id)
     {
         return $this->render('TSPlatformBundle:Advert:delete.html.twig');
     }

}