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

/* includes/jslinks.html.twig */
class __TwigTemplate_6169582fbb7ea1c17e3798f7aa8012d9cf9c7395550aafd0a4050b8224adbbb6 extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "includes/jslinks.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "includes/jslinks.html.twig"));

        // line 1
        echo "
<!-- jQuery -->
<script src=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("plugins/jquery/jquery.min.js"), "html", null, true);
        echo "\"></script>
<!-- jQuery UI 1.11.4 -->
<script src=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("plugins/jquery-ui/jquery-ui.min.js"), "html", null, true);
        echo "\"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  \$.widget.bridge('uibutton', \$.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("plugins/bootstrap/js/bootstrap.bundle.min.js"), "html", null, true);
        echo "\"></script>
<!-- ChartJS -->
<script src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("plugins/chart.js/Chart.min.js"), "html", null, true);
        echo "\"></script>
<!-- Sparkline -->
<script src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("plugins/sparklines/sparkline.js"), "html", null, true);
        echo "\"></script>
<!-- JQVMap -->
<script src=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("plugins/jqvmap/jquery.vmap.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("plugins/jqvmap/maps/jquery.vmap.usa.js"), "html", null, true);
        echo "\"></script>
<!-- jQuery Knob Chart -->
<script src=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("plugins/jquery-knob/jquery.knob.min.js"), "html", null, true);
        echo "\"></script>
<!-- daterangepicker -->
<script src=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("plugins/moment/moment.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("plugins/daterangepicker/daterangepicker.js"), "html", null, true);
        echo "\"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"), "html", null, true);
        echo "\"></script>
<!-- Summernote -->
<script src=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("plugins/summernote/summernote-bs4.min.js"), "html", null, true);
        echo "\"></script>
<!-- overlayScrollbars -->
<script src=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"), "html", null, true);
        echo "\"></script>
<!-- AdminLTE App -->
<script src=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("dist/js/adminlte.js"), "html", null, true);
        echo "\"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("dist/js/pages/dashboard.js"), "html", null, true);
        echo "\"></script>";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "includes/jslinks.html.twig";
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
        return array (  119 => 33,  114 => 31,  109 => 29,  104 => 27,  99 => 25,  94 => 23,  90 => 22,  85 => 20,  80 => 18,  76 => 17,  71 => 15,  66 => 13,  61 => 11,  52 => 5,  47 => 3,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
<!-- jQuery -->
<script src=\"{{ asset('plugins/jquery/jquery.min.js') }}\"></script>
<!-- jQuery UI 1.11.4 -->
<script src=\"{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}\"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  \$.widget.bridge('uibutton', \$.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src=\"{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}\"></script>
<!-- ChartJS -->
<script src=\"{{ asset('plugins/chart.js/Chart.min.js') }}\"></script>
<!-- Sparkline -->
<script src=\"{{ asset('plugins/sparklines/sparkline.js') }}\"></script>
<!-- JQVMap -->
<script src=\"{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}\"></script>
<script src=\"{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}\"></script>
<!-- jQuery Knob Chart -->
<script src=\"{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}\"></script>
<!-- daterangepicker -->
<script src=\"{{ asset('plugins/moment/moment.min.js') }}\"></script>
<script src=\"{{ asset('plugins/daterangepicker/daterangepicker.js') }}\"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src=\"{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}\"></script>
<!-- Summernote -->
<script src=\"{{ asset('plugins/summernote/summernote-bs4.min.js') }}\"></script>
<!-- overlayScrollbars -->
<script src=\"{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}\"></script>
<!-- AdminLTE App -->
<script src=\"{{ asset('dist/js/adminlte.js') }}\"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src=\"{{ asset('dist/js/pages/dashboard.js') }}\"></script>", "includes/jslinks.html.twig", "E:\\PFE\\CourseExpress\\templates\\includes\\jslinks.html.twig");
    }
}
