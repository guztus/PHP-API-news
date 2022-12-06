<?php declare(strict_types=1);

namespace App;

use App\Services\Register\RegisterService;
use App\ViewVariables\AlertsViewVariables;
use App\ViewVariables\AuthViewVariables;
use App\ViewVariables\ErrorsViewVariables;
use App\ViewVariables\ViewVariables;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigLoader
{
    private Environment $twig;

    public function __construct()
    {
        // Twig
        $loader = new FilesystemLoader('views');
        $this->twig = new Environment($loader);
    }

    public function getTwig(): Environment
    {
        $this->addGlobals();
        return $this->twig;
    }

    private function addGlobals()
    {
        if (!$_SESSION) {
            $currentUser = (new RegisterService())->currentUserData(null);
            $_SESSION['auth_id'] = $currentUser->getId();
        } else {
            $authVariables = [
                AuthViewVariables::class,
                ErrorsViewVariables::class,
                AlertsViewVariables::class
            ];

            foreach ($authVariables as $variable) {
                /**  @var ViewVariables $variable */
                $variable = new $variable;
                $this->twig->addGlobal($variable->getName(), $variable->getValue());
            }
        }
    }
}