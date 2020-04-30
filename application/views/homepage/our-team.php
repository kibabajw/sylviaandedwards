<?php $this->load->view('homepage/head') ?>
<body>

    <nav class="navbar navbar-default navbar-transparent navbar-fixed-top" color-on-scroll="200">
        <!-- if you want to keep the navbar hidden you can add this class to the navbar "navbar-burger"-->
        <div class="container">
            <div class="navbar-header">
                <button id="menu-toggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                </button>
                <a href="<?= base_url() ?>" class="navbar-brand">
                    Write Bright
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right navbar-uppercase">
                    <li>
                        <?php echo anchor('Home', 'Home'); ?>
                    </li>
                    <li>
                        <?php echo anchor('Home/contact_us', 'Contact us'); ?>
                    </li>
                    <li>
                        <?php echo anchor('Home/careers', 'Careers'); ?>
                    </li>
                    <li>
                        <?php echo anchor('Home/our_services', 'Our Services'); ?>
                    </li>
                    <li>
                        <?php echo anchor('writer/Auth_Writer_Controller/load_login_form', 'Writer area',  'class="btn btn-danger btn-fill"'); ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>


    <div class="section section-header">
        <div class="parallax filter filter-color-black">
            <div class="image"
                style="background-image: url('<?php echo base_url(); ?>gaia-bootstrap-template/assets/img/StockSnap_EOHWSALR5Q.jpg')">
            </div>
            <div class="container">
                <div class="content">
                    <div class="title-area">
                        <h3>Our clients say we probably are the most competent research firm.</h2>
                        <div class="separator line-separator">♦</div>
                    </div>

                    <div class="button-get-started">
                        <?= anchor('writer/Auth_Writer_Controller/load_register_form', 'Join us today', 'class="btn btn-white btn-fill btn-lg"') ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="section section-our-team-freebie">
        <div class="parallax filter filter-color-black">
            <div class="image" style="background-image:url('<?php echo base_url(); ?>assets/london-3833039_1920.jpg')">
            </div>
            <div class="container">
                <div class="content">
                    <div class="row">
                        <div class="title-area">
                            <h2>Our team</h2>
                            <div class="separator separator-danger">✻</div>
                        </div>
                    </div>

                    <div class="team">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card card-member">
                                            <div class="content">
                                                <div class="avatar avatar-danger">
                                                    <img alt="..." class="img-circle" src="<?php echo base_url(); ?>gaia-bootstrap-template/assets/img/faces/avatar.png"/>
                                                </div>
                                                <div class="description">
                                                    <h3 class="title">BRIAN OWUOR</h3>
                                                    <p class="small-text">Managing Director</p>
                                                    <p class="description"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-member">
                                            <div class="content">
                                                <div class="avatar avatar-danger">
                                                    <img alt="..." class="img-circle" src="<?php echo base_url(); ?>gaia-bootstrap-template/assets/img/faces/avatar2.jpeg"/>
                                                </div>
                                                <div class="description">
                                                    <h3 class="title">CHAVI B</h3>
                                                    <p class="small-text">Director of finance</p>
                                                    <p class="description"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-member">
                                            <div class="content">
                                                <div class="avatar avatar-danger">
                                                    <img alt="..." class="img-circle" src="<?php echo base_url(); ?>gaia-bootstrap-template/assets/img/faces/avatar.png"/>
                                                </div>
                                                <div class="description">
                                                    <h3 class="title">RAYMOND JEFF</h3>
                                                    <p class="small-text">General Manager</p>
                                                    <p class="description"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <div class="col-md-4">
                                        <div class="card card-member">
                                            <div class="content">
                                                <div class="avatar avatar-danger">
                                                    <img alt="..." class="img-circle" src="<?php echo base_url(); ?>gaia-bootstrap-template/assets/img/faces/avatar.png"/>
                                                </div>
                                                <div class="description">
                                                    <h3 class="title">CATHERINE WAFULA</h3>
                                                    <p class="small-text">Human Resource Manager</p>
                                                    <p class="description"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="section section-our-clients-freebie">
        <div class="container">
            <div class="title-area">
                <h5 class="subtitle text-gray">how to reach us</h5>
                <h2>Our contact information</h2>
                <div class="separator separator-danger">∎</div>
            </div>

            <div class="tab-content">
                <div class="tab-pane active" id="testimonial1">
                    <p class="description">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <i class="fa fa-phone"></i> +254 79660 9628
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                              <i class="fa fa-envelope"></i> info@writebright.com
                            </div>
                        </div>
                        <div class="row" style="margin-top:40px;">    
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              We are located in Western part of kenya, and with our physical location in Bungoma town, Marell estate, along the Lusaka Road opposite and Ahbaabi Petroleum Filling Station.
                            </div>
                        </div>
                    </p>
                </div>
            </div>

        </div>
    </div>


    <div class="section section-small section-get-started">
        <div class="parallax filter">
            <div class="image"
                style="background-image: url('<?php echo base_url(); ?>gaia-bootstrap-template/assets/img/office-1.jpeg')">
            </div>
            <div class="container">
                <div class="title-area">
                    <h2 class="text-white">Do you want to work with us?</h2>
                    <div class="separator line-separator">♦</div>
                    <p class="description"> We posses a strong sense of client centered satisfaction, we hope you share the same!</p>
                </div>

                <div class="button-get-started">
                    <a href="#gaia" class="btn btn-danger btn-fill btn-lg">Contact Us</a>
                </div>
            </div>
        </div>
    </div>

