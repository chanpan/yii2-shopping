<nav id="top" style="background: #263952">
    <div class="container">

        <div class="currency-language pull-right">
            <div class="pull-left">
                <form action="" method="post" enctype="multipart/form-data" id="form-language">
                    <div class="btn-group">
                        <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= $image?>en-gb.png" alt="English" title="English">
                            <span class="hidden-xs hidden-sm hidden-md">Language</span> <i class="fa fa-caret-down"></i></button>
                        <ul class="dropdown-menu dropdown-menu-right wrl-tlg">
                            <li><button class="btn btn-link btn-block language-select" type="button" name="ar"><img src="<?= $image?>ar.png" alt="Arabic" title="Arabic" /> Arabic</button></li>
                            <li><button class="btn btn-link btn-block language-select" type="button" name="en-gb"><img src="<?= $image?>en-gb.png" alt="English" title="English" /> English</button></li>
                        </ul>
                    </div>
                    <input type="hidden" name="code" value="" />
                    <input type="hidden" name="redirect" value="" />
                </form>
            </div>
            <div class="pull-left">
                <form action=" " method="post" enctype="multipart/form-data" id="form-currency">
                    <div class="btn-group">
                        <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <strong>$</strong>
                            <span class="hidden-xs hidden-sm hidden-md">Currency</span> <i class="fa fa-caret-down"></i></button>
                        <ul class="dropdown-menu dropdown-menu-right wrc-tlg">
                            <li><button class="currency-select btn btn-link btn-block" type="button" name="EUR">€ Euro</button></li>
                            <li><button class="currency-select btn btn-link btn-block" type="button" name="GBP">£ Pound Sterling</button></li>
                            <li><button class="currency-select btn btn-link btn-block" type="button" name="USD">$ US Dollar</button></li>
                        </ul>
                    </div>
                    <input type="hidden" name="code" value="" />
                    <input type="hidden" name="redirect" value="" />
                </form>
            </div>
        </div>
        <div id="top-links" class="nav pull-left hidden-xs">
            <ul class="list-unstyled">
                <li><a class="top-right">1st Time Buyer? Use "ONE" promocode to instantly get 10% OFF!</a></li>
            </ul>
        </div>
    </div>
</nav>