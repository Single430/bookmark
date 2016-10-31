<?php

class LogoutController extends ControllerBase
{
    protected function initialize()
    {
        $this->tag->setTitle('注销');
        parent::initialize();
    }

    public function indexAction()
    {
        $this->session->remove('username');
        $this->session->destroy();
    }
}

