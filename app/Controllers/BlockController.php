<?php

namespace Controllers;

use App\Models\Block;

class BlockController extends Controller
{
    public function get()
    {
        $blocks = Block::read();

        view('blocks', ['blocks' => $blocks]);
    }

    public function postCreate()
    {
        $block_name = $this->request['block_name'];

        $block = Block::create($block_name);

        response($block);
    }

    public function postUpdate()
    {
        $this->request['status'] = $this->request['status'] === "true" ? 1 : 0;

        unset($this->request['path']);

        $block = Block::update($this->request);

        response($block);
    }

    public function postDelete()
    {
        $block_id = $this->request['block_id'];

        $block = Block::delete($block_id);

        response($block);
    }
}