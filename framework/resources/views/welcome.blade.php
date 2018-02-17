<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        Esuite Plataforma de Comercio Exterior
    </title>

    <!-- Styles -->
    @yield('html-head')
    <link href="{{ asset('dist/css/web.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.css') }}">

</head>
<body>
    <div class="wrapper">
        <!-- Header Landing -->
        <header>
            <div class="container">
                <div class="header-branding">
                    <h1>ESuite</h1>
                    <ul class="list-applications">
                        <li><a href="#">SECENET</a></li>
                        <li><a href="#">COVE</a></li>
                        <li><a href="#">RECOVE</a></li>
                        <li><a href="#">QORE</a></li>
                    </ul>
                    <ul class="list-dealers">
                        <!--<li><a href="#"><img src="{{ asset('img/web/dealers/etam.jpg') }}" alt="etam"></a></li>-->
                        <li><a href="{{ url('/login') }}" class="btn-login">mi suite</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Slider Applications -->
        <div class="slider-applications-content">
            <div class="container">
                <div class="slider-applications">

                    <div class="application-item row">
                        <div class="col-md-5">
                            <div class="application-introduce">
                                <h2>Secenet</h2>
                                <p>Controle todas sus operaciones de comercio exterior en una sola plataforma desde cualquier dispositivo. Ahorre tiempo en su Anexo 24 usando la captura electrónica y olvídese de las plantillas en excel</p>
                            </div>
                        </div>
                        <div class="col-md-7 text-center">
                            <img src="{{ asset('img/web/preview-secenet.png') }}" alt="" class="application-img">
                        </div>
                    </div>

                    <div class="application-item row">
                        <div class="col-md-5">
                            <div class="application-introduce">
                                <h2>Cove</h2>
                                <p>Los COVES pertenecen a su empresa no a su Agente Aduanal, el módulo de COVE le ayuda a estar preparado para una eventual auditoria.</p>
                            </div>
                        </div>
                        <div class="col-md-7 text-center">
                            <img src="{{ asset('img/web/preview-cove.png') }}" alt="" class="application-img">
                        </div>
                    </div>

                    <div class="application-item row">
                        <div class="col-md-5">
                            <div class="application-introduce">
                                <h2>Recove</h2>
                                <p>Si no tiene sus COVES recupérelos ¡ahora!<br> No tarde meses en tener su información, RECOVE la obtiene el mismo día.</p>
                            </div>
                        </div>
                        <div class="col-md-7 text-center">
                            <img src="{{ asset('img/web/preview-recove.png') }}" alt="" class="application-img">
                        </div>
                    </div>

                    <div class="application-item row">
                        <div class="col-md-5">
                            <div class="application-introduce">
                                <h2>Qore</h2>
                                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quia accusantium facere deleniti maiores voluptate aspernatur aut nam odit officiis mollitia corporis maxime eveniet dolor, fugit voluptas, magni nihil eius.
                            </div>
                        </div>
                        <div class="col-md-7 text-center">
                            <img src="{{ asset('img/web/preview-qore.png') }}" alt="" class="application-img">
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Aplications -->
        <div class="applications-content">
            <div class="container">
                <div class="application row">
                    <div class="application-preview col-md-5 text-center">
                        <img src="{{ asset('img/web/preview/preview.png') }}" alt="preview secenet">
                    </div>
                    <div class="col-md-2 text-center">
                        <div class="application-divider">
                            <div class="divider-circle"></div>
                            <div class="divider-line"></div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="application-features">
                            <h3>Secenet</h3>
                            <p>Controlar sus operaciones de comercio exterior y cumplir sus obligaciones de ley nunca ha sido tan fácil, olvídese de recapturar pedimentos o subir pesadas plantillas en Excel con un alto riesgo de error, con SECENET podrá integrar su expediente digital, administrar sus descargos de anexo 24 y reportar en tiempo y forma su anexo 31.</p>
                        </div>
                    </div>
                </div>

                <div class="application row">
                    <div class="application-preview col-md-5 text-center">
                        <img src="{{ asset('img/web/preview/preview.png') }}" alt="preview secenet">
                    </div>
                    <div class="col-md-2 text-center">
                        <div class="application-divider">
                            <div class="divider-circle"></div>
                            <div class="divider-line"></div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="application-features">
                            <h3>Cove</h3>
                            <p>Gestione rápida y confiablemente sus COVES ante la Ventanilla Única de Comercio Exterior Mexicano (VUCEM), en combinación con SECENET, integre los e-documents al expediente digital de sus operaciones de comercio exterior, así como sus archivos XML requeridos por la autoridad, evite la recaptura de información al pasar de forma automática el detalle del COVE al inventario de ANEXO 24 incluyendo sus números de parte.</p>
                        </div>
                    </div>
                </div>

                <div class="application row">
                    <div class="application-preview col-md-5 text-center">
                        <img src="{{ asset('img/web/preview/preview.png') }}" alt="preview secenet">
                    </div>
                    <div class="col-md-2 text-center">
                        <div class="application-divider">
                            <div class="divider-circle"></div>
                            <div class="divider-line"></div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="application-features">
                            <h3>Recove</h3>
                            <p>Recupere de VUCEM la información total de sus operaciones de comercio exterior e intégrelas automáticamente en SECENET y COVE. Asegure sus expedientes guardándolos en su ubicación preferida.</p>
                        </div>
                    </div>
                </div>

                <div class="application row">
                    <div class="application-preview col-md-5 text-center">
                        <img src="{{ asset('img/web/preview/preview.png') }}" alt="preview secenet">
                    </div>
                    <div class="col-md-2 text-center">
                        <div class="application-divider">
                            <div class="divider-circle"></div>
                            <div class="divider-line"></div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="application-features">
                            <h3>Qore</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit magnam eum modi omnis dolorem illum ab. Iste possimus exercitationem, tempore, officia, nemo nam optio ab harum architecto dolor excepturi ratione.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas sit incidunt error placeat. Molestiae facere alias recusandae perferendis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slider Features -->
        <div class="slider-features-content">
            <div class="container">
                <div class="features-introduce text-center">
                    <h3>Principales funciones de la Suite</h3>
                </div>
                <div class="slider-features row">
                    <div class="feature feature-secenet col-md-3">
                        <i class="icon-keyboard2"></i>
                        <p>Captura electrónica de información</p>
                    </div>
                    <div class="feature feature-cove col-md-3">
                        <i class="icon-vpn_lock"></i>
                        <p>Conexión a Web Service de VUCEM</p>
                    </div>
                    <div class="feature feature-recove col-md-3">
                        <i class="icon-today"></i>
                        <p>Realize búsquedas por fechas</p>
                    </div>
                    <div class="feature feature-secenet col-md-3">
                        <i class="icon-content_copy"></i>
                        <p>Compulsa contra Data Stage</p>
                    </div>
                    <div class="feature feature-cove col-md-3">
                        <i class="icon-assignment"></i>
                        <p>XML y Acuses listos para ser auditados</p>
                    </div>
                    <div class="feature feature-secenet col-md-3">
                        <i class="icon-folder2"></i>
                        <p>Integración de expediente digital</p>
                    </div>
                    <div class="feature feature-recove col-md-3">
                        <i class="icon-find_in_page"></i>
                        <p>Realize búsquedas por pedimentos</p>
                    </div>
                    <div class="feature feature-secenet col-md-3">
                        <i class="icon-settings"></i>
                        <p>Descargos de Anexo 24</p>
                    </div>
                    <div class="feature feature-cove col-md-3">
                        <i class="icon-keyboard_hide"></i>
                        <p>Uso de catálogos para agilizar captura</p>
                    </div>
                    <div class="feature feature-secenet col-md-3">
                        <i class="icon-payment"></i>
                        <p>Reporte de Anexo 31</p>
                    </div>
                    <div class="feature feature-recove col-md-3">
                        <i class="icon-cloud_download"></i>
                        <p>Todas sus son descargas automáticas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact & Register Mailchimp -->
        <div class="contact-form-content">
            <div class="container">
                <div class="contact-form row">
                    {!! Form::open(['route' => 'landing.register', 'method' => 'POST', 'role' => 'form', 'id' => 'form-newsletter']) !!}
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <div class="contact-brand">
                                <h3>Enterate de las novedades de Esuite</h3>
                                <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur illo accusantium tempore, aliquam quod dolore dolorum quam magnam explicabo facere cupiditate eius inventore in facilis neque et, maiores harum eveniet.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="contact-content-field">
                                    <i class="icon-person_outline"></i>
                                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'field_name']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="contact-content-field">
                                    <i class="icon-mail_outline"></i>
                                    {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'field_email']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <a href="#" class="newsletter-submit btn btn-primary">Registrarme al Newsletter del Esuite</a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <!-- Branding ECode -->
        <div class="ecode-branding-content">
            <div class="container">
                <div class="ecode-branding row">
                    <div class="col-md-6">
                        <div class="branding-item ecode-branding-site">
                            <div class="branding-data">
                                <div class="branding-icon">
                                    <i class="icon-sphere"></i>
                                </div>
                                <div class="branding-text">
                                    <p>Visita nuestro sitio web</p>
                                    <span>Esuite es un producto de <a href="#">E-Code</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="branding-item ecode-branding-blog">
                            <div class="branding-data">
                                <div class="branding-icon">
                                    <i class="icon-blog"></i>
                                </div>
                                <div class="branding-text">
                                    <p>Lee nuestro Blog</p>
                                    <span>Bla blabla texto texto texto</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="testimonials-content">
            <div class="container">
                <div class="testimonials row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="testimonials-introduce text-center">
                            <h3>Great Clients work with us</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, nemo voluptatem iste tenetur quas temporibus illo facilis magnam eum officiis.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="testimonial">
                            <p class="testimonial-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat quo soluta architecto, distinctio maxime saepe sit quidem dicta perferendis, omnis quos nulla eos aliquam nisi quibusdam recusandae.</p>
                            <div class="testimonial-client">
                                <img src="{{ asset('img/web/testimonials/client_one.jpg') }}" alt="client">
                                <div class="testimonial-client-data">
                                    <p><strong>Richard Hendrix</strong></p>
                                    <span><strong>Piep Piper</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="testimonial">
                            <p class="testimonial-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat quo soluta architecto, distinctio maxime saepe sit quidem dicta perferendis, omnis quos nulla eos aliquam nisi quibusdam recusandae.</p>
                            <div class="testimonial-client">
                                <img src="{{ asset('img/web/testimonials/client_two.jpg') }}" alt="client">
                                <div class="testimonial-client-data">
                                    <p><strong>Laurie Bream</strong></p>
                                    <span><strong>Raviga</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="testimonial">
                            <p class="testimonial-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat quo soluta architecto, distinctio maxime saepe sit quidem dicta perferendis, omnis quos nulla eos aliquam nisi quibusdam recusandae.</p>
                            <div class="testimonial-client">
                                <img src="{{ asset('img/web/testimonials/client_three.jpg') }}" alt="client">
                                <div class="testimonial-client-data">
                                    <p><strong>Peter Gregory</strong></p>
                                    <span><strong>Hooli</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="footer-branding">
                    <h2>More experience less stuff</h2>
                    <p>With millions of appointments made and millions more on the way, Esuite is helping businesses deliver high quality, enriching experiences all over the world.</p>
                </div>

                <div class="footer-legal">
                    <div class="footer-legal-copy">ESuite - All rights Reserved</div>
                    <div class="footer-legal-terms">
                        <ul>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
<script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
<script src="{{ asset('js/slick.js') }}"></script>
<script src="{{ asset('js/jquery.toast.js') }}"></script>
<script>
    $(document).ready(function(){
        $(".slider-applications").slick({
            autoplay: true,
            autoplaySpeed: 9000,
            dots: true,
            fade: true
        });

        $(".slider-features").slick({
            autoplay: true,
            autoplaySpeed: 9000,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            speed: 300
        });

        $(".newsletter-submit").click(function(e){
            e.preventDefault();

            var url = $('#form-newsletter').attr('action');
            var data = $('#form-newsletter').serialize();

            $.post(url, data, function(){

                $('#field_name').val("");
                $('#field_email').val("");

                $.toast({
                    heading: 'Success',
                    text: 'Su subscripción se realizo exitosamente a partir de ahora recibira información de nuestros productos.',
                    showHideTransition: 'fade',
                    icon: 'success'
                });
            }).fail(function(){
                $.toast({
                    heading: 'Error',
                    text: 'Parece que hubo un error a realizar su subscripción, intente de nuevo más tarde ¡Lo sentimos!',
                    showHideTransition: 'fade',
                    icon: 'error'
                });
            });
        });

    });
</script>
