<template>
    <div>
        <div class="row row-wpanels justify-content-center gx-md-5">
            <div class="col-wpanels col-4 col-xxl-4 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="p-cat-1" name="category" data-delete="fw-panel" value="1" />
                <label for="p-cat-1">
                    <div class="radio-img">
                        <img class="img-fluid w-100" src="/media/components/fw-panel.jpg" alt="Decopanel" />
                    </div>
                    <div class="radio-txt">Formwood panel</div>
                </label>
            </div>

            <div class="col-wpanels col-4 col-xxl-4 mb-1 mb-sm-4">
                <input class="fw-product-builder-radio" type="radio" id="p-cat-2" name="category" data-delete="fw-sheet" value="2" />
                <label for="p-cat-2">
                    <div class="radio-img">
                        <img class="img-fluid w-100" src="/media/components/fw-sheet.jpg" alt="Formwood Sheet" />
                    </div>
                    <div class="radio-txt">Formwood Sheet</div>
                </label>
            </div>

            <div class="col-wpanels col-4 col-xxl-4 mb-1 mb-sm-4">
                <form class="mb-5">
                    <div class="row">
                        <div class="col-sm-12 col-lg-5 mb-2 mb-lg-0">
                            <div class="fw-drager p-block mb-2">
                                <h4 class="mb-3 fwp-size-h">Size</h4>
                                <form action="/" method="post" id="panel_drager_form">
                                    <div class="custom-radiobtn">
                                        <input type="radio" id="panel_drager0" name="panel_drager" value="1" />
                                        <label for="panel_drager0">48 x 96</label>
                                    </div>
                                    <div class="custom-radiobtn">
                                        <input type="radio" id="panel_drager1" name="panel_drager" value="2" checked="checked" />
                                        <label for="panel_drager1">48 x 120</label>
                                    </div>
                                    <div class="custom-radiobtn">
                                        <input type="radio" id="panel_drager2" name="panel_drager" value="3" />
                                        <label for="panel_drager2">48 x 144</label>
                                    </div>
                                    <div class="custom-radiobtn">
                                        <input type="radio" id="panel_drager3" name="panel_drager" value="4" />
                                        <label for="panel_drager3">60 x 96</label>
                                    </div>
                                    <div class="custom-radiobtn">
                                        <input type="radio" id="panel_drager4" name="panel_drager" value="5" />
                                        <label for="panel_drager4">60 x 120</label>
                                    </div>
                                    <div class="custom-radiobtn">
                                        <input type="radio" id="panel_drager5" name="panel_drager" value="6" />
                                        <label for="panel_drager5">60 x 144</label>
                                    </div>
                                    <div class="custom-radiobtn">
                                        <input type="radio" id="panel_drager6" name="panel_drager" value="7" />
                                        <label for="panel_drager6">96 x 48</label>
                                    </div>
                                    <div class="custom-radiobtn">
                                        <input type="radio" id="panel_drager7" name="panel_drager" value="8" />
                                        <label for="panel_drager7">120 x 48</label>
                                    </div>
                                    <div class="custom-radiobtn">
                                        <input type="radio" id="panel_drager8" name="panel_drager" value="9" />
                                        <label for="panel_drager8">144x48</label>
                                    </div>
                                    <div class="custom-radiobtn">
                                        <input type="radio" id="panel_drager9" name="panel_drager" value="10" />
                                        <label for="panel_drager9">96 x 60</label>
                                    </div>
                                    <div class="custom-radiobtn">
                                        <input type="radio" id="panel_drager10" name="panel_drager" value="11" />
                                        <label for="panel_drager10">120 x 60</label>
                                    </div>
                                    <div class="custom-radiobtn">
                                        <input type="radio" id="panel_drager11" name="panel_drager" value="12" />
                                        <label for="panel_drager11">144x60</label>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-7 mb-2 mb-lg-0">
                            <div class="form-group">
                                <span class="form-control-spe select-slicing">
                                    <select class="form-control valid" name="slicing" aria-invalid="false">
                                        <option value=".s-1" data-id="1">100</option>
                                        <option value=".s-2" data-id="2">200</option>
                                        <option value=".s-3" data-id="3">400</option>
                                        <option value=".s-4" data-id="4">500</option>
                                    </select>
                                    <label>Select quantity</label>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Product-cat",
        data() {
            return {
                imgpath: "/media/components",
            };
        },
    };
</script>
