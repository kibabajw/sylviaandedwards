<?php $this->load->view('homepage/head') ?>
<!-- body content ends here -->
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
		<?php echo anchor('Home/about_us', 'About Us'); ?>
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


<div class="section">
<div class="container">
<div class="row">
<div class="title-area">
<h2>Our Pillars</h2>
<div class="separator separator-danger">✻</div>
<p class="description">We promise to prioritize your research work as you focus on your other urgent activities.</p>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="info-icon">
<div class="icon text-danger">
<i class="pe-7s-graph1"></i>
</div>
<h3>Our vision</h3>
<p class="description"><blockquote>Write Bright envisions a customer centric, efficient, quality guided research service provider the best there can ever be.</blockquote></p>
</div>
</div>
<div class="col-md-4">
<div class="info-icon">
<div class="icon text-danger">
<i class="pe-7s-note2"></i>
</div>
<h3>Our mission</h3>
<p class="description">
<blockquote>To be the leading global research consultancy providing tailor made solutions to your research needs.</blockquote></p>
</div>
</div>
<div class="col-md-4">
<div class="info-icon">
<div class="icon text-danger">
<i class="pe-7s-pen"></i>
</div>
<h3>Guiding principle</h3>
<p class="description">
<blockquote style="font-style:italic;">“Most reasons to delay are invalid if you get right to the core: 
no time, no money, no audience. These are all future concerns, which make it hard to start anything. 
Worry about those things later or not at all. 
Make small decisions at first, and start moving in a direction that feels right.”

</blockquote><br/>
<b>-Paul Jarvis</b>
</p>
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
<h2>Our qualities</h2>
<div class="separator separator-danger">✻</div>
<p class="description">Our nine tiles of quality.</p>
</div>
</div>

<div class="team">
<div class="row">
<div class="col-md-10 col-md-offset-1">
<div class="row">
<div class="col-md-4">
<div class="card card-member">
<div class="content">
<div class="description">
<h1 class="title">1</h1>
<h3 class="title">Speedy</h3>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card card-member">
<div class="content">
<div class="description">
<h1 class="title">2</h1>
<h3 class="title">Trustworthy</h3>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card card-member">
<div class="content">
<div class="description">
<h1 class="title">3</h1>
<h3 class="title">Leadership</h3>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card card-member">
<div class="content">
<div class="description">
<h1 class="title">4</h1>
<h3 class="title">Visionary</h3>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card card-member">
<div class="content">
<div class="description">
<h1 class="title">5</h1>
<h3 class="title">Innovative</h3>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card card-member">
<div class="content">
<div class="description">
<h1 class="title">6</h1>
<h3 class="title">Adaptive & Efficient</h3>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card card-member">
<div class="content">
<div class="description">
<h1 class="title">7</h1>
<h3 class="title">Dynamic</h3>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card card-member">
<div class="content">
<div class="description">
<h1 class="title">8</h1>
<h3 class="title">World-wide mindset</h3>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card card-member">
<div class="content">
<div class="description">
<h1 class="title">9</h1>
<h3 class="title">Ambitious</h3>
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
<h5 class="subtitle text-gray">Here are some</h5>
<h2>Clients Testimonials</h2>
<div class="separator separator-danger">∎</div>
</div>

<ul class="nav nav-text" role="tablist">
<li class="active">
<a href="#testimonial1" role="tab" data-toggle="tab">
<div class="image-clients">
<img alt="..." class="img-circle" src="<?php echo base_url(); ?>gaia-bootstrap-template/assets/img/faces/avatar.png"/>
</div>
</a>
</li>
<li>
<a href="#testimonial2" role="tab" data-toggle="tab">
<div class="image-clients">
<img alt="..." class="img-circle" src="<?php echo base_url(); ?>gaia-bootstrap-template/assets/img/faces/avatar.png"/>
</div>
</a>
</li>
<li>
<a href="#testimonial3" role="tab" data-toggle="tab">
<div class="image-clients">
<img alt="..." class="img-circle" src="<?php echo base_url(); ?>gaia-bootstrap-template/assets/img/faces/avatar.png"/>
</div>
</a>
</li>
</ul>


<div class="tab-content">
<div class="tab-pane active" id="testimonial1">
<p class="description">
For all my research work I trust and always go back to Write Bright Research Consultancy Ltd because they never fail me.
</p>
</div>
<div class="tab-pane" id="testimonial2">
<p class="description">I had never heard of Write Bright Research Consultancy Ltd before, however when I contracted them for my research proposal and thesis writing, I now do not know of any other research consultancy firm.
</p>
</div>
<div class="tab-pane" id="testimonial3">
<p class="description">The guys at Write Bright Research Consultancy Ltd are amazing and talented, good job keep it up.
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
<?php echo anchor('writer/Auth_Writer_Controller/load_register_form', 'Join us now', 'class="btn btn-danger btn-fill btn-lg"'); ?>
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
                            <a href="https://www.facebook.com/Sylvia-Edwards-Research-Consancy-Ltd-397486134127492/?modal=admin_todo_tour" class="btn btn-social btn-facebook btn-simple" target="blank"><i class="fa fa-facebook-square"></i> Facebook</a>  
                        </li>
                        <li>
                            <a href="https://www.instagram.com/researchc2018/" class="btn btn-social btn-simple" target="blank">
                                <i class="fa fa-instagram"></i> Instagram
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/ResSylvia" target="blank" class="btn btn-social btn-twitter btn-simple"><i class="fa fa-twitter"></i> Twitter</a>
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
<script src="//code.tidio.co/bc9a2n2jkd8srjsvmmmzwd9n56kbnt1r.js"></script>
</body>

<!-- javascript scripts are in the footer view -->
<?php $this->load->view('homepage/footer') ?>



