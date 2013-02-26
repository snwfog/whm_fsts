<?
namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\ManageHousehold;
use WHM\Controller\Household;
use WHM\Model\Event;



class CreateHousehold extends Controller implements IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
     private $event;
    private $eventController;
 
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
      //  WHM\Helper::backtrace();
        $this->event = new Event();
   //     $this->eventController = new Event();
    }

    public function get()
    {
        $this->display("event.create.twig");
    }

    public function post()
    {
      /*if (isset($_POST))
        {
            $this->data["form"] = $_POST;
           

        }
        else
        {
            $this->display("household.create.twig");
        }*/
    }

    public function put()
    {
    }

}
