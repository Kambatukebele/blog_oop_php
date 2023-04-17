<?php $this->LOAD_VIEW("blog/header", $data);  ?>
<!-- Navbar End -->

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="container">
        <nav class="breadcrumb bg-transparent m-0 p-0">
            <a class="breadcrumb-item" href="<? ROOT ?>">Home</a>
            <span class="breadcrumb-item active">Register</span>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Contact Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Create Your Account</h3>
            <?php if (isset($data['errors'])) : ?>
            <div class="alert alert-danger">Please fix the error bellow</div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                    <div id="success"></div>
                    <form method="POST">
                        <div class="form-row">
                            <div class="col-md-6 py-1">
                                <div class="control-group">
                                    <input type="text" class="form-control p-4" name="firstname" id="name"
                                        placeholder="Your First Name" value="<?= REMEMBER_INPUTS('firstname'); ?>" />
                                    <?php if (isset($data['errors']['error_firstname'])) : ?>
                                    <p class="help-block text-danger"><?= $data['errors']['error_firstname']; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6 py-1">
                                <div class="control-group">
                                    <input type="text" class="form-control p-4" name="lastname" id="last name"
                                        placeholder="Your Last Name" value="<?= REMEMBER_INPUTS('lastname'); ?>" />
                                    <?php if (isset($data['errors']['error_lastname'])) : ?>
                                    <p class="help-block text-danger"><?= $data['errors']['error_lastname']; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="col-md-6 py-1">
                                <div class="control-group">
                                    <input type="email" class="form-control p-4" name="email" id="email"
                                        placeholder="Your Email" value="<?= REMEMBER_INPUTS('email'); ?>" />
                                    <?php if (isset($data['errors']['error_email'])) : ?>
                                    <p class="help-block text-danger"><?= $data['errors']['error_email']; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6 py-1">
                                <div class="control-group">
                                    <input type="password" class="form-control p-4" name="password" id="password"
                                        placeholder="Your Password" />
                                    <?php if (isset($data['errors']['error_password'])) : ?>
                                    <p class="help-block text-danger"><?= $data['errors']['error_password']; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="pt-3">
                            <button class="btn btn-primary font-weight-semi-bold px-4" style="height: 50px;"
                                type="submit" id="sendMessageButton">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<!-- Footer Start -->
<?php $this->LOAD_VIEW("blog/footer");  ?>