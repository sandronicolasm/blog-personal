<?php

namespace App\Admin;

use App\Entity\BlogPost;
use App\Entity\Category;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\Form\Type\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class BlogPostAdmin extends AbstractAdmin
{
  protected function configureFormFields(FormMapper $formMapper)
  {
    $formMapper
      ->tab('Post')
        ->with('Contenido', ['class' => 'col-md-12'])
        ->add('title', TextType::class)
        ->add('body', CKEditorType::class, [
//          'config' => [
//            'toolbar' => [
//              [
//                'name' => 'links',
//                'items' => ['Link', 'Unlink'],
//              ],
//              [
//                'name' => 'insert',
//                'items' => ['Image'],
//              ],
//            ],
//          ],
        ])
        ->end()
      ->end()
      ->tab('Categoría')
        ->with('Categoría', ['class' => 'col-md-12'])
        ->add('category', ModelType::class, [
          'class' => Category::class,
          'property' => 'name',
        ])
        ->end()
      ->end()
    ;
  }

  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
  {
    $datagridMapper
      ->add('title')
      ->add('category', null, [], EntityType::class, [
        'class' => Category::class,
        'choice_label' => 'name',
      ])
    ;
  }

  protected function configureListFields(ListMapper $listMapper)
  {
    $listMapper
      ->addIdentifier('title')
      ->add('category.name')
      ->add('draft')
    ;
  }

  public function toString($object)
  {
    return $object instanceof BlogPost
      ? $object->getTitle()
      : 'Post'; // shown in the breadcrumb on the create view
  }
}