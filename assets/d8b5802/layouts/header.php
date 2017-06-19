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
                    <div class="search-container">
                        <input type="text" name="search" id="text-search" value="" placeholder="Search For Product" class="" />
                        <div class="all-category">
                            <p><span class="category-select" data-value="0">All Categories</span></p>
                            <ul class="category-item">
                                <li class="cat-i" data-value="0">All Categories</li>
                                <li data-value="20" class="cat-i">Desktops</li>
                                <li data-value="26" class="cat-i">PC</li>
                                <li data-value="57" class="cat-i">Tablets</li>
                                <li data-value="17" class="cat-i">Software</li>
                                <li data-value="24" class="cat-i">Phones &amp; PDAs</li>
                                <li data-value="27" class="cat-i">Mac</li>
                                <li data-value="58" class="cat-i">test 25</li>
                                <li data-value="40" class="cat-i">test 7</li>
                                <li data-value="42" class="cat-i">test 9</li>
                                <li data-value="18" class="cat-i">Laptops</li>
                                <li data-value="46" class="cat-i">Macs</li>
                                <li data-value="48" class="cat-i">test 16</li>
                                <li data-value="25" class="cat-i">Components</li>
                                <li data-value="45" class="cat-i">Windows</li>
                                <li data-value="33" class="cat-i">Cameras</li>
                                <li data-value="34" class="cat-i">MP3 Players</li>
                                <li data-value="43" class="cat-i">test 11</li>
                                <li data-value="49" class="cat-i">test 17</li>
                                <li data-value="50" class="cat-i">test 18</li>
                                <li data-value="51" class="cat-i">test 19</li>
                                <li data-value="44" class="cat-i">test 12</li>
                                <li data-value="52" class="cat-i">test 20</li>
                                <li data-value="53" class="cat-i">test 21</li>
                                <li data-value="54" class="cat-i">test 22</li>
                                <li data-value="55" class="cat-i">test 23</li>
                                <li data-value="41" class="cat-i">test 8</li>
                                <li data-value="47" class="cat-i">test 15</li>
                                <li data-value="56" class="cat-i">test 24</li>
                                <li data-value="38" class="cat-i">test 4</li>
                                <li data-value="37" class="cat-i">test 5</li>
                                <li data-value="39" class="cat-i">test 6</li>
                            </ul>
                        </div>
                    </div>
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


                            $('#text-search').keypress(function (e) {
                                if (e.which === 13) { //Enter key pressed
                                    $('#btn-search-category').click();//Trigger search button click event
                                }
                            });

                            $('#btn-search-category').click(function () {
                                var url = ' ';
                                var text_search = $('#text-search').val();
                                if (text_search) {
                                    url += '&search=' + encodeURIComponent(text_search);
                                }
                                var category_search = $('.category-select').attr(\"data-value\");
                                if (category_search) {
                                    url += '&category_id=' + encodeURIComponent(category_search);
                                }
                                location = url;
                            });

                            if (ajax_search_enable === '1') {
                                $('#text-search').keyup(function (e) {
                                    var text_search = $(this).val();
                                    var cate_search = $('.category-select').attr(\"data-value\");
                                    if (text_search != null && text_search != '') {
                                        ajaxSearch(text_search, cate_search);
                                    } else {
                                        $('.ajax-result-container').html('');
                                        $('.ajax-loader-container').hide();
                                    }
                                });

                                $('ul.category-item li.cat-i').click(function () {
                                    var cate_search = $(this).data('value');
                                    var text_search = $('#text-search').val();
                                    $('.category-select').attr('data-value', cate_search);
                                    $('.category-select').html($(this).html());
                                    if (text_search != null && text_search != '') {
                                        ajaxSearch(text_search, cate_search);
                                    } else {
                                        $('.ajax-result-container').html('');
                                        $('.ajax-loader-container').hide();
                                    }
                                    $(\".category-item\").hide();
                                    $('#text-search').focus();
                                });

                            }

                            function ajaxSearch(text_search, cate_search) {
                                $.ajax({
                                    url: '',
                                    type: 'post',
                                    data: {text_search: text_search, cate_search: cate_search},
                                    beforeSend: function () {
                                        $('.ajax-loader-container').show();
                                    },
                                    success: function (json) {
                                        if (json['success'] == true) {
                                            $('.ajax-result-container').html(json['result_html']);
                                            $('.ajax-loader-container').hide();
                                        }
                                    }
                                });
                            }

                        });
                    ");
                ?>
            </div>
        </div>
    </div>
</header>