<footer class="footer footer-big footer-color-black" data-color="black">
<div class="container">
    <div class="row">
        <div class="col-md-2 col-sm-3">
            <div class="info">
                <h5 class="title">Company</h5>
                <nav>
                    <ul>
                        <li>
                            <?php echo anchor('Home', 'Home'); ?>
                        </li>
                        <?php echo anchor('writer/Auth_Writer_Controller/load_register_form', 'Join us'); ?>
                        </li>
                        <li>
                            <?php echo anchor('Home/our_team', 'Our team'); ?>
                        </li>
                        <li>
                            <?php echo anchor('Home/about_us', 'About Us'); ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-md-3 col-md-offset-1 col-sm-3">
            <div class="info">
                <h5 class="title"> Help and Support</h5>
                    <nav>
                    <ul>
                        <li>
                            <?php echo anchor('Home/contact_us', 'Contact us'); ?>
                        </li>
                        <li>
                            <?php echo anchor('Home/about_us', 'About Us'); ?>
                        </li>
                        <li>
                            <?php echo anchor('Home/careers', 'Careers'); ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="info">
                <h5 class="title">Latest News</h5>
                <nav>
                    <ul>
                    <li>
                            <a>
                                <i class="fa fa-twitter"></i> <b>Online research</b> The field of online research is gaining a major traction.
                                <hr class="hr-small">
                            </a>
                        </li>
                        <li>
                            <a>
                                <i class="fa fa-twitter"></i> Please come back <b> we'll have much more lined up for you.</b>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-md-2 col-md-offset-1 col-sm-3">
            <div class="info">
                <h5 class="title">Follow us on</h5>
                <nav>
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/Sylvi-Edward-Research-Consultancy-Ltd-397486134127492/?modal=admin_todo_tour" class="btn btn-social btn-facebook btn-simple" target="blank"><i class="fa fa-facebook-square"></i> Facebook</a>  
                        </li>
                        <li>
                            <a href="https://www.instagram.com/resechcenter02018/" class="btn btn-social btn-simple" target="blank">
                                <i class="fa fa-instagram"></i> Instagram
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/ResechSylvia" target="blank" class="btn btn-social btn-twitter btn-simple"><i class="fa fa-twitter"></i> Twitter</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <hr>
    <div class="copyright">
            © <script> document.write(new Date().getFullYear()) </script> Write Bright, made with love
    </div>
</div>
</footer>

</body>
<!-- javascript scripts are in the footer view -->
<?php $this->load->view('homepage/footer') ?>
