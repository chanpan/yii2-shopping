<?php 
    $images = \Yii::getAlias('@storageUrl') . "/web/image/";
?>
<header style="background: #2d4059">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-6">
                <div id="logo">
                    <a href=" "><img src="<?= $image?>logo.png" title="Shopkit-04" alt="Shopkit-04" class="img-responsive center-block" /></a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 user-cart">
                <ul class="list-inline list-unstyled">
                    <li class="dropdown account"><a href="" title="Sign In" class="dropdown-toggle" data-toggle="dropdown"><span>Sign In</span> <img src="<?= $image?>user.png" alt="user"> </a>
                        <ul class="dropdown-menu dropdown-menu-right wrc-acl">
                            <li><a href="">Register</a></li>
                            <li><a href="">Login</a></li>
                        </ul>
                    </li>
                    <li>
                        <div id="cart" class="btn-group btn-block">
                            <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="btn btn-block btn-lg dropdown-toggle">
                                <span class="text-cart"> my cart</span> <img src="<?= $image?>cart.png" alt="cart"> 
                                <span id="cart-total" class= "cart-items cart-digit1 img img-circle">
                                    0   </span>
                            </button>
                            <ul class="dropdown-menu pull-right hr-ct-tlg">
                                <li>
                                    <p class="text-center">Your shopping cart is empty!</p>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-7 col-sm-12">
                <div id="search-by-category">
                  
                    <div id="sp-btn-search" class="">
                        <button type="button" id="btn-search-category" class="btn btn-default btn-lg">
                            <span class="search-s"><i class="fa fa-search"></i></span>
                        </button>
                    </div>
                    <div class="search-ajax">
                        <div class="ajax-loader-container" style="display: none; right: 0;">
                            <img src="<?= $image?>loader.gif" class="ajax-load-img center-block" width="80" height="80" alt="plazathemes.com" />
                        </div>
                        <div class="ajax-result-container">
                            <!-- Content of search results -->
                        </div>
                    </div>
                    <input type="hidden" id="ajax-search-enable" value="1" />
                </div>

                <?php 
                    $this->registerJS("
                         $(document).ready(function () {

                            var flag = false;
                            var ajax_search_enable = $('#ajax-search-enable').val();

                            var current_cate_value = $('ul.category-item li.selected').data('value');
                            var current_cate_text = $('ul.category-item li.selected').html();

                            $('.category-select').attr('data-value', current_cate_value);
                            $('.category-select').html(current_cate_text);

                            $('.all-category p').click(function () {
                                $(\".category-item\").slideToggle(\"slow\");
                            });

                            $('.ajax-result-container').hover(
                                    function () {
                                        flag = true;
                                    },
                                    function () {
                                        flag = false;
                                    }
                            );

                            $('.all-category').hover(
                                    function () {
                                        flag = true;
                                    },
                                    function () {
                                        flag = false;
                                    }
                            );

                            $('#search-by-category').focusout(function () {
                                if (flag === true) {
                                    $('.ajax-result-container').show();
                                } else {
                                    $('.ajax-result-container').hide();
                                }
                            });

                            $('#search-by-category').focusin(function () {
                                $('.ajax-result-container').show();
                            });


                             

                            $('#btn-search-category').click(function () {
                                var global_group = $('.category-select').attr('data-value');
                                var global_text_search = $('#text-search').val();
                                
                                var url = ' ';
                                var text_search = $('#text-search').val();
                                if (text_search) {
                                    url += '&search=' + encodeURIComponent(text_search);
                                }
                                var category_search = $('.category-select').attr(\"data-value\");
                                if (category_search) {
                                    url += '&category_id=' + encodeURIComponent(category_search);
                                }
                                //var group = $('.category-select').attr('data-value');
                                
                                
                               // location = url;
                            });

                            if (ajax_search_enable === '1') {
//                                $('#text-search').keyup(function (e) {
//                                    var text_search = $(this).val();
//                                    var cate_search = $('.category-select').attr(\"data-value\");
//                                    if (text_search != null && text_search != '') {
//                                        ajaxSearch(text_search, cate_search);
//                                    } else {
//                                        $('.ajax-result-container').html('');
//                                        $('.ajax-loader-container').hide();
//                                    }
//                                });

                                $('ul.category-item li.cat-i').click(function () {
                                    var cate_search = $(this).data('value');
                                    var text_search = $('#text-search').val();
                                    $('.category-select').attr('data-value', cate_search);
                                    $('.category-select').html($(this).html());
                                    if (text_search != null && text_search != '') {
                                         
                                    } else {
                                        $('.ajax-result-container').html('');
                                        $('.ajax-loader-container').hide();
                                    }
                                    $(\".category-item\").hide();
                                    $('#text-search').focus();
                                });

                            }

                            

                        });
                    ");
                ?>
            </div>
        </div>
    </div>
</header>
 