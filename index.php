<?php

    require_once "includes/general.php";


    echo Template::header('Lanzarote');

    switch($_GET['seccion'])
    {
        case 'usuarios':
            //Cargamos la sección usuarios
        break;

        default:


            echo "
            
               <header class=\"masthead\">
                    <div class=\"container\">
                        <div class=\"masthead-.subheading\">
                        Bienvenido a Lanzaroe
                        </div>

                        <div class=\"masthead-heading text-uppercase\">
                        Descubre la isla diferente
                        </div>

                        <a class=\"btn btn-primary btn-xl text-uppercase\" href=\"#services\">
                        Descubrir mas
                        </a>
                    </div>
                </header>   
            ";    


            echo "

                <!-- Services -->
                <section class=\"page-section\" id=\"services\">
                    <div class=\"container\">

                        <div class=\"text-center\">
                            <h2 class=\"section-heading text-uppercase\">Servicios</h2>
                            <h3 class=\"section-subheading text-muted\">
                                Descubre todo lo que ofrece Lanzarote.
                            </h3>
                        </div>

                        <div class=\"row text-center\">

                            <div class=\"col-md-4\">
                                <span class=\"fa-stack fa-4x\">
                                    <i class=\"fas fa-circle fa-stack-2x text-primary\"></i>
                                    <i class=\"fas fa-umbrella-beach fa-stack-1x fa-inverse\"></i>
                                </span>
                                <h4 class=\"my-3\">Playas</h4>
                                <p class=\"text-muted\">
                                    Disfruta de las increíbles playas y paisajes
                                    naturales de nuestra isla.
                                </p>
                            </div>

                            <div class=\"col-md-4\">
                                <span class=\"fa-stack fa-4x\">
                                    <i class=\"fas fa-circle fa-stack-2x text-primary\"></i>
                                    <i class=\"fas fa-mountain fa-stack-1x fa-inverse\"></i>
                                </span>
                                <h4 class=\"my-3\">Naturaleza</h4>
                                <p class=\"text-muted\">
                                    Explora los volcanes, parques naturales
                                    y espacios protegidos.
                                </p>
                            </div>

                            <div class=\"col-md-4\">
                                <span class=\"fa-stack fa-4x\">
                                    <i class=\"fas fa-circle fa-stack-2x text-primary\"></i>
                                    <i class=\"fas fa-camera fa-stack-1x fa-inverse\"></i>
                                </span>
                                <h4 class=\"my-3\">Turismo</h4>
                                <p class=\"text-muted\">
                                    Conoce los lugares más emblemáticos
                                    y la cultura de Lanzarote.
                                </p>
                            </div>

                        </div>
                    </div>
                </section>

            ";


            echo "

                <!-- Portfolio -->
                <section class=\"page-section bg-light\" id=\"portfolio\">
                    <div class=\"container\">

                        <div class=\"text-center\">
                            <h2 class=\"section-heading text-uppercase\">Lugares de Lanzarote</h2>
                            <h3 class=\"section-subheading text-muted\">
                                Descubre algunos de los rincones más especiales de la isla.
                            </h3>
                        </div>

                        <div class=\"row\">

                            <div class=\"col-lg-4 col-sm-6 mb-4\">
                                <div class=\"portfolio-item\">
                                    <a class=\"portfolio-link\" href=\"#portfolio\">
                                        <div class=\"portfolio-hover\">
                                            <div class=\"portfolio-hover-content\">
                                                <i class=\"fas fa-plus fa-3x\"></i>
                                            </div>
                                        </div>
                                        <img class=\"img-fluid\" src=\"img/fondo1.jpeg\" alt=\"Paisaje de Lanzarote\">
                                    </a>
                                    <div class=\"portfolio-caption\">
                                        <div class=\"portfolio-caption-heading\">Paisajes volcánicos</div>
                                        <div class=\"portfolio-caption-subheading text-muted\">Naturaleza</div>
                                    </div>
                                </div>
                            </div>

                            <div class=\"col-lg-4 col-sm-6 mb-4\">
                                <div class=\"portfolio-item\">
                                    <a class=\"portfolio-link\" href=\"#portfolio\">
                                        <div class=\"portfolio-hover\">
                                            <div class=\"portfolio-hover-content\">
                                                <i class=\"fas fa-plus fa-3x\"></i>
                                            </div>
                                        </div>
                                        <img class=\"img-fluid\" src=\"img/fondo2.jpeg\" alt=\"Paisaje de Lanzarote\">
                                    </a>
                                    <div class=\"portfolio-caption\">
                                        <div class=\"portfolio-caption-heading\">Playas</div>
                                        <div class=\"portfolio-caption-subheading text-muted\">Turismo</div>
                                    </div>
                                </div>
                            </div>

                            <div class=\"col-lg-4 col-sm-6 mb-4\">
                                <div class=\"portfolio-item\">
                                    <a class=\"portfolio-link\" href=\"#portfolio\">
                                        <div class=\"portfolio-hover\">
                                            <div class=\"portfolio-hover-content\">
                                                <i class=\"fas fa-plus fa-3x\"></i>
                                            </div>
                                        </div>
                                        <img class=\"img-fluid\" src=\"img/fondo3.jpeg\" alt=\"Paisaje de Lanzarote\">
                                    </a>
                                    <div class=\"portfolio-caption\">
                                        <div class=\"portfolio-caption-heading\">Rincones de la isla</div>
                                        <div class=\"portfolio-caption-subheading text-muted\">Cultura</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

            ";



            echo "

                <!-- About -->
                <section class=\"page-section\" id=\"about\">
                    <div class=\"container\">

                        <div class=\"text-center\">
                            <h2 class=\"section-heading text-uppercase\">Sobre Lanzarote</h2>
                            <h3 class=\"section-subheading text-muted\">
                                Conoce nuestra historia.
                            </h3>
                        </div>

                        <ul class=\"timeline\">

                            <li>
                                <div class=\"timeline-image\">
                                    <img class=\"rounded-circle img-fluid\" src=\"img/fondo1.jpeg\" alt=\"Lanzarote\">
                                </div>
                                <div class=\"timeline-panel\">
                                    <div class=\"timeline-heading\">
                                        <h4>Lanzarote</h4>
                                        <h4 class=\"subheading\">Una isla volcánica</h4>
                                    </div>
                                    <div class=\"timeline-body\">
                                        <p class=\"text-muted\">
                                            Lanzarote destaca por sus paisajes volcánicos,
                                            sus playas y su riqueza natural.
                                        </p>
                                    </div>
                                </div>
                            </li>

                            <li class=\"timeline-inverted\">
                                <div class=\"timeline-image\">
                                    <img class=\"rounded-circle img-fluid\" src=\"img/fondo2.jpeg\" alt=\"Paisajes de Lanzarote\">
                                </div>
                                <div class=\"timeline-panel\">
                                    <div class=\"timeline-heading\">
                                        <h4>Naturaleza</h4>
                                        <h4 class=\"subheading\">Un entorno único</h4>
                                    </div>
                                    <div class=\"timeline-body\">
                                        <p class=\"text-muted\">
                                            Sus volcanes, parques naturales y espacios
                                            protegidos hacen de la isla un lugar especial.
                                        </p>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class=\"timeline-image\">
                                    <img class=\"rounded-circle img-fluid\" src=\"img/fondo3.jpeg\" alt=\"Cultura de Lanzarote\">
                                </div>
                                <div class=\"timeline-panel\">
                                    <div class=\"timeline-heading\">
                                        <h4>Cultura</h4>
                                        <h4 class=\"subheading\">Tradición y arte</h4>
                                    </div>
                                    <div class=\"timeline-body\">
                                        <p class=\"text-muted\">
                                            La arquitectura, la gastronomía y el arte
                                            forman parte de la identidad de Lanzarote.
                                        </p>
                                    </div>
                                </div>
                            </li>

                            <li class=\"timeline-inverted\">
                                <div class=\"timeline-image\">
                                    <h4>
                                        Descubre
                                        <br>
                                        Lanzarote
                                        <br>
                                        Contigo
                                    </h4>
                                </div>
                            </li>

                        </ul>
                    </div>
                </section>

            ";



            echo "

                <!-- Team -->
                <section class=\"page-section bg-light\" id=\"team\">
                    <div class=\"container\">

                        <div class=\"text-center\">
                            <h2 class=\"section-heading text-uppercase\">Nuestro equipo</h2>
                            <h3 class=\"section-subheading text-muted\">
                                Las personas que hacen posible este proyecto.
                            </h3>
                        </div>

                        <div class=\"row\">

                            <div class=\"col-lg-4\">
                                <div class=\"team-member\">
                                    <img class=\"mx-auto rounded-circle\" src=\"img/fondo1.jpeg\" alt=\"Equipo 1\">
                                    <h4>Turismo</h4>
                                    <p class=\"text-muted\">Información turística</p>
                                    <a class=\"btn btn-dark btn-social mx-2\" href=\"#!\">
                                        <i class=\"fab fa-twitter\"></i>
                                    </a>
                                    <a class=\"btn btn-dark btn-social mx-2\" href=\"#!\">
                                        <i class=\"fab fa-facebook-f\"></i>
                                    </a>
                                    <a class=\"btn btn-dark btn-social mx-2\" href=\"#!\">
                                        <i class=\"fab fa-linkedin-in\"></i>
                                    </a>
                                </div>
                            </div>

                            <div class=\"col-lg-4\">
                                <div class=\"team-member\">
                                    <img class=\"mx-auto rounded-circle\" src=\"img/fondo2.jpeg\" alt=\"Equipo 2\">
                                    <h4>Naturaleza</h4>
                                    <p class=\"text-muted\">Espacios naturales</p>
                                    <a class=\"btn btn-dark btn-social mx-2\" href=\"#!\">
                                        <i class=\"fab fa-twitter\"></i>
                                    </a>
                                    <a class=\"btn btn-dark btn-social mx-2\" href=\"#!\">
                                        <i class=\"fab fa-facebook-f\"></i>
                                    </a>
                                    <a class=\"btn btn-dark btn-social mx-2\" href=\"#!\">
                                        <i class=\"fab fa-linkedin-in\"></i>
                                    </a>
                                </div>
                            </div>

                            <div class=\"col-lg-4\">
                                <div class=\"team-member\">
                                    <img class=\"mx-auto rounded-circle\" src=\"img/fondo3.jpeg\" alt=\"Equipo 3\">
                                    <h4>Cultura</h4>
                                    <p class=\"text-muted\">Patrimonio y tradición</p>
                                    <a class=\"btn btn-dark btn-social mx-2\" href=\"#!\">
                                        <i class=\"fab fa-twitter\"></i>
                                    </a>
                                    <a class=\"btn btn-dark btn-social mx-2\" href=\"#!\">
                                        <i class=\"fab fa-facebook-f\"></i>
                                    </a>
                                    <a class=\"btn btn-dark btn-social mx-2\" href=\"#!\">
                                        <i class=\"fab fa-linkedin-in\"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

            ";



            echo "

                <!-- Contact -->
                <section class=\"page-section\" id=\"contact\">
                    <div class=\"container\">

                        <div class=\"text-center\">
                            <h2 class=\"section-heading text-uppercase\">Contacta con nosotros</h2>
                            <h3 class=\"section-subheading text-muted\">
                                ¿Quieres conocer más sobre Lanzarote?
                            </h3>
                        </div>

                        <form id=\"contactForm\" data-sb-form-api-token=\"API_TOKEN\">
                            <div class=\"row align-items-stretch mb-5\">

                                <div class=\"col-md-6\">
                                    <div class=\"form-group mb-3\">
                                        <input class=\"form-control\" id=\"name\" type=\"text\" placeholder=\"Tu nombre *\" required>
                                    </div>

                                    <div class=\"form-group mb-3\">
                                        <input class=\"form-control\" id=\"email\" type=\"email\" placeholder=\"Tu correo electrónico *\" required>
                                    </div>

                                    <div class=\"form-group mb-3\">
                                        <input class=\"form-control\" id=\"phone\" type=\"tel\" placeholder=\"Tu teléfono *\" required>
                                    </div>
                                </div>

                                <div class=\"col-md-6\">
                                    <div class=\"form-group mb-3\">
                                        <textarea class=\"form-control\" id=\"message\" placeholder=\"Tu mensaje *\" required></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class=\"text-center\">
                                <button class=\"btn btn-primary btn-xl text-uppercase\" type=\"submit\">
                                    Enviar mensaje
                                </button>
                            </div>
                        </form>

                    </div>
                </section>

            ";



        break;
    }


    echo Template::footer();

/*
lanzarote.lan/usuarios/editar/232


lanzarote.lan?seccion=usuarios&modo=editar&id=232

*/


?>