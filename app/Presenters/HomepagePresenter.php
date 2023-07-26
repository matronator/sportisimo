<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Database\Model\BrandRepository;
use Nette;
use Nette\Application\Attributes\Persistent;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    #[Persistent]
    public int $page = 1;

    #[Persistent]
    public string $sort = 'ASC';

    public function __construct(public BrandRepository $brandRepository)
    {
    }

    public function renderDefault(): void
    {
        $maxPages = (int) ceil($this->brandRepository->all()->count('*') / 5);
        $brands = $this->brandRepository->all()->order('id ' . $this->sort)->page($this->page, 5, $maxPages);

        $this->template->brands = $brands;
        $this->template->page = $this->page;
        $this->template->maxPages = $maxPages;
        $this->template->sort = $this->sort;
    }

    public function handleSetPage(int $page = 1): void
    {
        $this->page = $page;

        $this->redrawControl('wrapper');
        $this->redrawControl('pagination');
        $this->redrawControl('brands');
    }

    public function handleSetSort(bool $desc = false): void
    {
        $this->sort = $desc ? 'DESC' : 'ASC';

        $this->redrawControl('wrapper');
        $this->redrawControl('pagination');
        $this->redrawControl('brands');
    }

    public function handleDeleteBrand(int $id)
    {
        $this->brandRepository->remove($id);

        $this->redrawControl('wrapper');
        $this->redrawControl('pagination');
        $this->redrawControl('brands');
    }

    public function createComponentEditBrandForm(): Form
    {
        $form = new Form;

        $form->addText('name', 'Name')
            ->setRequired('Please enter brand name.');

        $form->addHidden('id', null);

        $form->addSubmit('save', 'Save');

        $form->onSuccess[] = [$this, 'editBrandFormSucceeded'];

        return $form;
    }

    public function editBrandFormSucceeded(Form $form, ArrayHash $values): void
    {
        $id = (int) $values['id'];
        unset($values['id']);

        if (!$id) {
            $this->brandRepository->add($values);
        } else {
            $this->brandRepository->update($id, $values);
        }
        
        $this->flashMessage('Brand was saved successfully.', 'success');

        if ($this->isAjax()) {
            $this->redrawControl('wrapper');
            $this->redrawControl('pagination');
            $this->redrawControl('brands');
        } else {
            $this->redirect('this');
        }
    }
}
