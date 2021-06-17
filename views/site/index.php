<?php
/* @var $this yii\web\View */
/* 8-9J_bvWDSNj_BrFcoaKU0PIJPznDMYFf9YAqBjhmPyK3hiY_4ZgTyqUT6gmxeM-dKJDmKpromQSslfnKa3Bkw== */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>JSON API!</h1>
    </div>

    <div class="body-content">

        <h2 name="add">Add</h2>

        <div class="row">
            <div class="col-sm-6">
                <form action="/site/add" method="POST"  class="form-horizontal">
                    <div class="form-group">
                        <label for="inputToken" class="col-sm-2 control-label">Token</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputToken" name="_token" value="WDSNj_BrFcoaKU0PIJPznDMYFf9YAqBjhmPyK3">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputId" class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputId" name="id" value="32">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTitle" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputTitle" name="title" value="My title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDescription" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputDescription" name="description" value="This is why">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Add</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-6">
                <div class="res"></div>
            </div>
        </div>

        <h2 name="list">List</h2>

        <div class="row">
            <div class="col-sm-6">
                <form action="/site/get" method="GET"  class="form-horizontal">
                    <div class="form-group">
                        <label for="inputToken" class="col-sm-2 control-label">Token</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputToken" name="_token" value="WDSNj_BrFcoaKU0PIJPznDMYFf9YAqBjhmPyK3">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Get</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-6">
                <div class="res"></div>
            </div>
        </div>

        <h2 name="item">Item</h2>

        <div class="row">
            <div class="col-sm-6">
                <form action="/site/item" method="GET"  class="form-horizontal">
                    <div class="form-group">
                        <label for="inputToken" class="col-sm-2 control-label">Token</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputToken" name="_token" value="WDSNj_BrFcoaKU0PIJPznDMYFf9YAqBjhmPyK3">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputId" class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputId" name="id" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Get item</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-6">
                <div class="res"></div>
            </div>
        </div>

        <h2 name="delete">Delete</h2>

        <div class="row">
            <div class="col-sm-6">
                <form action="/site/delete" method="POST"  class="form-horizontal">
                    <div class="form-group">
                        <label for="inputToken" class="col-sm-2 control-label">Token</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputToken" name="_token" value="WDSNj_BrFcoaKU0PIJPznDMYFf9YAqBjhmPyK3">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputId" class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputId" name="id" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Delete item</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-6">
                <div class="res"></div>
            </div>
        </div>

    </div>
</div>
