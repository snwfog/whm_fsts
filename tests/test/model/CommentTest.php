<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\Comment;

class CommentTest extends PHPUnit_Framework_TestCase
{
    public function testgetId()
    {
        $comment = new Comment();
        $comment->setId(123456789);
        $this->assertEquals(
                            123456789, 
                            $comment->getId()
                            );
    }


    public function testsetId()
    {
        $comment = new Comment();
        $comment->setId(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($comment, "id")
                            );
    }

    public function testgetContent()
    {
        $comment = new Comment();
        $comment->setContent(123456789);
        $this->assertEquals(
                            123456789, 
                            $comment->getContent()
                            );
    }

        public function testsetContent()
    {
        $comment = new Comment();
        $comment->setContent(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($comment, "content")
                            );
    }

    public function testgetFlags()
    {
        $comment = new Comment();
        $comment->setFlags(123456789);
        $this->assertEquals(
                            123456789,  
                            $comment->getFlags()
                            );
    }

    public function testsetFlags()
    {
        $comment = new Comment();
        $comment->setFlags(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($comment, "flags")
                            );
    }
}
