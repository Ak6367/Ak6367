<?php
    include("global.php");
    $siteQuery = $conn->query("select * from site_settings");
    $fetch = $siteQuery->fetch_assoc();
    $issubmit = 1;
    if(isset($_POST['name'])){
        if($_POST['name'] == ''){
            $issubmit = 0;
            $nameerr = ucwords('please enter your name');
        }
        if($_POST['email'] == ''){
            $issubmit = 0;
            $emailerr = ucwords('please enter your email');
        }
        if($_POST['phone'] == ''){
            $issubmit = 0;
            $phoneerr = ucwords('please enter your phone number');
        }
        if($_POST['subject'] == ''){
            $issubmit = 0;
            $suberr = ucwords('please enter a subject');
        }
        if($_POST['message'] == ''){
            $issubmit = 0;
            $msgerr = ucwords('please enter your message');
        }
        if($issubmit == 1){
            $insertQuery = $conn->query("insert into contact set name='".$_POST['name']."', email='".$_POST['email']."', phone='".$_POST['phone']."', subject='".$_POST['subject']."', message='".$_POST['message']."'");
            if($insertQuery){
                header("location:".SITEURL.'contact.php');
            }
        }
        
    }
    include("partial/header.php");
?>
<div class="content">
                <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Contact Us</h4>
                        <div class="breadcrumb__links">
                            <a href="index-2.html">Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Map Begin -->
    <div class="map">
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227748.99973450298!2d75.65047228361074!3d26.88514167956319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396c4adf4c57e281%3A0xce1c63a0cf22e09!2sJaipur%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1653297837891!5m2!1sen!2sin" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- Map End -->

    <!-- Contact Section Begin -->
    <section class="contact spad-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <h2>Contact Us</h2>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,</p>
                        </div>
                        <ul>
                            <li>
                                <h4>Jaipur</h4>
                                <p><?= $fetch['address'] ?>,<br> Jaipur, Rajasthan<br>(+91) <?= $fetch['contact_no'] ?></p>
                            </li>
                            <!-- <li>
                                <h4>Jaipur</h4>
                                <p>109 Avenue Léon, 63 Clermont-Ferrand <br />+91 9876543210</p>
                            </li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="" class="contactForm" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name" value="<?php echo isset($_POST['name'])?$_POST['name']:''; ?>" class="form-control" name="name">
                                <p class="error" style=""><?= isset($nameerr)?$nameerr:''; ?></p>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email" class="form-control" name="email" value="<?php echo isset($_POST['email'])?$_POST['email']:''; ?>">
                                <p class="error" style=""><?= isset($emailerr)?$emailerr:''; ?></p>

                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Phone" class="form-control" name="phone"value="<?php echo isset($_POST['phone'])?$_POST['phone']:''; ?>">
                                <p class="error" style=""><?= isset($phoneerr)?$phoneerr:''; ?></p>

                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Subject" class="form-control" name="subject"value="<?php echo isset($_POST['subject'])?$_POST['subject']:''; ?>">
                                <p class="error" style=""><?= isset($suberr)?$suberr:''; ?></p>

                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Message" class="form-control" name="message"><?php echo isset($_POST['message'])?$_POST['message']:''; ?></textarea>
                                <p class="error" style=""><?= isset($msgerr)?$msgerr:''; ?></p>

                                    <button type="submit" class="site-btn contact-submit-btn btn-product btn--animated">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
        </div>
<?php
    include("partial/footer.php");
?>