<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* nav.html.twig */
class __TwigTemplate_40f500f1bb76bda9d215ab50e3a8404622877c71e3c07c30728066bbc99bd185 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "nav.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "nav.html.twig"));

        // line 1
        echo "<!-- Navbar -->
<nav class=\"main-header navbar navbar-expand navbar-white navbar-light\">
<!-- Left navbar links -->
<ul class=\"navbar-nav\">
    <li class=\"nav-item\">
    <a class=\"nav-link\" data-widget=\"pushmenu\" href=\"#\" role=\"button\"><i class=\"fas fa-bars\"></i></a>
    </li>
    <li class=\"nav-item d-none d-sm-inline-block\">
    <a href=\"index3.html\" class=\"nav-link\">Home</a>
    </li>
    <li class=\"nav-item d-none d-sm-inline-block\">
    <a href=\"#\" class=\"nav-link\">Contact</a>
    </li>
</ul>

<!-- Right navbar links -->
<ul class=\"navbar-nav ml-auto\">
    <!-- Navbar Search -->
    <li class=\"nav-item\">
    <a class=\"nav-link\" data-widget=\"navbar-search\" href=\"#\" role=\"button\">
        <i class=\"fas fa-search\"></i>
    </a>
    <div class=\"navbar-search-block\">
        <form class=\"form-inline\">
        <div class=\"input-group input-group-sm\">
            <input class=\"form-control form-control-navbar\" type=\"search\" placeholder=\"Search\" aria-label=\"Search\">
            <div class=\"input-group-append\">
            <button class=\"btn btn-navbar\" type=\"submit\">
                <i class=\"fas fa-search\"></i>
            </button>
            <button class=\"btn btn-navbar\" type=\"button\" data-widget=\"navbar-search\">
                <i class=\"fas fa-times\"></i>
            </button>
            </div>
        </div>
        </form>
    </div>
    </li>

    <!-- Messages Dropdown Menu -->
    <li class=\"nav-item dropdown\">
    <a class=\"nav-link\" data-toggle=\"dropdown\" href=\"#\">
        <i class=\"far fa-comments\"></i>
        <span class=\"badge badge-danger navbar-badge\">3</span>
    </a>
    <div class=\"dropdown-menu dropdown-menu-lg dropdown-menu-right\">
        <a href=\"#\" class=\"dropdown-item\">
        <!-- Message Start -->
        <div class=\"media\">
            <img src=\"dist/img/user1-128x128.jpg\" alt=\"User Avatar\" class=\"img-size-50 mr-3 img-circle\">
            <div class=\"media-body\">
            <h3 class=\"dropdown-item-title\">
                Brad Diesel
                <span class=\"float-right text-sm text-danger\"><i class=\"fas fa-star\"></i></span>
            </h3>
            <p class=\"text-sm\">Call me whenever you can...</p>
            <p class=\"text-sm text-muted\"><i class=\"far fa-clock mr-1\"></i> 4 Hours Ago</p>
            </div>
        </div>
        <!-- Message End -->
        </a>
        <div class=\"dropdown-divider\"></div>
        <a href=\"#\" class=\"dropdown-item\">
        <!-- Message Start -->
        <div class=\"media\">
            <img src=\"dist/img/user8-128x128.jpg\" alt=\"User Avatar\" class=\"img-size-50 img-circle mr-3\">
            <div class=\"media-body\">
            <h3 class=\"dropdown-item-title\">
                John Pierce
                <span class=\"float-right text-sm text-muted\"><i class=\"fas fa-star\"></i></span>
            </h3>
            <p class=\"text-sm\">I got your message bro</p>
            <p class=\"text-sm text-muted\"><i class=\"far fa-clock mr-1\"></i> 4 Hours Ago</p>
            </div>
        </div>
        <!-- Message End -->
        </a>
        <div class=\"dropdown-divider\"></div>
        <a href=\"#\" class=\"dropdown-item\">
        <!-- Message Start -->
        <div class=\"media\">
            <img src=\"dist/img/user3-128x128.jpg\" alt=\"User Avatar\" class=\"img-size-50 img-circle mr-3\">
            <div class=\"media-body\">
            <h3 class=\"dropdown-item-title\">
                Nora Silvester
                <span class=\"float-right text-sm text-warning\"><i class=\"fas fa-star\"></i></span>
            </h3>
            <p class=\"text-sm\">The subject goes here</p>
            <p class=\"text-sm text-muted\"><i class=\"far fa-clock mr-1\"></i> 4 Hours Ago</p>
            </div>
        </div>
        <!-- Message End -->
        </a>
        <div class=\"dropdown-divider\"></div>
        <a href=\"#\" class=\"dropdown-item dropdown-footer\">See All Messages</a>
    </div>
    </li>
    <!-- Notifications Dropdown Menu -->
    <li class=\"nav-item dropdown\">
    <a class=\"nav-link\" data-toggle=\"dropdown\" href=\"#\">
        <i class=\"far fa-bell\"></i>
        <span class=\"badge badge-warning navbar-badge\">15</span>
    </a>
    <div class=\"dropdown-menu dropdown-menu-lg dropdown-menu-right\">
        <span class=\"dropdown-item dropdown-header\">15 Notifications</span>
        <div class=\"dropdown-divider\"></div>
        <a href=\"#\" class=\"dropdown-item\">
        <i class=\"fas fa-envelope mr-2\"></i> 4 new messages
        <span class=\"float-right text-muted text-sm\">3 mins</span>
        </a>
        <div class=\"dropdown-divider\"></div>
        <a href=\"#\" class=\"dropdown-item\">
        <i class=\"fas fa-users mr-2\"></i> 8 friend requests
        <span class=\"float-right text-muted text-sm\">12 hours</span>
        </a>
        <div class=\"dropdown-divider\"></div>
        <a href=\"#\" class=\"dropdown-item\">
        <i class=\"fas fa-file mr-2\"></i> 3 new reports
        <span class=\"float-right text-muted text-sm\">2 days</span>
        </a>
        <div class=\"dropdown-divider\"></div>
        <a href=\"#\" class=\"dropdown-item dropdown-footer\">See All Notifications</a>
    </div>
    </li>
    <li class=\"nav-item\">
    <a class=\"nav-link\" data-widget=\"fullscreen\" href=\"#\" role=\"button\">
        <i class=\"fas fa-expand-arrows-alt\"></i>
    </a>
    </li>
    <li class=\"nav-item\">
    <a class=\"nav-link\" data-widget=\"control-sidebar\" data-controlsidebar-slide=\"true\" href=\"#\" role=\"button\">
        <i class=\"fas fa-th-large\"></i>
    </a>
    </li>
