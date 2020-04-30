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
            <?php echo anchor('Home/careers', 'Careers'); ?>
        </li>
        <li>
        <?php echo anchor('Home/our_services', 'Our Services'); ?>
        </li>
        <li>
        <?php echo anchor('writer/Auth_Writer_Controller/load_login_form', 'login here',  'class="btn btn-danger btn-fill"'); ?>
        </li>
    </ul>
</div>
<!-- /.navbar-collapse -->
</div>
</nav>

<div class="section section-our-team-freebie">
<div class="parallax filter filter-color-black">
<div class="image" style="background-image:url('<?php echo base_url(); ?>assets/london-3833039_1920.jpg')">
</div>
<div class="container">
    <div class="content">
        <div class="row">
            <div class="title-area">
                <h2>Who We Are</h2>
                <div class="separator separator-danger">✻</div>
                <p class="description">
                    <h3 style="text-align: justify;line-height: 1.3;">
                    Write Bright Research Consultancy Ltd is a firm that offers
                    research consultancy services to National Government, County Governments,
                     Learning Institutions, Business Companies, Medical Research Institutions,
                      and Non-Profit Organizations. Through the identification of businesses' strengths,
                       opportunities, weaknesses, and threats; our intensive research assists in finding 
                       out workable ways of increasing organizational effectiveness and profitability. 
                       Besides, the research company also offers all forms of academic writing such as 
                       dissertations, research papers, case studies, essay writing and among others..
                    </h3>
                </p>
            </div>
        </div>
    </div>
</div>
</div>
</div>


<div class="section section-our-clients-freebie">
<div class="container">
<div class="title-area">
    <h5 class="subtitle text-gray">More about-us...</h5>
    <h2>Our History</h2>
    <div class="separator separator-danger">∎</div>
</div>

<div class="tab-content">
    <div class="tab-pane active" id="testimonial1">
        <p class="description">
            The Research Company was first established as a sole-proprietor business
                on 22nd May 2016, and with the overwhelming demand for our services across Kenya;
                it was changed to a Limited Company on 1st October 2018. Notably, 
                from a humble beginning of a handful seven staff, the companies now enjoy
                over 100 employees across the country.
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
                <a href="https://www.facebook.com/Sylvia-Edwards-Research-Contancy-Ltd-397486134127492/?modal=admin_todo_tour" class="btn btn-social btn-facebook btn-simple" target="blank"><i class="fa fa-facebook-square"></i> Facebook</a>  
            </li>
            <li>
                <a href="https://www.instagram.com/reschcenter02018/" class="btn btn-social btn-simple" target="blank">
                    <i class="fa fa-instagram"></i> Instagram
                </a>
            </li>
            <li>
                <a href="https://twitter.com/Researylvia" target="blank" class="btn btn-social btn-twitter btn-simple"><i class="fa fa-twitter"></i> Twitter</a>
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
