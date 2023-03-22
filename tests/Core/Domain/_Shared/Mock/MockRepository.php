<?php

namespace Tests\Core\Domain\_Shared\Mock;

class MockRepository
{
    protected $observers = [];

    public function __construct($observer = null)
    {
        $this->observers[] = $observer;    
    }

    public function spyCreate($input)
    {
        foreach ($this->observers as $observer) {
            $observer->create($input);
        }
    }

    public function spyUpdate($input)
    {
        foreach ($this->observers as $observer) {
            $observer->update($input);
        }
    }

    public function spyFind(string $id)
    {
        foreach ($this->observers as $observer) {
            $observer->find($id);
        }
    }

    public function spyFindAll(int $pagination)
    {
        foreach ($this->observers as $observer) {
            $observer->findAll($pagination);
        }
    }
}