</ul>
</nav>
<!-- /.navbar -->";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "nav.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!-- Navbar -->
<nav class=\"main-header navbar navbar-expand navbar-white navbar-light\">
<!-- Left navbar links -->
<ul class=\"navbar-nav\">
    <li class=\"nav-item\">
    <a class=\"nav-link\" data-widget=\"pushmenu\" href=\"#\" role=\"button\"><i class=\"fas fa-bars\"></i></a>
    </li>
    <li class=\"nav-item d-none d-sm-inline-block\">
    <a href=\"index3.html\" class=\"nav-link\">Home</a>
    </li>
    <li class=\"nav-item d-none d-sm-inline-block\">
    <a href=\"#\" class=\"nav-link\">Contact</a>
    </li>
</ul>

<!-- Right navbar links -->
<ul class=\"navbar-nav ml-auto\">
    <!-- Navbar Search -->
    <li class=\"nav-item\">
    <a class=\"nav-link\" data-widget=\"navbar-search\" href=\"#\" role=\"button\">
        <i class=\"fas fa-search\"></i>
    </a>
    <div class=\"navbar-search-block\">
        <form class=\"form-inline\">
        <div class=\"input-group input-group-sm\">
            <input class=\"form-control form-control-navbar\" type=\"search\" placeholder=\"Search\" aria-label=\"Search\">
            <div class=\"input-group-append\">
            <button class=\"btn btn-navbar\" type=\"submit\">
                <i class=\"fas fa-search\"></i>
            </button>
            <button class=\"btn btn-navbar\" type=\"button\" data-widget=\"navbar-search\">
                <i class=\"fas fa-times\"></i>
            </button>
            </div>
        </div>
        </form>
    </div>
    </li>

    <!-- Messages Dropdown Menu -->
    <li class=\"nav-item dropdown\">
    <a class=\"nav-link\" data-toggle=\"dropdown\" href=\"#\">
        <i class=\"far fa-comments\"></i>
        <span class=\"badge badge-danger navbar-badge\">3</span>
    </a>
    <div class=\"dropdown-menu dropdown-menu-lg dropdown-menu-right\">
        <a href=\"#\" class=\"dropdown-item\">
        <!-- Message Start -->
        <div class=\"media\">
            <img src=\"dist/img/user1-128x128.jpg\" alt=\"User Avatar\" class=\"img-size-50 mr-3 img-circle\">
            <div class=\"media-body\">
            <h3 class=\"dropdown-item-title\">
                Brad Diesel
                <span class=\"float-right text-sm text-danger\"><i class=\"fas fa-star\"></i></span>
            </h3>
            <p class=\"text-sm\">Call me whenever you can...</p>
            <p class=\"text-sm text-muted\"><i class=\"far fa-clock mr-1\"></i> 4 Hours Ago</p>
            </div>
        </div>
        <!-- Message End -->
        </a>
        <div class=\"dropdown-divider\"></div>
        <a href=\"#\" class=\"dropdown-item\">
        <!-- Message Start -->
        <div class=\"media\">
            <img src=\"dist/img/user8-128x128.jpg\" alt=\"User Avatar\" class=\"img-size-50 img-circle mr-3\">
            <div class=\"media-body\">
            <h3 class=\"dropdown-item-title\">
                John Pierce
                <span class=\"float-right text-sm text-muted\"><i class=\"fas fa-star\"></i></span>
            </h3>
            <p class=\"text-sm\">I got your message bro</p>
            <p class=\"text-sm text-muted\"><i class=\"far fa-clock mr-1\"></i> 4 Hours Ago</p>
            </div>
        </div>
        <!-- Message End -->
        </a>
        <div class=\"dropdown-divider\"></div>
        <a href=\"#\" class=\"dropdown-item\">
        <!-- Message Start -->
        <div class=\"media\">
            <img src=\"dist/img/user3-128x128.jpg\" alt=\"User Avatar\" class=\"img-size-50 img-circle mr-3\">
            <div class=\"media-body\">
            <h3 class=\"dropdown-item-title\">
                Nora Silvester
                <span class=\"float-right text-sm text-warning\"><i class=\"fas fa-star\"></i></span>
            </h3>
            <p class=\"text-sm\">The subject goes here</p>
            <p class=\"text-sm text-muted\"><i class=\"far fa-clock mr-1\"></i> 4 Hours Ago</p>
            </div>
        </div>
        <!-- Message End -->
        </a>
        <div class=\"dropdown-divider\"></div>
        <a href=\"#\" class=\"dropdown-item dropdown-footer\">See All Messages</a>
    </div>
    </li>
    <!-- Notifications Dropdown Menu -->
    <li class=\"nav-item dropdown\">
    <a class=\"nav-link\" data-toggle=\"dropdown\" href=\"#\">
        <i class=\"far fa-bell\"></i>
        <span class=\"badge badge-warning navbar-badge\">15</span>
    </a>
    <div class=\"dropdown-menu dropdown-menu-lg dropdown-menu-right\">
        <span class=\"dropdown-item dropdown-header\">15 Notifications</span>
        <div class=\"dropdown-divider\"></div>
        <a href=\"#\" class=\"dropdown-item\">
        <i class=\"fas fa-envelope mr-2\"></i> 4 new messages
        <span class=\"float-right text-muted text-sm\">3 mins</span>
        </a>
        <div class=\"dropdown-divider\"></div>
        <a href=\"#\" class=\"dropdown-item\">
        <i class=\"fas fa-users mr-2\"></i> 8 friend requests
        <span class=\"float-right text-muted text-sm\">12 hours</span>
        </a>
        <div class=\"dropdown-divider\"></div>
        <a href=\"#\" class=\"dropdown-item\">
        <i class=\"fas fa-file mr-2\"></i> 3 new reports
        <span class=\"float-right text-muted text-sm\">2 days</span>
        </a>
        <div class=\"dropdown-divider\"></div>
        <a href=\"#\" class=\"dropdown-item dropdown-footer\">See All Notifications</a>
    </div>
    </li>
    <li class=\"nav-item\">
    <a class=\"nav-link\" data-widget=\"fullscreen\" href=\"#\" role=\"button\">
        <i class=\"fas fa-expand-arrows-alt\"></i>
    </a>
    </li>
    <li class=\"nav-item\">
    <a class=\"nav-link\" data-widget=\"control-sidebar\" data-controlsidebar-slide=\"true\" href=\"#\" role=\"button\">
        <i class=\"fas fa-th-large\"></i>
    </a>
    </li>
</ul>
</nav>
<!-- /.navbar -->", "nav.html.twig", "E:\\PFE\\CourseExpress\\templates\\nav.html.twig");
    }
}
