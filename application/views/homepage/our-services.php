<?php $this->load->view('homepage/head') ?>
<body>

    <nav class="navbar navbar-default navbar-fixed-top">
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
                        <?php echo anchor('Home/about_us', 'About Us'); ?>
                    </li>
                    <li>
                        <?php echo anchor('Home/careers', 'Careers'); ?>
                    </li>
                    <li>
                    <?php echo anchor('writer/Auth_Writer_Controller/load_login_form', 'login here',  'class="btn btn-danger btn-fill"'); ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>

    <div class="section section-our-clients-freebie" style="margin-top:50px;">
        <div class="container">
            <div class="title-area">
                <h2>Our services</h2>
                <div class="separator separator-danger">∎</div>
            </div>

            <div class="tab-content">
                <div class="tab-pane active" id="testimonial1">
                    <p class="description"><h3>S&E research consultancy Ltd offers you the following services.</h3></p>
                    <div class="row">
                      <div class="col-md-4">
                          <ul style="text-align:left;">
                              <li><h4>Desertations and thesis writing</h4></li>
                              <li><h4>Research paper</h4></li>
                              <li><h4>Research proposals</h4></li>
                              <li><h4>Web design</h4></li>
                              <li><h4>Reearch on business ventures/investments</h4></li>
                          </ul>
                      </div>
                      <div class="col-md-4">
                          <ul style="text-align:left;">
                              <li><h4>Assisting on Assignments</h4></li>
                              <li><h4>Essay writing</h4></li>
                              <li><h4>Opinion polls</h4></li>
                              <li><h4>Capacity building training</h4></li>
                          </ul>
                      </div>
                      <div class="col-md-4">
                          <ul style="text-align:left;">
                              <li><h4>Market surveys</h4></li>
                              <li><h4>Employee satisfaction surveys</h4></li>
                              <li><h4>Academic writing training</h4></li>
                          </ul>
                      </div>
                    </div>
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
                <?php echo anchor('Home/contact_us', 'Contact us', 'class="btn btn-danger btn-fill btn-lg"'); ?>
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
                            <a href="https://www.facebook.com/Sylvia-Edwards-Research-Cnsulancy-Ltd-397486134127492/?modal=admin_todo_tour" class="btn btn-social btn-facebook btn-simple" target="blank"><i class="fa fa-facebook-square"></i> Facebook</a>  
                        </li>
                        <li>
                            <a href="https://www.instagm.com/researchcenter02018/" class="btn btn-social btn-simple" target="blank">
                                <i class="fa fa-instagram"></i> Instagram
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/searchSylvia" target="blank" class="btn btn-social btn-twitter btn-simple"><i class="fa fa-twitter"></i> Twitter</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <hr>
    <div class="copyright">
            © <script> document.write(new Date().getFullYear()) </script> Write Bright, made with love&nbsp;&nbsp;
						<?= mailto('raymondjeff90@gmail.com', 'Webmaster raymondjeff90@gmail.com', 'style="color:#fff;"'); ?>
    </div>
</div>
</footer>

</body>
<!-- javascript scripts are in the footer view -->
<?php $this->load->view('homepage/footer') ?>
