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

/* security/login.html.twig */
class __TwigTemplate_9a8d9c0ffe5aa1f35f4425e7604b685ced067ea150bb74637781dcef2ed471ec extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "baseauth.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/login.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/login.html.twig"));

        $this->parent = $this->loadTemplate("baseauth.html.twig", "security/login.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Log in!";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "<div class=\"limiter\">
\t\t<div class=\"container-login100\" style=\"background-image: url('";
        // line 7
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("authentification/images/bg-01.jpg"), "html", null, true);
        echo "');\">
\t\t\t<div class=\"wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54\">
                <form method=\"post\" class=\"login100-form validate-form\">
                    ";
        // line 10
        if ((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 10, $this->source); })())) {
            // line 11
            echo "                        <div class=\"alert alert-danger\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(twig_get_attribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 11, $this->source); })()), "messageKey", [], "any", false, false, false, 11), twig_get_attribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 11, $this->source); })()), "messageData", [], "any", false, false, false, 11), "security"), "html", null, true);
            echo "</div>
                    ";
        }
        // line 13
        echo "
                    ";
        // line 14
        if (twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 14, $this->source); })()), "user", [], "any", false, false, false, 14)) {
            // line 15
            echo "                        <div class=\"mb-3\">
                            You are logged in as ";
            // line 16
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 16, $this->source); })()), "user", [], "any", false, false, false, 16), "userIdentifier", [], "any", false, false, false, 16), "html", null, true);
            echo ", <a href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            echo "\">Logout</a>
                        </div>
                    ";
        }
        // line 19
        echo "
                    <h1 class=\"login100-form-title p-b-49\">
\t\t\t\t\t\tPlease sign in
\t\t\t\t\t</h1>

\t\t\t\t\t<div class=\"wrap-input100 validate-input m-b-23\" data-validate = \"Email is reauired\">
\t\t\t\t\t\t<span class=\"label-input100\">Email</span>
\t\t\t\t\t\t<input class=\"input100\" type=\"email\" value=\"";
        // line 26
        echo twig_escape_filter($this->env, (isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 26, $this->source); })()), "html", null, true);
        echo "\" name=\"_username\" id=\"username\" autocomplete=\"email\" required autofocus placeholder=\"Type your username\">
\t\t\t\t\t\t<span class=\"focus-input100\" data-symbol=\"&#xf206;\"></span>
\t\t\t\t\t</div>
                    
                    <div class=\"wrap-input100 validate-input\" data-validate=\"Password is required\">
\t\t\t\t\t\t<span class=\"label-input100\">Password</span>
\t\t\t\t\t\t<input class=\"input100\" type=\"password\" name=\"_password\" id=\"password\" class=\"form-control\" autocomplete=\"current-password\" required placeholder=\"Type your password\">
\t\t\t\t\t\t<span class=\"focus-input100\" data-symbol=\"&#xf190;\"></span>
\t\t\t\t\t</div>

                    <input type=\"hidden\" name=\"_csrf_token\"
                        value=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        echo "\"
                    >

                    ";
        // line 50
        echo "
                    <div class=\"text-right p-t-8 p-b-31\">
\t\t\t\t\t\t<a href=\"#\">
\t\t\t\t\t\t\tForgot password?
\t\t\t\t\t\t</a>
\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t\t<div class=\"container-login100-form-btn\">
\t\t\t\t\t\t<div class=\"wrap-login100-form-btn\">
\t\t\t\t\t\t\t<div class=\"login100-form-bgbtn\"></div>
\t\t\t\t\t\t\t<button class=\"login100-form-btn\" type=\"submit\">
\t\t\t\t\t\t\t\tLogin
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
                </form>
            </div>
\t\t</div>
\t</div>
\t

\t<div id=\"dropDownSelect1\"></div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "security/login.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  150 => 50,  144 => 37,  130 => 26,  121 => 19,  113 => 16,  110 => 15,  108 => 14,  105 => 13,  99 => 11,  97 => 10,  91 => 7,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'baseauth.html.twig' %}

{% block title %}Log in!{% endblock %}

{% block body %}
<div class=\"limiter\">
\t\t<div class=\"container-login100\" style=\"background-image: url('{{ asset('authentification/images/bg-01.jpg') }}');\">
\t\t\t<div class=\"wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54\">
                <form method=\"post\" class=\"login100-form validate-form\">
                    {% if error %}
                        <div class=\"alert alert-danger\">{{ error.messageKey|trans(error.messageData, 'security') }}</div>
                    {% endif %}

                    {% if app.user %}
                        <div class=\"mb-3\">
                            You are logged in as {{ app.user.userIdentifier }}, <a href=\"{{ path('app_logout') }}\">Logout</a>
                        </div>
                    {% endif %}

                    <h1 class=\"login100-form-title p-b-49\">
\t\t\t\t\t\tPlease sign in
\t\t\t\t\t</h1>

\t\t\t\t\t<div class=\"wrap-input100 validate-input m-b-23\" data-validate = \"Email is reauired\">
\t\t\t\t\t\t<span class=\"label-input100\">Email</span>
\t\t\t\t\t\t<input class=\"input100\" type=\"email\" value=\"{{ last_username }}\" name=\"_username\" id=\"username\" autocomplete=\"email\" required autofocus placeholder=\"Type your username\">
\t\t\t\t\t\t<span class=\"focus-input100\" data-symbol=\"&#xf206;\"></span>
\t\t\t\t\t</div>
                    
                    <div class=\"wrap-input100 validate-input\" data-validate=\"Password is required\">
\t\t\t\t\t\t<span class=\"label-input100\">Password</span>
\t\t\t\t\t\t<input class=\"input100\" type=\"password\" name=\"_password\" id=\"password\" class=\"form-control\" autocomplete=\"current-password\" required placeholder=\"Type your password\">
\t\t\t\t\t\t<span class=\"focus-input100\" data-symbol=\"&#xf190;\"></span>
\t\t\t\t\t</div>

                    <input type=\"hidden\" name=\"_csrf_token\"
                        value=\"{{ csrf_token('authenticate') }}\"
                    >

                    {#
                        Uncomment this section and add a remember_me option below your firewall to activate remember me functionality.
                        See https://symfony.com/doc/current/security/remember_me.html

                        <div class=\"checkbox mb-3\">
                            <label>
                                <input type=\"checkbox\" name=\"_remember_me\"> Remember me
                            </label>
                        </div>
                    #}

                    <div class=\"text-right p-t-8 p-b-31\">
\t\t\t\t\t\t<a href=\"#\">
\t\t\t\t\t\t\tForgot password?
\t\t\t\t\t\t</a>
\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t\t<div class=\"container-login100-form-btn\">
\t\t\t\t\t\t<div class=\"wrap-login100-form-btn\">
\t\t\t\t\t\t\t<div class=\"login100-form-bgbtn\"></div>
\t\t\t\t\t\t\t<button class=\"login100-form-btn\" type=\"submit\">
\t\t\t\t\t\t\t\tLogin
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
                </form>
            </div>
\t\t</div>
\t</div>
\t

\t<div id=\"dropDownSelect1\"></div>
{% endblock %}
", "security/login.html.twig", "E:\\PFE\\CourseExpress\\templates\\security\\login.html.twig");
    }
}
