<!DOCTYPE html>
 <html lang="en">
 <?php $this->load->view('temp/header'); ?>

 <body class="index-page sidebar-collapse">
   <?php $this->load->view('temp/nav'); ?>
   
    <?php $this->load->view($page)?>

   <?php $this->load->view('temp/footer'); ?>
 </body>

 </html>