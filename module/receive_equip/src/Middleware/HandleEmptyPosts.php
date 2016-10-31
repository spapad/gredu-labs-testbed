<?php

/**
 * gredu_labs.
 *
 * @link https://github.com/eellak/gredu_labs for the canonical source repository
 *
 * @copyright Copyright (c) 2008-2015 Greek Free/Open Source Software Society (https://gfoss.ellak.gr/)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace GrEduLabs\ReceiveEquip\Middleware;

use GrEduLabs\ReceiveEquip\Service\ReceiveEquipServiceInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;


class HandleEmptyPosts
{
    /**
     *
     * @var Twig
     */
    protected $view;
    protected $container;

    /**
     *
     * @var ReceiveEquipServiceInterface
     */
    protected $receiveEquipService;

    /**
     *
     * @var flash messages
     */
    protected $flash;


    public function __construct(Twig $view, ReceiveEquipServiceInterface $receiveEquipService, $flash, $container)
    {
        $this->view           = $view;
        $this->receiveEquipService     = $receiveEquipService;
        $this->flash                   = $flash;
        $this->container = $container;
    }

    public function __invoke(Request $req, Response $res, callable $next)
    {
        $school = $req->getAttribute('school');

        $this->container["logger"]->info(sprintf(
                                    'hello from middleware'
                                ));

        if(empty($_FILES) && empty($_POST) && isset($_SERVER['REQUEST_METHOD']) && strtolower($_SERVER['REQUEST_METHOD']) == 'post'){ //catch file overload error...
            $postMax = ini_get('post_max_size'); //grab the size limits...
            $this->flash->addMessage('danger', "Αποστείλατε αρχείο με μέγεθος ανώτερο του επιτρεπτού");
            if (null !== ($receiveEquip = $this->receiveEquipService->findSchoolReceiveEquip($school->id))) {
                    $this->view['form'] = [
                    'school' => $school,
                    'exists' => true,
                    'values' => $receiveEquip,
                ];
            } else {
                $this->view['form'] = [
                    'school' => $school,
                    'exists' => false,
                    'values' => null,
                ];
            }
            $res = $this->view->render($res, 'receive_equip/form.twig', [
            ]);
            return $res;
        }
        else {
            return $next($req, $res);
        }

    }
}
