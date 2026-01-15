<?php

namespace App\Controller\Admin;

use App\Entity\Task;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TaskCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Task::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInSingular('Tâche')
            ->setEntityLabelInPlural('Tâches');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add('category')
            ->add('isDone');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            BooleanField::new('isDone', 'Fait'),
            AssociationField::new('category')->autocomplete(),
            DateTimeField::new('createdAt', 'Création')->hideOnForm()
        ];
    }

    /**
     * Undocumented function
     *
     * @param EntityManagerInterface $entityManager
     * @param Task $entityInstance
     * @return void
     */
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setCreatedAt(new DateTimeImmutable());
        parent::persistEntity($entityManager, $entityInstance);
    }
}
