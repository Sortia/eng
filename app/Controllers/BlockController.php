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
        $block_name = $_REQUEST['block_name'];

        Block::create($block_name);
    }

    public function postUpdate()
    {
        $status = $_REQUEST['status'] === "true" ? 1 : 0;
        $block_id = $_REQUEST['block_id'];

        Block::update($status, $block_id);
    }

    public function postDelete()
    {
        $block_name = $_REQUEST['del_block'];

        Block::delete($block_name);
    }
}