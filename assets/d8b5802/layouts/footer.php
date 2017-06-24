 <footer>

    <!--footer top full -->
    <div class="container-fluid">
      <div class="row">
        
         
        <?= $this->registerJS("
           $(\"#owl-testimonial\").owlCarousel({
              items: 3,
              lazyLoad: true,
              navigation: true,
              navigationText: ['<i class=\"fa fa-angle-left\"></i>', '<i class=\"fa fa-angle-right\"></i>'],
              autoPlay: 2000,
              singleItem: true,
              pagination: false
            });  
")?>
        
            
          <?= $this->registerJS("
              $(\"#owl-testimonial\").owlCarousel({
            items: 3,
            lazyLoad: true,
            navigation: true,
            navigationText: ['<i class=\"fa fa-angle-left\"></i>', '<i class=\"fa fa-angle-right\"></i>'],
            autoPlay: 2000,
            singleItem: true,
            pagination: false
          });
         ")?>
      </div>
    </div>
    <!--over-->

    <div class="footer-up">
      <div class="container">
        <div class="row inner-row">
          <div id="content-footer" class="col-sm-9">

            <div class="col-sm-4">
              <h5>
                My Account <button type="button" class="btn btn-primary toggle collapsed" data-toggle="collapse" data-target="#extra">                       
	  </button>
              </h5>
              <hr class="foothr hidden-xs">
              <div id="extra" class="collapse footer-collapse">
                <ul class="list-unstyled main-ul">
                  <li><a href="#t">My Account</a></li>
                  <li><a href="#">Order History</a></li>
                  <li><a href="#">Wish List</a></li>
                  <li><a href="#">Newsletter</a></li>
                  <li><a href="#">Site Map</a></li>
                </ul>
              </div>
            </div>

            <div class="col-sm-4">
              <h5>
                Information <button type="button" class="btn btn-primary toggle collapsed" data-toggle="collapse" data-target="#information">          
	  </button>
              </h5>
              <hr class="foothr hidden-xs">
              <div id="information" class="collapse footer-collapse">
                <ul class="list-unstyled main-ul">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Delivery Information</a></li>
                  <li><a href="#">Privacy Policy</a></li>
                  <li><a href="#">Terms &amp; Conditions</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
            </div>

            <div class="col-sm-4">
              <h5>
                Customer Service <button type="button" class="btn btn-primary toggle collapsed" data-toggle="collapse" data-target="#myaccount">                    
	   </button>
              </h5>
              <hr class="foothr hidden-xs">
              <div id="myaccount" class="collapse footer-collapse">
                <ul class="list-unstyled main-ul">
                  <li><a href="#">Brands</a></li>
                  <li><a href="#">Gift Certificates</a></li>
                  <li><a href="#">Affiliates</a></li>
                  <li><a href="#">Specials</a></li>
                  <li><a href="#">Returns</a></li>
                </ul>
              </div>
            </div>

          </div>
          <aside id="footer-right" class="col-sm-3 hidden-xs">
            <div>
              <div class="main-service">
                <h5>
                  Contact us
                  <button type="button" class="btn btn-primary toggle collapsed" data-toggle="collapse" data-target="#service">          
	   </button>
                </h5>
                <hr class="foothr hidden-xs">
                <div id="service" class="footer-collapse collapse" aria-expanded="false" role="link">
                  <ul class="list-unstyled main-ul">
                    <li><a href="index.php?route=information/contact"><i class="fa fa-map-marker" aria-hidden="true"></i>Frankfurt, Germany</a></li>
                    <li><a href="index.php?route=information/contact"><i class="fa fa-envelope-o" aria-hidden="true"></i>website@info.com</a></li>
                    <li><a href="index.php?route=information/contact"><i class="fa fa-phone" aria-hidden="true"></i>Phone: +98 7654 321</a></li>
                    <li><a href="index.php?route=information/contact"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>Australia Melborne, 58 street</a></li>
                  </ul>
                </div>
              </div>
            </div>
             <?= $this->registerJS("
                $(\"#owl-testimonial\").owlCarousel({
                    items: 3,
                    lazyLoad: true,
                    navigation: true,
                    navigationText: ['<i class=\"fa fa-angle-left\"></i>', '<i class=\"fa fa-angle-right\"></i>'],
                    autoPlay: 2000,
                    singleItem: true,
                    pagination: false
                  });
             ")?>
          </aside>
        </div>
      </div>
    </div>
    <!--footer bottom full -->
    <div class="container-fluid">
      <div class="row">
        <div>
          <div class="container-fluid footer_bottom">
            <div class="row">
              <div class="container">
                <div class="row">
                  <div class="col-xs-12">
                    <p class="footer-paragraph text-center"> Powered By <a href="http://www.opencart.com">OpenCart</a> Demo Store © 2017</p>
                    <ul class="list-inline list-unstyled text-center">
                      <li><a href="#"><img class="img img-responsive" src="<?= $image?>mastercard.png" alt="master-card"></a></li>
                      <li><a href="#"><img class="img img-responsive" src="<?= $image?>moneypad.png" alt="moneypad"></a></li>
                      <li><a href="#"><img class="img img-responsive" src="<?= $image?>card.png" alt="card"></a></li>
                      <li><a href="#"><img class="img img-responsive" src="<?= $image?>paypal.png" alt="paypal"></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
         <?= $this->registerJS("
         $(\"#owl-testimonial\").owlCarousel({
                items: 3,
                lazyLoad: true,
                navigation: true,
                navigationText: ['<i class=\"fa fa-angle-left\"></i>', '<i class=\"fa fa-angle-right\"></i>'],
                autoPlay: 2000,
                singleItem: true,
                pagination: false
              });
")?>
      </div>
    </div>
    <!--over-->

  </footer>
<a href="" id="scroll" title="Scroll to Top" style="display: block;"><i class="fa fa-caret-up"></i></a>