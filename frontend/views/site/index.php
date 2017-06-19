<?php

use yii\helpers\Url;
use yii\helpers\Html;

$image = \Yii::getAlias('@storageUrl') . "/web/image/";

$this->title = Yii::$app->name;
?>  
<div class="container">
    <div class="row">
        <div id="content" class="col-sm-12">
            <div class="slideshow-panel">
                <div id="slideshow0" class="owl-carousel slideshow" style="opacity: 1;">
                    <div class="item">
                        <a href="index.php?route=product/product&amp;path=57&amp;product_id=49">
                            <img src="<?= $image; ?>1-1170x400.jpg" alt="iPhone 6" class="img-responsive" /></a>
                    </div>
                    <div class="item">
                        <img src="<?= $image; ?>2-1170x400.jpg" alt="MacBookAir" class="img-responsive" />
                    </div>
                </div>
            </div>
            <?= $this->registerJS("
                    $(document).ready(function () {

                    var time = 7;  
                    var \$progressBar,
                      \$bar,
                      \$elem,
                      isPause,
                      tick,
                      percentTime;

                    //Init the carousel
                    $('#slideshow0').owlCarousel({
                      slideSpeed: 500,
                      paginationSpeed: 500,
                      singleItem: true,
                      navigation: true,
                      navigationText: ['<i class=\"fa fa-caret-left fa-5x\"></i>', '<i class=\"fa fa-caret-right fa-5x\"></i>'],
                      pagination: false,
                      afterInit: progressBar,
                      afterMove: moved,
                      startDragging: pauseOnDragging
                    });
                  
                    function progressBar(elem) {
                      \$elem = elem;
                      //build progress bar elements
                      buildProgressBar();
                      //start counting
                      start();
                    }
                    function buildProgressBar() {
                      \$progressBar = $(\"<div>\", {
                        id: \"progressBar\"
                      });
                      \$bar = $(\"<div>\", {
                        id: \"bar\"
                      });
                      \$progressBar.append(\$bar).prependTo(\$elem);
                    }
                    function start() {
                      //reset timer
                      percentTime = 0;
                      isPause = false;
                      //run interval every 0.01 second
                      tick = setInterval(interval, 10);
                    };

                    function interval() {
                      if (isPause === false) {
                        percentTime += 1 / time;
                        \$bar.css({
                          width: percentTime + \"%\"
                        });
                        //if percentTime is equal or greater than 100
                        if (percentTime >= 100) {
                          //slide to next item 
                          \$elem.trigger('owl.next')
                        }
                      }
                    }

                    //pause while dragging 
                    function pauseOnDragging() {
                      isPause = true;
                    }

                    //moved callback
                    function moved() {
                      //clear interval
                      clearTimeout(tick);
                      //start again
                      start();
                    }
                  });
            ") ?>



            <?= $this->render("banner", ["image" => $image]); ?>
        </div>
    </div>
</div> 