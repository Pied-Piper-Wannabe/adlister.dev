<!--Page for creating new advertisement listings-->
<div class="container">
    <div class="row">
        <div class="col-sm offset-sm-0 col-md-6 offset-md-3">
            <h1>Sell Stuff</h1>
        </div>
    </div>
    <div class="row topMargin">
        <div class="col-sm offset-sm-0 col-md-6 offset-md-3">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Name:</label>
                    <div class="col-10">
                        <input class="form-control" name="name" type="text" id="productNameText">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Brand:</label>
                    <div class="col-10">
                        <input class="form-control" name="brand" type="text" id="productBrandText">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label" for="exampleSelect1">Category:</label>
                    <div class="col-10">
                        <select class="form-control" name="category" id="productCategory">
                            <option>Software</option>
                            <option>Hardware</option>
                            <option>Rockets</option>
                            <option>Investment</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Price:</label>
                    <div class="col-10">
                        <input class="form-control" name="price" type="number" id="priceText">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Description:</label>
                    <div class="col-10">
                        <textarea class="form-control" name="description" placeholder="Product Description Here" id="descriptionTextarea" rows="5"></textarea>
                    </div>
                </div>
                <input type="file" name="photodir" class="form-control-file" id="uploadInput" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Photos must be smaller than 3mb and in one of the following formats: PNG, JPG, JPEG</small>
                <button type="submit" class="btn btn-success float-right topMargin">Submit</button>
            </form>
        </div>
    </div>
</div>
