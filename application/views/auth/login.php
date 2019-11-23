<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('user/temp/header',$header); ?>
<body class="login-page sidebar-collapse">
<div class="page-header header-filter" style="background-image: url('https://images.ctfassets.net/wy4h2xf1swlt/asset_29564/2404f41bd98c21a763172984fc609bf9/New-Zealand-dairy-farm.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
            <div class="card card-nav-tabs">
                <div class="card-header card-header-success text-center">
                    <h2>Login</h2>
                </div>
                <div class="card-body">
                    <?php if ($this->session->message) {
                        $message['msg']=$this->session->message;
                        $this->load->view('user/temp/alert',$message);
                    } ?>
                    <form action="" method="post">
                        <div class="form-group label-floating has-success">
                            <label class="control-label">Username</label>
                            <input type="text" name="username" placeholder="Yuninda Eka" class="form-control" required />
                        </div>
                        <div class="form-group label-floating has-success">
                            <label class="control-label">Password</label>
                            <input type="password" name="password" placeholder="Password" class="form-control" required />
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="<?php echo base_url('register') ?>" class="btn btn-secondary btn-block btn-lg">Register</a>
                            </div>
                            <div class="col-md-6">
                                <input type="submit" value="Login" class="btn btn-success btn-block btn-lg">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
</body>
</html>