<!--Page that includes the form to edit an existing ad-->
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Name:</label>
                    <div class="col-10">
                        <input class="form-control" type="text" name="name" id="productNameText" value="<?=$name?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label" for="exampleSelect1">Category:</label>
                    <div class="col-10">
                        <select class="form-control" name="category" id="productCategory">
                            <option><?=$category?></option>
                            <option>Software</option>
                            <option>Hardware</option>
                            <option>Rockets</option>
                            <option>Investment</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Brand:</label>
                    <div class="col-10">
                        <input class="form-control" type="text" name="brand" id="brandText" value="<?=$brand?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Price:</label>
                    <div class="col-10">
                        <input class="form-control" type="number" name="price" id="priceText" value="<?=$price?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Description:</label>
                    <div class="col-10">
                        <textarea class="form-control" placeholder="Product Description Here" name="description" id="descriptionTextarea" rows="5"><?=$description?></textarea>
                    </div>
                </div>
                <input type="file" class="form-control-file" name="photodir" id="photoedit" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Photos must be smaller than 3mb and in one of the following formats: PNG, JPG, JPEG</small>
                <button type="submit" class="btn btn-success float-right">Update</button>
            </form>
        </div>
    </div>
</div>
