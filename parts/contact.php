 
<?php

include "php/databaze.php";

use main\Menu;

$menu = new Menu();

if(isset($_POST['submit'])){
    if(!empty($_POST['name']) && !empty($_POST['phone_number']) && !empty($_POST['contact_email']) && !empty($_POST['message'])){
        $menu->contact($_POST['name'], $_POST['phone_number'], $_POST['contact_email'], $_POST['message']);
        echo "<script> alert('Vaša správa bola prijatá!') </script>";
    }else{
        echo "<script> alert('Treba vyplniť všetky údaje!') </script>";
    }
}

?>

 <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Contact Us
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">

            <form action="contact.php" method="post">
              <div>
                <input type="text" name="name" placeholder="Your Name" />
              </div>
              <div>
                <input type="text" name="phone_number" placeholder="Phone Number" />
              </div>
              <div>
                <input type="email" name="contact_email" placeholder="Email" />
              </div>
              <div>
                <input type="text" name="message" class="message-box" placeholder="Message"/>
              </div>
              <div class="btn_box">               
                <button type="submit" name="submit"> SEND </button>
              </div>
            </form>


          </div>
        </div>
        <div class="col-md-6 ">
          <div class="map_container">
            <div class="map">
              <div id="googleMap"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->