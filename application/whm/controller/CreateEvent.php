<?
namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\Event;

class CreateEvent extends Controller implements IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());

    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //WHM\Helper::backtrace();
    }

    public function get()
    {
        $this->display("event.create.twig");
    }

    public function post()
    {

    }

    public function put()
    {
    }

}
