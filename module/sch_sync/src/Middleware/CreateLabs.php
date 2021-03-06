<?php
/**
 * gredu_labs.
 *
 * @link https://github.com/eellak/gredu_labs for the canonical source repository
 *
 * @copyright Copyright (c) 2008-2015 Greek Free/Open Source Software Society (https://gfoss.ellak.gr/)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace SchSync\Middleware;

use GrEduLabs\Schools\Service\LabServiceInterface;
use RedBeanPHP\R;
use Slim\Http\Request;
use Slim\Http\Response;
use Zend\Authentication\AuthenticationServiceInterface;

class CreateLabs
{
    /**
     *
     * @var LabServiceInterface
     */
    protected $labService;

    /**
     *
     * @var callable
     */
    protected $syncFromInventory;
    /**
     *
     * @var AuthenticationServiceInterface
     */
    protected $authService;

    public function __construct(
        LabServiceInterface $labService,
        callable $syncFromInventory,
        AuthenticationServiceInterface $authService

    ) {
        $this->labService        = $labService;
        $this->syncFromInventory = $syncFromInventory;
        $this->authService       = $authService;
    }

    public function __invoke(Request $req, Response $res, callable $next)
    {
        $res = $next($req, $res);

        $identity = $this->authService->getIdentity();
        if (null === $identity) {
            return $res;
        }
        $user = R::load('user', $identity->id);
        if (!$user->school_id) {
            return $res;
        }

        $school_id = $user->school_id;

        if (0 < count($this->labService->getLabsBySchoolId($school_id))) {
            return $res;
        }
        $sync = $this->syncFromInventory;
        $sync($school_id);

        return $res;
    }
}
